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
                    <span>{{decode('Service')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <!-- table section start  -->
    <section class="bg--light rounded shadow-sm">
        <div class="table-header d-flex align-items-center justify-content-between">

        </div>
        <form action="{{ route('admin.service.mark') }}" method="post">
            @csrf
            <div class="table-action-buttons">
                <div class="px-3 pb-2">
                    <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">
                        <button class="w-sm-100 btn--primary border-0 pointer rounded btn-sm mb-2" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Select Option <i class="ms-1 las la-angle-down"></i></button>
                        <ul class="dropdown-menu border-0">
                            @if(authUser()->can('service.edit'))
                                @if(Request::route('status') == 'DeActive' || Request::route('status')=='')
                                    <li><button name="status" value="Active" class="border-0 p-2 text-dark" href="#">Active</button></li>
                                @endif
                                @if(Request::route('status') == 'Active'|| Request::route('status')=='')
                                    <li>
                                        <button name="status" value="DeActive" type="submit" class="border-0 p-2 text-dark" href="#">DeActive</button>
                                    </li>
                                @endif
                            @endif
                        </ul>
                        <div class="d-sm-block d-lg-flex align-items-center mb-2">
                            <a href="{{ route('admin.service.index') }}" class="mb-sm-2 mb-lg-0 me-2 btn--primary border-0 pointer rounded btn-sm">All
                                @if(Route::currentRouteName() == 'admin.service.index' || Route::currentRouteName() == 'admin.service.status')
                                ({{ countModelData('Service') }})
                                @else
                                {{decode('Service')  }}
                                @endif
                            </a>

                            @if(Route::currentRouteName()== 'admin.service.index' || Route::currentRouteName()== 'admin.service.status')
                            <a href="{{ route('admin.service.status','Active')}}" class="mb-sm-2 mb-lg-0 me-2 btn--success border-0 pointer rounded btn-sm">{{decode('Active')}} ({{ getDataByStatus('Active','Service')->count() }})  </a>

                            <a href="{{ route('admin.service.status','DeActive')}}"  class="mb-sm-2 mb-lg-0 me-2 btn--danger border-0 pointer rounded btn-sm">{{decode('Deactive')}} ({{ getDataByStatus('DeActive','Service')->count() }})</a>
                            @endif

                            @if(authUser()->can('service.create'))
                                <a class="btn--primary border-0 btn-sm" href="{{route('admin.service.create')}}" class="text-decoration-none text-light" >{{decode('Create')}}<i class="las la-plus"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <table id='category-table' class="table dt-responsive nowrap w-100" id="admins-table">
                    <thead>
                        <tr>
                            <th>
                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="all-data-select">
                                    </div>
                                    <label for="all-data-select">{{ decode('All') }}</label>
                                </div>
                            </th>

                            <th>{{ decode('Logo') }}</th>
                            <th>{{ decode('Country') }}</th>
                            <th>{{ decode('Category') }}</th>
                            <th>{{ decode('Service name') }}</th>
                            <th>{{ decode('Process Time') }}</th>
                            <th>{{ decode('Fixed Charge') }}</th>
                            <th>{{ decode('Percent Charge') }}</th>
                            <th>{{ decode('Status') }}</th>
                            <th>{{ decode('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($services as $service)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check all-data-check">
                                            <input name="ids[]" class="form-check-input" type="checkbox" value="{{$service->id}}" id="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="Item d-flex align-items-center">
                                        <div class="Item_img me-3">
                                            <img class="rounded-circle" src="{{displayImage('assets/images/general/service/'.$service->logo, App\Cp\ImageProcessor::filePath()['service']['size'])}}" alt="">
                                        </div>                                    
                                    </div>
                                </td>
                                <td>{{$service->country ? $service->country->name : "N/A"}}</td>
                                <td>{{$service->serviceCategory ? $service->serviceCategory->name  : "N/A"}}</td>
                                <td>{{$service->name}}</td>
                                <td>{{$service->processing_time}}</td>
                                <td>{{$service->fixed_charge}}</td>
                                <td>{{$service->percent_charge}}</td>

                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input service-status" value="{{$service->id}}" type="checkbox" id="flexSwitchCheckChecked" {{$service->status == "Active" ? 'checked' : ''}}>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu border-0" style="">
                                        @if(authUser()->can('service.edit'))
                                            <li><a class="border-0 p-2 text-dark" href="{{route('admin.service.edit', $service->id)}}">{{decode('Update')}}</a></li>
                                        @endif

                                        @if(authUser()->can('service.index'))
                                            <li><a class="border-0 p-2 text-dark" href="{{route('admin.service.show', $service->id)}}">{{decode('Show')}}</a></li>
                                        @endif

                                        @if(authUser()->can('service.destroy'))
                                            <li data-route="{{route('admin.service.destroy') }}" class="sweet-delete" id="{{ $service->id }}" ><a class="border-0 p-2 text-dark" >{{decode('Delete')}}</a></li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        {{--  admin status update form  --}}
        @if(authUser()->can('service.edit'))
            <form id="service-status-update" hidden action="{{ route('admin.service.update.status')}}" method="post">
                @csrf
                <input id="service-id"  type="text" name="id">
            </form>
        @endif

    </section>
    <!-- table section end  -->   

@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //datatable initiation
            $('#category-table').DataTable({
            });
            const selectorType = 'class';
            // update roles status event start
            $(document).on('click','.service-status',function(e){
                const id  = $(this).attr('value')
                $('#service-id').val(id)
                $('#service-status-update').submit();
            })

            //all category check
             $(document).on('click','#all-data-select',function(e){
                if($(this).is(':checked')){
                    checkUncheckMethod(selectorType,`all-data-check input[type=checkbox]`,true)
                } else{
                    checkUncheckMethod(selectorType,`all-data-check input[type=checkbox]`,false)
                }
             })

        })(jQuery);
    </script>
@endpush
