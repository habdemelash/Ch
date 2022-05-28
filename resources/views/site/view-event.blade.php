@extends('layouts.site', ['myevents' => $myevents, 'myEventsList' => $myEventsList])
<div class="container" style="margin-top: 130px;">
    @section('content')
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/other/toastr.min.css') }}">
        {{-- Formatting and vars --}}
        <?php
        $locale = app()->getLocale();
        $members = App\Http\Controllers\Site\Home::howManyJoined($event->id);
        $formatted = (new Carbon\Carbon(new DateTime($event->due_date)))->toFormattedDateString();
        $start = (new Carbon\Carbon(new DateTime($event->start_time)))->format('g:i A');
        $end = (new Carbon\Carbon(new DateTime($event->end_time)))->format('g:i A');
        if (app()->getLocale() == 'am') {
            $formatted = (new Andegna\DateTime(new DateTime($event->due_date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART);
            $start = Andegna\DateTimeFactory::fromDateTime(new DateTime($event->start_time))->format('g:i A');
            $end = Andegna\DateTimeFactory::fromDateTime(new DateTime($event->end_time))->format('g:i A');
        } elseif (app()->getLocale() == 'or') {
            $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($event->due_date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART));
            $start = App\Http\Controllers\Admin\Dashboard::oromicTime(Andegna\DateTimeFactory::fromDateTime(new DateTime($event->start_time))->format('g:i A'));
            $end = App\Http\Controllers\Admin\Dashboard::oromicTime(Andegna\DateTimeFactory::fromDateTime(new DateTime($event->end_time))->format('g:i A'));
        }
        
        ?>
        {{--  --}}
        <div class="d-flex align-items-center">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        style="text-align: center;">
                        <h3>{{ $event->title }}</h3>
                        <h2>{{ $event->short_desc }}</h2>
                        <p class="text-dark text-muted"><?php echo $event->{'details_' . $locale}; ?></p>
                        <p class="text-success">@lang('home.we_need') <strong
                                class="text-danger"><?php echo $event->needed_vols; ?></strong> @lang('home.volunteers')</p>
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
                        <div class="justify-content-center" style="text-align: center;">
                            <div><?php $c = new Carbon\Carbon(new DateTime($event->due_date));
                            $c2 = $c->toFormattedDateString();
                            ?>
                                <strong class="text-primary">@lang('home.date'): <span
                                        class="text-info">{{ $formatted }}</span></strong>
                            </div>
                            <div><strong class="text-primary">@lang('home.location'): <span
                                        class="text-info"><?php echo $event->{'location_' . $locale}; ?></span></strong></div>
                            <div><strong class="text-primary">@lang('home.start_time'): <span
                                        class="text-info">{{ $start }}</span></strong></div>
                            <div><strong class="text-primary">@lang('home.end_time'): <span
                                        class="text-info">{{ $end }}</span></strong></div>
                            @if (!in_array($event->id, $myEventsList))
                                <div class="mt-3">
                                    @if ($event->status == 'Upcoming' and $members < $event->needed_vols)
                                        <a href="{{ url('join-event', $event->id) }}" class="fancy fw-bold"
                                            style="margin-top: 15px;"><i class="bi-person-plus mx-1"
                                                style="font-size:20px;"></i> @lang('home.join_this')</a>
                                    @else
                                        <a class="fancy fw-bold fw-bold" href=""
                                            style="margin-top: 15px;pointer-events: none; background-color: red;">@lang('home.you_cant_join')</a>
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
                    <div class="col-lg-6 order-1 order-lg-2 hero-img">
                        <img src="{{ asset('uploads/event-pictures') }}/{{ $event->picture }}"
                            class="img-fluid rounded animated" alt="">
                        @if (in_array($event->id, $myEventsList))
                            <span id="yours-tag" class="col-3 badge bg-danger my-3">@lang('home.your_event')</span>
                        @endif
                    </div>
                </div>
                <hr class="text-success" style="height: 2px;">
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    @if (Session::has('message'))
        <script type="text/javascript">
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif
@endsection
