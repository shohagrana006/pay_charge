@extends('layouts.admin.admin_app')
@section('user_active')
    activeBg
@endsection
@push('style-push')
    <style>
        .single_user_img_container {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            overflow: hidden;
        }
        .single_user_icon_container {
            height: 40px;
            width: 40px;
            background: #d8d8d8;
            border-radius: 50%;
        }
    </style>
@endpush
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
                    <a href="{{route('admin.user.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('User')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">             
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Show')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <div class="rounded_box">
        <div class="container-fluid p-0">
            <div class="row d-flex align--center rounded">
                <div class="col-7 col-md-6 col-lg-6 col-xl-6 text-start">
                    <h3 class="pageTitle">{{decode('User List')}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="rounded_box">
        <div class="d-flex align--center my-3 border-bottom p-3">
            <div>
                <div class="rounded-circle overflow-hidden single_user_img_container">
                    <img src="{{displayImage('assets/images/user/profile/'.$user->profile_image, App\Cp\ImageProcessor::filePath()['user_profile']['size'])}}" alt="" class="w-100 h-100">
                </div>
            </div>
            <div class="ms-3">
                <h5>{{ $user->name }}</h5>
                <span>{{ $user->email }}</span>
            </div>
        </div>
        <div class="user_information">
            <h5>{{decode('User Information')}}</h5>
            <div class="mt-3">
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Email')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $user->email }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <span>{{decode('Phone')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $user->phone }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-map-marker"></i>
                            </div>
                            <span>{{decode('Location')}}</span>
                        </div>
                    </div>
                    @if($user->address)
                        <div class="col-6 col-xl-9 my-3">
                            @foreach (json_decode($user->address) as $key => $value)
                                <div class="row my-2">
                                    <div class="col-xl-2"> {{ ucwords(str_replace('_', ' ', $key)) }}</div>
                                    <div class="col-xl-10">{{ $value }}</div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-sun"></i>
                            </div>
                            <span>{{decode('Status')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">
                        <span class="badge bg--{{ $user->status == 'Active' ? 'success' : 'danger' }}">{{ $user->status }}</span>
                    </div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-plus"></i>
                            </div>
                            <span>{{decode('Created By')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $user->createdBy ? $user->createdBy->name : ' N/A' }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-tools"></i>
                            </div>
                            <span>{{decode('Updated By')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $user->updatedBy ? $user->updatedBy->name : 'N/A' }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-history"></i>
                            </div>
                            <span>{{decode('Login Status')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ \Carbon\Carbon::parse($user->last_login_time)->diffForHumans() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
