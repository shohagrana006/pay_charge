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
                    <a href="{{route('admin.country.index')}}">
                        <i class="las la-dot-circle"></i>
                        <span>{{decode('Country')}}</span>
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
            <h5 class="m-0" id="">{{decode('Update Country')}}</h5>
        </div>
        <div class="section-container mb-3">
            <div class="content-wrapper">

        <!-- form section start  -->
            <form action="{{route('admin.country.update')}}" method="post" enctype="multipart/form-data">
                @csrf            
                <input type="hidden" name="id" value="{{$country->id}}">   
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <label for="validationCustom01" class="form-label">{{decode('Country name')}}<span class="text-danger">*</span> </label>
                        <div class="input-container position-relative ps-5">
                            <div class="link-icon-container mx-auto">
                                <i class="las la-globe-americas"></i>  
                            </div>
                            <input  type="text" name="name" value="{{$country->name}}" class="form-control  border-0 rounded-0" id="validationCustom01" required="">
                        </div>
                        <div class="ms-3 text-danger"></div>
                    </div>                   
                    <div class="col-md-12 mt-3">
                        <label for="file" class="form-label">{{decode('Country Logo')}} <span class="text-danger"> ({{implode(", ", fileFormat())}}) & size [{{ App\Cp\ImageProcessor::filePath()['country']['size'] }}]</span></label>
                        <div class="input-container position-relative ps-5">
                            <div class="link-icon-container mx-auto">
                                <i class="las la-globe-americas"></i>
                            </div>
                            <input type="file" name="logo" class="form-control  border-0 rounded-0" id="admin_photo">
                        </div>
                        <div class="ms-3 text-danger"></div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-group">      
                            <button type="submit" class="btn btn-primary">{{decode('Update')}}</button>
                        </div>
                    </div>            
                </div>             
            </form> 
         </div>
        </div>
        <!-- form section end  -->
    </section>
@endsection
