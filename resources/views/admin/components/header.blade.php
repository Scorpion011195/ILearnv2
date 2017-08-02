    <!-- Main Header -->
    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>I</b>LEARN</span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Menu mobile</span>

            </a>

            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="">{{ Session::get('user')->username }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ asset('http://184.171.241.153/~pagc/wp-content/uploads/2015/04/Welcome-New-Members.jpg') }}" class="img-circle _tooltip-me" alt="User Image" id="img-profile">
                                <p>
                                   <p>
                                    {{ Session::get('user')->name }}
                                </p>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{route('adminProfile')}}" class="btn btn-default btn-flat">Thông tin cá nhân</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('adminLogout') }}" class="btn btn-default btn-flat">Thoát</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            @if(Auth::user()->id !== Null)
            <script type="text/javascript"></script>
            @endif
        </nav>
    </header>
