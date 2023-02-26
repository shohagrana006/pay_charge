
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
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Language')}}</span>
                </li>
            </ul>
        </div>
    </section>

    <div>
    <!-- table section start  -->
    <section class="all_tables">
        <div class="tables">
            <div class="each_table full_width">
                <div class="bg--light rounded shadow-sm">
                    <div>
                        <div class="table-header">
                            <h6 class="fw-bold">{{ decode('Total Language') }}({{ count($languages) }})</h6>
                        </div>
                        <div class="table-action-buttons">
                            <div class="px-3 pb-2">
                                <div>
                                @if(authUser()->can('language.create'))
                                    <button  class="btn--primary border-0 btn-sm">
                                        <a  data-bs-toggle="modal" id="create-language" class="text-decoration-none text-light">Create <i class="las la-plus"></i></a>
                                    </button>
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="table-wrapper">
                        <table>
                            <thead>
                            <tr>
                                <th scope="">{{ decode('Name') }}</th>
                                <th scope="">{{ decode('Code') }}</th>
                                <th scope="">{{ decode('Default') }}</th>
                                <th scope="">{{ decode('Status') }}</th>
                                <th scope="">{{ decode('CreatedBy') }}</th>
                                <th scope="">{{ decode('UpdatedBy') }}</th>
                                <th scope="">{{ decode('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--  language table start  --}}
                                @forelse($languages as $language)
                                    <tr>
                                        <td>
                                            <div class="Item_meta">
                                                <span>{{ $language->name }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $language->code }}</td>
                                        <td>
                                        <div class="form-check form-switch">
                                            <input default-lang-id = '{{ $language->id }}' id="default-status-update"  class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $language->is_default == 1 ? "checked":'' }} >
                                        </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input lang-id='{{ $language->id }}' id="status-update" class="form-check-input" value="Active" type="checkbox" id="flexSwitchCheckChecked" {{ $language->status == 'Active' ? "checked":'' }} >
                                            </div>
                                        </td>
                                        <td>
                                          {{$language->createdBy ? $language->createdBy->name : "N/A" }}
                                        </td>

                                        <td>
                                           {{$language->updatedBy ? $language->updatedBy->name : "N/A" }}
                                        </td>

                                        <td>
                                            @if(authUser()->can('language.destroy') || authUser()->can('language.edit') )
                                            <button type="button" class="bg-transparent border-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="las la-cog"></i><i class="las la-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu border-0">
                                                @if(authUser()->can('language.edit'))
                                                    @if($language->code !='us')
                                                    <li class="pointer"><a data-bs-toggle="modal"
                                                        data-bs-target="#edit-Lang-modal-{{ $language->id }}" class="border-0 p-2 text-dark">Edit</a></li>
                                                    @endif
                                                <li><a class="border-0 p-2 text-dark" href="{{ route('admin.language.translate',$language->code) }}">Translate</a></li>
                                                @endif
                                                @if(authUser()->can('language.destroy'))
                                                    @if($language->code !='us')
                                                        @if($language->is_default != 1)
                                                            @if (authUser()->can('language.destroy'))
                                                                <li
                                                                data-route='{{route('admin.language.destroy') }}' id="{{ $language->id }}" class="pointer sweet-delete"><a  class="border-0 p-2 text-dark" >Delete</a></li>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            </ul>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="50" class="text-center">
                                            <span class="text-danger">No data aviable</span>
                                        </td>
                                    </tr>
                                @endforelse
                            {{--  language table end  --}}
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>


                    {{--  language edit modal  --}}
                    @forelse($languages as $language)
                       @include('admin.pages.includes.language.updateModal')
                    @endforeach
                    {{--  status update  --}}
                    <form id="lang-status-update" hidden action="{{ route('admin.language.status.update') }}" method="post">
                        @csrf
                        <input hidden type="text" name="id" id="lang-id">
                    </form>

                    {{--  default status update  --}}
                    <form id="default-lang-status-update" hidden action="{{ route('admin.language.default.status.update') }}" method="post">
                        @csrf
                        <input hidden type="text" name="id" id="default-lang-id">
                    </form>


            </div>
        </div>
    </section>
    <!-- table section end  -->
    @if(authUser()->can('language.create'))
      @include('admin.pages.includes.language.createModal')
    @endif
</div>
@endsection
@push('backend-js-push')
<script>
	(function($){

       	"use strict";
        //language create modal start
        $(document).on('click','#create-language', function(e){
            const modal = $('#language-create-modal');
            modal.modal('show');
            e.preventDefault();
        });

        //language status update
        $(document).on('click','#status-update',function(e){
            const id = $(this).attr('lang-id')
            $('#lang-id').attr("value",id);
            $('#lang-status-update').submit();
        })

        //language default status update
        $(document).on('click','#default-status-update',function(e){
            const id = $(this).attr('default-lang-id')
            $('#default-lang-id').attr("value",id);
            $('#default-lang-status-update').submit();
        })


	})(jQuery);

</script>
@endpush






