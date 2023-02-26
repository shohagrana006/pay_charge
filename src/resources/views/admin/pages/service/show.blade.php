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
                    <a href="{{route('admin.service.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Service')}}</span>
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
                    <img class="rounded-circle" src="{{displayImage('assets/images/general/service/'.$service->logo, App\Cp\ImageProcessor::filePath()['service']['size'])}}" alt="" class="w-100 h-100">
                </div>
            </div>
            <div class="ms-3">
                <h5>{{ $service->name }}</h5>
            </div>
        </div>
        <div class="user_information">
            <h5>{{ decode('Service Information') }}</h5>
            <div class="mt-3">

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Country')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $service->country->name }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Service Category')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $service->serviceCategory->name }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Processing Time')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $service->processing_time }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-sun"></i>
                            </div>
                            <span>{{decode('Fixed Charge')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $service->fixed_charge }}</div>
                </div>
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <span>{{decode('Percent Charge')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $service->percent_charge }}</div>
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
                    <div class="col-6 col-xl-9">{{ $service->status }}</div>
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
                    <div class="col-6 col-xl-9">{{ $service->createdBy? $service->createdBy->name :'N/A' }}</div>
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
                    <div class="col-6 col-xl-9">{{ $service->updatedBy? $service->updatedBy->name :'N/A' }}</div>
                </div>  
                
                @if(!empty(json_decode($service->info, true)))
                    <div class="row align--center">
                        <div class="col-6 col-xl-12 pt-4">
                            <div>
                                <h5>{{decode('User Input Field')}}</h5>
                            </div>
                        </div>
                        <div class="col-6 col-xl-12 pb-2">
                            @foreach (json_decode($service->info, true) as $item) 
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

