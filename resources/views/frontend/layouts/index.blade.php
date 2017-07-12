<!DOCTYPE html>
<html>
<head>
@include('frontend.components.html_header')
</head>
<body>
	<header>
		<div class='container'>
			@include('frontend.components.header')
		</div>
	</header>
	<div class="border-center"></div>
	<main class="row">
		@yield('content')
	</main>
	<footer>
		@include('frontend.components.footer')
	</footer>	
	@include('frontend.components.script_footer')
</body>
</html>