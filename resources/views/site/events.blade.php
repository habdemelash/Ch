@extends('layouts.site', ['myevents' => $myevents, 'myEventsList' => $myEventsList])
@section('search')
    <div class="container-fluid">
        <form class="d-flex" method="GET" action="{{ route('site.home.searchevents') }}">
            @csrf
            <input class="form-control" type="search" placeholder="@lang('home.search_place')" aria-label="Search" name="key">
            <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
        </form>
    </div>
@endsection
@section('content')
    <style>
        #yours-tag {
            position: absolute;
            top: -95px;
            left: 40px;
            transform: rotate(-45deg);
            animation: left-right 2s ease-in-out infinite alternate-reverse both;
        }

        #days-left {
            position: absolute;
            top: -115px;
            right: 50px;
        }

        .imager {
            height: 300px;
        }

    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/other/toastr.min.css') }}">
    <section class="services section-bg mt-5">
        <div class="container">
            <div class="section-title" style="margin-top: 100px;">
                <span>@lang('home.events_nav')</span>
                <h2>@lang('home.events_nav')</h2>
                <p>@lang('home.events_intro')</p>
            </div>
            <div class="row d-flex justify-content-center">
                @if (Session::has('result'))
                    <strong class="text-dark text-center">
                        @lang('home.your_search'): "{{ Session::get('result') }}"
                    </strong>
                @endif
                @php $locale = app()->getLocale(); @endphp
                @forelse($events as $event)
                    <div class="col-lg-4 col-md-6 d-flex mt-2"
                        style="margin-right: 10px; margin-left: 10px; border-width: 5px; text-align:center">
                        <div class="icon-box row d-flex justify-content-center">
                            <h4><?php echo $event->{'title_' . $locale}; ?></h4>
                            <div class="icon" style="position: relative;">

                                <span id="days-left"
                                    class="badge bg-success">{{ App\Http\Controllers\Site\Home::calculateDays($event->id) }}</span>
                                @if (in_array($event->id, $myEventsList))
                                    <span id="yours-tag" class="badge bg-danger my-3">@lang('home.your_event')</span>
                                @endif
                                <a href="{{ url('events/view', $event->id) }}">
                                    <div class="imager"><img class="img-fluid"
                                            src="{{ asset('uploads/event-pictures') }}/{{ $event->picture }}" style="">
                                    </div>
                                    </i>
                                </a>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <p class="text-primary"><?php echo $event->{'short_desc_' . $locale}; ?></p>
                                <p class="text-dark">{{ mb_substr($event->{'details_' . $locale}, 0, 50, 'UTF-8') }}
                                    ...
                                </p>
                            </div>
                            <?php $members = App\Http\Controllers\Site\Home::howManyJoined($event->id); ?>
                            <hr style="">
                            <div class="container-fluid">
                                <p class="text-success">@lang('home.we_need')<strong
                                        class="text-danger"><?php echo ' ' . $event->needed_vols; ?></strong> @lang('home.volunteers')</p>
                                <p class="text-success"> <strong class="text-primary fw-bold"><?php echo $members; ?></strong>
                                    @lang('home.volunteers_joined')
                                    @if ($members >= $event->needed_vols)
                                        <span class="badge bg-danger">@lang('home.full')</span>
                                    @endif
                                </p>
                                <strong>@lang('home.status'):
                                    @if ($event->status == 'Upcoming')
                                        <span class="badge bg-info">@lang('home.upcoming')</span>
                                    @elseif($event->status == 'Past')
                                        <span class="badge bg-dark">@lang('home.past')</span>
                                    @else
                                        <span class="badge bg-danger">@lang('home.cancelled')</span>
                                    @endif
                                </strong>
                                <div class="row d-flex flex-column justify-content-start">
                                    <div class="col"><strong class="text-success" style="white-space: nowrap">
                                            <i class="bx bxs-calendar-event text-success"></i><span
                                                class="text text-primary">@lang('home.date')</span>:
                                            {{ App\Http\Controllers\TimeFormatter::eventDateLocal($event->due_date) }}
                                        </strong><small class="text-danger fw-bold"></small>
                                    </div>
                                    <?php ?>
                                    <div class="col"><strong><i class="bx bx-time text-danger"
                                                style="font-family: sans-serif;">:</i><span
                                                class="text text-primary">@lang('home.time')
                                            </span>{{ App\Http\Controllers\TimeFormatter::timeLocal($event->start_time) }}
                                            -
                                            {{ App\Http\Controllers\TimeFormatter::timeLocal($event->end_time) }}</strong><br>
                                    </div>
                                    <div class="col"><strong><i
                                                class="bx bx-current-location text-danger"></i><span
                                                class="text text-primary">@lang('home.location')
                                            </span><?php echo ' ' . $event->{'location_' . $locale}; ?></strong> </div>
                                </div>
                            </div>
                            @if (!in_array($event->id, $myEventsList))
                                <div class="mt-3">
                                    @if ($event->status == 'Upcoming' and $members < $event->needed_vols)
                                        <a href="{{ url('join-event', $event->id) }}" class="fancy fw-bold"
                                            style="margin-top: 15px;"><i class="bi-person-plus mx-1"
                                                style="font-size:20px;"></i> @lang('home.join_this')</a>
                                    @else
                                        <a class="fancy fw-bold fw-bold" href=""
                                            style="margin-top: 15px;pointer-events: none; background-color: #BD0A02;">@lang('home.you_cant_join')</a>
                                        <br>
                                    @endif
                                </div>
                            @else
                                <div class="mt-3">
                                    <a class="leave-btn fw-bold" href="{{ url('leave-event', $event->id) }}"
                                        style="margin-top: 15px;"><i class="bi-x-lg mx-1"
                                            style="font-size:20px;"></i>@lang('home.leave_this')</a>
                                    <br>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <h1 class="text-center">@lang('home.no_events_yet')</h1>
                @endforelse
                <div class="text-center col-md-4">
                    {{ $events->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    @if (Session::has('message'))
        <script type="text/javascript">
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif
@endsection
