@extends('main')

@section('title', 'Appointments List')

@section('content')
<div class="appointsbook-page-wrapper">
@if(count($scheduledAppointments->toArray()) === 0)
   <div class="alert alert-info">
      <div>There is no appointment made!</div>
   </div>   
@endif
@foreach($scheduledAppointments as $dayOfWeek => $timeOfDay)
   <div class="container appoint-date mt-5">
      <h6>{{ date('l, F j, Y', strtotime($dayOfWeek))  }}</h6>
      <hr/>
      @foreach($timeOfDay as $time)
         <div class="container appoint-block">
            <div class="row">
               <div class="col-md-1 appoint-sign text-right pr-0"><i class="fas fa-circle"></i></div>
               <div class="col-md-2 pt-2">{{ date('g:ia', strtotime($time['date']))  }}</div>
               <div class="offset-md-1 col-md-2 pt-2">
                  <span class="text-primary font-weight-bold">
                     <a href="{{route('user.show', $time['patient_id'])}}">
                        {{$time['first_name']}}
                     </a>
                  </span> with you
               </div>
               <div class="col-md-2 offset-md-4 text-primary pt-2 hand cancel-appoint">  
                  <span class="details">Details <i class="fas fa-angle-down"></i></span>
                  <span class="closed">Close <i class="fas fa-times"></i></span>
               </div>
            </div>
            <div class="row collapse p-4 details-content">
               <div class="offset-md-1 col-md-2 text-muted" data-toggle="modal" data-target="#cancel-popup-{{$time['appointment_id']}}">
                  <span class="border d-inline-block p-2 pr-5 hand touch">
                     <i class="far fa-trash-alt"></i> Cancel
                  </span>
               </div>
               <div class="offset-md-1 col-md-8 border-top">
                  <h6 class="font-weight-bold mt-3">EMAIL</h6>
                  <h6 class="mb-4">{{$time['email']}}</h6>
                  <h6 class="text-muted font-italic">
                     <small>created at {{ date('F j, Y', strtotime($time['made_at']))  }}</small>
                  </h6>
               </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="cancel-popup-{{$time['appointment_id']}}">
               <div class="modal-dialog p-5">
                  <div class="modal-content">

                     <!-- Modal Header -->
                     <div>
                        <h4 class="text-center mt-3">Cancel Appointment</h4>
                     </div>

                     <!-- Modal body -->
                     <form action="{{route('appointments.cancel', $time['appointment_id'])}}" method="POST">
                        @csrf
                        <div class="modal-body">
                           <h6 class="text-center">
                              <a href="{{route('user.show', $time['patient_id'])}}">
                                 {{$time['first_name']}}
                              </a>
                           </h6>
                           <h6 class="text-center mb-3">{{ date('g:ia', strtotime($time['date']))  }}</h6>
                           <p>Please confirm that you would like to cancel this appointment.</p>
                           <input type="hidden" value="{{$time['first_name']}}" name="patient_name">
                           <input type="hidden" value="{{$time['email']}}" name="patient_email">
                           <div class="form-group">
                              <textarea class="form-control change" rows="4" 
                              placeholder="Add an optional cancellation message." name="textarea"></textarea>
                           </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="p-3">
                           <input type="submit" class="btn btn-primary" value="Cancel Appointment">
                           <button type="button" class="btn btn-light w-50" data-dismiss="modal">
                              Back
                           </button>
                        </div>
                     </form>            
                  </div>
               </div>
            </div>
         </div>
      @endforeach
   </div><!-- appoint-date end -->
@endforeach

</div><!-- appointsbook-page-wrapper end -->
@endsection