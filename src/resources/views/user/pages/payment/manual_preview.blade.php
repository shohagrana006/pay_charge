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
                        <span class="btn cus_box">
                            <img class="" src="{{displayImage('assets/images/general/manual_payment/'.$manualPayment->logo, App\Cp\ImageProcessor::filePath()['manual_payment']['size'])}}" alt="image logo">
                        </span>
                        <p>{{decode('Method Name')}}: {{$manualPayment->gateway_name}}</p>
                        <p>{{decode('Minimum Amount')}}: {{$manualPayment->minimum_amount }}</p>
                        <p>{{decode('Maximum Amount')}}: {{$manualPayment->maximum_amount}}</p>
                        @if ($manualPayment->fixed_charge)                                               
                            <p>{{decode('Fixed Charge')}}: {{$manualPayment->fixed_charge}}</p>
                        @endif
                        @if ($manualPayment->percent_charge)                                             
                            <p>{{decode('Percent Charge')}}: {{$manualPayment->percent_charge}}</p>
                        @endif
                        <p>{{decode('Instruction')}}: {{$manualPayment->instruction}}</p>
                        <br>
                        <br>

                        <div>
                            @php
                                $price = json_decode($purchase->package_info,true)['price'];
                            @endphp
                            <p>{{decode('Package Price')}} : {{$price}}</p>

                            @php
                                $percent_price=0;
                                if($manualPayment->percent_charge){
                                    $percent_price = ($price*($manualPayment->percent_charge))/100;
                                }
                                $pay_price = round($price+$percent_price+$manualPayment->fixed_charge);
                            @endphp
                            <p>{{decode('Pay with charge')}} : {{$pay_price}}</p>
                        </div>


                        <br>
                        <br>
                        @if($manualPayment->info != 'null')
                            <p>{{decode('User Input')}}: </p>
                        @endif
                        <form action="{{route('user.payment.log.post')}}" method="POST">
                            @csrf

                            <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
                            <input type="hidden" name="method_id" value="{{$manualPayment->id}}">
                            <input type="hidden" name="ammount" value="{{$pay_price}}">

                            @if($manualPayment->info != 'null')
                                @foreach (json_decode($manualPayment->info, true) as $key => $item)
                                    <div class="form-group">
                                        <label class="form-label" for="">{{ucfirst($item['name'])}}@if($item['validation'] == 'required')<span class="text-danger">*</span> @endif
                                        </label>
                                        @if($item['type'] == 'textarea')
                                            <textarea name="info[{{str_replace(' ', '_', $item['name'])}}]" class="form-control"></textarea>
                                        @else
                                            <input class="form-control" type="{{$item['type']}}" name="info[{{str_replace(' ', '_', $item['name'])}}]" {{$item['validation']}}>
                                        @endif
                                    </div>
                                @endforeach
                           

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{decode('Submit')}}</button>
                                </div>
                            @else
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">{{decode('Payment Yes')}}</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
               </div>

            </div>
        </section>

      
    </div>
@endsection
