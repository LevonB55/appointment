@extends('main')

@section('title', 'Appointment Confirmed')

@section('content')
<div class="confirmed-appoint-page-wrapper page-pose">
	<div class="container  text-center mt-4">
	   <div class="row">
	      <div class="col-md-5 mx-auto">
	         <h6 class="font-weight-bold">Confirmed</h6>
	         <h6 class="mb-4">
	         	You settled an appointment with Dr. {{$user->fname . ' ' . $user->lname}}.
	         </h6>
	         <hr>
	         <h6 class="text-primary">
	         	<i class="far fa-clock"></i> {{ date('g:sa - l, F j, Y', strtotime($appointment->date))  }}
	         </h6>
	         <hr>
	         <a href="{{route('user.index')}}" class="btn btn-outline-primary back-doctors">
	         	Go back to doctors list page
	      	</a>
	      </div>
	   </div>
	</div>
</div><!-- confirmed-appoint-page-wrapper end -->
@endsection