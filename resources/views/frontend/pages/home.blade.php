@extends('frontend.layouts.index')
@section('content')
@include('frontend.components.search.search')
	@if(isset($flash))
        <div class='col-md-3 margin--top-10-px'></div>
        <div class="col-md-6 margin--top-10-px">
            <div class="alert alert-info" id='idsuccess'>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h2 align="center"><strong>Chúc mừng!</strong> Bạn đã đăng ký thành công.</h2>
            </div>
            Bấm <a href="{{ url('dangnhap') }}">Đăng nhập</a> để đăng nhập
        </div>
    @endif

    @if(isset($flag))
        <div class='col-md-3 margin--top-10-px'></div>
        <div class="col-md-6 margin--top-10-px">
            <div class="alert alert-warning" id='idsuccess'>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  <h2 align="center">Dữ liệu đang được cập nhật</h2>
            </div>
        </div>
    @endif
@endsection
