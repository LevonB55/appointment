<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Doctor;
use App\Http\Requests\UpdateUserInfo;
use App\Http\Requests\SearchDoctors;
use Image;
use Storage;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type', '=', 'Doctor')->orderBy('id','desc')->paginate(4);        
        return view('users.index', ['users' => $users]);
    }

    public function searchDoctors(SearchDoctors $request) 
    {
      $validated = $request->validated();

      $doctors =  User::join('doctors', 'doctors.user_id', '=', 'users.id')
                        ->select('users.id','users.fname', 'users.lname', 'users.gender', 'users.avatar', 'doctors.profession')
                        ->where('fname', 'like', "%$request->search%")
                        ->orwhere('lname', 'like', "%$request->search%")
                        ->orwhere('profession', 'like', "%$request->search%")
                        ->paginate(2);                        
                        
      $doctors->appends(['search' => $request->search]);

      return view('users.search', ['doctors' => $doctors]);

    }

    public function searchDoctorsDropdown(Request $request)
    {
      $doctors =  User::join('doctors', 'doctors.user_id', '=', 'users.id')
                        ->select('users.id','users.fname', 'users.lname', 'users.gender', 'users.avatar', 'doctors.profession')
                        ->where('fname', 'like', "$request->search%")
                        ->orwhere('lname', 'like', "$request->search%")
                        ->orwhere('profession', 'like', "$request->search%")
                        ->take(4)
                        ->get();

      return json_encode($doctors);
      die();
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
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserInfo $request, $id)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        $user = User::find($id);

        $user->fname = $request->fname;
        $user->mname = $request->mname;
        $user->lname = $request->lname;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $fileName = time() . '.' . $request->avatar->extension();
            $location = storage_path('app/public/images/' . $fileName);
            Image::make($avatar)->resize(140,140)->save($location);

            if($user->avatar) {
                $oldFileName = $user->avatar;
                Storage::disk('local')->delete('public/images/' . $oldFileName);
            }

            $user->avatar = $fileName;
        }

        $user->save();          

        $doctor = Doctor::where('user_id', '=', $user->id)->first();

        $doctor->profession = ucfirst(strtolower(strip_tags($request->profession)));
        $doctor->experience = $request->experience;
        $doctor->background = strip_tags($request->background);                        

        $doctor->save();

        Session::flash('success', 'Your profile was successfully updated.'); 

        return redirect()->route('user.show', $user->id);
    }    
}
