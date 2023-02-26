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
                    <a href="{{route('admin.service.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Service')}}</span>
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

        <div class="mb-2">
            <h5 class="m-0" id="">{{decode('Create Service')}}</h5>
        </div>
        <!-- form section start  -->
        <form action="{{route('admin.service.store')}}" id="ServiceStore" method="post" enctype="multipart/form-data">
            @csrf
            
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
                                <div class="col-md-12 mt-3">
                                    <label for="validationCustom01" class="form-label">{{decode('Service Name')}} [{{ $language->code }}]
                                        @if(session()->get('locale') == $language->code)
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>  
                                        </div>
                                        <input placeholder="Enter Service Name" type="text" name="name[{{$language->code}}]" value="{{ old('name.'.$language->code) }}" class="form-control  border-0 rounded-0 @error('name') is-invalid @enderror" id="validationCustom01">
                                    </div>
                                    @if(session()->get('locale') == $language->code)
                                        <div class=" text-danger">
                                            @error('name.'.session()->get('locale')) {{ $message }} @enderror
                                        </div>
                                    @endif
                                    <div class="ms-3 text-danger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="section-container mt-4">
                <div class="content-wrapper pb-4">
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label class="mb-2" for="">{{ decode('Country') }}<span class="text-danger">*</span></label>
                                <div class="input-container position-relative ps-5">
                                    <div class="link-icon-container mx-auto">
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                    <select name="country_id" class="form-control  @error('country_id') is-invalid @enderror border-0 rounded-0" data-trigger-name="choices-single-groups" id="choices-single-groups">
                                        <option value=''>Select Country</option>
                                        @foreach($countries as $country)
                                            <option @if( old('country_id') == $country->id) selected @endif
                                            value="{{$country->id }}" alt="">{{$country->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ms-3 text-danger">
                                    @error('country_id') {{ $message }} @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label class="mb-2" for="">{{ decode('Category') }}<span class="text-danger">*</span></label>
                                <div class="input-container position-relative ps-5">
                                    <div class="link-icon-container mx-auto">
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                    <select name="service_category_id" class="form-control  @error('service_category_id') is-invalid @enderror border-0 rounded-0" data-trigger-name="choices-single-groups" id="choices-single-groups">
                                        <option value=''>Select Category</option>
                                        @foreach($categories as $category)
                                            <option @if( old('service_category_id') == $category->id) selected @endif
                                            value="{{$category->id }}" alt="">{{$category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ms-3 text-danger">
                                    @error('service_category_id') {{ $message }} @enderror
                                </div>
                            </div>                                                                             
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-container mt-4">
                <div class="content-wrapper pb-4">
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="validationCustom01" class="form-label">{{decode('Processing Time')}}</label>
                                <div class="input-container position-relative ps-5">
                                    <div class="link-icon-container mx-auto">
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                    <input placeholder="Enter Processing Time" type="text" name="processing_time" class="form-control  border-0 rounded-0  @error('processing_time') is-invalid @enderror" id="validationCustom01" value="{{old('processing_time')}}">
                                </div>
                                <div class="ms-3 text-danger">
                                    @error('processing_time') {{ $message }} @enderror
                                </div>
                                <div class="ms-3 text-danger"></div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="validationCustom01" class="form-label">{{decode('Fixed Charge')}}</label>
                                <div class="input-container position-relative ps-5">
                                    <div class="link-icon-container mx-auto">
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                    <input placeholder="Enter Fixed Charge" type="number" name="fixed_charge" class="form-control  border-0 rounded-0  @error('fixed_charge') is-invalid @enderror" id="validationCustom01" value="{{old('fixed_charge')}}">
                                </div>
                                <div class="ms-3 text-danger">
                                    @error('fixed_charge') {{ $message }} @enderror
                                </div>
                                <div class="ms-3 text-danger"></div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="validationCustom01" class="form-label">{{decode('Percent Charge')}}</label>
                                <div class="input-container position-relative ps-5">
                                    <div class="link-icon-container mx-auto">
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                    <input placeholder="Enter Percent Charge" type="number" name="percent_charge" class="form-control  border-0 rounded-0  @error('percent_charge') is-invalid @enderror" id="validationCustom01" value="{{old('percent_charge')}}">
                                </div>
                                <div class="ms-3 text-danger">
                                    @error('percent_charge') {{ $message }} @enderror
                                </div>
                                <div class="ms-3 text-danger"></div>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="file" class="form-label">{{decode('Service Logo')}} <span class="text-danger"> ({{implode(", ", fileFormat())}}) & size [{{ App\Cp\ImageProcessor::filePath()['service']['size'] }}]</span></label>
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

            <div class="section-container mt-4">
                <div class="content-wrapper pb-4">
                    <div class="mt-2">
                        <div class="row">
                            <div class="">
                                <h6>{{decode('Field add')}}</h6>
                            </div>
                            <div>
                                <button class="btn btn--primary bill_click_btn" type="button">{{decode('Add Field')}}</button>
                            </div>
                            <div class="col-md-12">
                                <div class="bill_add_field">
                                   
                                </div>
                            </div>                                                     
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-container mt-4">
                <div class="content-wrapper pb-4">
                    <div class="mt-2">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <div class="form-group">      
                                    <button type="submit" class="btn btn-primary submitBtnClass">{{decode('Submit')}}</button>
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


@push('backend-js-push')
    <script>
        (function($) {

            "use strict";
            //add field start
            let count = 0;
            $(document).on('click', '.bill_click_btn', function(e) {
                           
                if(checkInputField('textValue') != false){
                    count += 1;
                    let html = `
                        <div class="row removeRow">
                            <div class="col-md-4 mt-3">
                                <label>Field Name<span class="text-danger">*</span></label>                             
                                <div class="input-container position-relative ps-5">
                                    <div class="link-icon-container mx-auto">
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                    <input name="input[input-${count}][name]" class="form-control border-0 rounded-0 textValue" type="text" placeholder="Field Name" multiple>  
                                </div>                              
                            </div>
                            <div class="col-md-4 mt-3">
                                <label>Input Type</label>
                                <div class="input-container position-relative ps-5">
                                    <div class="link-icon-container mx-auto">
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                    <select  name="input[input-${count}][type]" class="form-control border-0 rounded-0" data-trigger-name="choices-single-groups" id="choices-single-groups" >
                                        <option value='text'>{{decode('Input Text')}}</option>
                                        <option value='number'>{{decode('Input Number')}}</option>
                                        <option value='textarea'>{{decode('Textarea')}}</option>
                                    </select>
                                </div>                              
                            </div>
                            <div class="col-md-3 mt-3"> 
                                <label>Validation Type</label>                             
                                <div class="input-container position-relative ps-5">
                                    <div class="link-icon-container mx-auto">
                                        <i class="las la-globe-americas"></i>
                                    </div>
                                    <select name="input[input-${count}][validation]" class="form-control border-0 rounded-0" data-trigger-name="choices-single-groups" id="choices-single-groups">
                                        <option value='nullable'>{{decode('Nullable')}}</option>
                                        <option value='required'>{{decode('Required')}}</option>
                                    </select>
                                </div>                              
                            </div>
                            <div class="col-md-1 mt-3">
                                <label></label>
                                <div>
                                    <button class="btn btn--danger--lite text--danger removeBtn" type="button">
                                        <i class="fas fa-trash text--danger" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;

                    $('.bill_add_field').append(html);
                } else{
                    toast.fire({
                        icon: 'error',
                        title: "please fillup all required field"
                    })
                }           
            })

            $(document).on('submit', '#ServiceStore', function(e){
                if(checkInputField('textValue') != false){
                    $(this).submit()
                } else{
                    toast.fire({
                        icon: 'error',
                        title: "please fillup all required field"
                    })
                    e.preventDefault();
                }
            })          

            // check input field is empty or not
            function checkInputField(selector){
                let classList = $(`.${selector}`)
                if(classList.length == 0){
                    return true;
                } else {
                    for(let i = 0; i <classList.length; i++){               
                        if($(classList[i]).val() ==''){
                            return false
                            break;
                        }
                    }
                }        
            }


            $(document).on('click', '.removeBtn', function(){
                $(this).closest('.removeRow').remove();
            })

        

        })(jQuery);
    </script>
@endpush
