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
                    <a href="{{route('admin.service.category.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Service Category')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('update')}}</span>
                </li>
            </ul>
        </div>
    </section>

    <section>
        <div class="mb-2">
            <h5 class="m-0" id="">{{decode('Update Service Category')}}</h5>
        </div>
        <!-- form section start  -->
            <form action="{{route('admin.service.category.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$serviceCategory->id}}">
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
                                @csrf                      
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <label for="validationCustom01" class="form-label">
                                            {{decode('Service Category name')}} [{{ $language->code }}] 
                                            @if(session()->get('locale') == $language->code)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>  
                                            </div>
                                            <input placeholder="Enter Service Category Name" type="text" name="name[{{$language->code}}]" value="{{ $serviceCategory->getTranslation('name', $language->code)}}" class="form-control  border-0 rounded-0" id="validationCustom01">
                                        </div>
                                        @if(session()->get('locale') == $language->code)
                                            <div class=" text-danger">
                                                @error('name.'.session()->get('locale')) {{ $message }} @enderror
                                            </div>
                                        @endif
                                        <div class="ms-3 text-danger"></div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <label class="mb-2" for="floatingInput">{{ decode('slug')}} [{{ $language->code }}]</label>
                                        <div class="input-container position-relative ps-5">
                                            <div class="link-icon-container mx-auto">
                                                <i class="las la-globe-americas"></i>
                                            </div>
                                            <input
                                            name="slug[{{ $language->code }}]"
                                            type="text"
                                            class="form-control border-0 rounded-0"
                                            id="floatingInput"
                                            placeholder=""
                                            value="{{ $serviceCategory->getTranslation('slug', $language->code) }}"
                                            />
                                        </div>
                                        <div class=" text-danger">
                                            @error('slug.'.$language->code) {{ $message }} @enderror
                                        </div>
                                    </div>                                      
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
    
                <div class="section-container">
                    <div class="content-wrapper pb-4">
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label for="file" class="form-label">{{decode('Service Category Logo')}} <span class="text-danger"> ({{implode(", ", fileFormat())}}) & size [{{ App\Cp\ImageProcessor::filePath()['service_category']['size'] }}]</span></label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>
                                        </div>
                                        <input type="file" name="logo" class="form-control  border-0 rounded-0" id="admin_photo">
                                     </div>
                                    <div class="ms-3 text-danger"></div>
                                </div>   
                                 
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="section-container mt-3">
                    <div class="content-wrapper pb-4">
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <div class="form-group">      
                                        <button type="submit" class="btn btn-primary">{{decode('Submit')}}</button>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>          
            </form> 
        <!-- form section end  -->
    </section>
@endsection
