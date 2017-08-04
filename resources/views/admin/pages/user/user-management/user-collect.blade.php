@extends('admin.layouts.ilearn')

@section('title')
    Thống kê user
@endsection

@section('content-header')
    <h1>Thống kê user<small></small></h1>
@endsection

@section('content')
    @include('admin.components.user.user-management.account-content')
@endsection

@section('script')
    <script src="{!! asset('js/admin/admin.js') !!}"></script>
    <script src="{!! asset('js/admin/admin-accounts.js') !!}"></script>
@endsection
