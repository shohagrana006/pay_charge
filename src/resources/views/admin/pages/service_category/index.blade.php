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
                    <span>{{decode('Service Category')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <!-- table section start  -->
    <section class="bg--light rounded shadow-sm">
        <div class="table-header d-flex align-items-center justify-content-between">

        </div>
        <form action="{{ route('admin.service.category.mark') }}" method="post">
            @csrf
            <div class="table-action-buttons">
                <div class="px-3 pb-2">
                    <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">
                        <button class="w-sm-100 btn--primary border-0 pointer rounded btn-sm mb-2" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Select Option <i class="ms-1 las la-angle-down"></i></button>
                        <ul class="dropdown-menu border-0">
                            @if(authUser()->can('service.category.edit'))
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
                            <a href="{{ route('admin.service.category.index') }}" class="mb-sm-2 mb-lg-0 me-2 btn--primary border-0 pointer rounded btn-sm">All
                                @if(Route::currentRouteName() == 'admin.service.category.index' || Route::currentRouteName() == 'admin.service.category.status')
                                ({{ countModelData('ServiceCategory') }})
                                @else
                                {{decode('Service Category')  }}
                                @endif
                            </a>

                            @if(Route::currentRouteName()== 'admin.service.category.index' || Route::currentRouteName()== 'admin.service.category.status')
                            <a href="{{ route('admin.service.category.status','Active')}}" class="mb-sm-2 mb-lg-0 me-2 btn--success border-0 pointer rounded btn-sm">Active ({{ getDataByStatus('Active','ServiceCategory')->count() }})  </a>

                            <a href="{{ route('admin.service.category.status','DeActive')}}"  class="mb-sm-2 mb-lg-0 me-2 btn--danger border-0 pointer rounded btn-sm">Deactive ({{ getDataByStatus('DeActive','ServiceCategory')->count() }})</a>
                            @endif

                            @if(authUser()->can('service.category.create'))
                                <a class="btn--primary border-0 btn-sm" href="{{route('admin.service.category.create')}}" class="text-decoration-none text-light" >Create<i class="las la-plus"></i></a>
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
                            <th>{{ decode('Service Category name') }}</th>
                            <th>{{ decode('slug') }}</th>
                            <th>{{ decode('CreatedBy') }}</th>
                            <th>{{ decode('UpdatedBy') }}</th>
                            <th>{{ decode('Status') }}</th>
                            <th>{{ decode('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($serviceCategories as $serviceCategory)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                    <div class="form-check all-data-check">
                                        <input name="ids[]" class="form-check-input" type="checkbox" value="{{$serviceCategory->id}}" id="">
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="Item d-flex align-items-center">
                                        <div class="Item_img me-3">
                                            <img class="rounded-circle" src="{{displayImage('assets/images/general/service_category/'.$serviceCategory->logo, App\Cp\ImageProcessor::filePath()['service_category']['size'])}}" alt="">

                                        </div>                                    
                                    </div>
                                </td>

                                <td>{{$serviceCategory->name}}</td>
                                <td>{{$serviceCategory->slug}}</td>
                                <td>{{$serviceCategory->created_by ? $serviceCategory->createdBy->name :'N/A' }}</td>
                                <td>{{$serviceCategory->updated_by ? $serviceCategory->updatedBy->name :'N/A' }}</td>

                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input service-category-status" value="{{$serviceCategory->id}}" type="checkbox" id="flexSwitchCheckChecked" {{$serviceCategory->status == "Active" ? 'checked' : ''}}>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu border-0" style="">
                                        @if(authUser()->can('service.category.edit'))
                                            <li><a class="border-0 p-2 text-dark" href="{{route('admin.service.category.edit', $serviceCategory->id)}}">{{decode('Update')}}</a></li>
                                        @endif

                                        @if(authUser()->can('service.category.destroy'))
                                            <li data-route="{{route('admin.service.category.destroy') }}" class="sweet-delete" id="{{ $serviceCategory->id }}" ><a class="border-0 p-2 text-dark" >{{decode('Delete')}}</a></li>
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
        @if(authUser()->can('service.category.edit'))
            <form id="service-category-status-update" hidden action="{{ route('admin.service.category.update.status')}}" method="post">
                @csrf
                <input id="service-category-id"  type="text" name="id">
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
            $(document).on('click','.service-category-status',function(e){
                const id  = $(this).attr('value')
                $('#service-category-id').val(id)
                $('#service-category-status-update').submit();
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
