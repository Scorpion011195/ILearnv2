<div class="row il-footer">	
	<div class=" col-md-3">
	</div>
	<div class="col-md-6 il-footer">
		<div class="col-md-12 il-footer">
			<span>Hệ thống tra từ ILEARN</span>
		</div>
		<div class='col-md-12 il-footer'>
			Liên kết: <a href="{{url('home')}}" title="">Từ điển</a> | 
			<a href="{{url('translate')}}" title="">Dịch văn bản</a> | 
			@if(Auth::guest())
			<a href="{{url('notify')}}">Từ của tôi</a> | 
			@else
			<a href="{{url('history')}}">Từ của tôi</a> |
			@endif
			<a href="{{url('login')}}" title=""> Đăng nhập</a> |
			<a href="{{url('register')}}">Đăng kí</a>
		</div>
		<div class='col-md-12 il-footer'>
			<p>© 2017 Coppy and design by RikkeiSoft Company</p>
		</div>
	</div>
</div>