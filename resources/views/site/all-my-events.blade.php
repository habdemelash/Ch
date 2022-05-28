@extends('layouts.site')
@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>@lang('home.we_strive')</h1>
                    <h2>
                        @lang('home.volunteering_is') – <strong>@lang('home.french')</strong>
                    </h2>
                    <div class="d-flex">
                        @guest
                            <a href="/join-us" class="btn-get-started scrollto">@lang('home.join_us_now')</a>
                        @endguest
                        @auth
                            <a href="{{ route('logout') }}" class="btn-get-started bg-danger "><i class="bx bxs-log-out"></i>
                                @lang('home.logout')</a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="{{ asset('site/assets/img/digital_22.jpg') }}" class="img-fluid animated" alt=""
                        style="border-radius:30px;">
                </div>
            </div>
        </div>

    </section>
    <div class="row">
        <h1 class="text-center">@lang('home.your_events')</h1>
    </div>
    <section class="d-flex flex-column align-items-center">
        <?php $locale = app()->getLocale(); ?>
        @for ($i = 0; $i < count($myEventsList); $i++)
            <?php $ev = App\Http\Controllers\Site\Home::fetchMyEvents($myEventsList[$i]); ?>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        style="text-align: center;">
                        <h3>{{ $ev->title }}<span class="badge"
                                style="background-color: blue;">{{ $i + 1 }}</span></h3>
                        <h2>{{ $ev->short_desc }}</h2>
                        <?php $formatted = (new Carbon\Carbon(new DateTime($ev->due_date)))->toFormattedDateString();
                        $start = (new Carbon\Carbon(new DateTime($ev->start_time)))->format('g:i A');
                        $end = (new Carbon\Carbon(new DateTime($ev->end_time)))->format('g:i A');
                        if (app()->getLocale() == 'am') {
                            $gregorian = new DateTime($ev->due_date);
                            $formatted = Andegna\DateTimeFactory::fromDateTime($gregorian)->format(\Andegna\Constants::DATE_ETHIOPIAN_PART);
                            $start = Andegna\DateTimeFactory::fromDateTime(new DateTime($ev->start_time))->format('g:i A');
                            $end = Andegna\DateTimeFactory::fromDateTime(new DateTime($ev->end_time))->format('g:i A');
                        } elseif (app()->getLocale() == 'or') {
                            $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($ev->due_date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART));
                            $start = App\Http\Controllers\Admin\Dashboard::oromicTime(Andegna\DateTimeFactory::fromDateTime(new DateTime($ev->start_time))->format('g:i A'));
                            $end = App\Http\Controllers\Admin\Dashboard::oromicTime(Andegna\DateTimeFactory::fromDateTime(new DateTime($ev->end_time))->format('g:i A'));
                        }
                        ?>
                        <p class="text-success"><?php echo mb_substr($ev->{'details_' . $locale}, 0, 50, 'UTF-8'); ?></p>
                        <div class="justify-content-center" style="text-align: center;">
                            <div><strong class="text-primary">@lang('home.date'):<span
                                        class="text-info">{{ $formatted }}</span><small class="text-muted">
                                    </small></strong></div>
                            <div><strong class="text-primary">@lang('home.location'):<span
                                        class="text-info"><?php echo $ev->{'location_' . $locale}; ?></span></strong></div>
                            <div><strong class="text-primary">@lang('home.start_time'):<span
                                        class="text-info">{{ $start }}</span></strong></div>
                            <div><strong class="text-primary">@lang('home.end_time'):<span
                                        class="text-info">{{ $end }}</span></strong></div>
                            <a href="{{ url('leave-event', $ev->id) }}" class="btn btn-danger btn-sm"><i
                                    class="bi-x-circle"></i>@lang('home.leave_it')</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img">
                        <a href="{{ url('events/view', $ev->id) }}"> <img
                                src="{{ asset('uploads/event-pictures') }}/{{ $ev->picture }}"
                                class="img-fluid rounded animated" alt=""></a>
                    </div>
                </div>
                <hr class="text-success" style="height: 2px;">
            </div>
        @endfor
    </section>
@endsection
