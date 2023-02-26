@extends('frontend.layouts.app')
@section('content')
@include('frontend.partials.breadcrumb')
<section>
    <div class="Container">
        <div class="payment-getway-container">
            <div class="payment-getway">
                <div class="payment-getway-content">
                    <h4>@lang('Payment with paypal')</h4>
                    <div class ="payment-amount">{{shortAmount($paymentLog->final_amount)}} {{$paymentLog->paymentGateway->currency->name}}<small></small></div>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('user.paypal') }}" id="payment-form" role="form"  >
                    @csrf
                    <button type="submit" class="btn btn-primary payment-btn">
                        @lang('Pay With Paypal')
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
