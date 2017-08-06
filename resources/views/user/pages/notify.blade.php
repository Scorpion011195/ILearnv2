@extends('user.layouts.index')

@section('content')
@if(Auth::guest())
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{{url('login')}}" title="">Đăng nhập</a> để sử dụng chức năng này
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
