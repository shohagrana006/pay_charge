@extends('layouts.admin.admin_app')
@section('3rd_party')
    activeBg
@endsection
@section('payment')
    custom-tab-active
@endsection
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
                    <span>{{decode('Automatic Payment')}}</span>
                </li>
            </ul>
        </div>
    </section>

    <section class="mt-3">
        <div class="rounded_box">
            <div class="row">
                @foreach($paymentMethods as $paymentMethod)

                    <div class="col-12 col-lg-4 col-xl-4 mb-2 mt-3 cus_box">
                        <div class="shadow-sm rounded">
                            <div class="">
                                <img class="w-25" src="{{ asset('assets/images/general/paymentMethod/'.$paymentMethod->image) }}" alt="{{ $paymentMethod->name }}">
                            </div>
                            <div class="p-3 position-relative">
                                <div class="d-flexr justify-content-center">
                                    <h5 class="m-0"> {{  ucwords(str_replace('_', ' ', $paymentMethod->name)) }}</h5>
                                </div>

                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-end p-2">
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input paymentMethod-status-update" value="{{ $paymentMethod->id }}" type="checkbox" id="flexSwitchCheckChecked" {{ $paymentMethod->status == 'Active' ? 'checked':'' }} >
                                    </div>
                                </div>
                            </div>

                            @php
                                $paymentCreds =  json_decode($paymentMethod->payment_parameter,true);
                            @endphp

                            <div class="p-3">

                             <form action="{{ route('admin.paymentMethod.update') }}" method="post">
                                @csrf
                                <input name="id" value="{{$paymentMethod->id}}" type="hidden">
                                @foreach($paymentCreds as $key => $value)
                                    <div class="mb-3">
                                        <label class="mb-2" for="">
                                            {{ ucFirst(str_replace('_', ' ', $key)) }}
                                        </label>

                                        @if($key == 'environment')
                                        <select class="form-control" name="paymentCreds[{{ $key }}]" id="">
                                            <option {{ $value == 'live' ? 'selected' : '' }} value="live">Live</option>
                                            <option {{ $value == 'sandbox' ? 'selected' : '' }}  value="sandbox">Sandbox</option>
                                        </select>
                                        @else
                                        <input value="{{$value}}" type="text" class="form-control" name="paymentCreds[{{ $key }}]" id="">
                                        @endif

                                    </div>
                                @endforeach
                                <div class="mb-3">
                                    <label class="mb-2" for=""> {{ decode('Currency') }} </label>
                                    <select class="form-control" name="currency_id" id="">
                                      @foreach($currencies as $currency)
                                        <option {{ $paymentMethod->currency_id == $currency->id ? 'selected' : '' }}  value="{{$currency->id}}">{{ $currency->symbol }}</option>
                                      @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2" for=""> {{ decode('Charge') }} </label>
                                    <input step="any" value="{{round($paymentMethod->charge)}}" type="number" class="form-control" name="charge" id="">
                                </div>
                                <div class="col-12 col-md-6 mt-3">
                                    <button class="d-block btn btn--primary" type="submit">{{ decode('update') }}</button>
                                </div>
                            </form>

                            </div>
                        </div>
                    </div>
 
                @endforeach
            </div>
        </div>

        {{--  update oauth cred status  --}}
        <form id="payment-method-status" action="{{route('admin.paymentMethod.status.update')}}" method="post">
            <input hidden name="id" id="payment-method-id" type="text">
            @csrf
        </form>
        {{--  update oauth cred status   --}}
    </section>

@endsection

@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //mail change function
            $(document).on('click','.paymentMethod-status-update',function(e){
                const id  = $(this).val()
                $('#payment-method-id').val(id)
                $('#payment-method-status').submit()
            })
        })(jQuery);
    </script>
@endpush
