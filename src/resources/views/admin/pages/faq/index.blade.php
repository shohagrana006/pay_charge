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
                    <span>{{decode('FAQ')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <div>
        <!-- table section start  -->
        <section class="bg--light rounded shadow-sm">
            <div class="table-header d-flex align-items-center justify-content-between">

            </div>
            <form action="{{ route('admin.faq.mark') }}" method="post">
                @csrf
                <div class="table-action-buttons">
                    <div class="px-3 pb-2">
                        <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">
                            <button class="w-sm-100 btn--primary border-0 pointer rounded btn-sm mb-2" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{decode('Select Option')}}<i class="ms-1 las la-angle-down"></i></button>
                            <ul class="dropdown-menu border-0">
                                @if(authUser()->can('faq.edit'))
                                    @if(Request::route('status') == 'DeActive' || Request::route('status')=='')
                                        <li><button name="status" value="Active" class="border-0 p-2 text-dark" href="#">{{decode('Active')}}</button></li>
                                    @endif
                                    @if(Request::route('status') == 'Active'|| Request::route('status')=='')
                                        <li>
                                            <button name="status" value="DeActive" type="submit" class="border-0 p-2 text-dark" href="#">{{decode('DeActive')}}</button>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                            <div class="d-sm-block d-lg-flex align-items-center mb-2">
                                <a href="{{ route('admin.faq.index') }}" class="mb-sm-2 mb-lg-0 me-2 btn--primary border-0 pointer rounded btn-sm">{{decode('All')}}
                                    @if(Route::currentRouteName() == 'admin.faq.index' || Route::currentRouteName() == 'admin.faq.status')
                                    ({{ countModelData('Faq') }})
                                    @else
                                    {{decode('faq')  }}
                                    @endif
                                </a>
                                @if(Route::currentRouteName()== 'admin.faq.index' || Route::currentRouteName()== 'admin.faq.status')
                                <a href="{{ route('admin.faq.status','Active')}}" class="mb-sm-2 mb-lg-0 me-2 btn--success border-0 pointer rounded btn-sm">{{decode('Active')}} ({{ getDataByStatus('Active','Faq')->count() }})  </a>

                                <a href="{{ route('admin.faq.status','DeActive')}}"  class="mb-sm-2 mb-lg-0 me-2 btn--danger border-0 pointer rounded btn-sm">{{decode('Deactive')}} ({{ getDataByStatus('DeActive','Faq')->count() }})</a>
                                @endif

                                @if(authUser()->can('faq.create'))
                                    <a class="btn--primary border-0 btn-sm" href="{{ route('admin.faq.create') }}" class="text-decoration-none text-light">{{decode('Create')}} <i class="las la-plus"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3">
                    <table id='package-table' class="table dt-responsive nowrap w-100" id="admins-table">
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
                                <th>{{ decode('Question') }}</th>
                                <th>{{ decode('Answer') }}</th>
                                <th>{{ decode('CreatedBy') }}</th>
                                <th>{{ decode('UpdatedBy') }}</th>
                                <th>{{ decode('Status') }}</th>
                                <th>{{ decode('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($faqs as $faq)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                        <div class="form-check all-data-check">
                                            <input name="ids[]" class="form-check-input" type="checkbox" value="{{$faq->id}}" id="">
                                        </div>
                                        </div>
                                    </td>                                                              
                                    <td>{{ mb_strimwidth($faq->qsn, 0, 20, '....')     }}</td>
                                    <td>{{mb_strimwidth($faq->ans, 0, 30, '....') }}</td>

                                    <td>{{$faq->createdBy ? $faq->createdBy->name :'N/A' }}</td>
                                    <td>{{$faq->updatedBy ? $faq->updatedBy->name :'N/A' }}</td>

                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input faq-status" value="{{$faq->id}}" type="checkbox" id="flexSwitchCheckChecked" {{$faq->status == "Active" ? 'checked' : ''}}>
                                        </div>
                                    </td>

                                    <td>
                                        <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu border-0" style="">
                                            @if(authUser()->can('faq.edit'))
                                            <li><a class="border-0 p-2 text-dark" href="{{route('admin.faq.edit', $faq->id)}}">{{decode('Update')}}</a></li>
                                            @endif

                                            @if(authUser()->can('faq.index'))
                                            <li><a class="border-0 p-2 text-dark" href="{{route('admin.faq.show', $faq->id)}}">{{decode('Show')}}</a></li>
                                            @endif

                                            @if(authUser()->can('faq.destroy'))
                                            <li data-route="{{route('admin.faq.destroy') }}" class="sweet-delete" id="{{ $faq->id }}" ><a href="#" class="border-0 p-2 text-dark" >{{decode('Delete')}}</a></li>
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
            @if(authUser()->can('faq.edit'))
                <form id="faq-status-update" hidden action="{{ route('admin.faq.status.update')}}" method="post">
                    @csrf
                    <input id="faq-status-id"  type="text" name="id">
                </form>              
            @endif

        </section>
        <!-- table section end  -->
    </div>


@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //datatable initiation
            $('#package-table').DataTable({
            });
            const selectorType = 'class';
            // update  status event start
            $(document).on('click','.faq-status',function(e){
                const id  = $(this).attr('value')
                $('#faq-status-id').attr('value',id)
                $('#faq-status-update').submit();
            })


            //all data check
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
