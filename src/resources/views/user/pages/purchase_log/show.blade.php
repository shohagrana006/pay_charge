@extends('layouts.user.user_app')
@section('user_main_content')
    <section class="pb-3">
        <div class="rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('user.dashboard')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('Dashboard')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('user.purchase.log.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Purchase Log')}}</span>
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

        <div class="user_information">
            <h5>{{ decode('Purchase Log Information') }}</h5>
            <div class="mt-3">
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Name')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $purchase->name }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Email')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $purchase->email }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-sun"></i>
                            </div>
                            <span>{{decode('Phone')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $purchase->phone }}</div>
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
                         @if($purchase->status == 1)
                            <span class="badge badge-sm bg-info">{{decode('Pending')}}</span>
                        @elseif($purchase->status == 2)
                                <span class="badge bg-success">{{decode('Success')}}</span>
                        @elseif($purchase->status == 3)
                                <span class="badge bg-danger">{{decode('Failed')}}</span>
                        @endif
                    </div>
                </div>              
                
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-plus"></i>
                            </div>
                            <span>{{decode('User Name')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $purchase->user? $purchase->user->name :'N/A' }}</div>
                </div>
                
                @if(!empty(json_decode($purchase->package_info, true)))
                    <div class="row align--center">
                        <div class="col-6 col-xl-12 pt-4">
                            <div>
                                <h5>{{decode('Package Info')}}</h5>
                            </div>
                        </div>
                        <div class="col-6 col-xl-6 pb-2">
                            <div class="row">
                                @foreach (json_decode($purchase->package_info, true) as $key => $item) 
                                    <div class="col-4 mt-3">
                                        <p>{{ucfirst($key)}} : <span class="badge bg-secondary">{{$item}}</span></p>         
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif                            
            </div>
        </div>
    </section>
@endsection


