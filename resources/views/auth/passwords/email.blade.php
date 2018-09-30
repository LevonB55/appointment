@extends('main')

@section('title', 'Request Password')

@section('content')
   <div class="container-fluid request-password-page-wrapper">
      <div class="row">
         <div class="col-md-4 mx-auto">
            <div class="bg-white p-4">
               <h5 class="text-center mb-3">Request Password</h5>              
               @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
               @else
                  <div class="alert alert-info mb-5">
                     Enter your Email and instructions will be sent to you!
                  </div>
               @endif
               <form method="POST" action="{{ route('password.email') }}">
                  @csrf           
                  <div class="form-group">
                     <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
                  </div>                      
                  <button type="submit" class="btn btn-primary btn-block my-4">Enter Email</button>
                </form> 
               <div class="text-center mt-2">
                  <a href="{{route('login')}}" class="text-muted"><i class="fas fa-sign-in-alt"></i> Back to Login</a>      
               </div>
            </div>
         </div>
      </div>
   </div><!-- reques-password-page-wrapper end -->
@endsection
