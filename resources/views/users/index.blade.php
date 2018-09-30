@extends('main')

@section('title', 'Doctors list')

@section('content')
  <div class="doctors-page-wrapper">
  
  <div class="container my-5">
    <div class="col-md-4 offset-md-8 search position-relative" id="search-doctor">
      <form action="{{route('doctors.search')}}" method="GET" target="_blank">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search" id="search" name="search" autocomplete="off">
          <div class="input-group-append">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>  
          </div>
        </div>
      </form>
      <div class="search-dropdown position-absolute shadow-lg">
              
      </div>        
    </div>
  </div>

  @foreach ($users as $user)
  <div class="container doctors-page-wrapper">
    <div class="media border p-3 shadow">
      <a href="{{route('user.show', $user->id)}}" target="_blank">
        @if ($user->avatar)
          <img src="{{ asset('storage/images/'. $user->avatar) }}" 
            alt="avatar" class="shadow avatar">
        @else
          <img src="{{asset('storage/images/avatar_' . $user->gender . '.png') }}" 
            alt="avatar" class="shadow avatar">
        @endif
      </a>
      <div class="media-body ml-4">
        <h4 class="text-primary">          
          <a href="{{route('user.show', $user->id)}}" target="_blank">
            Dr. {{ $user->fname . ' ' . $user->mname . ' ' . $user->lname}}
          </a> 
          <small>
            <span class="align-text-bottom profession">
              {{$user->doctor->profession}}
            </span>
          </small>
        </h4>
        <p>
          {{substr($user->doctor->background, 0, 200)}}{{strlen($user->doctor->background) > 200 ? 
            '...' : ''}}
        </p>
        <hr>
        <div class="float-right">
            @if ($user->doctor->experience)
              <span class="text-muted mr-2">
                {{$user->doctor->experience}}{{ $user->doctor->experience > 1 ? ' years' : ' year' }} 
                of professional experience
              </span>
            @endif
            <a href="{{ route('appointments.show', $user->id) }}" class="btn btn-outline-primary text-uppercase font-weight-bold" role='button'>
                Set Appointment
            </a>
        </div>      
      </div>
    </div>
  </div> <!-- doctors' page wrapper end -->
  @endforeach  

  <div class="container mt-5 d-flex justify-content-end">
     
    {{ $users->links() }}

  </div>

  </div>
@endsection