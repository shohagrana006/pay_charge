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
                    <a href="{{route('admin.package.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Package')}}</span>
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
                    <img class="rounded-circle" src="{{displayImage('assets/images/general/package/'.$package->logo, App\Cp\ImageProcessor::filePath()['package']['size'])}}" alt="" class="w-100 h-100">
                </div>
            </div>
            <div class="ms-3">
                <h5>{{ $package->name }}</h5>
            </div>
        </div>
        <div class="user_information">
            <h5>{{ decode('Package Information') }}</h5>
            <div class="mt-3">            
                <div class="row">
                    <div class="col-md-12">
                        <table id='package-table' class="table dt-responsive nowrap w-100" id="admins-table">
                            <thead>
                                <tr>
                                    <th>{{ decode('Package Name') }}</th>
                                    <th>{{ decode('Service Name') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                         
                            @foreach ($package->servicePackage as $service)
                                <tr>                                                                    
                                    <td>{{ $package->name }}</td>
                                    <td>                                        
                                        <p>{{$service->name}}</p>
                                    </td>                                                                  
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                                        
            </div>
        </div>
    </section>

@endsection

