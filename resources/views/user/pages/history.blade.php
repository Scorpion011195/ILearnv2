@extends('user.layouts.index')
@section('content')
	<section class="container margin-top margin-footer">
	    <div class="">
	        <div class="panel-content">
	            @include('user.components.partial.create-dict')
	        </div>
	        <div class=" text-center">
	            @include('user.components.partial.settings-table')
	        </div>
	    </div>
	</section>
@endsection

