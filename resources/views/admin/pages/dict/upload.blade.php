@extends('admin.layouts.ilearn')

@section('title')
    Thêm file csv
@endsection

@section('content-header')
    <h1>Thêm file csv</h1>
@endsection

@section('content')
    @include('admin.components.dict.upload.upload-content')
@endsection

@section('script')
    <script src="{!! asset('js/admin/admin-upload.js') !!}"></script>
@endsection
