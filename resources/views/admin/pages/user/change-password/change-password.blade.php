@extends('backend.layouts.ilearn')

@section('content-header')
    <h1>Đổi mật khẩu</h1>
@endsection

@section('content')
    @include('backend.components.user.change-password.change-password-content')
@endsection

@section('script')
    <script src="{!! asset('js/admin/admin.js') !!}"></script>
@endsection
