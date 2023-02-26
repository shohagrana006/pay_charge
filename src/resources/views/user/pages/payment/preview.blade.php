@extends('layouts.user.user_app')
@section('meta_description')
{{--  {{ $page->meta_description }}  --}}
@endsection
@section('meta_title')
{{--  {{ $page->meta_title }}  --}}
@endsection
@section('user_main_content')
<main>
    <div class="container pt-5 pb-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}"><i class="fa-solid fa-house-chimney"></i> {{ decode('home') }}</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">{{ decode('Payment Preview') }}</li>
        </ol>
      </nav>
    </div>
    <!-- =============About Us Start============= -->
    <section class="pt-0">
      <div class="container">
        <div class="row">
            <p>{{ decode('Choose Payment Method') }}</p>

             <div>
                <h4> Amount</h4>
              {{ json_decode($generalSetting->currency_setup,true)['symbol'] }}  {{ $package->discount_price ? $package->discount_price : $package->price  }}
             </div>
            <form  action="{{ route('user.payment.confirm') }}"  method="POST" >
                 @csrf
                @foreach(paymentMethods() as $paymentMethod)
                    <div class="col-lg-4">
                        @csrf
                        <label for="{{  $paymentMethod->id }}"> {{ $paymentMethod->name }}</label>
                        <input type="radio" value="{{ $paymentMethod->unique_code }}" name="unique_code" id="{{ $paymentMethod->id}}">
                    </div>
                @endforeach
                <button type="submit"  >{{ decode('Confrim') }}</button>
            </form>


        </div>
      </div>
    </section>

</main>
@endsection
