@extends('layouts.user.user_app')
@section('user_main_content')
    <section class="pb-3">
        <div class="rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('user.dashboard')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('Dashboard')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Package Details')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <div>
        <section class="bg--light rounded shadow-sm p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="search_manu">
                        <ul class="d-flex">
                            <p class="btn">{{decode('Search By')}} -- </p>
                            <li><a href="{{route('user.package.index')}}" class="btn btn-success me-2">{{decode('All')}}</a></li>
                            <li><a href="javascript:void(0)" class="btn btn-info me-2 country">{{decode('Country')}}</a></li>
                            <li><a href="javascript:void(0)" class="btn btn-primary me-2 category">{{decode('Category')}}</a></li>                          
                        </ul>
                    </div>
                </div>
                {{-- country and category --}}
                <div class="col-md-12">
                    <div class="search_sub_menu">
                        <div class="d-none country_result">
                            <ul class="d-flex">
                                @forelse ($countries as $country)
                                    <li><a href="javascript:void(0)" data-id="{{$country->id}}" class="btn btn-info me-2 country_id">{{$country->name}}</a></li>
                                @empty
                                    <li><span class="text-danger">{{decode('Country Not avilable')}}</span></li>
                                @endforelse                          
                            </ul>
                        </div>
                        <div class="d-none category_result">
                            <ul class="d-flex">
                                @forelse ($categories as $category)
                                    <li><a href="javascript:void(0)" data-id="{{$category->id}}" class="btn btn-primary me-2 category_id">{{$category->name}}</a></li>
                                @empty
                                    <li><span class="text-danger">{{decode('Category Not avilable')}}</span></li>
                                @endforelse                          
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <!-- service by country & category -->
                    <div>
                        <ul class="d-flex service_name">
                                                    
                        </ul>
                    </div>
                </div>


            </div>
        </section>

        <section class="bg--light rounded shadow-sm p-4">        
                <div class="row">
                    @forelse ($packageLists as $packageList)
                        <div class="col-md-3">
                            <div class="package">
                                <div class="card">                             
                                    <img src="{{ displayImage('assets/images/general/package/'.$packageList->packageService->package->logo, App\Cp\ImageProcessor::filePath()['package']['size']) }}" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ ucfirst($packageList->packageService ? $packageList->packageService->package->name :'N/A') }}
                                        </h5>
                                        <p class="card-text">{{$packageList->details}}</p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <p>
                                                {{decode('Minute')}} <span class="badge bg-primary">{{ $packageList->minute ?? 'N/A'}}</span>
                                            </p>
                                            <p>
                                                {{decode('MB')}} <span class="badge bg-primary">{{ $packageList->mb ?? 'N/A'}}</span>
                                            </p>
                                            <p>
                                                {{decode('SMS')}} <span class="badge bg-primary">{{ $packageList->sms ?? 'N/A'}}</span>
                                            </p>                                          
                                        </li>                                       
                                    </ul>
                                    <div class="card-body">
                                        <p class="card-text">{{decode('Duration')}}: {{$packageList->duration.decode(' days')}} </p>
                                        <p class="card-text">{{decode('Price')}}: <del>{{$packageList->price}} </del></p>
                                        <p class="card-text">{{decode('Price now')}}:  {{($packageList->price) - ($packageList->discount_price)}}</p>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{route('user.purchase.detail', $packageList->id)}}" class="card-link btn btn-success">{{decode('Buy now')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            
                    @empty
                        <div class="text-center">
                            <span class="text-danger text-center">{{decode('Packages Not avilable')}}</span>
                        </div>
                    @endforelse                 
                </div>
        </section>
        
    </div>
    @php
        $langCode =  App::getLocale();
    @endphp
@endsection
@push('backend-js-push')
    <script>
        $(document).on('click', '.country', function(){
           $('.country_result').removeClass('d-none');
           $('.category_result').addClass('d-none');
        })

        $(document).on('click', '.category', function(){
            $('.category_result').removeClass('d-none');
            $('.country_result').addClass('d-none');
        })

        $(document).on('click', '.country_id', function(){
            let id  = $(this).data('id');
            let url = "{{route('user.package.service','country')}}";
            ajaxCallRequest(id, url)
           
        })

        $(document).on('click', '.category_id', function(){
            let id  = $(this).data('id');
            let url = "{{route('user.package.service', 'category')}}";
            ajaxCallRequest(id, url)          
        })

        function ajaxCallRequest(id,url){
             $.ajax({
                url: url,
                type: "post",
                dataType: 'json',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}",
                },
                success: function(res){
                      outputRes(res)
                }
            });
        }

        function outputRes(res)
        {
            let langCode = "{{$langCode}}"
            let data = '';
         
            for( let i in res.data){
                let url = "{{ route('user.package.service.list',":id") }}";
                url = url.replace(':id', res.data[i].id);
                data += `<li class="bg-light"><a href="${url}" class="btn btn-dark me-1">${res.data[i].name[langCode]}</a></li>`
            }

            if(res.data.length==0){
                data = `<li class="w-50 bg-light p-3"><span class="text-danger ">{{decode('Service Not avilable')}}</span></li>`
            }

            $('.service_name').html(' ')
            $('.service_name').html(data)
        }
        
    </script>
     @if(session()->has('success'))
        <script>
            toast.fire({
                icon: 'success',
                title: "{{session()->get('success')}}"
            })
        </script>
    @endif
     @if(session()->has('error'))
        <script>
            toast.fire({
                icon: 'error',
                title: "{{session()->get('error')}}"
            })
        </script>
    @endif
@endpush
