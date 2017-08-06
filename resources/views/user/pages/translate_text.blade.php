@extends('user.layouts.index')
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
				    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			     	<select class="lagForm " id="lang_from">
			     	    @foreach($listLanguages as $key => $value)
			     	        <option value="{{ $key }}">Tiếng {{ $value }}</option>
			     	    @endforeach
			      	</select>
			     	<select class="lagTo" id="lang_to">
				        @foreach($listLanguages as $key => $value)
			     	        <option value="{{ $key }}">Tiếng {{ $value }}</option>
			     	    @endforeach
			      	</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-12 il-translate-text">
					<span>Nội dung cần dịch</span>
					<textarea rows="10" class="col-md-12 col-xs-12 col-sm-12" id="paragraph_from"></textarea>
					<div class="error_translate">
                    </div>
				</div>
			</div>
			<div class="row il-translate-button clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-4 il-translate-text">
					<button id="btn_translate" class="btn btn-warning">Dịch</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12 col-sm-12 il-translate-text"">
				    <div class="paragraph_to">
				    </div>
				</div>
			</div>
		</div>
	</div>
@endsection
