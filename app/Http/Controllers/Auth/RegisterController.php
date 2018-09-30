<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Doctor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Image;
use Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected function redirectTo()
    {
        return '/user/'. Auth::id();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname'     => 'required|string|min:2|max:255',
            'mname'     => 'nullable|string|min:2|max:255',
            'lname'     => 'required|string|min:2|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'phone'     => 'nullable|string|min:4|max:255|unique:users',            
            'password'  => 'required|string|min:6|confirmed',
            'gender'    => 'required|string',
            'birthday'  => 'required|string',
            'user_type' => 'required|string',
            'avatar'    => 'nullable|image'            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $fileName = null;

        if($_FILES['avatar']['name']) {
            $avatar = $_FILES['avatar']['name'];
            $tmp = explode('.', $avatar);
            $extension = end($tmp);
            $fileName = time() . '.' . $extension;
            $location = storage_path('app/public/images/' . $fileName);
            Image::make($_FILES['avatar']['tmp_name'])->resize(140,140)->save($location);
        }

        $user = User::create([
            'fname'     => ucfirst(strtolower(strip_tags($data['fname']))),
            'mname'     => ucfirst(strtolower(strip_tags($data['mname']))),
            'lname'     => ucfirst(strtolower(strip_tags($data['lname']))),
            'email'     => strtolower($data['email']),
            'phone'     => $data['phone'],
            'password'  => Hash::make($data['password']),
            'gender'    => strtolower($data['gender']),
            'birthday'  => $data['birthday'],
            'user_type' => $data['user_type'],
            'avatar'    => $fileName
        ]);

        if($data['user_type'] === 'Doctor') {
            Doctor::create([
                'user_id' => $user->id
            ]);
        }

        $user->assignRole(strtolower($data['user_type']));

        return $user;
    }
}
