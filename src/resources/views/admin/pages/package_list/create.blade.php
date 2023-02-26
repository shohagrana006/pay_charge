@extends('layouts.admin.admin_app')
@section('admin_main_content')

    <section class="pb-3">
        <div class="rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('admin.home')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('Dashboard')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('admin.package.list.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Package List')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Create')}}</span>
                </li>
            </ul>
        </div>
    </section>

    <section>
        <!-- form section start  -->
        <div class="white-auto-fill">
            <form action="{{route('admin.package.list.store')}}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation label_margin_top" >
                @csrf
                <input type="hidden" name="package_service_id" value="{{$packageService->id}}">
                <div class="col-lg-12">
                    <div class="section-container rounded">
                        <h5>{{ decode('Package List Create') }}</h5>
                        <div class="content-wrapper pb-4">
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label for="" class="form-label">{{ decode('Service Name') }}</label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input type="text"  class="border-0 rounded-0 form-control" readonly value="{{$packageService->service->name}}">
                                    </div>                                  
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="" class="form-label">{{ decode('Package Name') }}</label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input type="text"  class="border-0 rounded-0 form-control" readonly value="{{$packageService->package->name}}">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="" class="form-label">{{ decode('Minute') }}</label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input placeholder="Enter minute" type='number' name="minute" value="{{ old('minute') }}" class="border-0 rounded-0 form-control @error('minute') is-invalid @enderror" />
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('minute') {{ $message }} @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="" class="form-label">{{ decode('MB') }}</label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input placeholder="Enter MB" type="number" name="mb" value="{{ old('mb') }}" class="border-0 rounded-0 form-control @error('mb') is-invalid @enderror" id="" >
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('mb') {{ $message }} @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="" class="form-label">{{ decode('SMS') }}</label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input placeholder="Enter sms" type="number" name="sms" value="{{ old('sms') }}" class="border-0 rounded-0 form-control @error('sms') is-invalid @enderror" id="" >
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('sms') {{ $message }} @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="" class="form-label">{{ decode('Duration in day') }}</label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input placeholder="Enter duration day" type="number" name="duration" value="{{ old('duration') }}" class="border-0 rounded-0 form-control @error('duration') is-invalid @enderror" id="" >
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('duration') {{ $message }} @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="" class="form-label">{{ decode('Price') }}</label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input placeholder="Enter Price" type="number" name="price" value="{{ old('price') }}" class="rounded-0 w-100 border-0 form-control @error('price') is-invalid @enderror" id="" aria-describedby="inputGroupPrepend" >
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('price') {{ $message }} @enderror
                                    </div>
                                </div>


                                <div class="col-md-6 mt-3">
                                    <label for="" class="form-label">{{ decode('Discount Price') }} </label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input placeholder="Enter discount price" type="number" name="discount_price" value="{{ old('discount_price') }}" class="rounded-0 border-0 form-control @error('discount_price') is-invalid @enderror" id="" aria-describedby="inputGroupPrepend">
                                    </div>
                                    <div class="ms-3 text-danger">
                                        @error('discount_price') {{ $message }} @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <label for="" class="form-label @error('details') is-invalid @enderror  ">{{ decode('Details') }} </label>
                                    <textarea class="form-control" name="details" >{{ old('details') }}</textarea>
                                    <div class="ms-3 text-danger">
                                        @error('details') {{ $message }} @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-12 my-3">
                    <button class="d-block btn btn--primary" type="submit">{{ decode('Add') }}</button>
                </div>
            </form>
        </div>
        <!-- form section end  -->
    </section>
@endsection