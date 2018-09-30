@extends('main')

@section('title', 'Create Schedule')

@section('content')

	<div class="create-schedule">
		<div class="container">
			<h1 class="text-center mb-4">Make Your Schedule</h1>
			<div class="row">
				<div class="col-md-3">
					<form method="POST" action="{{route('appointments.store')}}">
						@csrf						
	         		<div class="input-group">
	             		<div class="input-group-prepend">        
	               		<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
	             		</div>
	             		<input type="text" class="form-control" id="datetimepicker" name="date" 
	             		placeholder="MM/DD/YYYY"  autocomplete="off"/>
	              	</div>
	              	<input type="submit" value="Submit" class="btn btn-primary mt-3">
					</form>
				</div>
				<div class="col-md-9">
					@foreach ($appointments as $appointment)
						<div class="row mb-2">
							<div class="col-md-5">
								{{ date('l, F j, Y g:ia', strtotime($appointment->date))  }}
							</div>
							<div class="col-md-3">
								<form action="{{route('appointments.destroy', $appointment->id)}}" method="POST">
									@method('DELETE')
    								@csrf
									<input type="submit" value="Delete" class="btn btn-sm btn-danger">
								</form>
							</div>
						</div>
					@endforeach				
				</div>				
			</div>
		</div>
	</div><!-- create-schedule end -->

@endsection