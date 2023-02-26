@extends('layouts.user.user_app')
@section('user_main_content')
    <section class="pb-3">
        <div class="rounded">
            <ul class="d-flex align-items-center justify-content-start">
                <li class="d-flex align-items-center me-3">
                    <a href="{{route('user.support.ticket.index')}}" >
                        <i class="las la-cube"></i>
                        <span>{{decode('Support Ticket')}}</span>
                    </a>
                </li>
                <li class="d-flex align-items-center me-3">
                    <i class="las la-dot-circle"></i>
                    <span>{{decode('New Ticket')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <div>
        <!-- table section start  -->
        <section class="bg--light rounded shadow-sm">   
            <div class="container-fluid p-0 mb-3 pb-2">
                <div class="row d-flex align--center rounded justify-content-center ">             
                    <div class="col-lg-10 mt-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{route('user.support.ticket.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-12">
                                        <div class="row my-3">
                                            <div class="col-lg-6 mb-3">
                                                <input type="text" name="subject" class="form-control" placeholder="{{ decode('Enter Subject')}}" required>
                                            </div>
                                            <div class="col-lg-6 mb-3">
                                                <select class="form-control" name="priority" required>
                                                    <option value="">{{ decode('Select Priority')}}</option>
                                                    <option value="1">{{ decode('Low')}}</option>
                                                    <option value="2">{{ decode('Medium') }}</option>
                                                    <option value="3">{{ decode('High') }}</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-12 mb-3">
                                                <textarea class="form-control" rows="5" name="message" placeholder="{{ decode('Enter Message')}}" required></textarea>
                                            </div>
                                            <div class="col-lg-8 mb-3">
                                                <input type="file" name="file[]" class="form-control">
                                                <div class="addnewdata">
                                                </div>
                                                <div class="form-text">{{ decode('Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx') }}</div>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <button type="button" class="btn btn--primary text--light addnewfile">{{ decode('Add More')}}</button>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <button type="submit" class="btn btn--primary text--light w-100" >{{ decode('Submit')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
	        </div>
        </section>
        <!-- table section end  -->
    </div>


@endsection
@push('backend-js-push')
   <script>
        $('.addnewfile').on('click', function () {
            var html = `
            <div class="row newdata my-2">
                <div class="mb-3 col-lg-10">
                    <input type="file" name="file[]" class="form-control" required>
                </div>

                <div class="col-lg-2 col-md-12 mt-md-0 mt-2 text-right">
                    <span class="input-group-btn">
                        <button class="btn btn-danger btn-sm removeBtn w-100" type="button">
                            <i class="fa fa-times"></i>
                        </button>
                    </span>
                </div>
            </div>`;
            $('.addnewdata').append(html);
            $(".removeBtn").on('click', function(){
                $(this).closest('.newdata').remove();
            });
        });
    </script>

    @if(session()->has('error'))
        <script>
            toast.fire({
                icon: 'error',
                title: "{{session()->get('error')}}"
            })
        </script>
    @endif
@endpush