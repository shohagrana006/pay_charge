@extends('layouts.admin.admin_app')
@section('admin_page_title')
 {{$generalSetting->name }} | {{decode('Show Admin')}}
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
                <a href="{{route('admin.index')}}">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Admin')}}</span>
                </a>
            </li>
            <li class="d-flex align-items-center me-3">
                <i class="las la-dot-circle"></i>
                <span>{{decode('Show')}}</span>
            </li>

        </ul>
    </div>
    </section>
    <section class="rounded_box">
        <div class="d-flex align--center my-3 border-bottom p-3">
            <div>
                <div class="rounded-circle overflow-hidden single_user_img_container">
                    <img src="{{displayImage('assets/images/admin/profile/'.$admin->profile_image, App\Cp\ImageProcessor::filePath()['admin_profile']['size'])}}" alt="" class="w-100 h-100">
                </div>
            </div>
            <div class="ms-3">
                <h5>{{ $admin->user_name }}</h5>
                <span>{{ $admin->email }}</span>
            </div>
        </div>
        <div class="user_information">
            <h5>{{ decode('Admin Information') }}</h5>
            <div class="mt-3">
                <div class="row align--center">

                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>Email</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $admin->email }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-sun"></i>
                            </div>
                            <span>Roles</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $admin->roles->first()->name }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <span>Phone</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $admin->phone }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-map-marker"></i>
                            </div>
                            <span>Location</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">
                        @if($admin->address)
                          @foreach(json_decode($admin->address,true) as $key => $value)
                          <div>
                           {{  ucfirst(str_replace('_', ' ', $key))  }}: {{ $value }}
                          </div>
                          <hr>
                          @endforeach
                        @endif

                    </div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-sun"></i>
                            </div>
                            <span> Status</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">
                        <span  class="badge bg--{{ $admin->status == "Active" ?"success" :'danger' }}">
                            {{ $admin->status }}
                        </span>

                    </div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-plus"></i>
                            </div>
                            <span>Created By</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $admin->createdBy? $admin->createdBy->name :'N/A' }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-tools"></i>
                            </div>
                            <span>Updated By</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $admin->updatedBy? $admin->updatedBy->name :'N/A' }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-history"></i>
                            </div>
                            <span>Last logged</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">not dynamic yet</div>
                </div>
            </div>
        </div>
    </section>

@endsection

