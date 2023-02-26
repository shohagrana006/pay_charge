@extends('layouts.admin.admin_app')
@section('admin_page_title')
 {{$generalSetting->name }} | {{decode('Admin')}}
@endsection
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
                    <span>{{decode('Admin')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <section>
        <!-- table section start  -->
        <div class="bg--light rounded shadow-sm">
            <div class="table-header d-flex align-items-center justify-content-between">
            </div>
            <form action="{{ route('admin.mark') }}" method="post">
                @csrf
                <div class="table-action-buttons">
                    <div class="px-3 pb-2">
                        <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">
                            <button class="w-sm-100 btn--primary border-0 pointer rounded btn-sm mb-2" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Select Option <i class="ms-1 las la-angle-down"></i></button>
                            <ul class="dropdown-menu border-0">
                                @if(authUser()->can('admin.edit'))
                                    @if(Request::route('status') == 'DeActive' || Request::route('status')=='')
                                        <li><button name="status" value="Active" class="border-0 p-1 text-dark w-100" href="#">Active</button></li>
                                    @endif
                                    @if(Request::route('status') == 'Active'|| Request::route('status')=='')
                                        <li>
                                            <button name="status" value="DeActive" type="submit" class="border-0 p-1 text-dark w-100" href="#">DeActive</button>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                            <div class="d-sm-block d-lg-flex align-items-center">
                                <a href="{{ route('admin.index') }}" class="mb-sm-2 mb-lg-0 me-2 btn--primary border-0 pointer rounded btn-sm">All ({{ countModelData('Admin')}})</a>

                                <a href="{{ route('admin.status','Active')}}" class="mb-sm-2 mb-lg-0 me-2 btn--success border-0 pointer rounded btn-sm">Active ({{ getDataByStatus('Active','Admin')->count() }})  </a>

                                <a href="{{ route('admin.status','DeActive')}}"  class="mb-sm-2 mb-lg-0 me-2 btn--danger border-0 pointer rounded btn-sm">Deactive ({{ getDataByStatus('DeActive','Admin')->count() }})</a>

                                @if(authUser()->can('admin.create'))
                                    <a href="{{ route('admin.create') }}" class="btn--primary border-0 btn-sm">Create <i class="las la-plus"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3">
                    <table  class=" table dt-responsive nowrap w-100" id="admins-table">
                        <thead>
                            <tr>
                                <th>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="all-admin">
                                        </div>
                                        <label for="all-admin">{{ decode('All') }}</label>
                                    </div>
                                </th>
                                <th>{{ decode('SN') }}</th>
                                <th>{{ decode('Img') }}</th>
                                <th>{{ decode('Name') }}</th>
                                <th>{{ decode('Email') }}</th>
                                <th>{{ decode('User Name') }}</th>
                                <th>{{ decode('Phone') }}</th>
                                <th>{{ decode('CreatedBy') }}</th>
                                <th>{{ decode('Status') }}</th>
                                <th>{{ decode('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                        <div class="form-check all-admin-check">
                                            @if(authUser()->id != $admin->id)
                                            <input name="ids[]" class="form-check-input" type="checkbox" value="{{$admin->id}}" id="">
                                            @endif
                                        </div>
                                        </div>
                                    </td>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        <div class="Item">
                                            <div class="Item_img w-25">
                                                <img class="rounded-circle" src="{{displayImage('assets/images/admin/profile/'.$admin->profile_image, App\Cp\ImageProcessor::filePath()['admin_profile']['size'])}}" alt="">
                                                
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$admin->name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->user_name}}</td>
                                    <td>{{$admin->phone}}</td>
                                    <td>{{$admin->createdBy?$admin->createdBy->name :"N/A"}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input admin-status" value="{{$admin->id}}" type="checkbox" id="flexSwitchCheckChecked }}" {{$admin->status == "Active" ? 'checked' : ''}}>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu border-0" style="">
                                            @if(authUser()->can('admin.edit'))
                                            <li><a class="border-0 p-2 text-dark" href="{{route('admin.edit', $admin->id)}}">Update</a></li>
                                            @endif
                                            @if(authUser()->can('admin.destroy'))
                                                @if(authUser()->id != $admin->id)
                                                <li class="sweet-delete pointer" data-route='{{route('admin.destroy') }}' id="{{ $admin->id }}"
                                                ><a class="border-0 p-2 text-dark"  href="">Delete</a></li>
                                                @endif
                                            @endif
                                            @if(authUser()->can('admin.index'))
                                            <li><a class="border-0 p-2 text-dark" href="{{ route('admin.show',$admin->id) }}">Show</a></li>
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
            @if(authUser()->can('admin.edit'))
                <form id="admin-status-update" hidden action="{{ route('admin.status.update')}}" method="post">
                    @csrf
                    <input id="admin-status-id"  type="text" name="id">
                </form>
            @endif

        </div>
        <!-- table section end  -->
    </section>


@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //datatable initiation
            $('#admins-table').DataTable({
            });
            const selectorType = 'class';
            // update roles status event start
            $(document).on('click','.admin-status',function(e){
                const id  = $(this).attr('value')
                $('#admin-status-id').attr('value',id)
                $('#admin-status-update').submit();
            })
            //all admin check
             $(document).on('click','#all-admin',function(e){
                if($(this).is(':checked')){
                    checkUncheckMethod(selectorType,`all-admin-check input[type=checkbox]`,true)
                } else{
                    checkUncheckMethod(selectorType,`all-admin-check input[type=checkbox]`,false)
                }
             })

        })(jQuery);
    </script>
@endpush
