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
                    <span>{{decode('Manual Payment')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <!-- table section start  -->
    <section class="bg--light rounded shadow-sm">
        <div class="table-header d-flex align-items-center justify-content-between">

        </div>
        <form action="{{ route('admin.payment.manual.mark') }}" method="post">
            @csrf
            <div class="table-action-buttons">
                <div class="px-3 pb-2">
                    <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">
                        <button class="w-sm-100 btn--primary border-0 pointer rounded btn-sm mb-2" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{decode('Select Option')}}<i class="ms-1 las la-angle-down"></i></button>
                        <ul class="dropdown-menu border-0">
                            @if(authUser()->can('payment.manual.edit'))
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
                            <a href="{{ route('admin.payment.manual.index') }}" class="mb-sm-2 mb-lg-0 me-2 btn--primary border-0 pointer rounded btn-sm">All
                                @if(Route::currentRouteName() == 'admin.payment.manual.index' || Route::currentRouteName() == 'admin.payment.manual.status')
                                ({{ countModelData('ManualPayment') }})
                                @else
                                {{decode('Manual Payment')}}
                                @endif
                            </a>

                            @if(Route::currentRouteName()== 'admin.payment.manual.index' || Route::currentRouteName()== 'admin.payment.manual.status')
                            <a href="{{ route('admin.payment.manual.status','Active')}}" class="mb-sm-2 mb-lg-0 me-2 btn--success border-0 pointer rounded btn-sm">{{decode('Active')}} ({{ getDataByStatus('Active','ManualPayment')->count() }})  </a>

                            <a href="{{ route('admin.payment.manual.status','DeActive')}}"  class="mb-sm-2 mb-lg-0 me-2 btn--danger border-0 pointer rounded btn-sm">{{decode('Deactive')}} ({{ getDataByStatus('DeActive','ManualPayment')->count() }})</a>
                            @endif

                            @if(authUser()->can('payment.manual.create'))
                                <a class="btn--primary border-0 btn-sm" href="{{route('admin.payment.manual.create')}}" class="text-decoration-none text-light" >{{decode('Create')}}<i class="las la-plus"></i></a>
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
                            <th>{{ decode('Gateway Name') }}</th>
                            <th>{{ decode('Minimum Amount') }}</th>
                            <th>{{ decode('Maximum Amount') }}</th>
                            <th>{{ decode('Fixed Charge') }}</th>
                            <th>{{ decode('Percent Charge') }}</th>
                            <th>{{ decode('Status') }}</th>
                            <th>{{ decode('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($manualPayments as $manualPayment)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="form-check all-data-check">
                                            <input name="ids[]" class="form-check-input" type="checkbox" value="{{$manualPayment->id}}" id="">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="Item d-flex align-items-center">
                                        <div class="Item_img me-3">
                                            <img class="rounded-circle" src="{{displayImage('assets/images/general/manual_payment/'.$manualPayment->logo, App\Cp\ImageProcessor::filePath()['manual_payment']['size'])}}" alt="">
                                        </div>                                    
                                    </div>
                                </td>
                                <td>{{$manualPayment->gateway_name}}</td>
                                <td>{{$manualPayment->minimum_amount}}</td>
                                <td>{{$manualPayment->maximum_amount}}</td>
                                <td>{{$manualPayment->fixed_charge}}</td>
                                <td>{{$manualPayment->percent_charge}}</td>

                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input manual_payment_status" value="{{$manualPayment->id}}" type="checkbox" id="flexSwitchCheckChecked" {{$manualPayment->status == "Active" ? 'checked' : ''}}>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu border-0" style="">
                                        @if(authUser()->can('payment.manual.edit'))
                                            <li><a class="border-0 p-2 text-dark" href="{{route('admin.payment.manual.edit', $manualPayment->id)}}">{{decode('Update')}}</a></li>
                                        @endif

                                        @if(authUser()->can('payment.manual.edit'))
                                            <li><a class="border-0 p-2 text-dark" href="{{route('admin.payment.manual.show', $manualPayment->id)}}">{{decode('Show')}}</a></li>
                                        @endif

                                        @if(authUser()->can('payment.manual.destroy'))
                                            <li data-route="{{route('admin.payment.manual.destroy') }}" class="sweet-delete" id="{{ $manualPayment->id }}" ><a class="border-0 p-2 text-dark" >{{decode('Delete')}}</a></li>
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
            <form id="manual_payment_status_update" hidden action="{{ route('admin.payment.manual.update.status')}}" method="post">
                @csrf
                <input id="manual_payment_id"  type="text" name="id">
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
            $(document).on('click','.manual_payment_status',function(e){
                const id  = $(this).attr('value')
                $('#manual_payment_id').val(id)
                $('#manual_payment_status_update').submit();
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
