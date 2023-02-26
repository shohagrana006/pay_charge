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
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Service Package Details')}}</span>
                </li>
            </ul>
        </div>
    </section>

    <section class="rounded_box">
        <div class="user_information">
            <h5>{{ decode('Service Package Details') }}</h5>
            <div class="mt-3">            
                <div class="row">
                    <div class="col-md-12">
                        <table id='package-table' class="table dt-responsive nowrap w-100" id="admins-table">
                            <thead>
                                <tr>
                                    <th>{{ decode('SL No.') }}</th>
                                    <th>{{ decode('Country Name') }}</th>
                                    <th>{{ decode('Category Name') }}</th>
                                    <th>{{ decode('Service Name') }}</th>
                                    <th>{{ decode('Package Name') }}</th>
                                    <th>{{ decode('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                         
                            @foreach ($packageServiceLists as $packageService)
                                <tr>                                                                    
                                    <td>{{ $loop->index+1}}</td>
                                    <td>{{ $packageService->service ? $packageService->service->country->name : ''}}</td>
                                    <td>{{ $packageService->service ? $packageService->service->serviceCategory->name : ''}}</td>
                                    <td>{{ $packageService->service ? $packageService->service->name : ''}}</td>
                                    <td>{{ $packageService->package ? $packageService->package->name : ''}}</td>
                                    <td>
                                        <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu border-0" style="">
                                            @if(authUser()->can('package.list.create'))
                                            <li><a class="border-0 p-2 text-dark" href="{{ route('admin.package.list.create', $packageService->id) }}">{{decode('Package details create')}}</a></li>
                                            @endif                                         
                                        </ul>
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

