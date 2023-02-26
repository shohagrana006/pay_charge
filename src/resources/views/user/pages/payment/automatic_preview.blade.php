@extends('layouts.user.user_app')
@section('user_main_content')
    <section class="pb-3">
        <div class="rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('user.payment.list')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('Payment Method')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Payment details')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <div>
        <section class="bg--light rounded shadow-sm p-4">
            <div class="row">
               <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <br>
                        <span class="btn text-start mb-3">
                            <img class="w-25" src="{{displayImage('assets/images/general/paymentMethod/'.$automaticPayment->image, App\Cp\ImageProcessor::filePath()['manual_payment']['size'])}}" alt="image logo">
                        </span>
                        <p>{{decode('Method Name')}}: {{$automaticPayment->name}}</p>
                        @if ($automaticPayment->charge > 0 && $automaticPayment->charge != null )
                            <p>{{decode('Fixed Charge')}}: {{$automaticPayment->charge}}</p>
                        @endif
                        
                       
                        <br>
                        <br>

                        <div>
                            @php
                                $price = json_decode($purchase->package_info,true)['price'];
                            @endphp
                            <p>{{decode('Package Price')}} : {{$price}}</p>

                            @php
                                $pay_price = round($price + $automaticPayment->charge);
                            @endphp
                            <p>{{decode('Pay with charge')}} : {{$pay_price}}</p>
                        </div>


                        <br>
                        <br>
                        <form action="{{route('user.payment.automatic.confirm')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$automaticPayment->id}}">
                            <input type="hidden" name="amount" value="{{$pay_price}}">
                            <button type="submit" class="btn btn-primary">{{decode('Confirm')}}</button>
                        </form>

                    </div>
                </div>
               </div>

            </div>
        </section>

      
    </div>
@endsection
