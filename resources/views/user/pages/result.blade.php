@extends('user.layouts.index')
@section('content')
	@include('user.components.search.search')
	<div class="row il-result">
		<div class="container">
			<div class="col-md-9 col-xs-12 col-sm-6 il-contents">
				<div class="row il-content-word">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="il-word"><span>{!! ucfirst($inputText) !!}</span></div>
					</div>
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="il-spelling">
							@if(isset($workSelf))
							<?php $pronounce = '' ?>
								@foreach( $workSelf as $language )
								@if(!($pronounce == $language->pronounce))
									<?php $pronounce = $language->pronounce ?>
									<span>{!! $language -> pronounce !!}</span>
								@endif
								@endforeach
							@endif
						</div>
					</div>
				</div>
				<hr>
				<div class="clearfix"></div>
				<div class="row il-word-tile">
					@if(isset($workInfo))
						<?php $type_word = '' ?>
						@foreach( $workInfo as $language)
							@if(!($type_word == $language->type_word))
								<?php $type_word = $language->type_word ?>
								<div class="il-category">{{ $language->type_word}}</div>
								@if(!Auth::guest())
									<ul class="il-list">
									    <span hidden>{{ $language->type_word }}</span>
										<span class="glyphicon glyphicon-hand-right _push-his _tooltip-me" id="_id{!! $language -> id!!}" title="Thêm vào Từ của tôi"></span>&nbsp;
										<b contenteditable>{!! $language->word!!}</b>
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
									    <span hidden>{{ $language->type_word }}</span>
										<span class="glyphicon glyphicon-hand-right _push-his _tooltip-me" id="_id{!! $language -> id!!}" title="Thêm vào Từ của tôi"></span>&nbsp;
										<b contenteditable>{!! $language->word!!}</b>
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
					@if(isset($workRelate))
						<?php $checkWordRelated = '' ?>
						@foreach($workRelate as $language)
							@if(($language->word) != $checkWordRelated)
                                <?php $checkWordRelated = $language->word ?>
                                <a class="btnSearch" href="javascript:void(0);" id="list-group-item"> {!! $language->word !!}</a>
                            @endif()
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
	<hr>
	<!-- facebook cmt -->
	@if(!Auth::guest())
		<div class="row">
		  	<div class="container">
			    <div class="col-md-9 col-xs-12 col-sm-6 il-contents">
				  	<div class="fb-comments" data-href="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" data-width="500" data-numposts="5"></div>
				  	<div
						class="fb-like"
						data-share="true"
						data-width="450"
						data-show-faces="true">
					</div>
				</div>
		  	</div>
		</div>
	@endif
	<!-- /.facebook cmt -->
@endsection
