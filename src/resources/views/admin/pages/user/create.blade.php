@extends('layouts.admin.admin_app')
@section('user_active')
    activeBg
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
                    <a href="{{route('admin.user.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('User')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Create')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <section>
        <!-- form section start  -->
        <div class="white-auto-fill">
                <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data"
                    class="pb-3 needs-validation" novalidate="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="section-container">
                                <h5>{{ decode('User Inforamtion') }}</h5>
                                <div class="content-wrapper pb-4">
                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom01" class="form-label">{{ decode('Name') }}<span class="text-danger">*</span> </label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Enter Name" type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror border-0 rounded-0" id="validationCustom01" required="">
                                            </div>
                                            <div class="ms-3 text-danger">@error('name') {{ $message }} @enderror </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom02" class="form-label">{{ decode('Email ') }}<span
                                                    class="text-danger">*</span>
                                            </label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Ex:xyz@gmail.com" type="email" name="email"
                                                value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror border-0 rounded-0"
                                                id="validationCustom02" required="">
                                            </div>
                                            <div class="ms-3 text-danger">
                                                @error('email')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">{{ decode('Phone Number') }} </span></label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Ex:01XXXXXX" type="text" name="phone" value="{{old('phone')}}"
                                                class="form-control @error('phone') is-invalid @enderror border-0 rounded-0" id="phone">
                                            </div>
                                                <div class="ms-3 text-danger">
                                                    @error('phone')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom05" class="form-label">{{ decode('Password') }} <span class="text-danger">*</span> </label>
                                                <div class="input-container position-relative ps-5">
                                                    <div class="link-icon-container mx-auto">
                                                        <i class="las la-globe-americas"></i>
                                                    </div>
                                                    <input placeholder="Ex:*****" type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror border-0 rounded-0" id="validationCustom05"
                                                    required="">
                                                </div>
                                            <div class="ms-3 text-danger">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom06" class="form-label">{{ decode('Confirm Password ') }}<span class="text-danger">*</span> </label>
                                                    <div class="input-container position-relative ps-5">
                                                    <div class="link-icon-container mx-auto">
                                                        <i class="las la-globe-americas"></i>
                                                    </div>
                                                    <input placeholder="Ex:*****" type="password" name="password_confirmation"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror border-0 rounded-0"
                                                    id="validationCustom06" required="">
                                                </div>
                                            <div class="ms-3 text-danger">
                                                @error('password_confirmation')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom06"
                                                class="form-label @error('status') is-invalid @enderror  ">{{ decode('Status') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                    <select class="w-100 form-control rounded-0 border-0" name="status">
                                                        <option>--select status --</option>
                                                        <option {{ old('status') == 'Active' ? 'selected' : '' }} value="Active">Active</option>
                                                        <option {{ old('status') == 'DeActive' ? 'selected' : '' }} value="DeActive">DeActive</option>
                                                    </select>
                                                </div>
                                            <div class="ms-3 text-danger">
                                                @error('status')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="file" class="form-label">{{ decode('Image') }}<span
                                                    class="text-danger"> ({{implode(", ", fileFormat())}}) </span></label>
                                                    <div class="input-container position-relative ps-5">
                                                    <div class="link-icon-container mx-auto">
                                                        <i class="las la-globe-americas"></i>
                                                    </div>
                                                        <input type="file" name="photo"
                                                        class="form-control @error('photo') is-invalid @enderror border-0 rounded-0" id="file">
                                                    </div>
                                            <div class="ms-3 text-danger">
                                                @error('photo')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div id="image-preview">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="section-container">
                                <h5>{{ decode('User Address') }}</h5>
                                <div class="content-wrapper pb-4">
                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label for="city" class="form-label">{{ decode('City') }}</label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Enter City" type="text" name="address[city]"
                                                value="{{ old('address.city') }}" class="form-control border-0 rounded-0" id="city">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="zip_code" class="form-label">{{ decode('Zip Code') }} </label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Enter zip code" type="text" name="address[zip_code]"
                                                    value="{{ old('address.zip_code') }}"
                                                    class="form-control @error('zip_code') is-invalid @enderror border-0 rounded-0" id="zip_code">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="postal_code" class="form-label">{{ decode('Postal Code') }} </label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Enter Postal code" type="text" name="address[postal_code]"
                                                value="{{ old('address.postal_code') }}" class="form-control border-0 rounded-0" id="postal_code">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="state" class="form-label">{{ decode('State') }} </label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Enter State" type="text" name="address[state]"
                                                value="{{ old('address.state') }}" class="form-control border-0 rounded-0" id="state">
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="address" class="form-label">{{ decode('Address ') }}</label>
                                            <textarea class="form-control @error('address.address') is-invalid @enderror" placeholder="Enter Your Adrress"
                                                name="address[address]" id="address" cols="10" rows="4">{{ old('address.address') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 mb-3">
                            <button class="btn btn--primary" type="submit">{{ decode('submit') }}</button>
                        </div>
                    </div>
                </form>
        </div>
        <!-- form section end  -->
    </section>
@endsection


@push('backend-js-push')
    <script>
        (function($) {

            "use strict";
            /* ==============================
                 file upload preview start
               ==============================   */
            $(document).on('change', '#file', function(e) {
                emptyInputFiled('image-preview')
                let file = e.target.files[0];
                imagePreview(file, 'image-preview');
                e.preventDefault();
            })
            /* ==============================
                file upload preview end
             ==============================   */

        })(jQuery);
    </script>

@endpush
