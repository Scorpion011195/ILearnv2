@extends('admin.layouts.ilearn')

@section('title')
    Thông Tin Cá Nhân
@endsection

@section('content-header')

    <h2><b><center>Thông tin cá nhân</center></b></h2>
    @if(isset($message))
<div class="alert alert-success alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Cập nhật thông tin thành công!
  </div>
@endif
@endsection

@section('content')
    @include('admin.components.user.profile.profile-content')
@endsection

@section('script')
    <script src="{!! asset('js/admin/admin.js') !!}"></script>
@endsection
