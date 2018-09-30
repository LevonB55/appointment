@extends('main')

@section('title', 'Reset Password')

@section('content')
   <div class="container-fluid reset-page-wrapper">
      <div class="row">
         <div class="offset-md-4 col-md-4 bg-white p-5">
            <h5 class="text-center mb-3">Reset Password</h5>              
            <form method="POST" action="{{ route('password.request') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                  <input type="email" class="form-control" placeholder="Email" 
                        name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password" name="password">
               </div>
               <div class="form-group">
                  <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
               </div>
               <input type="submit" value="Reset Password" class="btn btn-primary btn-block">
            </form>
         </div>
      </div>
   </div><!-- reset-page-wrapper end -->
@endsection