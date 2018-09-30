@extends('main')

@section('title', 'Register')

@section('content')
  <div class="container-fluid register-page-wrapper">
    <div class="row">
      <div class="offset-md-4 col-md-4">
        <div class="bg-white p-4">
          <h5 class="text-center mb-3">Register</h5>
          <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" placeholder="First name" name="fname" value="{{ old('fname') }}">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Middle name (optional)" name="mname" value="{{ old('mname') }}">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Last name" name="lname" value="{{ old('lname') }}">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Phone number (optional)" name="phone" value="{{ old('phone') }}" autocomplete="off">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" value="Female"
                {{ old('gender') === 'Female' ? 'checked' : '' }}>Female
              </label>
            </div>
            <div class="form-check-inline mb-2">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="gender" value="Male"
                {{ old('gender') ==='Male' ? 'checked' : '' }}>Male
              </label>
            </div>                
            <div class="form-group">
              <label class="control-label " for="birthday">Birthday</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">        
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input class="form-control" id="birthday" name="birthday" value="{{ old('birthday') }}" placeholder="MM/DD/YYYY" type="text" autocomplete="off"/>
              </div>
            </div>
            <div class="input-group my-3">
              <div class="input-group-prepend">
                <span class="input-group-text">I am a</span>
              </div>
              <select class="form-control" id="user-type" name="user_type">
                <option value="Patient" {{old('user_type') === "Patient" ? 'selected' : ''}}>
                  Patient
                </option>          
                <option value="Doctor" {{old('user_type') === "Doctor" ? 'selected' : ''}}>
                  Doctor
                </option>
              </select>
            </div>
            <p>Upload a profile image:</p>
            <input type="file" name="avatar">                    
            <button type="submit" class="btn btn-primary btn-block mt-5">Sign Up</button>
          </form> 
          <div class="text-center mt-4">
            <a href="{{route('login')}}" class="text-muted">
              <i class="fas fa-sign-in-alt"></i> Have an account? Log in
            </a>            
          </div>
        </div>      
      </div>
    </div>
  </div><!-- register-page-wrapper end -->
@endsection