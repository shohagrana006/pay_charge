@extends('layouts.user.user_app')
@section('user_main_content')
    <section class="pb-3">
        <div class="rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('user.dashboard')}}" >
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
        <div class="p-3">
            <table id='category-table' class="table dt-responsive nowrap w-100" id="admins-table">
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
                                    <li><a class="border-0 p-2 text-dark" href="{{route('user.purchase.log.show', $purchase->id)}}">{{decode('Details')}}</a></li>

                                    @if($purchase->status == 1 || $purchase->status == 3)
                                        <li><a class="border-0 p-2 text-dark purchase_delete" data-id="{{$purchase->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">{{decode('Delete')}}</a></li>
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
    <!-- purchase delete modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('user.purchase.log.delete')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" class="purchase_delete_input">
                    <div class="modal-header">                     
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-danger text-center">
                        <i class="fas fa-trash-alt"></i>
                        {{decode('Are you sure delete this !!')}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-bs-dismiss="modal">{{decode('Cancel')}}</button>
                        <button type="submit" class="btn btn-danger">{{decode('Delete')}}</button>
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

            $(document).on('click', '.purchase_delete', function(){
                let id = $(this).data('id');
                $('.purchase_delete_input').val(id)
            })

        })(jQuery);
    </script>

    @if(session()->has('error'))
        <script>
            toast.fire({
                icon: 'error',
                title: "{{session()->get('error')}}"
            })
        </script>
    @endif
    @if(session()->has('seccess'))
        <script>
            toast.fire({
                icon: 'success',
                title: "{{session()->get('seccess')}}"
            })
        </script>
    @endif
@endpush
