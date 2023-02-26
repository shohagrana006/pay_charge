@extends('layouts.admin.admin_app')
@section('admin_main_content')
    <div class="rounded_box">
        <div class="container-fluid p-0">
            <div class="row d-flex align--center rounded">
                <div class="col-7 col-md-6 col-lg-6 col-xl-6 text-start">
                    <h3 class="pageTitle">{{ decode('Social media link') }}</h3>
                </div>
            </div>
        </div>
    </div>
    <section class="mt-2 bg--light rounded shadow-sm">
        <div>
          <div class="table-header d-flex align-items-center justify-content-between">
            <h6 class="fw-bold">{{decode('Total Social Media')}} ({{ (count(json_decode($generalSetting->social_media,true))) }})</h6>
          </div>
          <div class="p-3 table-wrapper">
            <table id="social-media" class="table  dt-responsive nowrap w-100">
              <thead>
                <tr>
                  <th>{{decode('No')}}</th>
                  <th>{{decode('Name')}}</th>
                  <th>{{decode('Link')}}</th>
                  <th>{{decode('Status')}}</th>
                  <th>{{decode('Action')}}</th>
                </tr>
              </thead>
              <tbody>
                @foreach (json_decode($generalSetting->social_media) as $key => $socialMedia)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {!! json_decode($socialMedia,true)['icon'] !!}
                        {{$key}}
                    </td>
                    <td>{{ json_decode($socialMedia)->link }} </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input socialActiveDeactive" value="{{$key}}" type="checkbox" id="flexSwitchCheckChecked" {{json_decode($socialMedia)->status == "Active" ? "checked" : ' '}}>
                        </div>
                    </td>
                    <td>
                        <div>
                            <button data-bs-toggle="modal"
                            data-bs-target="#social-media-{{ $key }}" class="btn">
                                <i class="fas fa-edit text--primary" aria-hidden="true"></i>
                            </button>
                        </div>
                    </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </section>

    @foreach (json_decode($generalSetting->social_media) as $key => $value)
       @include('admin.pages.includes.socialMedia.socialMediaModal')
    @endforeach


    {{-- social media table status form --}}
    <div>
        <form class="d-none linkStatusForm" action="{{route('admin.settings.socialMedia.status')}}" method="post">
            @csrf
            <input type="hidden" name="name" id="linkStatusInput" value="">
        </form>
    </div>

@endsection

@push('backend-js-push')
    <script>

        (function($) {
            "use strict";

            //datatable initiation
            $('#social-media').DataTable({
            });

            //social media table status active deactive
            $(document).on('click', '.socialActiveDeactive', function(){
                const value = $(this).val();
                $('#linkStatusInput').attr('value', value);
                $('.linkStatusForm').submit();
            })

        })(jQuery);
    </script>
@endpush
