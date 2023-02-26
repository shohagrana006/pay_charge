@extends('layouts.admin.admin_app')

@section('admin_main_content')
    <section class="pb-3">
        <ul class="d-flex align-items-center justify-content-start">
            <li class="d-flex align-items-center me-3">
                <i class="las la-cube"></i>
                <span>Dashboard</span>
            </li>
            <li class="d-flex align-items-center me-3">
                <i class="las la-dot-circle"></i>
                <span>Pages</span>
            </li>
            <li class="d-flex align-items-center me-3">
                <i class="las la-dot-circle"></i>
                <span>Informations</span>
            </li>
        </ul>
    </section>
    <section class="py-3 bg--light rounded">
        <div class="row">
            <div class="col-12 col-lg-10 col-xl-10 order-2 order-sm-2 order-lg-1">
                <div class="ms-3">
                    <p class="fw-bold">{{decode('Roll Permission Create')}}</p>
                </div>
                <div class="role-create">
                  <form>
                    <div class="bg--light rounded">
                        <div>
                            <div class="table-header d-flex align-items-center justify-content-between">
                            <h6 class="fw-bold">{{decode('total role')}} ({{ $data['roles']->count() }})</h6>
                            </div>
                            <div class="">
                                <table  class="p-3 table dt-responsive nowrap w-100" id="roles-table">
                                    <thead>
                                    <tr>
                                        <th>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            </div>
                                            <span>All</span>
                                        </div>
                                        </th>
                                        <th>No</th>
                                        <th>Role Name</th>
                                        <th>Total Permission</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['roles'] as $role)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$role->name}}</td>
                                                <td>
                                                {{ count($role->permissions) }}
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input data-id = {{ $role->id }} class="form-check-input" type="checkbox" id="role-status"
                                                        {{ $role->status == 'Active'? "checked":'' }}
                                                        >
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu border-0">
                                                        @if(authUser()->can('role.edit'))
                                                            <li><a data-bs-toggle="modal"
                                                                data-bs-target="#edit-permission-{{ $role->id }}"
                                                                class="border-0 p-2 text-dark" href="#">Update</a>
                                                            </li>
                                                        @endif
                                                        @if(authUser()->can('role.destroy'))
                                                        <li
                                                        data-route='{{route('admin.roles.destroy') }}' id="{{ $role->id }}" class="pointer sweet-delete"
                                                        ><a class="border-0 p-2 text-dark" href="#">Delete</a></li>
                                                        @endif
                                                        @if(authUser()->can('role.index'))
                                                            <li><a data-bs-toggle="modal"
                                                                data-bs-target="#show-permission-{{ $role->id }}"  class="border-0 p-2 text-dark" href="#">show</a>
                                                            </li>
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
                  </form>
                </div>

                {{--  roles show & edit modal strat  --}}
                @foreach ($data['roles'] as $role)
                    @if(authUser()->can('role.index'))
                        @include('admin.pages.includes.roles.showPermission')
                    @endif
                    @if(authUser()->can('role.edit'))
                        @include('admin.pages.includes.roles.editPermission')
                    @endif
                @endforeach

                {{--  role status update form  --}}
                @if(authUser()->can('role.edit'))
                    <form id="role-status-update" hidden action="{{ route('admin.roles.status.update')}}" method="post">
                        @csrf
                        <input id="role-status-form-id"  type="id" name="id">
                    </form>
                @endif
            </div>
            @if(authUser()->can('role.create'))
                <div class="col-12 col-lg-2 col-xl-2 order-1 order-sm-1 order-lg-2 border-start">
                    <form action="{{route('admin.roles.store')}}" method="post">
                        @csrf
                        <div class="table-sidebar p-3">
                            <div>
                                <label class="d-block" for="role-input">{{decode('Role Name')}}
                                    <span class="text-danger">*</span>
                                </label>
                                <input value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror " name="name" placeholder="Example : Admin"
                                type="text">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div><hr>

                            <div class="my-3">
                                <span class="me-3">{{decode('Module Permission')}}</span>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="selectAllPermission">
                                    <label class="form-check-label" for="selectAllPermission">{{decode('All Select')}}</label>
                                </div>
                            </div><hr>

                            @foreach ($data['permissions'] as $key => $permissionGroup)
                                <div class="module-permission-group-test">
                                    <div class="mb-2 d-flex align-items-center justify-content-between pointer">
                                        <div class="form-check permissionGroup module-permission-group-{{$loop->iteration}}" id="">
                                            <input data-id="{{$loop->iteration}}"  class="form-check-input  module-group-permission"
                                            id="group-module-permission-{{$loop->iteration}}" type="checkbox">

                                            <label data-id="{{$loop->iteration}}"  class="form-check-label groupCheck module-group-permission  fw-bold"
                                            for="group-module-permission-{{$loop->iteration}}">{{$key}}
                                            </label>
                                        </div>
                                        <i class="las la-angle-down check-box-header"></i>
                                    </div>
                                    <div class="d-none ps-3 module-permission-{{$loop->iteration}}">
                                        @foreach($permissionGroup as $permission)
                                            <div class="mb-2 ">
                                                <div class="form-check singlePermission">
                                                    <input data-id='{{$loop->parent->iteration}}' name="permissions[]" class="form-check-input single-permission" id="module-single-permission-{{$loop->parent->iteration}}-{{$loop->iteration}}" type="checkbox" value="{{$permission->name}}">
                                                    <label data-id='{{$loop->parent->iteration}}' class="form-check-label single-permission" for="module-single-permission-{{$loop->parent->iteration}}-{{$loop->iteration}}">
                                                        {{$permission->name}}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn--primary mt-3">Submit</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('backend-js-push')
    <script>
        $(function(){
            "use strict"
            //datatable initiation
            $('#roles-table').DataTable({
            });
            let selectorType = "class"
            const rolesLength = '{{ count($data['permissions']) }}'
            // store check box select js start
            $(document).on('click', '#selectAllPermission', function(){

                if($(this).is(':checked')){
                    permissionCheckUncheck(selectorType,'permissionGroup input[type=checkbox]',true)
                    permissionCheckUncheck(selectorType,'singlePermission input[type=checkbox]',true)
                } else{
                    permissionCheckUncheck(selectorType,'permissionGroup input[type=checkbox]',false)
                    permissionCheckUncheck(selectorType,'singlePermission input[type=checkbox]',false)
                }
            })

            //permission check uncheck function
            function permissionCheckUncheck(type,selector,status){
                if(type == 'class'){
                    $(`.${selector}`).prop('checked', status)
                }
                else{
                    $(`#${selector}`).prop('checked', status)
                }
            }
           //module group permission event
            $(document).on('click','.module-group-permission', function(){
                let id = $(this).attr('data-id');
                moduleCheckUncheck()
                if($(this).is(':checked')){
                    permissionCheckUncheck(selectorType,`module-permission-${id} input[type=checkbox]`,true)
                } else{
                    permissionCheckUncheck(selectorType,`module-permission-${id} input[type=checkbox]`,false)
                }
            })

            function moduleCheckUncheck(){
                const length = countChekboxLength(`permissionGroup`,true)
                let type  ='id'
                if(rolesLength>length){
                    permissionCheckUncheck(type,`selectAllPermission`,false)
                }
                else{
                    permissionCheckUncheck(type,`selectAllPermission`,true)
                }
            }
            //individual permission event
            $(document).on('click', '.single-permission', function(e){
                const id  = $(this).attr('data-id')
                const length = countChekboxLength(`module-permission-${id}`,false)
                const checkedlength = countChekboxLength(`module-permission-${id}`,true)
                if(length>checkedlength){
                    permissionCheckUncheck(selectorType,`module-permission-group-${id} input[type=checkbox]`,false)
                }
                else{
                    permissionCheckUncheck(selectorType,`module-permission-group-${id} input[type=checkbox]`,true)
                }
                moduleCheckUncheck()
            })

            function countChekboxLength(selector,checked){
                if(checked){
                    return $(`.${selector} input[type=checkbox]:checked`).length;
                }else{
                    return $(`.${selector} input[type=checkbox]`).length;
                }
            }
            // store check box select js end

            // update roles status event start
            $(document).on('click','#role-status',function(e){
                const id  = $(this).attr('data-id')
                $('#role-status-form-id').attr('value',id)
                $('#role-status-update').submit();
            })

            // update check box select js start
            $(document).on('click', '.all-select', function(){
                const id = $(this).attr('data-id')
                if($(this).is(':checked')){
                    permissionCheckUncheck(selectorType,`permissionGroup-${id} input[type=checkbox]`,true)
                    permissionCheckUncheck(selectorType,`singlePermission-${id} input[type=checkbox]`,true)
                } else{
                    permissionCheckUncheck(selectorType,`permissionGroup-${id} input[type=checkbox]`,false)
                    permissionCheckUncheck(selectorType,`singlePermission-${id} input[type=checkbox]`,false)
                }
            })

            // update module group permission event
            $(document).on('click','.update-module-group-permission', function(){
                let id = $(this).attr('data-id');
                let roleId = $(this).attr('data-role-id');

                editModuleCheckUncheck(roleId)
                if($(this).is(':checked')){
                    permissionCheckUncheck(selectorType,`module-permission-${id}-${roleId} input[type=checkbox]`,true)
                } else{
                    permissionCheckUncheck(selectorType,`module-permission-${id}-${roleId} input[type=checkbox]`,false)
                }
            })

            function editModuleCheckUncheck(roleId){
                const length = countChekboxLength(`permissionGroup-${roleId}`,true)
                if(rolesLength>length){
                    permissionCheckUncheck(selectorType,`all-select-${roleId}`,false)
                }
                else{
                    permissionCheckUncheck(selectorType,`all-select-${roleId}`,true)
                }
            }

            // individual permission event
            $(document).on('click', '.edit-single-permission', function(e){
                const id  = $(this).attr('data-id')
                const roleId  = $(this).attr('data-role-id')

                const length = countChekboxLength(`module-permission-${id}-${roleId}`,false)
                const checkedlength = countChekboxLength(`module-permission-${id}-${roleId}`,true)
                if(length>checkedlength){
                    permissionCheckUncheck(selectorType,`module-permission-group-${id}-${roleId} input[type=checkbox]`,false)
                }
                else{
                    permissionCheckUncheck(selectorType,`module-permission-group-${id}-${roleId} input[type=checkbox]`,true)
                }
                editModuleCheckUncheck(roleId)
            })


        })
    </script>
@endpush
