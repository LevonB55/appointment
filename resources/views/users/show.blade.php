@extends('main')

@section('title', "$user->user_type Profile")

@section('content')
<div class="user-profile-page-wrapper">  
  <div class="container">
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif   
    <div class="row">    
      <div class="col-md-2">        
        @if ($user->avatar)
          <img src="{{ asset('storage/images/'. $user->avatar) }}" 
            alt="avatar" class="mr-5 shadow avatar">
        @else
          <img src="{{ asset('storage/images/avatar_' . $user->gender . '.png') }}" 
            alt="avatar" class="mr-5 shadow avatar">
        @endif
      </div>
      <div class="col-md-3 p-4">
        <h6 class="text-primary font-weight-bold">
          @if ($user->hasRole('doctor'))Dr.@endif {{ $user->fname . ' ' . $user->mname . ' ' . $user->lname}}
        </h6>
        @if (Auth::id() === $user->id)     
          <h6 class="font-italic">
            <a href="{{route('user.edit', $user->id)}}" class="text-muted">Update your profile</a>
          </h6>          
        @endif

        @role('patient')
          @if(Auth::id() !== $user->id)
            <h6><a href="{{ route('appointments.show', $user->id) }}">Make an appointment</a></h6>
          @endif
        @endrole
      </div>
      <div class="col-md-7 p-3 mt-1">
        <div><a href="mailto:{{ $user->email }}" target="_top">{{ $user->email }}</a></div>
        @if ($user->hasRole('doctor'))        
          <div>{{$user->doctor->profession}}</div>
          @if ($user->doctor->experience)
            <div>
              {{$user->doctor->experience}}{{ $user->doctor->experience > 1 ? ' years' : ' year' }}
              of experience
            </div>
          @endif
          <div class="text-justify">{{$user->doctor->background}}</div>
        @endif 
      </div>
    </div>
  </div>
</div>{{-- user-profile-page-wrapper end --}}
@endsection