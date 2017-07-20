@extends('user.layouts.index')
@section('content')
	@include('user.components.search.search')
	<div class="row il-result">
		<div class="container">
			<div class="col-md-9 col-xs-12 col-sm-6 il-contents">
				<div class="row il-content-word">
					<div class="col-md-3 col-xs-12 col-sm-3">
						<div class="il-word"><span>{!! ucfirst($inputText) !!}</span></div>
						<div class="il-listen"><a href=""><i class="glyphicon glyphicon-volume-up"></a></i></div>
					</div>
					<div class="col-md-9 col-xs-12 col-sm-9">
						<div class="il-spelling">
							@if(isset($workSelf))
								@foreach( $workSelf as $language )
									<span>{!! $language -> pronounce !!}</span>
								@endforeach
							@endif
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="row il-word-tile">
					@if(isset($workInfo))
						<?php $type_word = '' ?>
						@foreach( $workInfo as $language)
							@if(!($type_word == $language->type_word))
								<?php $type_word = $language->type_word ?>
								<div class="il-category">{{ $language->type_word}}</div>
								@if(!Auth::guest())
									<ul class="il-list">
										<span class="glyphicon glyphicon-plus _push-his _tooltip-me" id="_id{!! $language -> id!!}"></span>&nbsp;<b>{!! $language->word!!}</b>
									</ul>
								@endif
								@if(Auth::guest())
									<ul class="il-list">
										<li><b>{!! $language->word!!}</b></li>
									</ul>
								@endif
							@else
								@if(!Auth::guest())
									<ul class="il-list">
										<span class="glyphicon glyphicon-plus _push-his _tooltip-me" id="_id{!! $language -> id!!}"></span>&nbsp;<b>{!! $language->word!!}</b>
									</ul>
								@endif
								@if(Auth::guest())
									<ul class="il-list">
										<li><b>{!! $language->word!!}</b></li>
									</ul>
								@endif
							@endif
						@endforeach
					@endif
				</div>
			</div>
			<div class="col-md-3 col-xs-12 col-sm-6 sidebar-offcanvas" id="sidebar">
				<div class="list-group il-sidebar">
					<a href="" title="" class="list-group-item active">Từ gợi ý</a>
					<a href="" class="list-group-item">Từ 1</a>
					<a href="" class="list-group-item">Từ 1</a>
					<a href="" class="list-group-item">Từ 1</a>
					<a href="" class="list-group-item">Từ 1</a>
				</div>
			</div>
		</div>
	</div>
	<hr>
@endsection
