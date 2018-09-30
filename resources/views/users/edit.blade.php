@extends('main')

@section('title', 'Update Your Profile')

@section('content')
	<div class="user-profile-update-wrapper">
    <div class="container mt-4">      
      <div class="row">
        <div class="col-md-4 mx-auto bg-white p-3">
          <h2 class="text-center">Update Your Profile</h2>
          <form action="{{ route('user.update', $user->id) }}" method="POST" 
            enctype="multipart/form-data" class="mt-4">
       	  	@method('PUT')
            @csrf
            <div class="form-group row">
              <label for="fname" class="col-md-4 col-form-label">First Name</label>
              <input type="text" class="form-control col-md-7 input-pose" placeholder="First name" id="fname" name="fname" value="{{ $user->fname }}">
            </div>
            <div class="form-group row">
              <label for="mname" class="col-md-4 col-form-label">Middle Name</label>              
              <input type="text" class="form-control col-md-7 input-pose" placeholder="Middle name (optional)" id="mname" name="mname" value="{{ $user->mname }}">
            </div>
            <div class="form-group row">
              <label for="fname" class="col-md-4 col-form-label">Last Name</label>              
              <input type="text" class="form-control col-md-7 input-pose" placeholder="Last name" name="lname" value="{{ $user->lname }}">
            </div>            
            <div class="form-group row">
              <label for="Phone" class="col-md-4 col-form-label">Phone</label>              
              <input type="text" class="form-control col-md-7 input-pose" placeholder="Phone number (optional)" id="phone" name="phone" value="{{ $user->phone }}">
            </div>
            <div class="row">
              <div class="col-md-4">Gender</div> 
              <div class="col-md-8">
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="female"
                    {{ $user->gender ==='female' ? 'checked' : '' }}>Female
                  </label>
                </div>
                <div class="form-check-inline mb-2">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="male"
                    {{ $user->gender ==='male' ? 'checked' : '' }}>Male
                  </label>
                </div>   
              </div>
            </div>                         
            <div class="form-group">
              <label class="control-label " for="birthday">Birthday</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">        
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input class="form-control" id="birthday" name="birthday" value="{{ $user->birthday }}" placeholder="MM/DD/YYYY" type="text"/>
              </div>
            </div>
             
            @role('doctor')
              <div class="form-group">
                <label for="profession">Profession:</label>
                <input type="text" class="form-control" id="profession" name="profession" 
                  value="{{$user->doctor->profession}}">              		 
              </div>
              <div class="form-group">
                <label for="experience">Total years of experience:</label>            
                <input type="text" class="form-control" id="experience" name="experience" 
                  value="{{$user->doctor->experience}}"> 
              </div>
              <div class="form-group">
        				<label for="background">Tell patients about your background:</label>
        				<textarea class="form-control change" rows="5" id="background" 
        					name="background">{{ $user->doctor->background }}</textarea>
              </div>
            @endrole

            <p>Upload a profile image:</p>
            <input type="file" name="avatar"><br>
            <button type="submit" class="btn btn-primary my-4">Submit</button>
          </form>
        </div>
      </div>  
    </div><!-- .container end -->
  </div><!-- user-profile-update-wrapper end -->
@endsection