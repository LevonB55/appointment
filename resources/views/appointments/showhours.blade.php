@extends('main')

@section('title', 'Make an appointment')

@section('content')

<div class="select-page-wrapper">
	<div class="container available">
		<div class="row">
			<div class="col-md-2 offset-md-2 text-primary">
				<a href="{{route('appointments.show', $appointment->user_id)}}"><i class="fas fa-arrow-left"></i></a>
			</div>
			<div class="col-md-4 text-center">
				<h4>{{ date('l', strtotime($appointment->date))  }}</h3>
				<h6>{{ date('F j Y', strtotime($appointment->date))  }}</h5>
			</div>
		</div>
	</div>
	<hr>
	<div class="container">
		@if(count($setHours) === 0)
		   <div class="alert alert-info">
		      <div>No appointment date is available!</div>
		   </div>   
		@endif
		<div class="row">
			<div class="col-md-4 mx-auto">
				<h6 class="font-weight-bold mb-4">Select a Time</h6>
				
				@foreach($setHours as $hourID => $hour)
					<div class="available-time-wrap mb-2">		
						<button type="button" class="available-time btn btn-outline-primary btn-block mb-2">
							 {{ date('Y-m-d G:i:s', strtotime($hour))  }}
						</button>
						<div class="confirm collapse">
							<button type="button" class="btn btn-dark cancel cancel-button">Cancel</button>
							<form action="{{ route('appointments.make', $hourID) }}" method="POST" class="float-right">
								@csrf
								<input type="hidden" value="{{ date('Y-m-d G:i:s', strtotime($hour))  }}" name="date">
								<input type="submit" value="Confirm" class="btn btn-primary confirm-button">
							</form>							
						</div>
					</div>
				@endforeach 
						
			</div>
		</div>
	</div>	

</div><!-- select-page-wrapper end -->

@endsection