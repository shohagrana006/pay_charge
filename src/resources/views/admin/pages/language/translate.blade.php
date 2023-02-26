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
                <a href="{{route('admin.language.index')}}">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('Language')}}</span>
                </a>
            </li>
            <li class="d-flex align-items-center me-3">
                <i class="las la-dot-circle"></i>
                <span>{{decode('Translate')}}</span>
            </li>
        </ul>
    </div>
  </section>
  <section class="bg--light rounded shadow-sm">
    <div>
      <div class="table-header">
        <h6 class="fw-bold">{{ decode(' test Translate Languages') }}</h6>
      </div>
      <div class="table-wrapper p-3">
        <table  class="p-3 table  dt-responsive nowrap w-100" id="translate-dataTable">
          <thead>
            <tr>
              <th class="p-2">SL NO</th>
              <th class="p-2 table-width">KEY</th>
              <th class="p-2 table-width2">VALUE</th>
              <th class="p-2 text-center">ACTION</th>
            </tr>
          </thead>
          <tbody id="language-translate">
              @include('admin.pages.includes.language.tableData')
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
@endsection
@push('backend-js-push')
<script>
	(function($){
       	"use strict";

        //data table initilization
        $('#translate-dataTable').DataTable({
            responsive: true,
            processing: true,
        });
        //update key value via ajax
        $(document).on('click','#update-lang-key',function(e){
          e.preventDefault()
          const code = $(this).attr('key')
          const id = $(this).attr('unique-id')
          const keyValue = $(`#lang-key-value-${id}`).val()
          const key= $(`#lang-key-${id}`).val()
          updateLangKeyValue(code,key,keyValue)
        })


        //update language value function
        function updateLangKeyValue(code,key,keyValue){
          const data = {
            "code":code,
            "key":key,
            "keyValue":keyValue,
          }
          $.ajax({
            method:'post',
            url: "{{ route('admin.language.tranlateKey') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
              data
            },
            dataType: 'json'
          }).then(response => {
                if(response.success){
                    toast.fire({
                        icon: 'success',
                        title: "{{decode('Successfully Translated')}}"
                    })
                }
                else{
                    toast.fire({
                        icon: 'error',
                        title: "{{decode('Translation Failed')}}"
                    })
                }
          })
        }

	})(jQuery);

</script>
@endpush





