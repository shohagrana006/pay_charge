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
                <span>{{decode('Edit')}}</span>
            </li>
        </ul>
    </div>
</section>
    <!-- <div class="rounded_box">
        <div class="container-fluid p-0">
            <div class="row d-flex align--center rounded">
                <div class="col-7 col-md-6 col-lg-6 col-xl-6 text-start">
                    <h3 class="pageTitle">{{ decode('User Edit Form') }}</h3>
                </div>
                <div class="col-5 col-md-6 col-lg-6 col-xl-6 text-end d--flex align--center justify-content-end">
                    <a href="{{ route('admin.user.index') }}" class="pageTitleButtons text-light">{{decode('User List')}}</a>
                </div>
            </div>
        </div>
    </div> -->
    <section>
        <div class="white-auto-fill">
            <form action="{{ route('admin.user.update') }}" method="POST" enctype="multipart/form-data"
                class="pb-3 needs-validation" novalidate="">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div class="section-container">
                            <h5>{{decode('User Inforamtion')}}</h5>
                            <div class="content-wrapper pb-4">
                                <div class="row">

                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01" class="form-label">{{decode('Name')}} <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Enter Name" type="text" name="name" value="{{ $user->name }}"
                                            class="form-control @error('name') is-invalid @enderror border-0 rounded-0" id="validationCustom01"
                                            required="">
                                        </div>
                                        <div class="ms-3 text-danger">
                                            @error('name')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02" class="form-label">{{decode('Email')}} <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input placeholder="Ex:xyz@gmail.com" type="email" name="email"
                                            value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror border-0 rounded-0"
                                            id="validationCustom02" required="">
                                        </div>
                                        <div class="ms-3 text-danger">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustomUsername" class="form-label">{{decode('Username')}}<span class="text-danger">*</span> </label>
                                        <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Enter  UserName" type="text" name="username" value="{{ $user->username }}" class="border-0 rounded-0 form-control @error('username') is-invalid @enderror" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required="">
                                        </div>
                                        <div class="ms-3 text-danger">
                                            @error('username')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom06"
                                            class="form-label @error('status') is-invalid @enderror  ">{{decode('Status')}} <span class="text-danger">*</span> </label>
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <select class="form-control border-0 rounded-0" name="status">
                                                    <option>--select status --</option>
                                                    <option {{ $user->status == 'Active' ? 'selected' : '' }} value="Active">{{decode('Active')}}
                                                        </option>
                                                        <option {{ $user->status == 'DeActive' ? 'selected' : '' }} value="DeActive">{{decode('DeActive')}}
                                                            </option>
                                                </select>
                                            </div>
                                        <div class="ms-3 text-danger">
                                            @error('status')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">{{decode('Phone Number')}} </span></label>
                                        <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Ex:01XXXXXX" type="text" value="{{ $user->phone }}" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror border-0 rounded-0" id="validationCustom03">
                                            </div>
                                        <div class="ms-3 text-danger">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="file" class="form-label">{{decode('Image')}} <span
                                                class="text-danger">(  {{implode(", ", fileFormat())}} )</span></label>
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
                                        <div class="mt-2 w-25" id="image-preview">
                                            <img class="mt-2 preview-image img-thumbnail me-2 f-left" src="{{displayImage('assets/images/user/profile/'.$user->profile_image, App\Cp\ImageProcessor::filePath()['user_profile']['size'])}}" alt="">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <div class="section-container">
                            <h5>{{decode('User Address')}}</h5>
                            <div class="content-wrapper pb-4">
                                <div class="row">
                                    @foreach (json_decode($user->address) as $key => $value)
                                        <div class="mb-3 col-md-{{ $key == 'address' ? 12 : 6 }}">
                                            <label for="city" class="form-label"> {{ ucwords(str_replace('_', ' ', $key)) }}</label>
                                            @if ($key == 'address')
                                                <textarea class="form-control @error('address.address') is-invalid @enderror" placeholder="Enter Your Adrress" name="address[address]" id="address" cols="10" rows="4">{{ $value }}</textarea>
                                            @else
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input placeholder="Enter {{ ucwords(str_replace('_', ' ', $key)) }}" type="text" name="address[{{ $key }}]" value="{{ $value }}" class="form-control border-0 rounded-0" id="city">
                                            </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 mb-3">
                    <button class="btn btn--primary" type="submit">{{decode('Update')}}</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('backend-js-push')
    <script>
        (function($) {

            "use strict";
            //ajax csrf token setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta [name="csrf-token"]').attr('content')
                }
            })

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
    @if (Session::has('user_update_success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('user_update_success') }}"
            })
        </script>
    @endif

    @if ($errors->any())
        <script>
            Toast.fire({
                icon: 'error',
                title: 'SomeThing Went Wrong ! Please Try Again'
            })
        </script>
    @endif

@endpush
