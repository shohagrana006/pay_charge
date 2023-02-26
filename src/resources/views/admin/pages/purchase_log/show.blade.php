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
                    <a href="{{route('admin.purchase.log.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Purchase Log')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Show')}}</span>
                </li>
            </ul>
        </div>
    </section>

    <section class="rounded_box">

        <div class="user_information">
            <h5>{{ decode('Purchase Log Information') }}</h5>
            <div class="mt-3">
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Name')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $purchase->name }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Email')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $purchase->email }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-sun"></i>
                            </div>
                            <span>{{decode('Phone')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $purchase->phone }}</div>
                </div>              
                
                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-plus"></i>
                            </div>
                            <span>{{decode('User Name')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $purchase->user? $purchase->user->name :'N/A' }}</div>
                </div>
                
                @if(!empty(json_decode($purchase->package_info, true)))
                    <div class="row align--center">
                        <div class="col-6 col-xl-12 pt-4">
                            <div>
                                <h5>{{decode('Package Info')}}</h5>
                            </div>
                        </div>
                        <div class="col-6 col-xl-6 pb-2">
                            <div class="row">
                                @foreach (json_decode($purchase->package_info, true) as $key => $item) 
                                    <div class="col-4 mt-3">
                                        <p>{{ucfirst($key)}} : <span class="badge bg-secondary">{{$item}}</span></p>         
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                

                <div class="row align--center bg-primary mt-3">
                    <div class="col-6 col-xl-2 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-map-marker"></i>
                            </div>
                            <span class="text-white">{{decode('Status Update')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-3">
                        <div class="status_update">
                            <form action="{{route('admin.purchase.log.update')}}" method="post" class="status_update_form">
                                @csrf
                                <input type="hidden" name="id" value="{{$purchase->id}}">
                                <select class="form-select status_update" name="status" id="">
                                    <option {{$purchase->status == 1 ? 'selected' : ''}} value="1">{{decode('Pending')}}</option>
                                    <option {{$purchase->status == 2 ? 'selected' : ''}} value="2">{{decode('Success')}}</option>
                                    <option {{$purchase->status == 3 ? 'selected' : ''}} value="3">{{decode('Failed')}}</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection

@push('backend-js-push')

    <script>
        $(document).on('change','.status_update', function(e){
            $('.status_update_form').submit();
            e.preventDefault();
        })
    </script>

    @if(session()->has('error'))
        <script>
            toast.fire({
                icon: 'error',
                title: "{{session()->get('error')}}"
            })
        </script>
    @endif
    @if(session()->has('seccess'))
        <script>
            toast.fire({
                icon: 'success',
                title: "{{session()->get('seccess')}}"
            })
        </script>
    @endif
@endpush

