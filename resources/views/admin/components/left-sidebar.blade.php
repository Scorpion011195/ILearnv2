<!--     Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        @if(Auth::user()->role_id ==1)
          <ul class="sidebar-menu">
              <li class="header text-center"> </li>
              <!-- superadmin -->
              <li class="treeview" id="_menu-qltd">
                  <a href="">
                      <i class="fa fa-book"></i>
                      <span>Quản lý từ điển</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " id= "list_menu">
                  <li id="_menu-qltd-tt"><a href="{{ route('getAddWord') }}">Thêm từ</a></li>
                  <li id="_menu-qltd-trt"><a href="{{route('adminDisplay')}}">Tra từ</a></li>
                  <li id="_menu-qltd-tk"><a href="{{ route('adminDictCollect')}}">Thống kê</a></li>
                  <li id="_menu-qltd-tfscv"><a href="{{route('adminUpload')}}">Upload từ điển</a></li>
                </ul>
              </li>
              <li id="_menu-qltk">
                  <a href="">
                      <i class="fa fa-user-circle"></i>
                      <span>Quản lý tài khoản</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                <ul class="treeview-menu " id= "list_menu">
                  <li id="_menu-qlus-ds"><a href="{{route('adminUserManagement')}}">Danh sách User</a></li>
                  <li id="_menu-qlus-tk"><a href="">Thống kê</a></li>
                </ul>
              </li>
          <!-- admin -->
          </ul>
        @endif
        @if(Auth::user()->role_id == 2)
          <ul class="sidebar-menu">
              <li class="header text-center"> </li>
              <!-- superadmin -->
              <li class="treeview" id="_menu-qltd">
                  <a href="">
                      <i class="fa fa-book"></i>
                      <span>Quản lý từ điển</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " id= "list_menu">
                  <li id="_menu-qltd-tt"><a href="{{ route('getAddWord') }}">Thêm từ</a></li>
                  <li id="_menu-qltd-trt"><a href="{{route('adminDisplay')}}">Tra từ</a></li>
                  <li id="_menu-qltd-tk"><a href="{{ route('adminDictCollect')}}">Thống kê</a></li>
                </ul>
              </li>
          <!-- admin -->
          </ul>
        @endif
        @if(Auth::user()->role_id == 3)
          <ul class="sidebar-menu">
              <li class="header text-center"> </li>
              <!-- superadmin -->
              <li class="treeview" id="_menu-qltd">
                  <a href="">
                      <i class="fa fa-book"></i>
                      <span>Quản lý từ điển</span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu " id= "list_menu">
                  <li id="_menu-qltd-tt"><a href="{{ route('getAddWord') }}">Thêm từ</a></li>
                  <li id="_menu-qltd-trt"><a href="{{route('adminDisplay')}}">Tra từ</a></li>
                </ul>
              </li>
          <!-- admin -->
          </ul>
        @endif


    <!-- /.sidebar-menu -->
    </section>
<!-- /.sidebar -->
</aside>
