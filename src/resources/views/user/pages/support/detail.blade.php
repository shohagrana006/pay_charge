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
                    <span>{{decode('Ticket Number')}}-<span class="badge bg-primary">{{$ticket->ticket_number}}</span></span>
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
                        <div class="card">
                            <div class="card-header bg--lite--violet">
                                <div class="row">
                                    <div class="col-lg-10 col-sm-10 col-md-6 mt-3">
                                        <span class="card-title text-dark">{{ decode('Reply to admin') }}</span>
                                    </div>
                                    @if($ticket->status != 4)
                                        <div class="text-end col-lg-2 col-sm-10 col-md-6 mt-2">
                                            <button class="btn btn--danger text--light" data-bs-toggle="modal" data-bs-target="#close">{{ decode('Close Ticket') }}</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                @if($ticket->status != 4)
                                    <form action="{{route('user.support.ticket.reply', $ticket->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row my-3">
                                            <div class="col-lg-12 mb-3">
                                                <textarea class="form-control" rows="5" name="message" placeholder="{{ decode('Enter Message')}}" required></textarea>
                                            </div>
                                            <div class="col-lg-8 mb-3">
                                                <input type="file" name="file[]" class="form-control">
                                                <div class="addnewdata"></div>
                                                <div class="form-text">{{ decode('Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx')}}</div>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <button type="button" class="btn btn--primary text--light addnewfile">{{ decode('Add More')}}</button>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <button type="submit" class="btn btn--primary text--light w-100" >{{ decode('Reply')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                                @foreach($ticket->messages as $meg)
                                    @if($meg->admin_id == null)
                                        <div class="row shadow-lg p-2 mb-3 bg-light rounded">
                                            <div class="col-lg-3 text-end">
                                                <p>{{ decode('Create ticket')}} {{($meg->created_at)->format("d-m-Y h:i:s")}}</p>
                                                <h5>{{$ticket->name}}</h5>
                                            </div>

                                            <div class="col-lg-9">
                                                <p>{{$meg->message }}</p>
                                                @if($meg->supportfiles()->count() > 0)
                                                    <div class="my-3">
                                                        @foreach($meg->supportfiles as $key=> $file)
                                                            <a href="{{route('user.support.ticket.file.download',encrypt($file->id))}}" class="mr-3 text-dark"><i class="fa fa-file"></i>{{ decode('File')}} {{++$key}}</a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="row shadow-lg p-2 mb-3 bg-dark rounded">
                                            <div class="col-lg-3 text-end">
                                                <p class="text--light">{{ decode('Admin Reply')}} {{ ($meg->created_at)->format("d-m-Y h:i:s") }}</p>
                                                <h6 class="text--light">{{ decode('Admin')}}</h6>
                                            </div>

                                            <div class="col-lg-9">
                                                <p class="text--light">{{__($meg->message)}}</p>
                                                @if($meg->supportfiles()->count() > 0)
                                                    <div class="my-3">
                                                        @foreach($meg->supportfiles as $key=> $file)
                                                            <a href="{{route('user.support.ticket.file.download',encrypt($file->id))}}" class="mr-3 text--light"><i class="fa fa-file"></i>  {{ decode('File')}} {{++$key}} </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
	        </div>
        </section>
        <!-- table section end  -->
    </div>

    @if($ticket->status != 4)
        <div class="modal fade" id="close" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{route('user.support.ticket.closed', $ticket->id)}}" method="POST">
                        @csrf
                        <div class="modal_body2">
                            <div class="modal_icon2">
                                <i class="las la-trash-alt"></i>
                            </div>
                            <div class="modal_text2 mt-3">
                                <h6>{{ decode('Are you sure to want close this ticket?')}}</h6>
                            </div>
                        </div>
                        <div class="modal_button2">
                            <button type="button" class="" data-bs-dismiss="modal">{{ decode('Cancel')}}</button>
                            <button type="submit" class="bg--danger">{{ decode('Closed')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif


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
                icon: 'success',
                title: "{{session()->get('error')}}"
            })
        </script>
    @endif

    @if(session()->has('success'))
        <script>
            toast.fire({
                icon: 'success',
                title: "{{session()->get('success')}}"
            })
        </script>
    @endif
@endpush