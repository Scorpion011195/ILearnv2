@extends('admin.layouts.ilearn')

@section('title')
    Upload từ điển
@endsection

@section('content-header')
    <h1>Upload từ điển</h1>
@endsection

@section('content')
    @include('admin.components.dict.upload.upload-content')
@endsection
