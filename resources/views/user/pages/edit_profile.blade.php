@extends('user.layouts.profile')
@section('content')
<div class="container">
    <div class="row profile">
        {!! Form::open(array('action' => array('UserController@postEditUser', $user->id), 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')) !!}
		<div class="col-md-3">
			<div class="profile-sidebar">
                <div class="profile-userpic">
                    <figure {{ $errors->has('image') ? 'has-error' : '' }}>
                        <img src="../uploads/user/{{$user->image}}" class="img-responsive" alt="">
                        <figcaption>
                            <input type="file" name="image">Thay đổi hình ảnh
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif 
                        <figcaption>
                    <figure>
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
                            <a href="{{url('changePass')}}">
                            <i class="glyphicon glyphicon-lock"></i>
                            Thay đổi mật khẩu </a>
                        </li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            @if($status = Session::get('status'))
                <div class="alert alert-info" role="alert">
                    {!! $status !!}
                </div>
            @endif()
            @if($notify = Session::get('notify'))
                <div class="alert alert-warning" role="alert">
                    {!! $notify !!}
                </div>
            @endif()
            <div class="profile-content">
                    <div class="form-group ">
                        <label class="col-lg-3 control-label">Tên đăng nhập:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" value="{{ $user['username']}}" name="username" required="" maxlength="32" minlength="6" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="email" name= "email" value="{{ $user['email']}}" readonly="">
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-lg-3 control-label">Họ và tên:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="name" value="{{ $user['name']}}">
                             @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Địa chỉ:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="address" value="{{ $user['address']}}">
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label">Số điện thoại:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="number" name="phone" value="{{ $user['phone']}}">
                            @if ($errors->has('phone'))
                              <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                              </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label">Ngày sinh:</label>
                        <div class="col-md-8">
                            <input class="form-control" type="date" name= "date_of_birth" value="{{ $user['date_of_birth']}}">
                            @if ($errors->has('date_of_birth'))
                              <span class="help-block">
                                <strong>{{ $errors->first('date_of_birth') }}</strong>
                              </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-primary" value="Save">
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
    		</div>
        </div>
        {!! Form::close()!!}
	</div>
</div>
<hr>
@endsection