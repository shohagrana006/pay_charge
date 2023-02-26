
@extends('layouts.user.auth.user_auth_app')
@section('user_auth_title')
 {{ $generalSetting->name }} | {{ decode('Verify Email') }}
@endsection
@section('user_auth_content')
    <div class="container-fluid p-0">
        <div class="login_container">
            <div class="row login_form">
                <div class="col-12 col-md-6 col-lg-8 col-xl-9 p-0 m-0 column-1">
                <img
                    src="https://img.freepik.com/free-photo/vintage-architecture-classical-facade-building-with-red-door_158595-6444.jpg?t=st=1650695296~exp=1650695896~hmac=43043faddd3db91ea80285950d237e394fada6c0973cc2b0f2614e6e5b044194&w=1380"
                    alt=""
                    class="w-100 h-100" />
                </div>

                <div class="col-12 col-md-5 col-lg-4 col-xl-3 p-0 m-0 column-2">
                    <div class="d-flex align-items-center justify-content-center h-100 w-100 p-3">
                        <form id="login-form"  class="text-start w-75" method="POST"  action="{{ route('user.otp.verify') }}"  >
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">{{decode('Email verification OTP')}}</label>

                                <div class="row align--center border-0 border-bottom">
                                    <div class="col-1 text-center">
                                        <i class="fas fa-envelope text-light"></i>
                                    </div>
                                    <div class="col-11">
                                        <input name="otp"  type="text" class="form-control bg-transparent border-0 rounded p-2 text-light" placeholder="Enter OTP" id="exampleInputEmail1" value="{{ old('otp') }}" />
                                    </div>
                                </div>
                            </div>

                            <button class="d-block text-center btn btn-dark w-100 border rounded p-2 btn--indigo text-light">
                                {{decode('Email Verify')}}
                            </button>
                            <br/><br/>
                            <a href="{{ route('user.otp.resend', request()->route('token')) }}" class="mb-5 text--lite--purple">{{decode('Resend code')}}</a>
                            <br>
                            <a href="{{ route('user.login') }}" class="mb-5 text--lite--purple">{{decode('Login')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend-auth-js-push')

@endpush