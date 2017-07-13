@extends('frontend.layouts.index')
@section('content')
	@include('frontend.components.search.search')
	<div class="row il-result">
		<div class="container">
			<div class="col-md-9 col-xs-12 col-sm-6 il-contents">
				<div class="row il-content-word">
					<div class="col-md-4 col-xs-12 col-sm-4">
						<div class="il-word"><span>Hello</span></div>
						<div class="il-spelling">[hə'lou]</div>
						<div class="il-listen"><i class="glyphicon glyphicon-volume-up"></i></div>
					</div>
					<div class="col-md-8 col-xs-12 col-sm-8">
						<div class="il-explain">
							<h5>Noun</h5>
							<span>An utterance of “hello”; a greeting.she was getting polite nods and hellos from people</span>
							<h5>Verb</h5>
							<span>An utterance of “hello”; a greeting.she was getting polite nods and hellos from people</span>
							<h5>Abject</h5>
							<span>An utterance of “hello”; a greeting.she was getting polite nods and hellos from people</span>
							<h5>Adv</h5>
							<span>An utterance of “hello”; a greeting.she was getting polite nods and hellos from people</span>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<hr>
				<div class="row il-word-tile">
					<div class="il-category">Thán từ</div>
					<ul class="il-list">
						<li><b>Xin chào</b></li>
					</ul>
					<ul class="il-list">
						<li><b>Này, này</b></li>
					</ul>
					<div class="il-category clearfix">Danh từ</div>
					<ul class="il-list">
						<li><b>Tiếng chào</b></li>
					</ul>
					<ul class="il-list">
						<li><b>Câu chào</b></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 col-xs-12 col-sm-6 sidebar-offcanvas" id="sidebar">
				<div class="list-group il-sidebar">
					<a href="" title="" class="list-group-item active">Từ có liên quan</a>
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
