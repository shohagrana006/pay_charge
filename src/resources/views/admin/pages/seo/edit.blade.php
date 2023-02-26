@extends('layouts.admin.admin_app')

@section('admin_main_content')
    <section>
        <div class="p-3 rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('admin.home')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('Dashboard')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('admin.seoSetting.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Seo')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Update')}}</span>
                </li>
            </ul>
        </div>
    </section>

    <div>
        <!-- form section start  -->

        <form action="{{ route('admin.seoSetting.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="rounded_box mt-3">
                <input hidden name="id" value="{{ $seoSetting->id }}" type="text">
                <div class="mb-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5> {{ decode('Update Frontend Seo') }} </h5>
                        </div>
                    </div>
                </div>
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
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="mb-2" for="floatingInput">{{ decode('Page Name')}}
                                </label>
                                <input disabled class="form-control" type="text" value="{{ $seoSetting->name }}" id="">
                            </div>
                        </div>
                    </div>
                    @foreach(getSystemLanguage() as $language)
                    <div class=" mt-2 tab-pane fade show {{ $loop->index == 0 ?'active' :''}}" id="{{ $language->code }}" role="tabpanel" aria-labelledby="{{ $language->code }}-tab">
                        <div class="mb-2 seo-section d-none">
                            <h5>{{ decode('Seo Manage') }}</h5>
                        </div>
                        <div class="row seo-section">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="mb-2" for="floatingInput">{{ decode('meta title')}} [{{ $language->code }}]
                                    </label>
                                    <input
                                    name="meta_title[{{$language->code}}]"
                                        type="text"
                                        class="form-control"
                                        id="floatingInput"
                                        value="{{ $seoSetting->getTranslation('meta_title',$language->code) }}"
                                        placeholder=""
                                    />
                                </div>
                                <div class="mb-3">
                                    <label class="mb-2" for="floatingInput">{{ decode('meta description')}} [{{ $language->code }}]</label>
                                    <textarea  class="form-control" name="meta_description[{{$language->code}}]" id="" cols="30" rows="10">
                                        {{ $seoSetting->getTranslation('meta_description',$language->code) }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-md-6 mt-3">
                <button class="btn btn--primary" type="submit">{{ decode('Update') }}</button>
            </div>
        </form>


        <!-- form section end  -->
    </div>
@endsection

