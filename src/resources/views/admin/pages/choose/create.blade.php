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
                    <a href="{{route('admin.choose.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Choose')}}</span>
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
            <div class="section-container rounded py-3">
                <h5>{{ decode('Choose Create') }}</h5>
            </div>
            <form action="{{route('admin.choose.store')}}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation label_margin_top">
                @csrf

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach(getSystemLanguage() as $language)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link multi-form
                            {{ $loop->index == 0 ?'active' :''}}" id="{{ $language->code }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $language->code }}" type="button" role="tab" aria-controls="{{ $language->code }}"
                            @if($loop->index == 0)
                            aria-selected="true"
                            @endif >
                            {{ ucFirst($language->code) }}
                        </button>
                        </li>
                    @endforeach
                </ul>
    
    
                <div class="tab-content" id="myTabContent">
                    @foreach(getSystemLanguage() as $language)
                    <div class="my-3 tab-pane fade show {{ $loop->index == 0 ?'active' :''}}" id="{{ $language->code }}" role="tabpanel" aria-labelledby="{{ $language->code }}-tab">
                        <div class="section-container mb-3">
                            <div class="content-wrapper">                 
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <label for="validationCustom01" class="form-label">
                                            {{decode('Heading')}} [{{ $language->code }}] 
                                            @if(session()->get('locale') == $language->code)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>  
                                            </div>
                                            <input placeholder="Write heading" type="text" name="qsn[{{$language->code}}]" value="{{ old('qsn.'.$language->code) }}" class="form-control  border-0 rounded-0" id="validationCustom01">
                                        </div>
                                        @if(session()->get('locale') == $language->code)
                                            <div class=" text-danger">
                                                @error('qsn.'.session()->get('locale')) {{ $message }} @enderror
                                            </div>
                                        @endif
                                        <div class="ms-3 text-danger"></div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="mb-2" for="floatingInput">{{ decode('Paragraph')}} [{{ $language->code }}]</label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input
                                            name="ans[{{ $language->code }}]"
                                            type="text"
                                            class="form-control border-0 rounded-0"
                                            id="floatingInput"
                                            placeholder=""
                                            value="{{ old('ans.'.$language->code) }}"
                                            />
                                        </div>
                                        <div class=" text-danger">
                                            @error('ans.'.$language->code) {{ $message }} @enderror
                                        </div>
                                    </div>                                      
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                 
                <div class="col-lg-12">
                    <div class="section-container rounded">                      
                        <div class="content-wrapper pb-4">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label for="icon" class="form-label">{{decode('Icon Name')}}</label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input type="text" name="icon" class="form-control  border-0 rounded-0">
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

