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
                    <a href="{{route('admin.package.list.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Package List')}}</span>
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
            <h5>{{ decode('Service Information') }}</h5>
            <div class="mt-3">

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Service Name')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->packageService->service->name }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Package name')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->packageService->package->name }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Minute')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->minute }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-sun"></i>
                            </div>
                            <span>{{decode('MB')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->mb }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <span>{{decode('SMS')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->sms }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <span>{{decode('Duration')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->duration }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <span>{{decode('Price')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->price }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <span>{{decode('Discount')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->discount }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <span>{{decode('Details')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->details }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-map-marker"></i>
                            </div>
                            <span>{{decode('Status')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $packageList->status }}</div>
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
                    <div class="col-6 col-xl-9">{{ $packageList->createdBy? $packageList->createdBy->name :'N/A' }}</div>
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
                    <div class="col-6 col-xl-9">{{ $packageList->updatedBy? $service->updatedBy->name :'N/A' }}</div>
                </div>  
                
                @if(!empty(json_decode($packageList->info, true)))
                    <div class="row align--center">
                        <div class="col-6 col-xl-12 pt-4">
                            <div>
                                <h5>{{decode('User Input Field')}}</h5>
                            </div>
                        </div>
                        <div class="col-6 col-xl-12 pb-2">
                            @foreach (json_decode($packageList->info, true) as $item) 
                                <div class="row">
                                    @foreach ($item as $key => $field)
                                        <div class="col-md-4 mt-3">
                                            <label>{{decode('Field '). $key}}</label>                             
                                            <div class="input-container position-relative ps-5">
                                                <div class="link-icon-container mx-auto">
                                                    <i class="las la-globe-americas"></i>
                                                </div>
                                                <input disabled class="form-control border-0 rounded-0 textValue" type="text" value="{{$field}}">
                                            </div>                              
                                        </div>
                                    @endforeach                                                                                       
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif                            
            </div>
        </div>
    </section>

@endsection

