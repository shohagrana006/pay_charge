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
                    <span>{{decode('Update')}}</span>
                </li>
            </ul>
        </div>
    </section>

    <section>
        <!-- form section start  -->
        <div class="white-auto-fill">
            <form action="{{route('admin.faq.update')}}" method="POST" enctype="multipart/form-data" class="needs-validation label_margin_top" novalidate="">
                @csrf
                <input type="hidden" value="{{ $faq->id }}" name="id">


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach(getSystemLanguage() as $language)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link multi-form
                            {{ $loop->index == 0 ?'active' :''}}" id="{{ $language->code }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $language->code }}" type="button" role="tab" aria-controls="{{ $language->code }}"
                            @if($loop->index == 0)
                            aria-selected="true"
                            @endif
                            >
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
                                            {{decode('Faq question')}} [{{ $language->code }}] 
                                            @if(session()->get('locale') == $language->code)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>  
                                            </div>
                                            <input placeholder="Enter question name" type="text" name="qsn[{{$language->code}}]" value="{{ $faq->getTranslation('qsn', $language->code) }}" class="form-control  border-0 rounded-0" id="validationCustom01">
                                        </div>
                                        @if(session()->get('locale') == $language->code)
                                            <div class=" text-danger">
                                                @error('qsn.'.session()->get('locale')) {{ $message }} @enderror
                                            </div>
                                        @endif
                                        <div class="ms-3 text-danger"></div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="mb-2" for="floatingInput">{{ decode('Faq answer')}} [{{ $language->code }}]</label>
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
                                            value="{{ $faq->getTranslation('ans', $language->code) }}"
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
             
                <div class="col-12 col-md-12 my-3">
                    <button class="d-block btn btn--primary" type="submit">{{ decode('Update') }}</button>
                </div>
             
            </form>
        </div>
        <!-- form section end  -->
    </section>
@endsection

