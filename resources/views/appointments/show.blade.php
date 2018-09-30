@extends('main')

@section('title', 'Days List')

@section('content')
<div class="dayslist-page-wrapper py-5">
   <h6 class="text-center doctor font-weight-bold">Dr. {{ $user->fname . ' ' . $user->lname}}</h6>
   <hr/>
   <hr/>
   <div class="container text-center">
      <h6 class="font-weight-bold mt-4">Select a Day</h6>
      <ul class="list-inline date mt-5">
         
         @foreach ($dates as $appointmentID => $date)
         
            <li class="list-inline-item mb-2">              
               <a href="{{route('appointments.hours', $appointmentID)}}" 
                  class="d-block rounded-circle text-dark border-primary appointment-date">
                  <span class="font-weight-bold">{{ date('l', strtotime($date))  }} </span>
                  {{ date('F j Y', strtotime($date))  }}
               </a>               
            </li>
            
            @if(Carbon\Carbon::parse(next($dates))->weekOfYear != Carbon\Carbon::parse($date)->weekOfYear)
               <div class="text-muted my-3 d-none d-lg-block">
                  --------------------------------------------------- ONE WEEK ---------------------------------------------------
               </div>
            @endif
            
         @endforeach
         
      </ul>
      
  </div>
</div><!-- dayslist-page-wrapper end -->
@endsection