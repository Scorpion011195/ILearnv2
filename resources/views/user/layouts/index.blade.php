<!DOCTYPE html>
<html>
<head>
@include('user.components.html_header')
</head>
<body>
    <!-- Facebook comment -->
    <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=135151730410573";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- /.Facebook comment -->

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
