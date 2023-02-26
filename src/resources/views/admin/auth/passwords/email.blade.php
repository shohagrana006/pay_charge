
@extends('layouts.admin.auth.admin_auth_app')
@section('admin_auth_title')
 {{ $generalSetting->name }} | {{ decode('Reset Password') }}
@endsection
@section('admin_auth_content')
    <div class="container-fluid p-0">
        <div class="login_container">
            <div class="row login_form">
                <div class="col-12 col-md-7 col-lg-8 col-xl-9 p-0 m-0 column-1">
                <img
                    src="https://img.freepik.com/free-photo/vintage-architecture-classical-facade-building-with-red-door_158595-6444.jpg?t=st=1650695296~exp=1650695896~hmac=43043faddd3db91ea80285950d237e394fada6c0973cc2b0f2614e6e5b044194&w=1380"
                    alt=""
                    class="w-100 h-100" />
                </div>
                <div class="col-12 col-md-5 col-lg-4 col-xl-3 p-0 m-0 column-2">
                    <div class="d-flex align-items-center justify-content-center h-100 w-100 p-3">
                        <form class="text-start w-75" method="POST"  action="{{ route('admin.resetpassword.post') }}"  >
                            @csrf
                            <h5 class="mb-5">{{ decode('Reset Password') }}</h5>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">{{ decode('Email') }}</label>
                                <div class="row align--center border-0 border-bottom">
                                    <div class="col-1 text-center">
                                        <i class="fas fa-envelope text-light"></i>
                                    </div>
                                    <div class="col-11">
                                        <input name="email"
                                        type="email"
                                        class="form-control bg-transparent border-0 rounded p-2 text-light"
                                        placeholder="Email"
                                        id="exampleInputEmail1"
                                       />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="d-block text-center w-100 border-0 rounded border-light p-2 btn--dark text-light">
                                {{ decode('Send Password Reset Link') }}
                            </button>
                            <br/><br/>
                            <p class="text-muted mb-0">{{ decode('Do Nothing') }}? <a href="{{ route('admin.login') }}"
                                class="text-primary fw-semibold"> {{ decode('Login') }}</a> </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
