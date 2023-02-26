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
                    <a href="{{route('admin.faq.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('FAQ')}}</span>
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
            <h5>{{ decode('FAQ') }}</h5>
            <div class="mt-3">

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-envelope"></i>
                            </div>
                            <span>{{decode('Question')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $faq->qsn }}</div>
                </div>

                <div class="row align--center">
                    <div class="col-6 col-xl-3 py-2">
                        <div class="d-flex align-items-center">
                            <div class="single_user_icon_container d--flex align--center justify-content-center fs-4 text-dark me-3">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <span>{{decode('Answer')}}</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-9">{{ $faq->ans }}</div>
                </div>
                       
            </div>
        </div>
    </section>

@endsection

