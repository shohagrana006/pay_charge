@extends('layouts.user.user_app')
@section('meta_description')
{{ decode('Payment With Razor Pay') }}
@endsection
@section('meta_title')
{{ decode('Payment With Razor Pay') }}
@endsection
@section('user_main_content')
<main>
    <div class="container">
        <div class="payment-getway-container">
            @php
                if((authUser('web')->address))
                {
                   $address = json_decode((authUser('web')->address),true)['address'];
                }
                $amount = session()->get('payment_amount');
                $creds = json_decode($paymentMethod->payment_parameter, true);
                $currencySetup = json_decode(generalSetting()->currency_setup,true);
            @endphp
            <div class="payment-getway">
                <div class="payment-getway-content">
                    <h4>{{ decode('Payment with Paystack') }}</h4>
                    <div class="payment-amount">{{$amount}}
                        {{$currencySetup['symbol']}}<small></small></div>
                </div>
                <form id="paymentForm">
                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary payment-btn"
                            onclick="payWithPaystack(event)">{{ decode('Pay With Paystack') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
@push('frontend-js-include')
<script src="https://js.paystack.co/v2/inline.js"></script>
@endpush
@push('frontend-js-push')
<script>
'use strict';
var paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener('submit', payWithPaystack, false);

function payWithPaystack(e) {
    e.preventDefault();
    var handler = PaystackPop.setup({
        key: '{{$creds['public_key']}}',
        email: '{{authUser('web')->email}}',
        amount: '{{$amount * 100}}',
        currency: 'NGN',
        ref: '{{trxNumber()}}',
        callback: function(response) {
            $.ajax({
                url: "{{route('user.paystack')}}",
                data: {
                    reference: response.reference
                },
                type: "GET",
                success: function(response) {
                    const responseData = JSON.parse(response)
                    if(responseData.success){
                        toast.fire({
                            icon: 'success',
                            title:'Payment Successfull'
                        })
                        window.location.href = "{{route('user.dashboard')}}";
                    }
                    else{
                        toast.fire({
                            icon: 'error',
                            title: responseData.error
                        })
                    }
                }
            });
        },
        onClose: function() {
            toast.fire({
                icon: 'error',
                title:'Transaction was not completed, window closed.'
            })
        },
    });
    handler.openIframe();
}
</script>
@endpush
