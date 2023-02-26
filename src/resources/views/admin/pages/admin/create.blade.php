@extends('layouts.admin.admin_app')
@section('admin_page_title')
 {{$generalSetting->name }} | {{decode('Create Admin')}}
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
                    <a href="{{route('admin.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Admin')}}</span>
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
            <form action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data" class="pb-3 needs-validation label_margin_top" novalidate="">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div class="section-container">
                            <h5>{{ decode('Admin Inforamtion') }}</h5>
                            <div class="content-wrapper pb-4">
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label for="validationCustom01" class="form-label">{{ decode('Name') }}<span class="text-danger">*</span> </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Enter Name" type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror border-0 rounded-0" id="validationCustom01" required="">
                                        </div>
                                            <div class="ms-3 text-danger">
                                            @error('name') {{ $message }} @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="validationCustom02" class="form-label">{{ decode('Email') }} <span class="text-danger">*</span> </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Ex:xyz@gmail.com" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror border-0 rounded-0" id="validationCustom02" required="">
                                        </div>
                                        <div class="ms-3 text-danger">
                                            @error('email') {{ $message }}  @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="validationCustomAdminUsername" class="form-label">{{ decode('User Name ') }}<span class="text-danger">*</span> </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Enter UserName" type="text" name="user_name" value="{{ old('user_name') }}" class="form-control @error('user_name') is-invalid @enderror border-0 rounded-0" id="validationCustomAdminUsername" aria-describedby="inputGroupPrepend" required="">
                                        </div>
                                        <div class="ms-3 text-danger">
                                            @error('user_name') {{ $message }} @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="phone" class="form-label">{{ decode('Phone Number ') }}</span></label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Ex:01XXXXXX" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror border-0 rounded-0" value="{{ old('phone') }}"
                                            id="validationCustom03">
                                        </div>
                                        <div class="ms-3 text-danger">
                                        @error('phone')  {{ $message }} @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label for="validationCustom05" class="form-label">{{ decode('Password ') }}<span class="text-danger">*</span> </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Ex:*****" type="password" name="password" class="form-control @error('password') is-invalid @enderror border-0 rounded-0" id="validationCustom05" required="">
                                        </div>
                                        <div class="ms-3 text-danger">
                                            @error('password') {{ $message }} @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="validationCustom06" class="form-label">{{ decode('Confirm Password') }} <span class="text-danger">*</span> </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Ex:*****" type="password" name="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror border-0 rounded-0" id="validationCustom06" required="">
                                        </div>
                                            <div class="ms-3 text-danger">
                                            @error('password_confirmation') {{ $message }} @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label for="validationCustom006" class="form-label @error('status') is-invalid @enderror  ">{{ decode('Status') }} <span class="text-danger">*</span> </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <select class="w-100 py-2 px-3 rounded-0 border-0" name="status">
                                                <option value="" >{{ decode('select status') }}</option>
                                                <option {{ old('status') == 'Active' ? 'selected' : '' }} value="Active">  Active</option>
                                                <option {{ old('status') == 'DeActive' ? 'selected' : '' }} value="DeActive"> DeActive </option>
                                            </select>
                                        </div>
                                        <div class="ms-3 text-danger">
                                            @error('status') {{ $message }} @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 mt-3">
                                        <label for="createRole" class="form-label @error('role') is-invalid @enderror">{{ decode('Role') }} <span class="text-danger">*</span> </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <select class="w-100 py-2 px-3 rounded-0 border-0" name="role" id="createRole">
                                                <option value="">{{ decode('select role') }}</option>
                                                @foreach ($roles as $role)
                                                <option {{ old('role') == $role->name ? "selected" :'' }}
                                                    value="{{ $role->name }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="ms-3 text-danger">
                                            @error('role') {{ $message }} @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="file" class="form-label">{{ decode('Image') }} <span class="text-danger"> ({{implode(", ", fileFormat())}})</span></label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input type="file" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror border-0 rounded-0" id="admin_photo">
                                        </div>
                                        <div class="ms-3 text-danger">
                                            @error('profile_image') {{ $message }} @enderror
                                        </div>
                                        <div id="admin-image-preview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="section-container">
                            <h5>{{ decode('Admin Address') }}</h5>
                            <div class="content-wrapper pb-4">
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <label for="city" class="form-label">{{ decode('City') }}</label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Enter City" type="text" name="address[city]" value="{{ old('address.city') }}" class="form-control rounded-0 border-0" id="city">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="zip_code" class="form-label">{{ decode('Zip Code') }} </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Enter zip code" type="text" name="address[zip_code]" value="{{ old('address.zip_code') }}" class="form-control @error('zip_code') is-invalid @enderror rounded-0 border-0" id="zip_code">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="postal_code" class="form-label">{{ decode('Postal Code') }} </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Enter Postal code" type="text" name="address[postal_code]" value="{{ old('address.postal_code') }}" class="form-control rounded-0 border-0 " id="postal_code">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label for="state" class="form-label">{{ decode('State') }} </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Enter State" type="text" name="address[state]" value="{{ old('address.state') }}" class="form-control rounded-0 border-0" id="state">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label for="address" class="form-label">{{ decode('Address') }} </label>
                                        <textarea class="form-control @error('address.address') is-invalid @enderror" placeholder="Enter Your Adrress" name="address[address]" id="address" cols="10" rows="4">{{ old('address.address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <button class="d-block btn btn--primary" type="submit">{{ decode('Add Info') }}</button>
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
                  Admin image upload preview start
                ==============================   */
            $(document).on('change', '#admin_photo', function(e) {
                emptyInputFiled('admin-image-preview')
                let file = e.target.files[0];
                imagePreview(file, 'admin-image-preview');
                e.preventDefault();
            })
            /* ==============================
                  Admin image upload preview end
              ==============================   */

        })(jQuery);
    </script>
@endpush
