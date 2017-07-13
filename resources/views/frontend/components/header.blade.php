<div class="row il-top-header">
	<a href="{{url('login')}}"> Đăng nhập</a> |
	<a href="{{url('register')}}">Đăng ký</a>
</div>
<div class="row il-bottom-header">
	<div class="col-md-3 col-xs-4 il-logo"><a href="#"><img src="{{ asset('img/logo.png')}}" alt="il-logo" class="img-responsive il-logo"></a></div>
	<div class="col-md-9 col-xs-8 il-bottom-banner">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		    <!-- Indicators -->
		    <div class="carousel-indicators">
		      <div data-target="#myCarousel" data-slide-to="0" class="active" hidden></div>
		      <div data-target="#myCarousel" data-slide-to="1" hidden></div>
		      <div data-target="#myCarousel" data-slide-to="2" hidden></div>
		    </div>
		    <!-- Wrapper for slides -->
		    <div class="carousel-inner">
		      <div class="item active">
		        <img src="{{ asset('img/slide.png')}}" alt="Los Angeles" style="width:100%;">
		      </div>
		      <div class="item">
		        <img src="{{ asset('img/slide1.png')}}" alt="Chicago" style="width:100%;">
		      </div>
		      <div class="item">
		        <img src="{{ asset('img/slide2.jpg')}}" alt="New york" style="width:100%;">
		      </div>
		    </div>
		    <!-- Left and right controls -->
		    <a class="left carousel-control" href="#myCarousel" data-slide="prev"></a>
		    <a class="right carousel-control" href="#myCarousel" data-slide="next"></a>
		</div>
	</div>
</div>
<nav class="nav navbar-default il-menu">
	<ul class="clearfix">
		<li class="active"><a href="{{url('home')}}">Từ điển</a></li>
		<li><a href="{{url('translate')}}">Dịch văn bản </a></li>
		<li><a href="{{url('')}}">Từ của tôi</a></li>
	</ul>
</nav>