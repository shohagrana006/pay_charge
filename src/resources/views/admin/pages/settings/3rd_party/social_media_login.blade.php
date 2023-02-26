@extends('layouts.admin.admin_app')

@section('media_login')
    custom-tab-active
@endsection
@section('admin_main_content')
    <section>
        <div class="p-3 rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('admin.home')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('Dashboard')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('admin.settings.mail')}}" >
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('3rd Party')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Socail Login Method')}}</span>
                </li>
            </ul>
        </div>
    </section>
   @include('admin.pages.includes.3rdParty.3rd_party_tabs')

    <section class="mt-3">
        <div class="rounded_box">
            <div class="row">
                @php
                    $social_login =  json_decode($generalSetting->social_login,true);
                @endphp

                @foreach($social_login as $key => $oauthCred)
                    <div class="col-12 col-lg-6 col-xl-6 mb-2">
                        <form action="{{ route('admin.settings.media.login.update')}}" method="post">
                            @csrf
                            <input hidden type="text" name="oauth_key" value="{{ $key }}">
                            <div class="shadow-sm rounded">
                                <div class="p-3 position-relative">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <h5 class="m-0"> {{  ucwords(str_replace('_', ' ', $key)) }}</h5>
                                    </div>
                                    @php
                                        $oauthCred =  json_decode($oauthCred,true);
                                    @endphp
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-end p-2">
                                        <div class="form-check form-switch mt-2">
                                        <input class="form-check-input cred-status-update" value="{{$key}}"  type="checkbox" id="flexSwitchCheckChecked }}"{{ $oauthCred['status'] == 'Active' ? 'checked':'' }} >
                                        </div>
                                    </div>
                                </div>
                                @php
                                  $medimum =  explode("_",$key);
                                @endphp
                                <div class="p-3">
                                    <div class="mb-3">
                                        <label class="d-block" for="">{{decode('Callback URI')}}</label>
                                        <div class="border position-relative rounded">
                                            <input value= "{{route('user.social.login.callback',$medimum[0])}}" readonly type="text" class="form-control border-0">
                                            <div class="position-absolute d-flex align-items-center justify-contend-end top-0 h-100 me-1 end-0">
                                                <button data-route ='{{route('user.social.login.callback',$medimum[0])}}' class="copy-text btn btn-sm btn-primary"><span class="me-1"><i class="lar la-copy"></i></span><span class="hide_small">Copy URI</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Store Client ID</label>
                                        <input value="{{ $oauthCred['client_id'] }}" type="text" class="form-control" name="{{$key}}[client_id]" id="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Store Client Secret key</label>
                                        <input value="{{ $oauthCred['client_secret'] }}" type="text" class="form-control" name="{{$key}}[client_secret]" id="">
                                        <input hidden value="{{ $oauthCred['status'] }}" type="text" class="form-control" name="{{$key}}[status]" id="">
                                    </div>

                                    <div class="mt-3 d-flex align-items-center justify-content-between">
                                        <a
                                        @if($key == 'google_oauth')
                                        href="https://console.cloud.google.com/apis/credentials"
                                        @else
                                        href="https://developers.facebook.com/apps/"
                                        @endif
                                        class="btn border border-primary text-primary">{{ decode('See Credential Setup Instruction') }}
                                        </a>
                                        <button class="btn btn-primary px-4">{{ decode('save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        {{--  update oauth cred status  --}}
            <form id="oauth-cred-status" hidden action="{{route('admin.settings.media.Login.status')}}" method="post">
                <input name="oauth_key" id="oauth-key" type="text">
               @csrf
            </form>
        {{--  update oauth cred status   --}}
    </section>
@endsection

@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //cred status change function
            $(document).on('click','.cred-status-update',function(e){
                const key = $(this).attr('value')
                $('#oauth-key').val(key)
                $('#oauth-cred-status').submit()
            })

            // copy text form input field
            $(document).on('click','.copy-text',function(e){
                let url = $(this).attr('data-route');
                let tempInput = $("<input>");
                $("body").append(tempInput);
                tempInput.val(url).select();
                document.execCommand("copy");
                tempInput.remove();
                toast.fire({
                    icon: 'success',
                    title: "Call Back Url Coppied Successfully Successfully"
                })
            })
        })(jQuery);
    </script>
@endpush
