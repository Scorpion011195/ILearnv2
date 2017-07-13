@extends('frontend.layouts.index')
@section('content')
	<div class='row il-register clearfix'>
		<div class="container">
			<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-lg-offset-3 col-md-offset-2 col-sm-offset-2">
	            <form method="post" role="form" accept-charset="utf-8" name="registerForm" id="registerForm">
	            	{!! csrf_field() !!}
	            	<div class='il-title-register'>
	            		<legend>Đăng kí</legend>
	            		<span>Bạn vui lòng điền chính xác tất cả các thông tin dưới đây để đảm bảo nhận đầy đủ mọi quyền lợi của mình</span>
	            	</div>
	            	<div class="il-form-register clearfix">
	            		<div class="row">
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<fieldset class="form-group">
									<input type="email" class="form-control " value="" name="email" placeholder="Email của bạn" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
								</fieldset>
								<fieldset class="form-group">
									<input type="text" class="form-control " value="" name="name" maxlength="32" minlength="6"  placeholder="Tên đăng nhập của bạn" required="">
								</fieldset>
								<fieldset class="form-group">
									<input type="password" class="form-control " value="" maxlength="6" minlength="32" name="password" placeholder="Mật khẩu của bạn" required="">
								</fieldset>
								<fieldset class="form-group">
									<input type="password" class="form-control " value="" maxlength="6" minlength="32" name="confirm-password" placeholder="Nhập lại mật khẩu của bạn" required="">
								</fieldset>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<button class="btn btn-info button-50 btn-50-blue" type="submit" >Đăng ký</button>
								<a class="btn btn-link" href="{{url('login')}}"> Quay lại đăng nhập</a>
							</div>
						</div>
	            	</div>
	            </form>
        	</div>
		</div>
	</div>
@endsection