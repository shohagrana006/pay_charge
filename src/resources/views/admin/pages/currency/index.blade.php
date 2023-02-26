@extends('layouts.admin.admin_app')
@section('admin_main_content')
    <section>
        <div class="p-3 rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('admin.home')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('Dashboard')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Currency')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <div>
        <!-- table section start  -->
        <section class="mt-3 bg--light rounded shadow-sm">
            <div class="table-header d-flex align-items-center justify-content-between">

            </div>
                <div class="table-action-buttons">
                    <div class="px-3 pb-2">
                        <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">

                            <div class="d-sm-block d-lg-flex align-items-center mb-2">

                                <a href="{{ route('admin.currency.index') }}" class="mb-sm-2 mb-lg-0 me-2 btn--primary border-0 pointer rounded btn-sm">{{ decode('All') }}
                                    @if(Route::currentRouteName() == 'admin.currency.index' || Route::currentRouteName() == 'admin.currency.status')
                                    ({{ countModelData('Currency') }})
                                    @endif
                                </a>
                                @if(Route::currentRouteName()== 'admin.currency.index' || Route::currentRouteName()== 'admin.currency.status')
                                <a href="{{ route('admin.currency.status','Active')}}" class="mb-sm-2 mb-lg-0 me-2 btn--success border-0 pointer rounded btn-sm">Active ({{ getDataByStatus('Active','Currency')->count() }})  </a>

                                <a href="{{ route('admin.currency.status','DeActive')}}"  class="mb-sm-2 mb-lg-0 me-2 btn--danger border-0 pointer rounded btn-sm">Deactive ({{ getDataByStatus('DeActive','Currency')->count() }})</a>
                                @endif
                                @if(authUser()->can('currency.create'))
                                    <a  data-bs-toggle="modal"
                                    data-bs-target="#create-currency"  class="
                                    btn--primary border-0 btn-sm text-decoration-none text-light">{{ decode('Create') }} <i class="las la-plus"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3">
                    <table id='currency-table' class="table dt-responsive nowrap w-100" id="admins-table">
                        <thead>
                            <tr>
                                <th>{{ decode('Name') }}</th>
                                <th>{{ decode('Symbol') }}</th>
                                <th>{{ decode('Rate') }}</th>
                                <th>{{ decode('Status') }}</th>
                                <th>{{ decode('CreatedBy') }}</th>
                                <th>{{ decode('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($currencies as $currency)
                                    <tr>
                                        <td>
                                            {{$currency->name}}
                                        </td>
                                        <td>
                                                {{($currency->symbol)}}
                                        </td>
                                        <td>1 USD = {{round($currency->rate) }} {{$currency->name}}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input currency-status" value="{{$currency->id}}" type="checkbox" id="flexSwitchCheckChecked }}" {{$currency->status == "Active" ? 'checked' : ''}}>
                                            </div>
                                        </td>

                                        <td>
                                            {{($currency->CreatedBy->name)}}
                                       </td>
                                        <td>
                                            <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu border-0" style="">
                                                @if(authUser()->can('currency.edit'))
                                                <li><a data-bs-toggle="modal"
                                                    data-bs-target="#update-currency-{{ $currency->id }}" class="border-0 p-2 text-dark" >{{ decode('Update') }}</a></li>
                                                @endif
                                                @if(authUser()->can('currency.destroy'))
                                                    <li class="sweet-delete pointer" data-route='{{route('admin.currency.destroy')}}' id="{{ $currency->id }}"
                                                    ><a class="border-0 p-2 text-dark" >{{ decode('Delete') }}</a></li>
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
            @if(authUser()->can('currency.edit'))
                <form id="currency-status-update" hidden action="{{ route('admin.currency.status.update')}}" method="post">
                    @csrf
                    <input id="currency-status-id"  type="id" name="id">
                </form>
            @endif

            @include('admin.pages.includes.currency.createModal')
                {{--  currency edit modal  --}}
            @forelse($currencies as $currency)
                @include('admin.pages.includes.currency.updateModal')
            @endforeach

        </section>
        <!-- table section end  -->
    </div>


@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //datatable initiation
            $('#currency-table').DataTable({
            });
            const selectorType = 'class';
            // update roles status event start
            $(document).on('click','.currency-status',function(e){
                const id  = $(this).attr('value')
                $('#currency-status-id').attr('value',id)
                $('#currency-status-update').submit();
            })


        })(jQuery);
    </script>
@endpush
