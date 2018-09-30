<div class="container">
  <nav class="float-right mt-4">      
    @if(Auth::check())      
      <span class="dropdown-toggle hand font-weight-bold text-primary" data-toggle="dropdown">
        {{ Auth::user()->fname . ' ' . Auth::user()->lname }}
      </span>
      <div class="dropdown-menu">
        @role('doctor')
          <a class="dropdown-item" href="{{route('appointments.index', Auth::id())}}">Appointments</a>
          <a class="dropdown-item" href="{{route('appointments.create', Auth::id())}}">
            Schedule Appointments
          </a>
        @endrole
        @role('patient')
          <a class="dropdown-item" href="{{ route('user.index') }}">Doctors List</a>
        @endrole
        <a class="dropdown-item" href="{{route('user.show', Auth::id())}}">My Profile</a>
        <a class="dropdown-item" href="{{route('getLogout')}}">Logout</a>
      </div>
    @else        
        <a href="{{url('/')}}" class="font-weight-bold px-2 
          {{Request::is('/') ? "taken" : "" }}">Doctors List
        </a>          
        <a href="{{ route('login') }}" class="font-weight-bold px-2 
          {{Request::is('login') ? "taken" : "" }}">Login
        </a>          
        <a href="{{ route('register') }}" class="font-weight-bold px-2 
          {{Request::is('register') ? "taken" : "" }}">Register
        </a>          
    @endif
  </nav>
</div>