@extends('user.layouts.index')
@section('content')
@include('user.components.search.search')
	<div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 col-lg-offset-3 col-md-offset-2 col-sm-offset-2">
	    @if($status = Session::get('status'))
	        <div class="alert alert-success" role="alert">
	            {{ $status}}
	        </div>
	    @endif()
	</div>
@endsection
