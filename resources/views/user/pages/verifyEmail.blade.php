@extends('user.layouts.index')
@section('content')
	<h2>Verify Your Email Address</h2>
	Hi {!! $username !!}
        <div>
            Thanks for creating an account with the verification demo app.
            Please follow the link below to verify your email address
            {{ route ('confirm', $confirmation_code)}}
        </div>
@endsection