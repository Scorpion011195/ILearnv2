@extends('user.layouts.profile')
@section('content')
<div class="container">
    <div class="row il-profile">
        {!! Form::open(array('action' => array('UserController@postEditUser', $user->id), 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data')) !!}
		<div class="col-md-3 il-profile-col-md-3">
			<div class="profile-sidebar">
                <div class="profile-userpic {{ $errors->has('image') ? 'has-error' : '' }}">
                    <img src="{{ asset('uploads/images/' . $user->image) }} " class="img-responsive" alt="" />
                    <div class="description">
                        <p class="description-body">Thay đổi hình ảnh</p>
                        <input type="file" name="image">
                    </div>
                </div>
                    @if ($errors->has('image'))
                        <span class="il-message">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif 
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{!! ucfirst($user->username) !!}
					</div>
					<div class="profile-usertitle-job">
						{!! $user->name !!}
					</div>
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
		<div class="col-md-9 il-profile-col-md-9">
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
                        <input class="form-control" type="text" name="name" value="{{ $user['name']}}" maxlength="100" minlength="6">
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
                        <input class="form-control" type="text" name="address" value="{{ $user['address']}}" maxlength="200" minlength="3">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label class="col-md-3 control-label">Số điện thoại:</label>
                    <div class="col-md-8">
                        <input class="form-control" type="number" name="phone" value="{{ $user['phone'] }}">
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
                        <div class='input-group date' id='datepicker'>
                            <input type='text' name= "date_of_birth" value="{{ $user['date_of_birth'] }}" class="form-control" data-role ="date" data-inline = "true"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
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