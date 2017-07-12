@extends('backend.layouts.ilearn')

@section('title')
    Tra từ
@endsection

@section('content-header')
    <h1>Tra từ</h1>
@endsection

@section('content')
    @include('backend.components.dict.search.search-content')
@endsection

@section('script')
    <script src="{!! asset('js/admin/admin.js') !!}"></script>
    <script src="{!! asset('js/admin/admin-search.js') !!}"></script>
@endsection
