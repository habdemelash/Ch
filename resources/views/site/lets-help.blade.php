@extends('layouts.site', ['myevents' => $myevents])
@section('search')
    <div class="container-fluid">
        <form class="d-flex">
            <input class="form-control" type="search" placeholder="@lang('home.search_place')" aria-label="Search">
            <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
        </form>
    </div>
@endsection
@section('content')
    <?php $locale = app()->getLocale(); ?>
    <div class="container">
        <section id="hero" class="d-flex align-items-center">
            <style>
                @media (max-width: 768px) {

                    .single-definition,
                    .wrapper {
                        text-align: center;
                    }

                    .separator {
                        display: block;
                    }
                }

                @media (min-width: 768px) {
                    .separator {
                        display: none;
                    }
                }

                .wrapper {
                    border-bottom: solid;
                    border-color: #4EC5EF;
                    border-width: 1px;
                }

            </style>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1>@lang('home.we_strive')</h1>
                        <h2>
                            @lang('home.volunteering_is') – <strong>@lang('home.french')</strong>
                        </h2>
                        <div class="d-flex">
                            @guest
                                <a href="/join-us" class="btn-get-started scrollto">@lang('home.join_btn')</a>
                            @endguest
                            @auth
                                <a href="{{ route('logout') }}" class="btn-get-started bg-danger "><i
                                        class="bx bxs-log-out"></i> @lang('home.logout')</a>
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
        <section id="about" class="about" style="">
            <div class="section-top-border">
                <h3 class="mb-30 title_color">@lang('home.hands_waiting')</h3>
                <hr>
                <div class="row">
                    @foreach ($helpme as $help)
                        <div class="col-md-6 col-lg-4 wrapper my-2">
                            <a href="{{ url('lets-help/view', $help->id) }}">
                                <div class="single-definition">
                                    <strong class="text-info"><i
                                            class="bx bxs-user-circle bx-md"></i><?php echo $help->{'name_' . $locale}; ?></strong><br>
                                    <?php $on = new Carbon\Carbon(new DateTime($help->created_at));
                                    $formatted = $on->toDayDateTimeString();
                                    if (app()->getLocale() == 'am') {
                                        $formatted = Andegna\DateTimeFactory::fromDateTime($help->created_at)
                                            ->modify('-2 hours')
                                            ->format(\Andegna\Constants::DATE_ETHIOPIAN);
                                    } elseif (app()->getLocale() == 'or') {
                                        $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($help->created_at)))->modify('-2 hours')->format(\Andegna\Constants::DATE_ETHIOPIAN));
                                    } ?>
                                    <span class="badge bg-info">@lang('home.sent_at')</span><span class="text-secondary">:
                                        {{ $formatted }}</span><br>
                                    <strong class="badge bg-danger">{{ $help->problem_title }}</strong><br>
                                    <p><?php echo mb_substr($help->{'problem_details_' . $locale}, 0, 100, 'UTF-8'); ?> ...</p>
                                    <a class="text-primary"
                                        href="{{ url('lets-help/view', $help->id) }}">@lang('home.see_full_info')</a>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                {{ $helpme->links('pagination::bootstrap-4') }}
            </div>
        </section>
    </div>
@endsection
