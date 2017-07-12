@extends('backend.layouts.ilearn')

@section('title')
    Thông Tin Cá Nhân
@endsection

@section('content-header')
    <h1>Thông Tin Cá Nhân</h1>
@endsection

@section('content')
    @include('backend.components.user.profile.profile-content')
@endsection

@section('script')
    <script src="{!! asset('js/admin/admin.js') !!}"></script>
    <script src="{!! asset('js/admin/admin-profile.js') !!}"></script>
@endsection
