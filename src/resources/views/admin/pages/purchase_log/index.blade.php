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
                    <span>{{decode('Purchase Log')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <!-- table section start  -->
    <section class="bg--light rounded shadow-sm">
        <div class="table-action-buttons">
            <div class="px-3 pb-2">
                <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">
                    <div class="d-sm-block d-lg-flex align-items-center mb-2">
                        <span class="mb-sm-2 mb-lg-0 me-2 btn--primary border-0 pointer rounded btn-sm">{{decode('Total')}} ({{$totalPurchases}})</span>

                        <span href="" class="mb-sm-2 mb-lg-0 me-2 btn--info border-0 pointer rounded btn-sm">{{decode('Pending')}} ({{ getDataByStatus(1,'Purchase')->count() }})</span>

                        <span href="" class="mb-sm-2 mb-lg-0 me-2 btn--success border-0 pointer rounded btn-sm">{{decode('Success')}} ({{ getDataByStatus(2,'Purchase')->count() }})</span> 
                        
                        <span href="" class="mb-sm-2 mb-lg-0 me-2 btn--danger border-0 pointer rounded btn-sm">{{decode('Failed')}} ({{ getDataByStatus(3,'Purchase')->count() }})</span>   
                    </div>
                </div>
            </div>
        </div>

        <div class="p-3">
            <table id='purchase_table' class="table dt-responsive nowrap w-100" id="admins-table">
                <thead>
                    <tr>
                        <th>{{ decode('TRX Number') }}</th>
                        <th>{{ decode('Name') }}</th>
                        <th>{{ decode('Email') }}</th>
                        <th>{{ decode('Phone') }}</th>
                        <th>{{ decode('Status') }}</th>
                        <th>{{ decode('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{$purchase->trx_number}}</td>
                            <td>{{$purchase->name}}</td>
                            <td>{{$purchase->email}}</td>
                            <td>{{$purchase->phone}}</td>
                            <td>
                                @if($purchase->status == 1)
                                    <span class="badge badge-sm bg-info">{{decode('Pending')}}</span>
                                @elseif($purchase->status == 2)
                                     <span class="badge bg-success">{{decode('Success')}}</span>
                                @elseif($purchase->status == 3)
                                     <span class="badge bg-danger">{{decode('Failed')}}</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu border-0" style="">
                                    @if(authUser()->can('purchase.log.edit'))
                                        <li><a class="border-0 p-2 text-dark" href="{{route('admin.purchase.log.show', $purchase->id)}}">{{decode('Details')}}</a></li>
                                    @endif                                 
                                </ul>
                            </td>
                        </tr>
                        <!--  purchase status update form  -->                    
                    @endforeach
                </tbody>
            </table>
        </div>

        

    </section>
    <!-- table section end  -->   

@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //datatable initiation
            $('#purchase_table').DataTable({
            });

        })(jQuery);
    </script>
@endpush
