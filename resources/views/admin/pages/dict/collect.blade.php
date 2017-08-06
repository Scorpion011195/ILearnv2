@extends('admin.layouts.ilearn')

@section('title')
    Thống kê
@endsection

@section('content-header')
    <h1>Thống kê</h1>
@endsection

@section('content')
    @include('admin.components.dict.collect.collect-content')
@endsection
