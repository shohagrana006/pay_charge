@extends('layouts.user.user_app')
@section('meta_description')
{{ decode('Payment With SslCommerz') }}
@endsection
@section('meta_title')
{{ decode('Payment With SslCommerz') }}
@endsection
@section('user_main_content')
<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div >
                    <h4>@lang('Payment with SSL Commerz')</h4>
                    <div>{{session()->get('payment_amount')}} {{json_decode(generalSetting()->currency_setup,true)['symbol']}}</div>
                </div>
                <form action="{{route('user.sslcommerz.store')}}"   class="form-horizontal" method="POST" id="payment-form" role="form" >
                    @csrf
                     <button type="submit" class="btn btn-primary payment-btn" id="sslczPayBtn">{{ decode('PAY') }}</button>
                </form>
            </div>
        </div>

    </div>
</main>
@endsection
