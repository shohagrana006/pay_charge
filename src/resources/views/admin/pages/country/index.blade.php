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
                    <span>{{decode('country')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <!-- table section start  -->
    <section class="bg--light rounded shadow-sm">
        <div class="table-header d-flex align-items-center justify-content-between">

        </div>
        <form action="{{ route('admin.country.mark') }}" method="post">
            @csrf
            <div class="table-action-buttons">
                <div class="px-3 pb-2">
                    <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">
                        <button class="w-sm-100 btn--primary border-0 pointer rounded btn-sm mb-2" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Select Option <i class="ms-1 las la-angle-down"></i></button>
                        <ul class="dropdown-menu border-0">
                            @if(authUser()->can('country.edit'))
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
                            <a href="{{ route('admin.country.index') }}" class="mb-sm-2 mb-lg-0 me-2 btn--primary border-0 pointer rounded btn-sm">All
                                @if(Route::currentRouteName() == 'admin.country.index' || Route::currentRouteName() == 'admin.country.status')
                                ({{ countModelData('Country') }})
                                @else
                                {{decode('Country')  }}
                                @endif
                            </a>

                            @if(Route::currentRouteName()== 'admin.country.index' || Route::currentRouteName()== 'admin.country.status')
                            <a href="{{ route('admin.country.status','Active')}}" class="mb-sm-2 mb-lg-0 me-2 btn--success border-0 pointer rounded btn-sm">Active ({{ getDataByStatus('Active','Country')->count() }})  </a>

                            <a href="{{ route('admin.country.status','DeActive')}}"  class="mb-sm-2 mb-lg-0 me-2 btn--danger border-0 pointer rounded btn-sm">Deactive ({{ getDataByStatus('DeActive','Country')->count() }})</a>
                            @endif

                            @if(authUser()->can('country.create'))
                                <a class="btn--primary border-0 btn-sm" href="javascript:void(0)" class="text-decoration-none text-light" data-bs-toggle="modal" data-bs-target="#countryCreate" >Create<i class="las la-plus"></i></a>
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

                            <th>{{ decode('country logo') }}</th>
                            <th>{{ decode('country name') }}</th>
                            <th>{{ decode('CreatedBy') }}</th>
                            <th>{{ decode('UpdatedBy') }}</th>
                            <th>{{ decode('Status') }}</th>
                            <th>{{ decode('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countries as $country)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                    <div class="form-check all-data-check">
                                        <input name="ids[]" class="form-check-input" type="checkbox" value="{{$country->id}}" id="">
                                    </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="Item d-flex align-items-center">
                                        <div class="Item_img me-3">
                                            <img class="rounded-circle" src="{{displayImage('assets/images/general/country/'.$country->logo, App\Cp\ImageProcessor::filePath()['country']['size'])}}" alt="">

                                        </div>                                    
                                    </div>
                                </td>

                                <td>{{$country->name}}</td>
                                <td>{{$country->created_by ? $country->createdBy->name :'N/A' }}</td>
                                <td>{{$country->updated_by ? $country->updatedBy->name :'N/A' }}</td>

                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input country-status" value="{{$country->id}}" type="checkbox" id="flexSwitchCheckChecked" {{$country->status == "Active" ? 'checked' : ''}}>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu border-0" style="">
                                        @if(authUser()->can('country.edit'))
                                        <li><a class="border-0 p-2 text-dark" href="{{route('admin.country.edit', $country->id)}}">{{decode('Update')}}</a></li>
                                        @endif
                                        @if(authUser()->can('country.destroy'))
                                            <li data-route="{{route('admin.country.destroy') }}" class="sweet-delete" id="{{ $country->id }}" ><a href="#" class="border-0 p-2 text-dark" >{{decode('Delete')}}</a></li>
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
        @if(authUser()->can('country.edit'))
            <form id="country-status-update" hidden action="{{ route('admin.country.update.status')}}" method="post">
                @csrf
                <input id="country-status-id"  type="text" name="id">
            </form>
        @endif

    </section>
    <!-- table section end  -->
  
    <!-- Create Country Modal -->
    <div class="modal fade" id="countryCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="{{route('admin.country.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{decode('Add Country')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <label for="validationCustom01" class="form-label">{{decode('Country name')}}<span class="text-danger">*</span> </label>
                            <div class="input-container position-relative ps-5">
                                <div class="link-icon-container mx-auto">
                                    <i class="las la-globe-americas"></i>  
                                </div>
                                <input placeholder="Enter Country Name" type="text" name="name" value="" class="form-control  border-0 rounded-0" id="validationCustom01" required="">
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="file" class="form-label">{{decode('Country Logo')}} <span class="text-danger"> ({{implode(", ", fileFormat())}}) & size [{{ App\Cp\ImageProcessor::filePath()['country']['size'] }}]</span></label>
                            <div class="input-container position-relative ps-5">
                                <div class="link-icon-container mx-auto">
                                    <i class="las la-globe-americas"></i>
                                </div>
                                <input type="file" name="logo" class="form-control  border-0 rounded-0" id="admin_photo">
                            </div>
                        </div>  

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{decode('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{decode('submit')}}</button>
                </div>
            </form>          
          </div>
        </div>
      </div>


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
            $(document).on('click','.country-status',function(e){
                const id  = $(this).attr('value')
                $('#country-status-id').val(id)
                $('#country-status-update').submit();
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
