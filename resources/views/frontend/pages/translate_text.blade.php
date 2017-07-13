@extends('frontend.layouts.index')
@section('content')
	<div class="row il-translate-text">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-12 il-translate-text">
					<div class="row il-translate-title">
						<span>Dịch văn bản</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-12 il-translate-text">
			     	<select class="lagForm " id="sel1">
				        <option>Tiếng anh</option>
				        <option>Tiếng nhật</option>
				        <option>Tiếng Việt</option>
			      	</select>
			     	<select class="lagTo" id="sel2">
				        <option>Tiếng anh</option>
				        <option>Tiếng nhật</option>
				        <option>Tiếng Việt</option>
			      	</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-12 il-translate-text">
					<span>Nội dung cần dịch</span>
					<div class="form-group">
						<textarea name="trans-text" class="col-md-12 col-xs-12 col-sm-12 il-translate-content"></textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection