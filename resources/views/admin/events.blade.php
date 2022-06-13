@extends('layouts.admin')
@section('content')
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/ec.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    <li class="d-flex flex-column flex-md-row">
        <span id="option-container" style="visibility: hidden; position:absolute;"></span>
        <div class="container-fluid">
            <form action="{{ url('dash/events/search') }}" method="GET" class="d-flex">
                @csrf
                <input class="form-control" id="searchEvent" type="text" name="keyword"
                    placeholder="{{ __('home.search_place') }}" aria-label="Search">
                <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
            </form>

        </div>
    </li>

    @include('admin.styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/other/toastr.min.css') }}">
    <h1 class="h3 mb-3"><strong>{{ __('home.events_nav') }}</strong> {{ __('home.administration') }}</h1>
    <div class="row d-flex mt-3 justify-content-center">
        <div class="container">
            <div class="row align-items-start justify-content-center">
                <a href="{{ route('admin.event.addform') }}" class="btn btn-success col-2">
                    {{ __('home.add_new') }}
                </a>
            </div>
        </div>
    </div>
    <div class="" style="overflow-x: auto;">
        <table class="table table-hover my-0 table-responsive" id="eventsTable" style="border: none">
            <thead>
                <tr>
                    <th>{{ __('home.title') }}</th>
                    <th class=" d-xl-table-cell text-center"> {{ __('home.date') }}</th>
                    <th class=" d-xl-table-cell text-center"> {{ __('home.location') }}</th>
                    <th class=" d-xl-table-cell"> {{ __('home.start_time') }}</th>
                    <th class=" d-xl-table-cell">{{ __('home.end_time') }}</th>
                    <th class=" d-xl-table-cell"> {{ __('home.short_desc') }}</th>
                    <th>{{ __('home.status') }}</th>
                    <th class=" d-md-table-cell">{{ __('home.needed_vols') }}</th>
                    <th class=" d-md-table-cell">{{ __('home.joined_by') }}</th>
                    <th>{{ __('home.picture') }}</th>
                    <th>{{ __('home.actions') }}</th>
                </tr>
            </thead>
            <tbody id="eventsTBody">
                @forelse($events as $event)
                    <tr id="eid{{ $event->id }}">
                        <?php $members = App\Http\Controllers\Site\Home::howManyJoined($event->id); 
                        $locale = app()->getLocale();?>
                        <td class="text-success fw-bold" style="font-style: initial;">
                            <?php echo $event->{'title_' . app()->getLocale()}; ?></td>
                        <td class="text-primary" style="white-space: nowrap">
                            {{ App\Http\Controllers\TimeFormatter::eventDateLocal($event->due_date) }}</td>
                        <td>
                            @php echo $event->{'location_'.app()->getLocale()}; @endphp
                        </td>
                        <td class=" d-xl-table-cell text-primary">
                            {{ App\Http\Controllers\TimeFormatter::timeLocal($event->start_time) }}</td>
                        <td class="text-primary">{{ App\Http\Controllers\TimeFormatter::timeLocal($event->end_time) }}
                        </td>
                        <td class=" d-md-table-cell text-dark">{{ $event->{'short_desc_'.$locale} }}</td>
                        <td >
                            @if ($event->status == 'Upcoming')
                                <span class="badge bg-primary">{{ __('home.upcoming') }}</span>
                            @elseif($event->status == 'Cancelled')
                                <span class="badge bg-danger">{{ __('home.cancelled') }}</span>
                            @else
                                <span class="badge bg-dark">{{ __('home.past') }}</span>
                            @endif
                        </td>
                        <td>{{ $event->needed_vols }}</td>
                        <td>
                            @if ($members >= $event->needed_vols)
                                <span class="badge bg-danger">{{ __('home.full') }}</span><br>
                            @endif
                            @if ($members < 1)
                                <span class="text-danger">{{ __('home.no_one_yet') }}</span>
                            @elseif($members == 1)
                                <a href="{{ url('dash/event/viewmembers', $event->id) }}"
                                    style="white-space: nowrap; font-weight: 700">
                                    {{ $members }} {{ __('home.vol') }} </a>
                            @else
                                <a href="{{ url('dash/event/viewmembers', $event->id) }}"
                                    style="white-space: nowrap; font-weight: 700">
                                    {{ $members }} {{ __('home.vols') }} </a>
                            @endif
                        </td>
                        <td><img src="{{ asset('uploads/event-pictures') }}/{{ $event->picture }}"
                                class="rounded-circle rounded me-1" alt="{{ __('home.no_pic') }}"
                                style="height: 60px;width: 60px;" /></td>
                        <td class="d-flex flex-row">
                            <a href="{{ url('dash/event/updateform', $event->id) }}" class="mx-2 my-4"><i
                                    class="bi-pen-fill" style="font-size: 20pt"></i></a>
                            <button value="{{ $event->id }}" class="btn mx-2 deleteEvent" data-bs-toggle="modal"
                                data-bs-target="#deleteEventModal"><i class="bi-trash-fill text-danger"
                                    style="font-size: 20pt"></i>
                            </button>
                        </td>
                    </tr>
                    <tr><td></td></tr>
                @empty
                    <tr>
                        <h4 class="text-center">@lang('home.no_events_yet')</h4>
                    </tr>
                @endforelse
            </tbody>
            <tbody id="content"></tbody>
        </table>
    </div>
    <div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url('/events/delete') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="ModalLabel">{{ __('home.delete_event') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="event_id" id="event_id">
                        <p class="fw-bold">{{ __('home.do_u_delete_event') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('home.no') }}</button>
                        <button type="submit" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ __('home.yes_delete') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 mt-3 mb-lg-5">
            <strong>{{ $events->links('pagination::bootstrap-4') }}</strong>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteEvent', function(e) {
                e.preventDefault();
                var event_id = $(this).val();
                $('#event_id').val(event_id);
                $('#deleteEventModal').modal('show');
                // Ethiopian calendar instance
            });
        });
    </script>


    @if (Session::has('message'))
        <script>
            toastr.success("{!! Session::get('message') !!}");
        </script>
        
    @endif
    
@endsection
