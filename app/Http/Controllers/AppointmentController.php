<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAppointmentDate;
use App\Http\Requests\CancelAppointmentDate;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelAppointment;
use App\Appointment;
use App\User;
use Session;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $user = User::find($id);
        
        $scheduledAppointments = Appointment::where('user_id', '=', $user->id)          
        ->join('users', 'appointments.patient_id', '=', 'users.id')
        ->select('appointments.id as appointment_id', 'appointments.date', 'appointments.patient_id', 'appointments.made_at', 'users.fname', 'users.email' )
        ->get();

        $collection = collect($scheduledAppointments->toArray());

        $scheduledAppointmentsSorted = $collection->sortBy('date');
        
        $collection = collect($scheduledAppointmentsSorted->toArray());       

        $scheduledAppointmentsGrouped = $collection->mapToGroups(function ($item, $key) {
            return [date('Y-m-d', strtotime($item['date'])) => 
                    [
                        'appointment_id' => $item['appointment_id'], 
                        'date'           => date('Y-m-d G:i:s', strtotime($item['date'])),
                        'patient_id'     => $item['patient_id'],
                        'made_at'        => $item['made_at'],
                        'first_name'     => $item['fname'],
                        'email'          => $item['email']
                    ]
            ];
        });        
        
        return view('appointments.index', [
            'user' => $user,
            'scheduledAppointments' => $scheduledAppointmentsGrouped
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::find($id);
        $collection = collect($user->appointments);
        $doctorAppointments = $collection->sortBy('date');
        
        return view('appointments.create', ['appointments' => $doctorAppointments->values()->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentDate $request)
    {
        $validated = $request->validated();

        $appointment = new Appointment;        

        $appointment->date = date('Y-m-d G:i:s', strtotime($request->date));
        $appointment->user_id = $request->user()->id;
        $appointment->taken = Appointment::APPOINTMENT_OPEN;

        $appointment->save();

        Session::flash('success', 'You added a new date.'); 

        return redirect()->route('appointments.create', $appointment->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $collection = collect($user->appointments);
        $doctorAppointments = $collection->sortBy('date');

        $appointmentDates = [];

        foreach ($doctorAppointments->values()->all() as $appointment) {
            $appointmentDates[$appointment->id] = date('M j, Y', strtotime($appointment->date));
        }

        $dates = array_unique($appointmentDates);
        
        return view('appointments.show', ['user' => $user, 'dates' => $dates]);
    }

    public function showAppointmentHours($id)
    {
        $appointment = Appointment::find($id);
        $createdAppointments = Appointment::where([
            ['user_id', '=', $appointment->user_id], 
            ['taken', '=', Appointment::APPOINTMENT_OPEN]
        ])->get();

        $createdHours = [];
        foreach ($createdAppointments as $app) {
            $createdHours[$app->id] = $app->date;
        }

        $collection = collect($createdHours);
        $createdHoursSorted = $collection->sort();

        $collection = collect($createdHoursSorted);

        $setHours = $collection->filter(function ($value, $key) use($appointment) {
            return date('Y-m-d', strtotime($value)) == date('Y-m-d', strtotime($appointment->date));
        });
        
        return view('appointments.showhours', ['appointment' => $appointment, 'setHours' => $setHours]);
    }

    public function makeAppointment(StoreAppointmentDate $request, $id)
    {
        $validated = $request->validated();        

        $appointment = Appointment::find($id);

        $appointment->date = $request->date;
        $appointment->patient_id = $request->user()->id;
        $appointment->made_at = date('Y-m-d G:i:s');
        $appointment->taken = Appointment::APPOINTMENT_TAKEN;

        $appointment->save();

        return redirect()->route('appointments.confirmed', $appointment->id);
    }

    public function confirmedAppointment($id)
    {
        $appointment = Appointment::find($id);
        $user = User::where('id', $appointment->user_id)->first();
        return view('appointments.confirmed', ['appointment' => $appointment, 'user' => $user]);
    }    

    public function cancelAppointment(CancelAppointmentDate $request, $id)
    {
        $appointment = Appointment::find($id);

        $validated = $request->validated();        

        $appointment->patient_id = Appointment::EMPTY_VALUE;
        $appointment->taken = Appointment::APPOINTMENT_OPEN;
        $appointment->made_at = Appointment::EMPTY_VALUE;

        $appointment->save();

        Session::flash('success', 'You canceled an appointment with ' . $request->patient_name . '!'); 

        if($request->textarea) {
            Mail::to($request->patient_email)->send(new CancelAppointment($request->textarea));
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        $userId = $appointment->user_id;
        $appointment->delete();

        Session::flash('success', 'You deleted a date.'); 

        return redirect()->route('appointments.create', $userId);
    }
}
