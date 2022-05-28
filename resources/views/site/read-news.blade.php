@extends('layouts.site')
@section('content')
    <title></title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('site/read-news/img/core-img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('site/read-news/style.css') }}">
    <?php $locale = app()->getLocale(); ?>
    <a href="{{ url('read-news', $latest->id) }}">
        <div class="post-details-title-area bg-overlay clearfix img-fluid"
            style="background-image: url({{ asset('uploads/news-pictures') }}/{{ $latest->picture }});top: 100px;">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 col-lg-8">
                        <?php
                        $fmla = (new Carbon\Carbon(new DateTime($main->created_at)))->toDayDateTimeString();
                        if ($locale == 'am') {
                            $fmla = Andegna\DateTimeFactory::fromDateTime($latest->created_at)->format(\Andegna\Constants::DATE_ETHIOPIAN_PART);
                        } elseif (app()->getLocale() == 'or') {
                            $fmla = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($latest->created_at)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART));
                        }
                        ?>
                        <!-- Post Content -->
                        <div class="post-content">
                            <p class="tag"><span>@lang('home.our_latest_news')</span></p>
                            <p class="fw-bold"><?php echo $latest->{'heading_' . $locale}; ?></p>
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6"><span class="badge bg-primary">@lang('home.posted_by'):</span><span
                                        class="text-white">{{ $latest->author->name }}</span></div>
                                <div class="col-md-6 my-2"><span
                                        class="post-date col-md-6 fw-bold">{{ $fmla }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <section class="post-news-area section-padding-100-0 mb-70">
        <?php $author = App\Http\Controllers\Admin\Dashboard::findAuthor($main->author_id);
        $formatted = (new Carbon\Carbon(new DateTime($main->created_at)))->toDayDateTimeString();
        if (app()->getLocale() == 'am') {
            $formatted = Andegna\DateTimeFactory::fromDateTime($main->created_at)->format(\Andegna\Constants::DATE_ETHIOPIAN);
        } elseif ($locale == 'or') {
            $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($main->created_at)))->format(\Andegna\Constants::DATE_ETHIOPIAN));
        } ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="post-details-content mb-100">
                        <div class="row d-flex justify-content-md-between">
                            <div class="col-md-6 text-info">
                                <h5><?php echo $main->{'heading_' . $locale}; ?></h5>
                            </div>
                            <div class="col-md-4"><span
                                    class="badge bg-success">@lang('home.posted_by'):</span><strong>{{ $author->name }}</strong>
                            </div>
                        </div>
                        <p class="text-success fw-bold">{{ $formatted }}</p>
                        <img class="mb-30" src="{{ asset('uploads/news-pictures') }}/{{ $main->picture }}"
                            alt="">
                        <p class="fw-bold" style="white-space: pre-wrap;"><?php echo $main->{'body_' . $locale}; ?></p>
                        <p></p>
                        <h5 class="mb-30"></h5>
                        <p></p>
                    </div>
                    <!-- Comment Area Start -->
                </div>
                <div class="col-12 col-sm-9 col-md-6 col-lg-4">
                    <div class="sidebar-area">
                        <!-- Newsletter Widget -->
                        <div class="single-widget-area newsletter-widget mb-30">
                            <h4>@lang('home.subscribe_to')</h4>
                            <form action="#" method="post">
                                <input type="email" name="nl-email" id="nlemail" placeholder="@lang('home.email')">
                                <button type="submit" class="btn btn-success">@lang('home.subscribe')</button>
                            </form>
                            <p class="mt-30">@lang('home.if_u_sub')</p>
                        </div>
                        <!-- Latest News Widget -->
                        <div class="single-widget-area news-widget mb-30">
                            <h4>@lang('home.trending_news')</h4>
                            <!-- Single News Area -->
                            @foreach ($rest as $article)
                                <div class="single-blog-post d-flex style-4 mb-30">
                                    <!-- Blog Thumbnail -->
                                    <div class="blog-thumbnail">
                                        <a href="{{ url('read-news', $article->id) }}"><img
                                                src="{{ asset('uploads/news-pictures') }}/{{ $article->picture }}"
                                                alt=""></a>
                                    </div>
                                    <?php
                                    $formatted = (new Carbon\Carbon(new DateTime($article->created_at)))->toDayDateTimeString();
                                    if (app()->getLocale() == 'am') {
                                        $formatted = Andegna\DateTimeFactory::fromDateTime($article->created_at)->format(\Andegna\Constants::DATE_ETHIOPIAN_PART);
                                    } elseif ($locale == 'or') {
                                        $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($article->created_at)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART));
                                    }
                                    ?>
                                    <!-- Blog Content -->
                                    <div class="blog-content">
                                        <span class="post-date text-primary">{{ $formatted }}</span>
                                        <a href="{{ url('read-news', $article->id) }}"
                                            class="post-title"><?php echo $article->{'heading_' . $locale}; ?></a>
                                    </div>
                                </div>
                            @endforeach
                            {{ $rest->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')
<!-- ##### Post Details Area End ##### -->
