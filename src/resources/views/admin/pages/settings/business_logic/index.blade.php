@extends('layouts.admin.admin_app')

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
                    <span>{{decode('Business Logic')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <section>
        <div class="row g-3">
            <div class="col-12 col-lg-6 col-xl-6">
                <div class="rounded_box maintanance_mode">
                    <div class="d-flex align-items-center justify-content-between border rounded py-2 px-3">
                        <h6 class="m-0">{{ decode('Maintanace Mood') }}</h6>
                        <div class="form-check form-switch">

                            {{ $generalSettings->maintenance_mood  }}
                            <input key="maintenance_mood" class="  key-update form-check-input" type="checkbox"
                            {{ $generalSettings->maintenance_mood == 'Active' ? "checked" :'' }}>
                        </div>

                    </div>
                    <small class="text-secondary">('site maintaince mode')</small>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-6">
                <div class="rounded_box maintanance_mode">
                    <div class="d-flex align-items-center justify-content-between border rounded py-2 px-3">
                        <h6 class="m-0">{{ decode('Demo Mode') }}</h6>
                        <div class="form-check form-switch">
                            {{ $generalSettings->demo_mode  }}
                            <input key="demo_mode" class=" key-update form-check-input" type="checkbox"
                            {{ $generalSettings->demo_mode == 'Active' ? "checked" :'' }}>
                        </div>

                    </div>
                    <small class="text-secondary">('Site Demo Mode')</small>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-6">
                <div class="rounded_box maintanance_mode">
                    <div class="d-flex align-items-center justify-content-between border rounded py-2 px-3">
                        <h6 class="m-0">{{ decode('Accept Cookie') }}</h6>
                        <div class="form-check form-switch">
                            {{ $generalSettings->accept_cookie  }}
                            <input key="accept_cookie" class="key-update form-check-input" type="checkbox"
                            {{ $generalSettings->accept_cookie == 'Active' ? "checked" :'' }}>
                        </div>

                    </div>
                    <small class="text-secondary">('Frontend Accept Cookie')</small>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-6">
                <div class="rounded_box maintanance_mode">
                    <h6 class="">{{ decode('Counted By') }}</h6>
                    <div class="like_form d-flex align-items-center justify-content-between">
                        <div class="form-check form-switch">
                            <input  value="ip"
                            {{$generalSettings->count_by == 'ip' ?'checked' :'' }}
                                class="form-check-input count-by" type="checkbox" id="flexSwitchCheckChecked" >
                            <span>IP Base</span>
                        </div>
                        <div class="form-check form-switch">
                            <input  value="session"
                            {{$generalSettings->count_by == 'session' ?'checked' :'' }}
                                class="form-check-input count-by" type="checkbox" id="flexSwitchCheckChecked" >
                            <span>Session Base</span>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
     {{--  update count by form  --}}
    <form id="count-by" hidden action="{{ route('admin.settings.countby') }}" method="post">
        @csrf
        <input type="text" id="count-by-val" name="count_by">
    </form>
    {{--  update count by form end  --}}

     {{--  update count by form  --}}
    <form id="update-key-status" hidden action="{{ route('admin.settings.key.update') }}" method="post">
        @csrf
        <input type="text" id="key-id" name="key">
    </form>
    {{--  update count by form end  --}}

    <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section class="mt-3 bg--light rounded">
            <div class="row">
                <div class="col-12">
                    <div class="shadow-sm rounded">
                        <div class="p-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <i class="lar la-building fs-4 me-3 text--primary"></i>
                                <h6 class="m-0 fw-bold">{{ decode('Company Information') }}</h6>
                            </div>
                        </div>
                        <div class="px-3 pt-2 pb-3">
                            <div class="row">
                                <div class="col-12 col-lg-6 col-xl-4 mb-2">
                                    <label class="text-secondary" for="system-currency">{{ decode('Company Name') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="system-currency" class="form-control @error('name')
                                    is-invalid
                                    @enderror bg-transparent mt-1" value="{{$generalSettings->name}}">
                                    <div class="ms-3 text-danger">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-xl-4 mb-2">
                                    <label class="text-secondary" for="company-phone">{{ decode('Company Phone') }}<span class="text-danger">*</span> </label>
                                    <input type="text" name="phone" id="company-phone" class="form-control @error('phone')
                                    is-invalid
                                    @enderror
                                     bg-transparent mt-1" value="{{ $generalSettings->phone }}">
                                    <div class="ms-3 text-danger">
                                        @error('phone')
                                        {{ $message }}
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-lg-6 col-xl-4 mb-2">
                                    <label class="text-secondary" for="company-email">{{ decode('Company Email') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="email" id="company-email" class="form-control  @error('email')
                                    is-invalid
                                    @enderror
                                    bg-transparent mt-1" value="{{ $generalSettings->email }}">
                                    <div class="ms-3 text-danger">
                                        @error('email')
                                        {{ $message }}
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12 col-lg-6 col-xl-4 mb-2">
                                    <label class="text-secondary" for="company-address">{{ decode('Company Address') }}</label>
                                    <input type="text" name="address" id="company-address" class="form-control
                                        @error('address')
                                        is-invalid
                                        @enderror
                                    bg-transparent" value="{{ $generalSettings->address }}">
                                    <div class="ms-3 text-danger">
                                        @error('address')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-3 bg--light rounded">
            <div class="row">
                <div class="col-12">
                    <div class="shadow-sm rounded">
                        <div class="p-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <i class="lar la-building fs-4 me-3 text--primary"></i>
                                <h6 class="m-0 fw-bold">{{ decode('System Currency SetUp') }}</h6>
                            </div>
                        </div>
                        <div class="px-3 pt-2 pb-3">
                            <div class="row">
                                @foreach(json_decode( $generalSettings->currency_setup,true) as $key => $value)
                                <div class="col-12 col-lg-6 col-xl-6 mb-2">
                                    <label class="text-secondary" for="system-currency">{{ (ucfirst($key)) }}
                                        <span class="text-danger">*</span></label>
                                    <input type="text" name="currency[{{ $key }}]" id="system-currency" class="form-control @error('currency.'.$key)
                                    is-invalid
                                    @enderror bg-transparent mt-1" value="{{$value}}">
                                    <div class="ms-3 text-danger">
                                        @error('currency.'.$key)
                                          {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mt-3">
            <div class="rounded_box">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-4 mb-2">
                        <div class="shadow-sm rounded">
                            <div class="d-flex align-items-center p-3 border-bottom justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="las la-photo-video fs-4 me-3 text-secondary"></i>
                                    <h5 class="m-0">{{ decode('Admin site logo') }}
                                        <span class="text-danger"> ({{implode(", ", fileFormat())}})</span></label>
                                    </h5>
                                </div>
                                <span class="text--secondary">{{ App\Cp\ImageProcessor::filePath()['logo']['size'] }}</span>
                            </div>
                            <div class="p-3">
                                <div id="site-preview" class=" block_image my-5">
                                    <img  src="{{ displayImage('assets/images/general/weblogo/' . $generalSettings->logo, App\Cp\ImageProcessor::filePath()['logo']['size']) }}"
                                        alt="" class="w-100 h-100">
                                </div>

                            </div>
                            <div class="d-flex align-items-center px-3 pt-2 border-top justify-content-between">
                                <div class="fav-preview input-group mb-3">
                                    <input type="file"  id="site-logo" name="logo" class="form-control
                                    @error('logo')
                                      is-invalid
                                    @enderror
                                    " placeholder="Upload Image"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>

                            </div>
                            <div class="ms-3 text-danger">
                                @error('logo')
                                 {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 col-xl-4 mb-2">
                        <div class="shadow-sm rounded">
                            <div class="d-flex align-items-center p-3 border-bottom justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="las la-photo-video fs-4 me-3 text-secondary"></i>
                                    <h5 class="m-0">{{ decode('Fav Icon') }}
                                     <span class="text-danger"> ({{implode(", ", fileFormat())}})</span></label>
                                    </h5>
                                </div>
                                <span class="text--secondary">{{ App\Cp\ImageProcessor::filePath()['favicon']['size'] }}</span>

                            </div>
                            <div class="p-3">
                                <div id="fav-preview" class="loader_image my-5">
                                    <img src="{{ displayImage('assets/images/general/favIcon/' . $generalSettings->favicon, App\Cp\ImageProcessor::filePath()['favicon']['size']) }}" alt="" class="w-100 h-100">
                                </div>
                            </div>
                            <div class="d-flex align-items-center px-3 pt-2 border-top justify-content-between">
                                <div class="input-group mb-3">
                                    <input type="file"  id="fav-icon" name="favicon" class="form-control
                                    @error('favicon')
                                    is-invalid
                                    @enderror
                                    " placeholder="{{decode('Upload favicon')}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>

                            </div>
                            <div class="ms-3 text-danger">
                                @error('favicon')
                                 {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>


                    {{--  mail footer start  --}}
                    <div class="col-12 col-lg-6 col-xl-4 mb-2">
                        <div class="shadow-sm rounded">
                            <div class="d-flex align-items-center p-3 border-bottom justify-content-between">
                                <div class="d-flex align-items-center">
                                    <i class="las la-photo-video fs-4 me-3 text-secondary"></i>
                                    <h5 class="m-0">{{ decode('Mail  Footer Logo') }}
                                     <span class="text-danger"> ({{implode(", ", fileFormat())}})</span></label>
                                    </h5>
                                </div>
                                <span class="text--secondary">{{ App\Cp\ImageProcessor::filePath()['mail_footer']['size'] }}</span>

                            </div>
                            <div class="p-3">
                                <div id="mail-logo-preview"  class=" mail_footer_logo my-5">
                                    <img src="{{ displayImage('assets/images/general/mailFooter/' .  json_decode($generalSettings->mail_footer,true)['logo'], App\Cp\ImageProcessor::filePath()['mail_footer']['size']) }}" alt="" class="w-100 h-100">
                                </div>
                            </div>
                            <div class="d-flex align-items-center px-3 pt-2 border-top justify-content-between">

                                <div class="input-group mb-3">
                                    <input type="file"  id="mail-footer-logo" name="mail_footer[logo]" class="form-control
                                    " placeholder="{{decode('Upload Mail Footer Logo')}}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>

                            </div>
                            <div class="ms-3 text-danger">
                                @error('mail_footer.logo')
                                 {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{--  mail footer end  --}}
                        <div class="col-12 col-lg-4">
                            <div class="shadow-sm rounded">
                                <div class="d-flex align-items-center p-3 border-bottom justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="las la-paragraph fs-4 me-3 text-secondary"></i>
                                        <h5 class="m-0">{{ decode('Copyright Text') }}
                                        <label><span class="text-danger">*</span> </label>
                                        </h5>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <input class="form-control
                                    @error('copy_right_text')
                                    is-invalid
                                    @enderror
                                    " type="numbner" name="copy_right_text" value="{{ $generalSettings->copy_right_text }}" name="copy_right_text" id="">
                                </div>
                                <div class="ms-3 text-danger">
                                    @error('copy_right_text')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="shadow-sm rounded">
                                <div class="d-flex align-items-center p-3 border-bottom justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="las la-sort-numeric-up fs-4 text-secondary me-3"></i>
                                        <h5 class="m-0">{{ decode('Pagination Number') }}
                                        <label><span class="text-danger">*</span> </label>
                                        </h5>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <input class="form-control
                                    @error('pagination_number')
                                    is-invalid
                                    @enderror
                                    " type="numbner" name="pagination_number" value="{{ $generalSettings->pagination_number }}" name="pagination_number" id="">
                                </div>
                                <div class="ms-3 text-danger">
                                    @error('pagination_number')
                                    {{ $message }}
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="shadow-sm rounded">
                                <div class="d-flex align-items-center p-3 border-bottom justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="las la-link fs-4 text-secondary me-3"></i>
                                        <h5 class="m-0">{{ decode('Mail Footer Link') }}
                                        <label><span class="text-danger">*</span> </label>
                                        </h5>
                                    </div>
                                </div>

                                <div class="p-3">
                                    <input class="form-control" type="link" name="mail_footer[link]" value="{{ json_decode($generalSettings->mail_footer,true)['link'] }}"  id="">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
        <section class="mt-3">
            <div class="rounded_box">
                <div class="row">
                    <div class="col-12 col-lg-6 col-xl-4 mb-2">
                        <button class="btn btn--primary text-light" type="submit">{{ decode('Update') }}</button>
                    </div>
                </div>
            </div>
        </section>
    </form>

@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";

            //update a specific key status
            $(document).on('click','.key-update', function(e){
                const key = $(this).attr('key')
                $('#key-id').attr('value',key)
                $('#update-key-status').submit()
            })
            //site logo image preview start
            $(document).on('change', '#site-logo', function(e) {
                emptyInputFiled('site-preview')
                let file = e.target.files[0];
                console.log(file)
                imagePreview(file,'site-preview','block_image');
                e.preventDefault();
            })
            //fav icon image preview start
            $(document).on('change', '#fav-icon', function(e) {
                emptyInputFiled('fav-preview')
                let file = e.target.files[0];
                imagePreview(file,'fav-preview','loader_image');
                e.preventDefault();
            })

            //mail logo preview
            $(document).on('change', '#mail-footer-logo', function(e) {
                emptyInputFiled('mail-logo-preview')
                let file = e.target.files[0];
                imagePreview(file,'mail-logo-preview','mail_footer_logo');
                e.preventDefault();
            })

            //count-by change function
            $(document).on('click','.count-by',function(e){
                let data = $(this).attr('value')
                if(!$(this).is(':checked')){
                  if(data ==  'ip'){
                    data = 'session'
                  }
                  else{
                    data = 'ip'
                  }
                }
                $('#count-by-val').attr('value',data)
                $('#count-by').submit()
            })

            //demo mode active decative
             $(document).on('click','#demo-mode' ,function(e){
                $('#demo-mode-form').submit()
             })
            //accepet cookie status update
             $(document).on('click','#accept-cookie' ,function(e){
                $('#accept-cookie-form').submit()
             })


        })(jQuery);
    </script>
@endpush

