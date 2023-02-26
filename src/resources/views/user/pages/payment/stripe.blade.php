@extends('layouts.user.user_app')
@section('meta_description')
{{ decode('Payment With Stripe') }}
@endsection
@section('meta_title')
{{ decode('Payment With Stripe') }}
@endsection
@section('user_main_content')
<main>
    <div class="container">
        <div class="card">
            <div class="card-header bg--lite--violet">
                <h3 class="card-title text-center">{{ decode('Payment With Stripe') }}</h3>
            </div>
            <div class="strip-body">
                @php
                    $creds =  json_decode($paymentMethod->payment_parameter,true);
                @endphp
                <form role="form" method="post" action="{{ route('user.stripe') }}"   class="stripe-payment" data-cc-on-file="false" data-stripe-publishable-key="{{@$creds['publishable_key']}}"  id="stripe-payment">
                    @csrf
                    <div class="row">
                        <div class="mb-5 col-lg-12">
                            <label for="name" class="form-label">{{ decode('Name on Card') }}</label>
                            <input type="text" class="fs-4 form-control" placeholder="Enter Card Name">
                        </div>
                        <div class="mb-5 col-lg-6 col-md-6">
                            <label for="number" class="form-label">{{ decode('Card Number') }}</label>
                            <input type="text" id="number" class="fs-4  form-control card-num" placeholder="Enter Card Number">
                        </div>
                        <div class="mb-5 col-lg-6 col-md-6">
                            <label for="cvc" class="form-label">{{ decode('CVC') }}</label>
                            <input type="text" id="cvc" autocomplete='off' class="fs-4  form-control card-cvc" placeholder="E.G 595">
                        </div>
                        <div class="mb-5 col-lg-6 col-md-6">
                            <label for="month" class="form-label">{{ decode('Expiration Month') }}</label>
                            <input type="text" id="month" autocomplete='off' class="fs-4  form-control card-expiry-month" placeholder="MM">
                        </div>
                        <div class="mb-5 col-lg-6 col-md-6">
                            <label for="year" class="form-label">{{ decode('Expiration Year') }}</label>
                            <input type="text" id="year" autocomplete='off' class="fs-4  form-control card-expiry-year" placeholder="MM">
                        </div>
                        <button class="btn btn-primary" type="submit">{{ decode('Pay') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<main>
@endsection
@push('frontend-js-include')
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@endpush
@push('frontend-js-push')
	<script>
		"use strict"
	    $(function () {
	        var $form = $(".stripe-payment");
	        $('form.stripe-payment').bind('submit', function (e) {
	            var $form = $(".stripe-payment"),
	            inputVal = ['input[type=email]', 'input[type=password]',
	                'input[type=text]', 'input[type=file]',
	                'textarea'
	            ].join(', '),
	            valid = true;

	            if (!$form.data('cc-on-file')) {
	                e.preventDefault();
	                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
	                Stripe.createToken({
	                    number: $('.card-num').val(),
	                    cvc: $('.card-cvc').val(),
	                    exp_month: $('.card-expiry-month').val(),
	                    exp_year: $('.card-expiry-year').val()
	                }, stripeRes);
	            }
	        });

	        function stripeRes(status, response) {
	            if (response.error) {
                    toast.fire({
                        icon: 'error',
                        title: response.error.message
                    })
	            } else {
	                var token = response['id'];
	                $form.find('input[type=text]').empty();
	                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
	                $form.get(0).submit();
	            }
	        }
	    });
	</script>
@endpush
