
@extends('layouts.admin.auth.admin_auth_app')
@section('admin_auth_title')
 {{ $generalSetting->name }} | {{ decode('Login') }}
@endsection
@section('admin_auth_content')
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

                        @php
                          $recaptcha = (json_decode($generalSetting->recaptcha,true));
                          $siteKey  = $recaptcha['key'];
                        @endphp

                        <form id="login-form"  class="text-start w-75" method="POST"  action="{{ route('admin.login.post') }}"  >
                            @csrf
                            <h5 class="mb-5">Login as admin user</h5>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email/User Name</label>

                                <div class="row align--center border-0 border-bottom">
                                    <div class="col-1 text-center">
                                        <i class="fas fa-envelope text-light"></i>
                                    </div>
                                    <div class="col-11">
                                        <input name="email"
                                        required
                                        type="text"
                                        class="form-control bg-transparent border-0 rounded p-2 text-light"
                                        placeholder="Email /User name"
                                        id="exampleInputEmail1"
                                        value="{{ old('email') }}"
                                       />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <div class="row align--center border-0 border-bottom">
                                    <div class="col-1 text-center">
                                      <i class="fas fa-lock text-light"></i>
                                    </div>
                                    <div class="col-9">
                                      <input required value="{{ old('password') }}" type="password"
                                        class="form-control bg-transparent border-0 rounded p-2 text-light"
                                        placeholder="8+ characters is required" id="exampleInputPassword1" name="password" />
                                    </div>
                                    <div class="col-2 text-center">
                                        <i onclick="hidePassword()" class="hidePass d-none lar la-eye"></i>
                                        <i onclick="showPassword()" class="showPass lar la-eye-slash"></i>
                                    </div>
                                  </div>
                            </div>
                            <div class="mb-3">
                                @if(($recaptcha) && $recaptcha['status'] == 'Active')
                                    <div id="recaptcha" class="w-100;" data-type="image"></div>
                                    <br/>
                                @else
                                    <a id='genarate-captcha'>
                                        <img class="captcha-default" src="{{ route('admin.captcha.genarate',1) }}" id="default-captcha">
                                        <i class="las la-sync"></i>
                                    </a>
                                    <div class="mt-2">
                                        <input type="text" class="form-control bg-transparent border-light rounded-0 p-2 text-light" name="default_captcha_code" value="" placeholder="{{decode('Enter captcha value')}}" autocomplete="off">
                                    </div>
                                @endif
                            </div>
                            <button class="d-block text-center btn btn-dark w-100 border rounded p-2 btn--indigo text-light">
                                Login
                            </button>
                            <br/><br/>
                            <a href="{{ route('admin.resetPassword') }}" class="mb-5 text--lite--purple">Forgotten password</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('backend-auth-js-push')
<script>
    (function($) {
        "use strict";
        //datatable initiation
        $(document).on('click','#genarate-captcha',function(e){
            let url = "{{ route('admin.captcha.genarate',[":randId"]) }}"
            url = (url.replace(':randId',Math.random()))
            document.getElementById('default-captcha').src = url;
            e.preventDefault()
        })
    })(jQuery);
</script>

@if(($recaptcha) && $recaptcha['status'] == 'Active')
    <script type="text/javascript">

        var onloadCallback = function () {
            grecaptcha.render('recaptcha', {
                'sitekey':"{{   $siteKey  }}"
            });
        };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    <script>
        $("#login-form").on('submit',function(e) {
            let  responseData = grecaptcha.getResponse();
            if (responseData.length === 0) {
                toast.fire({
                    icon: 'error',
                    title: "{{ decode('Please Check Recaptcha!! Then Try Again') }}"
                    })
                e.preventDefault()
            }
        });
    </script>
@endif
@endpush







