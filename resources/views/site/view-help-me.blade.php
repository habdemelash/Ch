@extends('layouts.site')
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
            <style>
                .act {
                    text-decoration: none;
                }

                .act:hover {
                    text-decoration: none;
                }

                .single-definition {
                    padding: 10px;
                    border-style: solid;
                    border-radius: 10px;
                    border-color: green;
                    border-width: 0.5px;
                    margin-top: 10px;
                }

                .main {
                    ;
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
                                <a href="/register" class="btn-get-started scrollto">@lang('home.join_us_now')</a>
                            @endguest
                            @auth
                                <a href="{{ route('logout') }}" class="btn-get-started bg-danger "><i
                                        class="bx bxs-log-out"></i>
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
        <section id="about" class="about" style="">
            <div class="section-top-border">
                <?php $on = new Carbon\Carbon(new DateTime($helpme->created_at));
                $formatted = $on->toDayDateTimeString();
                if (app()->getLocale() == 'am') {
                    $formatted = Andegna\DateTimeFactory::fromDateTime($helpme->created_at)
                        ->modify('-2 hours')
                        ->format(\Andegna\Constants::DATE_ETHIOPIAN);
                } elseif ($locale == 'or') {
                    $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($helpme->created_at)))->modify('-2 hours')->format(\Andegna\Constants::DATE_ETHIOPIAN));
                } ?>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 main">
                        <div class="container">
                            <div class="section-top-border">
                                <h3 class="mb-30 title_color"><strong class="text-info"><i
                                            class="bx bxs-user-circle bx-md"></i><?php echo $helpme->{'name_' . $locale}; ?>
                                    </strong>@lang('home.really_needs_your_help')</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="single-definition">
                                            <h4 class="mb-20 text-success">@lang('home.applicant_name')</h4>
                                            <p><?php echo $helpme->{'name_' . $locale}; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-definition">
                                            <h4 class="mb-20 text-success">@lang('home.address_town')</h4>
                                            <p><?php echo $helpme->{'address_' . $locale}; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="single-definition">
                                            <h4 class="mb-20 text-success">@lang('home.problem_subject')</h4>
                                            <p><?php echo $helpme->{'problem_title_' . $locale}; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-definition ">
                                            <h4 class="mb-20 text-success">@lang('home.phone')</h4>
                                            <p>{{ $helpme->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-definition">
                                            <h4 class="mb-20  text-success">@lang('home.email')</h4>
                                            <p>{{ $helpme->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-3">
                                        <div class="single-definition">
                                            <h4 class="mb-20 text-success">@lang('home.sent_at')</h4>
                                            <p class="">{{ $formatted }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="text-success">
                            <div class="section-top-border single-definition">
                                <h3 class="mb-30 title_color">@lang('home.problem_details_and')</h3>
                                <div class="row">
                                    <div class="col-lg-12 ">
                                        <blockquote class="generic-blockquote" style="white-space: pre-wrap;">
                                            <?php echo $helpme->{'problem_details_' . $locale}; ?>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="section-top-border single-definition">
                                <h3 class="mb-30 title_color text-center">@lang('home.supplied_docs')</h3>
                                <div class="row d-flex justify-content-center">
                                    @foreach ($docs as $doc)
                                        <div class="col-md-4">
                                            <a href="{{ asset('uploads/helpme-pictures') }}/{{ $doc->document }}"
                                                class="img-gal">
                                                <div><img
                                                        src="{{ asset('uploads/helpme-pictures') }}/{{ $doc->document }}"
                                                        alt="" class="img-fluid"></div>
                                            </a>
                                        </div>
                                    @endforeach
                                    {{ $docs->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 text-center mt-sm-4 mt-md-2 others">
                        <div><strong class="text-danger">@lang('home.you_may_also_help')</strong></div>
                        @foreach ($others as $other)
                            <div class="col my-2">
                                <a href="{{ url('lets-help/view', $other->id) }}">
                                    <div class="single">
                                        <strong class="text-info"><i
                                                class="bx bxs-user-circle"></i><?php echo $other->{'name_' . $locale}; ?></strong><br>
                                        <?php $on = new Carbon\Carbon(new DateTime($other->created_at));
                                        $formatted = $on->toDayDateTimeString(); ?>
                                        <span class="text-secondary">@lang('home.sent_at'): {{ $formatted }}</span><br>
                                        <strong class="badge bg-danger">{{ $other->problem_title }}</strong><br>
                                        <p><?php echo mb_substr($other->{'problem_details_' . $locale}, 0, 100, 'UTF-8'); ?> ...</p>
                                        <a href="{{ url('lets-help/view', $other->id) }}">@lang('home.see_full_info')</a>
                                    </div>
                                </a>
                            </div>
                            <hr>
                        @endforeach
                        {{ $others->links('pagination::bootstrap-4') }}
                    </div>
                </div>
        </section>
    </div>
@endsection
