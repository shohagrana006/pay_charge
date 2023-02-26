@extends('layouts.user.user_app')
@section('meta_description')
{{ decode('Payment With Razor Pay') }}
@endsection
@section('meta_title')
{{ decode('Payment With Razor Pay') }}
@endsection
@section('user_main_content')
<main>
    <div class="container-fluid p-0 mb-3 pb-2">
        <div class="row d-flex align--center rounded">
            <div class="col-xl-12">
                <div class="card">

                    @php
                        if((authUser('web')->address))
                        {
                          $address = json_decode((authUser('web')->address),true)['address'];
                        }
                        $amount = session()->get('payment_amount');
                        $creds = json_decode($paymentMethod->payment_parameter, true);
                        $currencySetup = json_decode(generalSetting()->currency_setup,true);
                    @endphp
                    <div class="card-header bg-lite-violet">
                        <h6 class="card-title text-center text-light">{{decode('Payment With Razor Pay')}}</h6>
                    </div>
                    <div class="card-body text-center">

                        <h3>{{$amount}} {{$currencySetup['currency']}}</h3>
                        <div class="form-submit">
                            <button type="submit" class="mt-3 btn btn--primary text-light payment-btn" id="JsCheckoutPayment">{{ decode('Pay Now') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="payment-success" action="{{ route('user.razorpay.store') }}" method="post">
            @csrf
            <div id="response-data">
            </div>
            <button type="submit"> {{ decode('Pay') }}</button>
        </form>
    </div>


</main>
@endsection

@push('frontend-js-include')
   <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endpush
@push('frontend-js-push')
<script type="text/javascript">
        "use strict";
        var options = {
                "amount": "{{$amount}}",
                "currency": "{{$currencySetup['currency']}}",
                "name": "{{$generalSetting->name}}",
                "description": "Test Transaction",
                "image": "{{displayImage('assets/images/general/weblogo/'.$generalSetting->logo, App\Cp\ImageProcessor::filePath()['logo']['size'])}}",
                "order_id": "{{$order->id}}",
                //"callback_url": "",
                "prefill": {
                    "name": "{{authUser('web')->name ? authUser('web')->name :'Test User' }}",
                    "email": "{{authUser('web')->email}}",
                    "contact": "{{authUser('web')->phone ?? authUser('web')->phone }}"
                },
                "handler": function (response){
                    let {
                    razorpay_signature,
                    razorpay_payment_id,
                    razorpay_order_id
                     } = response;
                    if (typeof response.razorpay_payment_id == 'undefined' ||  response.razorpay_payment_id < 1) {
                        notify('error', "Invalid Request");
                      } else {
                        $('#response-data').append(
                            `
                            <input hidden type="text" name="razorpay_signature" value="${razorpay_signature}">
                            <input hidden type="text" name="razorpay_payment_id" value="${razorpay_payment_id}">
                            <input hidden type="text" name="razorpay_order_id" value="${razorpay_order_id}">
                            `
                        )
                        $('#payment-success').submit()
                    }
                },
                "notes": {
                    "address": "{{@$address}}"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };

        var rzp1 = new Razorpay(options);
        $("#JsCheckoutPayment").on("click",function(e){
            rzp1.open();
            e.preventDefault();
        });
</script>
@endpush
