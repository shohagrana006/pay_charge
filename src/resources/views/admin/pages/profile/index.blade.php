@extends('layouts.admin.admin_app')

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
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('profile')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <div class="profile-container pt-5">
        <div class="row ">
            <div class="col-12 col-md-12 col-lg-3 col-xl-2 col-xxl-2">
                <div class="profile">
                    <img
                    src="{{displayImage('assets/images/admin/profile/'.$user->profile_image, App\Cp\ImageProcessor::filePath()['admin_profile']['size'])}}"
                    alt="" class="w-100 h-100">
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-9 col-xl-10 col-xxl-10">
                <div class="d-flex align-items-center">
                    <h4 class="text-secondary m-0">{{ $user->name }}</h4>
                </div>
                <div class="d-flex align-items-center">
                    <h4 class="text-secondary m-0">Role : {{ $user->roles->first()->name }}</h4>
                </div>

            </div>
        </div>
    </div>


    <div class="p-sm-0 p-lg-4">
        <div class="row">
            <div class="col-12 col-lg-3 col-xl-2 col-xxl-2">
                <div class="row">
                    <div class="col-md-8 col-lg-12 col-xl-12">
                        <div>
                            <span class=" text-secondary">{{ decode('address') }}</span>
                            <div class="p-2 row">
                                @foreach(json_decode($user->address,true) as $key => $value)
                                <div class="col-md-6 col-lg-12 col-xl-12">
                                    <div class="d-flex align-itmes-center">
                                        <h6 class="fw-bold">{{ ucfirst(str_replace('_', ' ', $key)) }}</h6>
                                    </div>
                                    <div class="lh-1 mt-2">
                                        <p class="text-secondary m-0">{{ $value }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-12 col-lg-9 col-xl-10 col-xxl-10">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link profile-tab active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                            {{ decode('Personal Inforamtion') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link profile-tab" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">{{ decode('Password Section') }}</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="shadow-sm mt-2">
                                <div class="p-2 border-bottom">
                                    <p class="m-0">{{ decode('Profile Information') }}</p>
                                </div>
                                <div class="p-2">
                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            <label for="validationCustom02" class="form-label">{{ decode('Name') }} <span class="text-danger">*</span> </label>
                                            <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" id="validationCustom02" required="">
                                            <div class="ms-3 text-danger">
                                                @error('name') {{ $message }}  @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="validationCustom02" class="form-label">{{ decode('User Name') }} <span class="text-danger">*</span> </label>
                                            <input type="text" name="user_name" value="{{ $user->user_name }}" class="form-control @error('user_name') is-invalid @enderror" id="validationCustom02" required="">
                                            <div class="ms-3 text-danger">
                                                @error('user_name') {{ $message }}  @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="validationCustom02" class="form-label">{{ decode('Email') }} <span class="text-danger">*</span> </label>
                                            <input type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" id="validationCustom02" required="">
                                            <div class="ms-3 text-danger">
                                                @error('email') {{ $message }}  @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3 mb-3">
                                            <label for="validationCustom02" class="form-label">{{ decode('Phone') }}  </label>
                                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control @error('phone') is-invalid @enderror" id="validationCustom02" >
                                            <div class="ms-3 text-danger">
                                                @error('phone') {{ $message }}  @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-xl-6 mt-2">
                                    <div class="shadow-sm mt-2">
                                        <div class="p-2 border-bottom">
                                            <p class="m-0">{{ decode('Adress Section') }}</p>
                                        </div>
                                        <div class="p-2">
                                            <div class="row">
                                                @foreach(json_decode($user->address,true) as $key => $value)
                                                    @if ($key == 'address')
                                                        <div class="col-md-12 mt-3">
                                                            <label for="{{$key}}" class="form-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                                                            <textarea class="form-control @error('address.address') is-invalid @enderror" name="address[{{$key}}]" id="{{$key}}" cols="10" rows="4">{{ $value }}</textarea>
                                                        </div>
                                                    @else
                                                        <div class="col-md-6 mt-3">
                                                            <label for="{{$key}}" class="form-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                                                            <input type="text" name="address[{{$key}}]" value="{{ $value }}" class="form-control" id="{{$key}}">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-xl-6 mt-2">
                                    <div class="shadow-sm mt-2">
                                        <div class="p-2 border-bottom">
                                            <p class="m-0">{{ decode('Image Section') }}</p>
                                        </div>
                                        <div class="p-2">
                                            <div class="row">
                                                <div class="col-md-12 mt-3 mb-2">
                                                    <label for="file" class="form-label">{{ decode('Image') }} <span class="text-danger">( jpg, jpeg, png, jfif, webp)</span></label>
                                                    <input type="file" name="profile_image" class="form-control @error('profile_image') is-invalid @enderror" id="admin_photo">
                                                    <div class="ms-3 text-danger">
                                                        @error('profile_image') {{ $message }} @enderror
                                                    </div>
                                                    <div class="admin-image-preview" id="admin-image-preview">
                                                        <img alt=''class='mt-2  img-thumbnail me-2 '
                                                        src="{{displayImage('assets/images/admin/profile/'.$user->profile_image, App\Cp\ImageProcessor::filePath()['admin_profile']['size'])}}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="mt-2 ms-1">
                                        <button class="d-block btn btn--primary" type="submit">{{ decode('Update') }}</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>


                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('admin.profile.password.update') }}" method="post">
                            @csrf
                            <div class="shadow-sm mt-2">
                                <div class="p-2 border-bottom">
                                    <p class="m-0">{{ decode('Update Password') }}</p>
                                </div>
                                <div class="p-2">
                                    <div class="row">
                                        <div class="col-md-12 mt-3">
                                            <label for="validationCustom05" class="form-label">{{ decode('Current Password ') }}<span class="text-danger">*</span> </label>
                                            <input placeholder="Ex:*****" type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="validationCustom05" required="">
                                            <div class="ms-3 text-danger">
                                                @error('current_password') {{ $message }} @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="validationCustom05" class="form-label">{{ decode('Password ') }}<span class="text-danger">*</span> </label>
                                            <input placeholder="Ex:*****" type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="validationCustom05" required="">
                                            <div class="ms-3 text-danger">
                                                @error('password') {{ $message }} @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="validationCustom06" class="form-label">{{ decode('Confirm Password') }} <span class="text-danger">*</span> </label>
                                            <input placeholder="Ex:*****" type="password" name="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror" id="validationCustom06" required="">
                                            <div class="ms-3 text-danger">
                                                @error('password_confirmation') {{ $message }} @enderror
                                            </div>
                                        </div>

                                        <div class="mt-2 ms-1">
                                            <button class="d-block btn btn--primary" type="submit">{{ decode('Update') }}</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
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
                imagePreview(file, 'admin-image-preview','admin-image-preview');
                e.preventDefault();
            })
            /* ==============================
                  Admin image upload preview end
              ==============================   */

        })(jQuery);
    </script>
@endpush
