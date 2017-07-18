<!DOCTYPE html>
<html>
<head>
@include('user.components.html_header')
</head>
<body>
	<header>
		<div class='container'>
			@include('user.components.profile.header-profile')
		</div>
	</header>
	<main class="row">
		@yield('content')
	</main>
	<footer>
		@include('user.components.footer')
	</footer>	
	@include('user.components.script_footer')
</body>
</html>