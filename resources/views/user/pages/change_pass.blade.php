@extends('user.layouts.profile')
@section('content')
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="../uploads/user/{{ Auth::user()->image }}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {!! ucfirst (Auth::user()->username) !!}
                    </div>
                    <div class="profile-usertitle-job">
                        {!! Auth::user()->name !!}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <button type="button" class="btn btn-success btn-sm">Active</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
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
                {!! Form::open(array('action' => array('UserController@postChangePass'), 'class' => 'form-horizontal', 'role' => 'form')) !!}
                    <div class="form-group {{ $errors->has('passwordOld') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label">Mật khẩu cũ:</label>
                        <div class="col-md-8">
                            <input class="form-control password" type="password" value="" name="passwordOld" >
                            @if ($errors->has('passwordOld'))
                              <span class="help-block">
                                <strong>{{ $errors->first('passwordOld') }}</strong>
                              </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label">Mật khẩu mới:</label>
                        <div class="col-md-8">
                            <input class="form-control password" type="password" value="" name="password" >
                            @if ($errors->has('password'))
                              <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                              </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                        <label class="col-md-3 control-label">Nhập lại mật khẩu:</label>
                        <div class="col-md-8">
                            <input class="form-control password" type="password" value="" name="confirm_password">
                            @if ($errors->has('confirm_password'))
                              <span class="help-block">
                                <strong>{{ $errors->first('confirm_password') }}</strong>
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
                {!! Form::close()!!}
    		</div>
        </div>
	</div>
</div>
<hr>
@endsection