@extends('layouts.admin.admin_app')
@section('recaptcha')
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
                    <span>{{decode('Recaptcha')}}</span>
                </li>
            </ul>
        </div>
    </section>
    @include('admin.pages.includes.3rdParty.3rd_party_tabs')
    <section class="mt-3">
        <div class="rounded_box">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-12 mb-2">
                    <div class="shadow-sm rounded">

                    </div>
                </div>
                    @php
                        $recaptcha = (json_decode($generalSetting->recaptcha,true));
                    @endphp
                 <div class="col-12 col-lg-12 col-xl-12 mb-2">
                     <div class="shadow-sm rounded">
                         <div class="p-3 border-bottom">
                             <div class="d-flex align-items-center justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <h5 class="m-0"> {{ decode('Recaptcha Setup') }}</h5>
                                    <div class="form-check form-switch ms-2 min_height0">
                                        <input id="recaptcha-status-update" class="form-check-input admin-status mailer-status" value="{{  $recaptcha['status'] }}"
                                        {{  $recaptcha['status'] == 'Active'? 'checked' : "" }}
                                        type="checkbox" id="flexSwitchCheckChecked }}" >
                                    </div>
                                 </div>
                                 <a target="_blanck" href="https://www.google.com/recaptcha/admin/create" class="btn border rounded">{{ decode('Credential Setup Page') }}</a>
                             </div>
                         </div>
                         <div class="p-3">
                             <div class="my-2">
                                <form action="{{ route('admin.settings.recaptcha.update') }}" method="post">
                                    @csrf
                                    <div class="col-md-12 mt-3">
                                        <label for="" class="form-label">Key</label>
                                        <input type="text" name="recaptcha[key]" value="{{   $recaptcha['key'] }}" class="form-control" id="">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="" class="form-label">Secret Key</label>
                                        <input type="text" name="recaptcha[secret_key]" value="{{$recaptcha['secret_key'] }}" class="form-control" id="">
                                        <input hidden type="text" name="recaptcha[status]" value="{{$recaptcha['status'] }}" class="form-control" id="">
                                    </div>
                                    <div class="col-12 col-md-6 mt-3">
                                        <button class="d-block btn btn--primary" type="submit">{{ decode('update') }}</button>
                                    </div>
                                </form>
                             </div>
                         </div>
                     </div>
                 </div>
                 {{--  update recaptcha status  --}}
                     <form id="recaptcha-status" hidden action="{{route('admin.settings.recaptcha.status')}}" method="post">
                        @csrf
                     </form>
                 {{--   update recaptcha status --}}
            </div>
        </div>
    </section>
@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //mail change function
            $(document).on('click','#recaptcha-status-update',function(e){
                $('#recaptcha-status').submit()
            })
        })(jQuery);
    </script>
@endpush

