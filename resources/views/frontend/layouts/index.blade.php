<!DOCTYPE html>
<html>
<head>
@include('frontend.components.html_header')
</head>
<body>
	<div class='container'>
		<div class="row">
			@include('frontend.components.header')	
		</div>
		<div class="row">
			<!-- @yield('content') -->
		</div>
		<div class="row">
			<!-- @include('frontend.components.footer') -->
		</div>
	</div>
	@include('frontend.components.script_footer')
</body>
</html>