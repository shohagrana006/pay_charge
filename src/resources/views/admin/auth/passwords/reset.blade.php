
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
                        <form class="text-start w-75" method="POST"  action="{{ route('admin.updatePassword.post') }}"  >
                            @csrf
                            <h5 class="mb-5">{{ decode('Update Password') }}</h5>
                            <div class="mb-3">
                                <input type="hidden" name="token" value="{{ $data['reset_data']->token }}">
                                <input hidden type="email"  class="form-control" id="input-username"  name="email" value="{{ $data['reset_data']->email }}" placeholder="Enter Email">
                                <label for="exampleInputEmail1" class="form-label">{{ decode('password') }}</label>
                                <div class="row align--center border-0">

                                    <div class="col-11">
                                        <input type="password" class="form-control bg-transparent border-0 rounded p-2 text-light" id="input-new-password" name="password" placeholder="Enter new password">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">{{ decode('Confirm password') }}</label>
                                <div class="row align--center border-0 ">

                                    <div class="col-11">
                                        <input type="password" class="form-control bg-transparent border-0 rounded p-2 text-light" id="input-new-password_confirm" name="password_confirmation" placeholder="Enter confirm password">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="d-block text-center btn btn-dark w-100 border rounded p-2 btn--indigo text-light">
                             {{ decode('Update Password') }}
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

@push('admin-auth-js-push')

@if ($errors->any())
    <script>
          Toast.fire({
            icon: 'error',
            title: 'SomeThing Went Wrong!! Unauthorized Token , or Password Mismatch !! Please Try Again'
          })
    </script>
@endif

@endpush












