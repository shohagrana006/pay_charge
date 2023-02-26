@extends('layouts.admin.admin_app')
@section('seo')
    custom-tab-active
@endsection
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
                    <a href="{{route('admin.seoSetting.index')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('frontend')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Seo')}}</span>
                </li>
            </ul>
        </div>
        @include('admin.pages.includes.frontend.frontend_tabs')
    </section>
    <div>
        <!-- table section start  -->
        <section class="mt-3 bg--light rounded shadow-sm">
            <div class="table-header d-flex align-items-center justify-content-between">

            </div>
                <div class="table-action-buttons">
                    <div class="px-3 pb-2">
                        <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">

                            <div class="d-sm-block d-lg-flex align-items-center mb-2">
                                <a href="{{ route('admin.seoSetting.index') }}" class="mb-sm-2 mb-lg-0 me-2 btn--primary border-0 pointer rounded btn-sm">All
                                    @if(Route::currentRouteName() == 'admin.seoSetting.index')
                                    ({{ countModelData('SeoSetting') }})
                                    @endif
                                </a>

                                @if(authUser()->can('seo.create'))
                                    <a class="btn--primary border-0 btn-sm" href="{{ route('admin.seoSetting.create') }}" class="text-decoration-none text-light">Create <i class="las la-plus"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3">
                    <table id='seo-table' class="table dt-responsive nowrap w-100" id="admins-table">
                        <thead>
                            <tr>
                                <th>{{ decode('Name') }}</th>
                                <th>{{ decode('Meta Title') }}</th>
                                <th>{{ decode('CreatedBy') }}</th>
                                <th>{{ decode('UpdatedBy') }}</th>
                                <th>{{ decode('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($seoSettings as $seoSetting)
                                <tr>
                                    <td>
                                        <div class="Item d-flex align-items-center">
                                            {{$seoSetting->name}}
                                        </div>
                                    </td>
                                    <td>
                                        {{$seoSetting->meta_title}}
                                    </td>
                                    <td>{{$seoSetting->created_by ? $seoSetting->createdBy->name :'N/A' }}</td>
                                    <td>{{$seoSetting->updated_by ? $seoSetting->updatedBy->name :'N/A' }}</td>
                                    <td>
                                        <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu border-0" style="">
                                            @if(authUser()->can('seo.edit'))
                                            <li><a class="border-0 p-2 text-dark" href="{{route('admin.seoSetting.edit', $seoSetting->id)}}">Update</a></li>
                                            @endif
                                            @if(authUser()->can('seo.destroy'))
                                                <li class="sweet-delete pointer" data-route='{{route('admin.seoSetting.destroy')}}' id="{{ $seoSetting->id }}"
                                                ><a class="border-0 p-2 text-dark" >Delete</a></li>
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </form>

        </section>
        <!-- table section end  -->
    </div>


@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //datatable initiation
            $('#seo-table').DataTable({
            });



        })(jQuery);
    </script>
@endpush
