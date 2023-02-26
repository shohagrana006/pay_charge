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
                    <span>{{decode('Purchase details')}}</span>
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
                        <p>{{$packageList->packageService ? $packageList->packageService->package->name : ''}}</p>
                        <p>
                            <span>{{decode('Minute')}} : {{$packageList->minute}}</span>
                            <span>{{decode('mb')}} : {{$packageList->mb}}</span>
                            <span>{{decode('sms')}} : {{$packageList->sms}}</span>
                            <span>{{decode('duration')}} : {{$packageList->duration}}</span>
                            <span>{{decode('price')}} : {{$packageList->price}}</span>
                            <span>{{decode('new Price')}} : {{$packageList->price - $packageList->discount_price}}</span>
                        </p>
                    </div>
                </div>
               </div>

            </div>
        </section>

        <section class="bg--light rounded shadow-sm p-4">
            <div class="row">
               <div class="col-md-12">
                    <form action="{{route('user.purchase.buy')}}" method="post" >
                        @csrf
                        <input type="hidden" value="{{$packageList->id}}" name="package_list_id">
                        <input type="hidden" value="{{$user->id}}" name="user_id">
                        <div class="form-group">
                            <label for="">{{decode('Name')}}</label>
                            <input type="text"  class="form-control" name="name" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="">{{decode('Email')}}</label>
                            <input type="text"  class="form-control" name="email" value="{{$user->email}}">
                        </div>
                        <div class="form-group">
                            <label for="">{{decode('Phone')}}</label>
                            <input type="text"  class="form-control" name="phone" value="{{$user->phone}}">
                        </div>                      
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{decode('Submit')}}</button>
                        </div>                      
                    </form>
               </div>

            </div>
        </section>  
    </div>
@endsection
