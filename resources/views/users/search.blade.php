@extends('main')

@section('title', 'Found Doctors')

@section('content')
<div class="container search-doctors-page-wrapper">

@foreach ($doctors as $doctor)
 	<div class="media border p-3 shadow mb-5">
      <a href="{{route('user.show', $doctor->id)}}" target="_blank">
        @if ($doctor->avatar)
       		<img src="{{ asset('storage/images/'. $doctor->avatar) }}" 
            alt="avatar" class="shadow avatar">
        @else
       		<img src="{{asset('storage/images/avatar_' . $doctor->gender . '.png') }}" 
            alt="avatar" class="shadow avatar">
        @endif
      </a>
      <div class="media-body ml-4">
        <h4 class="text-primary">          
       		<a href="{{route('user.show', $doctor->id)}}" target="_blank">
          	Dr. {{ $doctor->fname . ' ' . $doctor->mname . ' ' . $doctor->lname}}
        	</a> 
        	<small>
            <span class="align-text-bottom profession">
              {{$doctor->doctor->profession}}
            </span>
        	</small>
        </h4>
        <p>
       		{{substr($doctor->doctor->background, 0, 200)}}{{strlen($doctor->doctor->background) > 200 ? 
            '...' : ''}}
        </p>
        <hr>
        <div class="float-right">
            @if ($doctor->doctor->experience)
              <span class="text-muted mr-2">
             		{{$doctor->doctor->experience}}{{ $doctor->doctor->experience > 1 ? ' years' : ' year' }} 
                	of professional experience
              </span>
            @endif
            <a href="{{ route('appointments.show', $doctor->id) }}" class="btn btn-outline-primary text-uppercase font-weight-bold" role='button'>
          		Set Appointment
            </a>
        </div>      
   	</div>
 	</div>
@endforeach

<div class="container mt-5 d-flex justify-content-end">
     
   {{ $doctors->links() }}

</div>  

</div> <!-- search-doctors-page-wrapper end -->
@endsection