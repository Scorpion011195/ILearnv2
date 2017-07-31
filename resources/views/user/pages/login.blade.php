@extends('user.layouts.index')
@section('content')
	<div class='row il-login clearfix'>
		<div class="container">
			<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-lg-offset-3 col-md-offset-2 col-sm-offset-2 ">
	            <form method="post" role="form" action= "{{route('login')}}" accept-charset="utf-8" name="loginForm" id="loginForm">
	            	{{ csrf_field() }}
	            	<div class='il-title-login'>
	            		<legend>Đăng nhập</legend>
	            		<span>Bạn có tài khoản vui lòng đăng nhập để sử dụng nhiều tiện ích</span>
	            	</div>
	            	<div class="il-form-login clearfix">
	            		<div class="row">
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<fieldset class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
									<input type="text" class="form-control form-control-lg" value="" name="name" maxlength="32" minlength="6"  placeholder="Tên đăng nhập của bạn" required="" value="{{ old('name')}}">
									@if($errors->has('name'))
										<div class="text-danger ng-hide">
											<span><i class="fa fa-times text-danger"></i>{!! $errors->first('name') !!}</span>
										</div>
									@endif
								</fieldset>
								<fieldset class="form-group {{ $errors->has('pass') ? 'has-error' : ''}}">
									<input type="password" class="form-control form-control-lg" value="" maxlength="100" minlength="6" name="pass" placeholder="Mật khẩu của bạn" required="">
									@if($errors->has('pass'))
										<div class="text-danger ng-hide">
											<span> <i class="fa fa-times text-danger"></i>{!! $errors->first('pass')!!}</span>
										</div>
									@endif
								</fieldset>
							</div>
						</div>
						 @if($errors->has('errorLogin'))
							<div class="row">
								<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
									<div class="form-group">
										<div class="text-danger ng-hide">
	                                    {!! $errors->first('errorLogin') !!}
	                                	</div>
	                                </div>
								</div>
							</div>
						@endif
						<div class="row">
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<div class="checkbox">
	                    		<label>
	                        		<input type="checkbox" name="remember" {!! old('remember') ? 'checked' : '' !!}>
	                        		Nhớ mật khẩu
	                    		</label>
	               				</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<button class="btn btn-info button-50 btn-50-blue" type="submit" >Đăng nhập</button>
								<a class="btn btn-link" href="{{url('register')}}"> Đăng ký tài khoản mới</a>
							</div>
						</div>
	            	</div>
	            </form>
        	</div>
		</div>
	</div>
@endsection