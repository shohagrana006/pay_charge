@extends('layouts.admin.admin_app')
@section('user_active')
    activeBg
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
                    <span>{{decode('User')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <section>
        <!-- table section start  -->
        <section class="pt-4 bg--light rounded shadow-sm">
            <form action="{{ route('admin.user.mark') }}" method="post">
                @csrf
                <div>
                    <div class="table-action-buttons">
                        <div class="px-3 pb-2">
                            <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">
                                <div class="btn-group">
                                    <button type="button" class="w-sm-100 btn--primary border-0 pointer rounded btn-sm mb-2"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ decode('Select Option') }}
                                        <i class="ms-1 las la-angle-down"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if(authUser()->can('admin.edit'))
                                            @if(Request::route('status') == 'DeActive' || Request::route('status') =='')
                                            <li><button name="status" value="Active" class="border-0 p-2 text-dark" href="#">Active</button></li>
                                            @endif
                                            @if(Request::route('status') == 'Active'|| Request::route('status') =='')
                                            <li>
                                                <button name="status" value="DeActive" type="submit" class="border-0 p-2 text-dark" href="#">DeActive</button>
                                            </li>
                                            @endif
                                        @endif
                                    </div>
                                </div><!-- /btn-group -->

                                <div class="d-sm-block d-lg-flex align-items-center mb-2">
                                    <a href="{{ route('admin.user.index') }}"
                                        class="mb-sm-2 mb-lg-0 me-2 btn--primary text-light border-0 pointer rounded btn-sm">{{ decode('All') }}({{ countModelData('User')}})</a>

                                    <a href="{{ route('admin.user.status', 'Active') }}"
                                        class="mb-sm-2 mb-lg-0 me-2 btn--success text-light border-0 pointer rounded btn-sm">{{ decode('Active') }}({{ getDataByStatus('Active','User')->count() }}) </a>

                                    <a href="{{ route('admin.user.status', 'DeActive') }}"
                                        class="mb-sm-2 mb-lg-0 me-2 btn--danger border-0 pointer text-light rounded btn-sm">{{ decode('DeActive') }} ({{ getDataByStatus('DeActive','User')->count() }}) </a>

                                    @if (authUser()->can('user.create'))
                                        <a href="{{ route('admin.user.create') }}" class="mb-sm-2 mb-lg-0 me-2 btn--primary text-light border-0 pointer rounded btn-sm">{{ decode('Create') }} <i class="las la-plus"></i></a>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="p-3 responsive-table">
                        <table class="table dt-responsive nowrap w-100" id="users-table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="all-user">
                                            </div>
                                            <label for="all-user">{{ decode('All') }}</label>
                                        </div>
                                    </th>
                                    <th>{{decode('SN')}}</th>
                                    <th>{{decode('Img')}}</th>
                                    <th>{{decode('Name')}}</th>
                                    <th>{{decode('Email')}}</th>
                                    <th>{{decode('phone')}}</th>
                                    <th>{{decode('Created BY')}}</th>
                                    <th>{{decode('Status')}}</th>
                                    <th>{{decode('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                            <div class="form-check all-user-check">
                                                <input name="ids[]" class="form-check-input" type="checkbox" value="{{$user->id}}" id="">
                                            </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="Item">
                                                <div class="Item_img w-25">
                                                    <img class="rounded-circle" src="{{displayImage('assets/images/user/profile/'.$user->profile_image, App\Cp\ImageProcessor::filePath()['user_profile']['size'])}}" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            {{ $user->createdBy?$user->createdBy->name:"" }}
                                        </td>
                                        <td>
                                            @if (authUser()->can('user.edit'))
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input statusActiveDeactive" value="{{$user->id}}" type="checkbox" id="flexSwitchCheckChecked" {{$user->status == 'Active' ? 'checked' : ''}} >
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu border-0" style="">
                                                @if(authUser()->can('user.edit'))
                                                    <li><a class="border-0 p-2 text-dark" href="{{route('admin.user.edit', $user->id)}}">{{decode('Update')}}</a></li>
                                                @endif
                                                @if(authUser()->can('user.destroy'))
                                                    <li data-route="{{route('admin.user.destroy') }}" id="{{ $user->id }}" class="pointer sweet-delete">
                                                        <a class="border-0 p-2 text-dark" >{{decode('Delete')}}</a>
                                                    </li>
                                                @endif
                                                @if(authUser()->can('user.index'))
                                                    <li><a class="border-0 p-2 text-dark"  href="{{ route('admin.user.show',$user->id) }}">{{decode('Show')}}</a></li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="50" class="text-center">
                                            <span class="text-danger">{{decode('No data avilable')}}</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </section>
        <!-- table section end  -->
    </section>
    {{-- status update form --}}
    @if(authUser()->can('user.edit'))
        <form id="statusUpdateForm" hidden action="{{route('admin.user.updateStatus')}}" method="post">
            @csrf
            <input id="statusInput" type="hidden" name="id" value="">
        </form>
    @endif
@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";

            // status Active DeActive
            $(document).on('click', '.statusActiveDeactive', function(){
               let id =  $(this).attr('value')
                $('#statusInput').attr('value', id)
                $('#statusUpdateForm').submit()
            })

            //datatable initiation
            $('#users-table').DataTable({
            });

            //all user check
            const selectorType = 'class';
            $(document).on('click','#all-user',function(e){
                if($(this).is(':checked')){
                    checkUncheckMethod(selectorType,`all-user-check input[type=checkbox]`,true)
                } else{
                    checkUncheckMethod(selectorType,`all-user-check input[type=checkbox]`,false)
                }
             })


        })(jQuery);
    </script>
@endpush

