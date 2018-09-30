@extends('main')

@section('title', 'Login')

@section('content')
   <div class="container-fluid login-page-wrapper">
      <div class="row">
         <div class="offset-md-4 col-md-4">
            <div class="bg-white p-4">
               <h5 class="text-center mb-3">Login</h5>            
               <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                     <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                  </div>
                  <div class="form-group">
                     <input type="password" class="form-control" placeholder="Password" name="password">
                  </div>
                  <div class="form-group form-check">
                     <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
                     </label>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">Log In</button>
               </form>                 
               <div class="text-center mt-3">
                  <a href="{{ route('password.request') }}" class="text-muted">
                     <i class="fas fa-lock"></i> Forgot Password?
                  </a>              
               </div>
               <div class="text-center mt-2 text-muted">
                  <a href="{{route('register')}}" class="text-muted">
                     <i class="fas fa-user-plus"></i> New here? Create account.
                  </a>                 
               </div>
            </div>         
         </div>
      </div>
   </div><!-- login-page-wrapper end -->
@endsection
