@extends('backend.layouts.ilearn')

@section('title')
    Thông tin tài khoản
@endsection

@section('content-header')
    <h1>Thông tin tài khoản<small>{{ $user->username }}</small></h1>
@endsection

@section('content')
    @include('backend.components.user.user-management.detail-user-content')
@endsection

@section('script')
    <script src="{!! asset('js/admin/admin.js') !!}"></script>
    <script src="{!! asset('js/admin/admin-accounts.js') !!}"></script>
@endsection
