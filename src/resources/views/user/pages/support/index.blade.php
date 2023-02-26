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
                    <span>{{decode('Support Ticket')}}</span>
                </li>
            </ul>
        </div>
    </section>
    <div>
        <!-- table section start  -->
        <section class="bg--light rounded shadow-sm">
            <div class="table-action-buttons">
                <div class="px-3 pt-2">
                    <div class=" d-sm-block d-lg-flex align-items-center justify-content-between">
                        <div class="d-sm-block d-lg-flex align-items-center mb-2">
                            <a class="btn--primary border-0 btn-sm" href="{{ route('user.support.ticket.create') }}" class="text-decoration-none text-light">{{decode('New Ticket')}} <i class="las la-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <table id='package-table' class="table dt-responsive nowrap w-100" id="admins-table">
                    <thead>
                        <tr>
                            <th>{{ decode('Time') }}</th>
                            <th>{{ decode('Ticket Number') }}</th>
                            <th>{{ decode('Subject') }}</th>
                            <th>{{ decode('Priority') }}</th>
                            <th>{{ decode('Status') }}</th>
                            <th>{{ decode('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($tickets as $ticket)
                        <tr>
                            <td>
                                {{$ticket->created_at->diffForHumans()}}
                                <br>
                                {{$ticket->created_at->format('d-m-Y h:i:s') }}
                            </td>
                            <td>{{$ticket->ticket_number }}</td>
                            <td>{{$ticket->subject }}</td>
                            <td>
                                @if($ticket->priority == 1)
                                    <span class="badge bg-info">{{ decode('Low')}}</span>
                                @elseif($ticket->priority == 2)
                                    <span class="badge bg--primary">{{ decode('Medium ')}}</span>
                                @elseif($ticket->priority == 3)
                                    <span class="badge bg--success">{{ decode('High')}}</span>
                                @endif
                            </td>
                            <td>
                                @if($ticket->status == 1)
                                    <span class="badge bg--info">{{ decode('Running')}}</span>
                                @elseif($ticket->status == 2)
                                    <span class="badge bg--primary">{{ decode('Answered')}}</span>
                                @elseif($ticket->status == 3)
                                    <span class="badge bg--warning">{{ decode('Replied')}}</span>
                                @elseif($ticket->status == 4)
                                    <span class="badge bg--danger">{{ decode('Closed')}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('user.support.ticket.detail', $ticket->id)}}" class="btn-primary text-light p-1"><i class="las la-desktop"></i></a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>                       

        </section>
        <!-- table section end  -->
    </div>


@endsection
@push('backend-js-push')
    <script>
        (function($) {
            "use strict";
            //datatable initiation
            $('#package-table').DataTable({
            });

        })(jQuery);
    </script>
    @if(session()->has('success'))
        <script>
            toast.fire({
                icon: 'success',
                title: "{{session()->get('success')}}"
            })
        </script>
    @endif
@endpush
