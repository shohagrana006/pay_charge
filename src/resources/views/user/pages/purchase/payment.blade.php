@extends('layouts.user.user_app')
@section('user_main_content')
    <section class="pb-3">
        <div class="rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('user.package.index')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('package List')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Payment method')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <div>
        <section class="bg--light rounded shadow-sm p-4">
            <div class="row">
               <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <p>{{decode('Automatic payment method')}}</p>
                    </div>
                    <div class="card-body">
                      <div class="row">
                            @foreach ($automaticPayments as $automaticPayment)
                                <div class="col-md-3 mt-4">
                                    <a href="{{route('user.payment.automatic.preview', $automaticPayment->id)}}" class="btn cus_box w-100">
                                        <div class="card-body">
                                            <img src="{{asset('assets/images/general/paymentMethod/'.$automaticPayment->image) }}" alt="image logo">
                                            <p>{{decode('Method')}}: {{$automaticPayment->name}}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
               </div>
            </div>
        </section>

        <section class="bg--light rounded shadow-sm p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <p>{{decode('Manual payment method')}}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($manualPayments as $manualPayment)
                                    <div class="col-md-3 mt-4">
                                        <a href="{{route('user.payment.manual.preview', $manualPayment->id)}}" class="btn cus_box">
                                            <div class="card-body">
                                                <span class="btn cus_box">
                                                    <img class="" src="{{displayImage('assets/images/general/manual_payment/'.$manualPayment->logo, App\Cp\ImageProcessor::filePath()['manual_payment']['size'])}}" alt="image logo">
                                                </span>
                                                <p>{{$manualPayment->gateway_name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

       
        
        
    </div>
@endsection
