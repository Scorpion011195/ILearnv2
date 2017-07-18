<div class="row il-profile">
  <nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand il-profile-img" href="#"><img src="{{ asset('img/logo.png')}}" alt="il-logo" class="img-responsive il-logo">
        </a>
      </div>
      <div id="navbar3" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{!! Auth::user()->username !!}<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{url('profile')}}">Thông tin tài khoản</a></li>
              <li class="divider"></li>
              <li><a href="{{ url('logout')}}">Thoát</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
    <!--/.container-fluid -->
  </nav>
</div>
