<div class="modal fade" id="edit-permission-{{ $role->id }}"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="language-modal-title">Update {{ $role->name }} Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div  class="modal-body">
                @php
                   $permissionsArray = array_unique($role->permissions->pluck('group_name')->toArray());
                @endphp

                <form action="{{ route('admin.roles.update') }}" method="POST">
                    @csrf
                    <input hidden name="id" value="{{ $role->id }}" type="text">
                    <div class="table-sidebar p-3">
                        <div>
                            <label class="d-block" for="role-input">{{decode('Role Name')}}
                                <span class="text-danger">*</span>
                            </label>
                            <input
                             class="form-control @error('role_name') is-invalid @enderror" value="{{ $role->name }}" name="role_name" placeholder="Example : Admin"type="text">
                            @error('role_name')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><hr>

                        <div class="my-3">
                            <span class="me-3">{{decode('Module Permission')}}</span>
                            <div class="form-check">
                                <input
                                @if((count($data['permissions']) == count($permissionsArray) ) &&
                                (getTotalPermission() ==  count($role->permissions)))
                                    checked
                                @endif
                                data-role-id={{ $role->id }} data-id="{{$loop->iteration}}" class="form-check-input all-select all-select-{{ $role->id }}" type="checkbox"
                                 value="" id="edit-selectAllPermission-{{$role->id}}">
                                <label data-id="{{$role->id}}" class="form-check-label all-select" for="edit-selectAllPermission-{{ $role->id }}">{{decode('All Select')}}</label>
                            </div>
                        </div>
                        <hr>

                        @foreach ($data['permissions'] as $key => $permissionGroup)
                            <div class="">
                                <div class="mb-2 d-flex align-items-center justify-content-between pointer">
                                    <div class="form-check permissionGroup-{{$role->id}} module-permission-group-{{$loop->iteration}}-{{ $role->id }}" id="">
                                        <input
                                        data-role-id={{ $role->id }} data-id="{{$loop->iteration}}"  class="form-check-input  update-module-group-permission"
                                        id="edit-group-{{$loop->iteration}}-{{$role->id}}" type="checkbox"
                                        @if((in_array($key,$permissionsArray)) &&
                                        (count($role->permissions->groupBy('group_name')[$key]) == count( $permissionGroup))
                                        )
                                         checked
                                        @endif
                                        >
                                        <label  data-role-id={{ $role->id }} data-id="{{$loop->iteration}}"   class="form-check-label fw-bold update-module-group-permission"
                                        for="edit-group-{{$loop->iteration}}-{{$role->id}}">{{$key}}
                                        </label>
                                    </div>
                                    <i class="las la-angle-down check-box-header"></i>
                                </div>

                                <div class="d-none ps-3 module-permission-{{$loop->iteration}}-{{ $role->id }}">
                                    @foreach($permissionGroup as $permission)
                                        <div class="mb-2 ">
                                            <div class="form-check singlePermission-{{$role->id }}">
                                                <input data-role-id="{{ $role->id }}" data-id='{{$loop->parent->iteration}}'
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked': ''}}
                                                name="permissions[]" class="form-check-input edit-single-permission" id="edit-module-single-permission-{{$role->id}}-{{$loop->parent->iteration}}-{{$loop->iteration}}" type="checkbox" value="{{$permission->name}}">
                                                <label data-role-id="{{ $role->id }}" data-id='{{$loop->parent->iteration}}' class="form-check-label edit-single-permission" for="edit-module-single-permission-{{$role->id}}-{{$loop->parent->iteration}}-{{$loop->iteration}}">
                                                    {{$permission->name}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                  <button type='submit' class="btn btn-sm btn-primary">Submit</button>

                </form>
            </div>
        </div>
    </div>
</div>
