@extends('user.layouts.index')
@section('content')
@include('user.components.search.search')
    @if($status = Session::get('notify'))
        <div class="alert alert-info" role="alert">
            {{ $status}}
        </div>
    @endif()
@endsection
