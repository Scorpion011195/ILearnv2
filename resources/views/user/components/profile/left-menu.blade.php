<div class="col-md-3">
	<div class="profile-sidebar">
        <div class="profile-userpic">
          <img src="" class="img-responsive" alt="">
        </div>
		<div class="profile-usertitle">
			<div class="profile-usertitle-name">
				{!! ucfirst($user->username) !!}
			</div>
			<div class="profile-usertitle-job">
				{!! $user->name !!}
			</div>
		</div>
		<div class="profile-userbuttons">
			<button type="button" class="btn btn-success btn-sm">Active</button>
		</div>
		<div class="profile-usermenu">
			<ul class="nav">
				<li class="active">
					<a href="{{url('profile')}}">
					<i class="glyphicon glyphicon-home"></i>
					Trang cá nhân </a>
				</li>
				<li>
					<a href="">
					<i class="glyphicon glyphicon-user"></i>
					Chỉnh sử thông tin cá  nhân </a>
				</li>
                <li>
                    <a href="">
                    <i class="glyphicon glyphicon-lock"></i>
                    Thay đổi mật khẩu </a>
                </li>
			</ul>
		</div>
		<!-- END MENU -->
	</div>
</div>