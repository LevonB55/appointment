<!DOCTYPE html>
<html lang="en-US">

<head>

    @include('partials._head')

</head>

<body>

    @include('partials._nav')
	
    @include('partials._messages')
	
	@yield('content')

	<script src="{{asset('js/app.js')}}" type="text/javascript"></script>

</body>

</html>