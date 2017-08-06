@extends('user.layouts.profile')
@section('content')
<div class="container">
    <div class="row il-profile">
		<div class="col-md-3 il-profile-col-md-3">
			<div class="profile-sidebar">
				<div class="profile-userpic">
					<img src="{{ asset('uploads/images/' . Auth::user()->image) }} " class="img-responsive"/>
				</div>
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{!! ucfirst (Auth::user()->username) !!}
					</div>
					<div class="profile-usertitle-job">
						{!! Auth::user()->name !!}
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
							<a href="editprofile/{{Auth::user()->id}}">
							<i class="glyphicon glyphicon-user"></i>
							Chỉnh sử thông tin cá  nhân </a>
						</li>
						<li>
							<a href="{{url('changePass')}}">
							<i class="glyphicon glyphicon-lock"></i>
							Thay đổi mật khẩu </a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9 il-profile-col-md-9">
            <div class="profile-content">
			    <h4 class="heading"><strong>Thông tin</strong> {!! ucfirst (Auth::user()->username) !!} <span></span></h4>
                <div class="form-group">
                <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Tên</td>
                        <td>{!! Auth::user()->name !!}</td>
                      </tr>
                      <tr>
                        <td>Ngày sinh</td>
                        <td>{!! Auth::user()->date_of_birth !!}</td>
                      </tr>
                        <tr>
                        <td>Địa chỉ</td>
                        <td>{!! Auth::user()->address !!}</td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td>{!! Auth::user()->email !!}</td>
                      </tr>
                        <td>Số điện thoại</td>
                        <td>{!! Auth::user()->phone !!}
                        </td> 
                      </tr>
                    </tbody>
                  </table>
            </div>
            </div>
		</div>
	</div>
</div>
<hr>
@endsection