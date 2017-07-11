<!DOCTYPE html>
<html>
<head>
@include('frontend.components.html_header')
</head>
<body>
	@include('frontend.components.header')
	@yield('content')
	@include('frontend.components.script_footer')
	@include('frontend.components.footer')
</body>
</html>