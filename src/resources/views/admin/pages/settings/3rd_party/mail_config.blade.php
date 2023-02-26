@extends('layouts.admin.admin_app')

@section('mail')
    custom-tab-active
@endsection
@section('admin_main_content')
    <section class="pb-3">
        <div class="rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('admin.home')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('Dashboard')}}</span>
                    </a>
                </li>

                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Mail Config')}}</span>
                </li>
            </ul>
        </div>
    </section>

    @include('admin.pages.includes.3rdParty.3rd_party_tabs')
    <!-- grid block section start  -->
    <section>
       <div class="rounded_box">
           <div class="row">
               <div class="col-12 col-lg-6 col-xl-12 mb-2">
                   <div class="shadow-sm rounded">
                       <div class="p-3 border-bottom">
                           <div class="d-flex align-items-center">
                               <h5 class="m-0">{{ decode('test your mail') }} <span class="text-danger">*</span></h5>
                           </div>
                       </div>
                       <div class="p-3">
                            <form action="{{route('admin.settings.test.mail')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-lg-9 mb-2">
                                        <input placeholder="Ex: test@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email"  type="mail">
                                        <div class="ms-3 text-danger">
                                            @error('email') {{ $message }} @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-3 mb-2">
                                        <button
                                            class="w-100 d-block btn btn--primary text-light" type="submit">Send</button>
                                    </div>
                                </div>
                            </form>
                       </div>
                   </div>
               </div>

               @foreach($mailConfigs as $mailer)
                <div class="col-12 col-lg-6 col-xl-6 mb-2">
                    <div class="shadow-sm rounded">
                        <div class="p-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <h5 class="m-0">{{ $mailer->name }} {{ decode('Mail Config') }}</h5>
                            </div>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input admin-status mailer-status" value="{{ $mailer->status }}" id="{{ $mailer->id }}" type="checkbox" id="flexSwitchCheckChecked }}"{{ $mailer->status == 'Active' ? 'checked':'' }} >
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="my-2">
                                <form action="{{ route('admin.settings.mailConfig.update') }}" method="post">
                                    @csrf
                                    <input hidden type="text" value="{{ $mailer->id }}" name="id" id="">
                                    @foreach(json_decode($mailer->driver_information,true) as $key => $value)
                                        @if($key != 'from')
                                            <div class="col-md-12 mt-3">
                                                <label for="city" class="form-label">{{ucfirst($key) }}</label>
                                                <input type="text" name="driver[{{ $key }}]" value="{{ $value }}" class="form-control" id="city">
                                            </div>
                                        @else
                                         @foreach(($value) as $from => $data)
                                            <div class="col-md-12 mt-3">
                                                <label for="city" class="form-label">{{ ucfirst($from) }}</label>
                                                <input type="text" name="driver[{{ $key }}][{{ $from }}] " value="{{ $data }}" class="form-control" id="city">
                                            </div>
                                         @endforeach
                                        @endif
                                    @endforeach
                                    <div class="col-12 col-md-6 mt-5">
                                        <button class="d-block btn btn--primary" type="submit">{{ decode('update') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               @endforeach

                {{--  update mail config status  --}}
                    <form id="mail-status" hidden action="{{route('admin.settings.mail.status')}}" method="post">
                        @csrf
                        <input hidden type="text" id="mail-id" name="id">
                    </form>
                {{--   update mail config status --}}

           </div>
       </div>
   </section>
   <!-- grid block section end -->

@endsection
@push('backend-js-push')
    <script>
        (function($) {

            "use strict";
            //mail change function
            $(document).on('click','.mailer-status',function(e){
                let id = $(this).attr('id')
                $('#mail-id').attr('value',id)
                $('#mail-status').submit()
            })


        })(jQuery);
    </script>
@endpush

