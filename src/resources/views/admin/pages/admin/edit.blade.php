@extends('layouts.admin.admin_app')
@section('admin_page_title')
 {{$generalSetting->name }} | {{decode('Admin Update')}}
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
                <span>{{decode('Edit')}}</span>
            </li>
        </ul>
    </div>
</section>

<section>
    <!-- form section start  -->
    <div class="white-auto-fill">
        <form action="{{route('admin.update')}}" method="POST" enctype="multipart/form-data" class="pb-3 needs-validation label_margin_top" novalidate="">
            @csrf
            <div class="row">
                <input type="hidden" name="id" value="{{$data['admin']->id}}">
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
                                        <input type="text" name="name" value="{{ $data['admin']->name }}" class="form-control @error('name') is-invalid @enderror border-0 rounded" id="validationCustom01" required="">
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
                                        <input type="email" name="email" value="{{ $data['admin']->email }}" class="border-0 rounded form-control @error('email') is-invalid @enderror" id="validationCustom02" required="">
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('email') {{ $message }}  @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="validationCustomAdminUsername" class="form-label">{{ decode('Username') }}<span class="text-danger">*</span> </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input  type="text" name="user_name" value="{{ $data['admin']->user_name }}" class="border-0 rounded-0 form-control @error('user_name') is-invalid @enderror" id="validationCustomAdminUsername" aria-describedby="inputGroupPrepend" required="">
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
                                        <input type="text" name="phone" value="{{ $data['admin']->phone }}" class="border-0 rounded-0 form-control @error('phone') is-invalid @enderror" id="validationCustom03">
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('phone')  {{ $message }} @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="validationCustom006" class="form-label @error('status') is-invalid @enderror  ">{{ decode('Status') }} <span class="text-danger">*</span> </label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <select class="w-100 py-2 px-3 rounded-0 border-0 border--secondary" name="status">
                                            <option>{{ decode('select status') }}</option>
                                            <option {{ $data['admin']->status == 'Active' ? 'selected' : '' }} value="Active"> Active</option>
                                            <option {{ $data['admin']->status == 'DeActive' ? 'selected' : '' }} value="DeActive">DeActive</option>
                                        </select>
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('status') {{ $message }} @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 mt-3">
                                    <label for="createRole" class="form-label @error('role') is-invalid @enderror  ">{{ decode('Role') }} <span class="text-danger">*</span> </label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <select class="w-100 py-2 px-3 rounded-0 border-0 border--secondary" name="role" id="createRole">
                                            <option>{{ decode('select role') }}</option>
                                            @foreach ($data['admin']->roles as $item)
                                            @foreach ($data['roles'] as $role)
                                            <option {{$item->name == $role->name ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('role') {{ $message }} @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="file" class="form-label">{{ decode('Image') }} <span class="text-danger">( jpg, jpeg, png, jfif, webp)</span></label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input type="file" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror rounded-0 border-0" id="admin_photo">
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('profile_image') {{ $message }} @enderror
                                    </div>
                                    <div id="admin-image-preview" class="Item_img">
                                        <img alt=''class='mt-2 img-thumbnail me-2 f-left'
                                        src="{{displayImage('assets/images/admin/profile/'.$data['admin']->profile_image, App\Cp\ImageProcessor::filePath()['admin_profile']['size'])}}"
                                        >
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
                                @foreach (json_decode($data['admin']->address, true) as $key => $value)
                                    @if ($key == 'address')
                                        <div class="col-md-12 mt-3">
                                            <label for="{{$key}}" class="form-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                                            <textarea class="form-control @error('address.address') is-invalid @enderror" name="address[{{$key}}]" id="{{$key}}" cols="10" rows="4">{{ $value }}</textarea>
                                        </div>
                                    @else
                                        <div class="col-md-6 mt-3">
                                            <label for="{{$key}}" class="form-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input type="text" name="address[{{$key}}]" value="{{ $value }}" class="form-control border-0 rounded-0" id="{{$key}}">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 mb-3">
                <button class="btn btn--primary" type="submit">{{ decode('Update') }}</button>
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
