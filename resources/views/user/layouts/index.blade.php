<!DOCTYPE html>
<html>
<head>
@include('user.components.html_header')
</head>
<body>
	<header>
		<div class='container'>
			@include('user.components.header')
		</div>
	</header>
	<div class="border-center"></div>
	<main class="row">
		@yield('content')
	</main>
	<footer>
		@include('user.components.footer')
	</footer>	
	@include('user.components.script_footer')
</body>
</html>