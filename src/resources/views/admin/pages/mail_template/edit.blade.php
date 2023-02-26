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
                    <a href="{{route('admin.mail.template.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Mail Template')}}</span>
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
            <form action="{{route('admin.mail.template.update')}}" method="POST" enctype="multipart/form-data" class="needs-validation label_margin_top" novalidate="">
                @csrf
                <input type="hidden" value="{{ $mailTemplate->id }}" name="id" id="">

                 <div class="col-lg-12">
                    <div class="section-container rounded">                      
                        <div class="content-wrapper pb-4">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <h5> {{ decode('Email Tempalte Short Code')}}</h5>
                                    <div class="work_list_body ms-4 mt-3">
                                        @forelse(json_decode($mailTemplate->codes, true) as $key => $value)
                                            <div class="d--flex align--center justify--between single_work_item complete_item">
                                                <div>
                                                    <h6>{{$value}}</h6>
                                                </div>
                                                <p>@php echo "{{". $key ."}}"  @endphp</p>
                                            </div>
                                        @empty

                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-12">
                    <div class="section-container rounded">                      
                        <div class="content-wrapper pb-4">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label for="validationCustom01" class="form-label">
                                        {{decode('Subject')}}<span class="text-danger">*</span>
                                    </label>
                                    <div class="input-container position-relative ps-5">
                                        <div class="link-icon-container mx-auto">
                                            <i class="las la-globe-americas"></i>  
                                        </div>
                                        <input placeholder="Enter subject" type="text" name="subject" value="{{ $mailTemplate->subject }}" class="form-control  border-0 rounded-0" id="validationCustom01">
                                    </div>
                                    <div class=" text-danger">
                                        @error('subject') {{ $message }} @enderror
                                    </div>
                                    <div class="ms-3 text-danger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
                <div class="col-lg-12">
                    <div class="section-container rounded">                      
                        <div class="content-wrapper pb-4">
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label for="validationCustom01" class="form-label">
                                        {{decode('Description')}}<span class="text-danger">*</span>
                                    </label>
                                    <div class="input-container position-relative">
                                       
                                        <textarea id="div_editor1" placeholder="Enter description" name="body" class="form-control  border-0 rounded-0" >{!! $mailTemplate->body !!}</textarea>
                                    </div>
                                    <div class=" text-danger">
                                        @error('body') {{ $message }} @enderror
                                    </div>
                                    <div class="ms-3 text-danger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>           
              
                <div class="col-12 col-md-12 my-3">
                    <button class="d-block btn btn--primary" type="submit">{{ decode('Update') }}</button>
                </div>

            </form>
        </div>
        <!-- form section end  -->
    </section>
@endsection

@push('backend-style-push')
   <link rel="stylesheet" href="{{asset('assets/backend-assets/css/rte_theme_default.css')}}">
@endpush
@push('backend-js-push')
   <script src="{{asset('assets/backend-assets/js/rte.js')}}"></script>
   <script>
        var editor1 = new RichTextEditor("#div_editor1");
   </script>
@endpush 
