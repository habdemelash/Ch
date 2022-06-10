<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@lang('home.cvsms') - @lang('home.site')-
        {{ Request::is('/') ? __('home.home_nav') : '' }}{{ Request::is('events') ? __('home.events_nav') : '' }}
        {{ Request::is('all-my-events') ? __('home.my_events_nav') : '' }}
        {{ Request::is('join-us') ? __('home.join_btn') : '' }}{{ Request::is('login') ? __('home.login') : '' }}
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php $address = Request::url(); ?>
    <!-- Favicons -->
    <link href="{{ asset('site/assets/img/3dheart.png') }}" rel="icon">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('site/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('site/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/other/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('site/assets/css/abyssinica-sil.css') }}" rel="stylesheet">



    <style>
        .more {
            display: none;
        }

        .service-item.open .more {
            display: inline;
        }

        .service-item.open .dots {
            display: none;
        }

        @media screen and (min-width: 768px) {
            .drmsg:hover .dr-menu {
                display: block;
                margin-top: 0; // remove the gap so it doesn't close
            }
        }

    </style>
    @if (app()->getLocale() == 'am')
        <style>
            header,
            main,
            section {
                font-family: 'Abyssinica SIL', sans-serif;
            }

        </style>
    @endif
    @livewireStyles
</head>

<body>
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <span class="logo "><a class="brand text-danger" href="/"><img
                        src="{{ asset('site/assets/img/3dheart.png') }}" class="mx-3">@lang('home.cvsms')</a>
            </span>
            <?php $address = Request::url();
            $myEventsList = App\Http\Controllers\Site\Home::myEventLister();
            $myevents = App\Http\Controllers\Site\Home::myevents();
            $locale = app()->getLocale(); ?>
            <nav id="navbar" class="navbar">
                <ul>
                    <li>
                        @yield('search')
                    </li>
                    <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : '' }}"
                            href="{{ route('site.home') }}">@lang('home.home_nav')<i class="bi-house-fill"></i></a></li>
                    <li><a class="nav-link scrollto {{ Request::is('events') ? 'active' : '' }}"
                            href="{{ route('site.events') }}">@lang('home.events_nav')</a></li>
                    <li><a class="nav-link scrollto {{ Request::is('lets-help') ? 'active' : '' }} "
                            href="{{ route('site.letshlep') }}">@lang('home.letshelp_nav')<i
                                class="bi-calendar-event-fill"></i></a></li>
                    <li class="dropdown">
                        <a class="nav nav-link  {{ Request::is('all-my-events') ? 'active' : '' }}"
                            href="{{ route('all.my.events') }}"><span>@lang('home.my_events_nav')
                                @if (Auth::check())
                                    <?php \App\Http\Controllers\Site\Home::localizer(); ?>
                                    <span class="badge bg-primary">{{ $myevents }}</span>
                                @endif
                            </span></a>
                        <ul>
                            <?php $arr = array_reverse($myEventsList); ?>
                            @for ($i = 0; $i < count($myEventsList) and $i < 3; $i++)
                                <?php $ev = App\Http\Controllers\Site\Home::fetchMyEvents($arr[$i]); ?>
                                <li class="dropdown">
                                    <a href="#" style="pointer-events: none">
                                        <div>
                                            <?php
                                            $formatted = (new Carbon\Carbon(new DateTime($ev->due_date)))->toFormattedDateString();
                                            
                                            if (app()->getLocale() == 'am') {
                                                $formatted = (new Andegna\DateTime(new DateTime($ev->due_date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART);
                                            } elseif (app()->getLocale() == 'or') {
                                                $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($ev->due_date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART));
                                            }
                                            
                                            ?>
                                            <span
                                                class="badge bg-primary">{{ $i + 1 }}</span><strong>{{ $ev->{'title_' . $locale} }}</strong><br>
                                            <small>@lang('home.date'): <span
                                                    class="text-primary">{{ ' ' . $formatted }}</span></small><br>
                                            <small>@lang('home.location'): <span class="text-primary"> @php echo ' ' . $ev->{'location_'.$locale}; @endphp
                                                </span></small>
                                        </div>
                                        <a id="leave-span" href="{{ url('leave-event', $ev->id) }}"><span
                                                class="badge"
                                                style="background: rgb(255, 0, 0);">@lang('home.leave_it')<i
                                                    class="bi-x-circle"></i></span></a>
                                        <hr class="text-success">
                                    </a>
                                </li>
                            @endfor
                            @if ($myevents > 3)
                                <a href="{{ route('all.my.events') }}" style="text-decoration: none;"
                                    class="text-primary">@lang('home.see_all')</a>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#"><span>@lang('home.more')<i class="bi-plus-circle-fill font-weight-bold"></i></span>
                            <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ route('site.helpmeform') }}">@lang('home.help_me_form_link')<i
                                        class="bx bxs-hand"></i></a></li>
                            <li><a class="nav-link scrollto" href="{{ route('site.staff') }}">@lang('home.our_staff')<i
                                        class="bi-people-fill"></i></a></li>

                            <li><a href="#about">@lang('home.about')<i class="bx bxs-info-square"></i></a></li>
                        </ul>
                    </li>
                    @auth
                        <li class="dropdown">
                            <a href="#"><span>{{ Auth::user()->name }}
                                    @if (Auth::user()->profile_photo_path == null)
                                        <img class="img-thumbnail rounded-circle" height="50" width="50"
                                            src="{{ asset('site/assets/img/user.png') }}">
                                    @else
                                        <img class="img-thumbnail rounded-circle" height="50" width="50"
                                            src="{{ asset('uploads/profile-photos') }}/{{ Auth::user()->profile_photo_path }}"
                                            alt="">
                                    @endif
                            </a>
                            <ul>
                                <li><a href="{{ route('profile') }}">@lang('home.profile')<i class="bx bxs-user"></i></a>
                                </li>
                                @can('staffs', Auth::user())
                                    <li><a href="{{ route('admin.dashboard') }}">@lang('home.administration')<i
                                                class="bi-gear-fill"></i></a></li>
                                @endcan
                                <li><a class="nav-link scrollto" href="{{ route('logout') }}">@lang('home.logout')<i
                                            class="bx bx-lock"></i></a></li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        @if (Request::is('login'))
                            <li><a class="getstarted scrollto fw-bold my-1" href="{{ route('joinus') }}"><i
                                        class="bx bxs-user-plus mx-1" style="font-size:20px;"></i>@lang('home.join_btn')</a>
                            </li>
                        @else
                            <li><a class="getstarted scrollto fw-bold my-1" href="{{ route('login') }}"><i
                                        class="bx bxs-lock-open mx-1" style="font-size:20px;"></i>@lang('home.login')</a>
                            </li>
                        @endif
                    @endguest

                    <li class="dropdown my-1">
                        <a href="#"
                            style="font-size: 13px"><span>{{ config('app.languages')[app()->getLocale()] }}</span> <i
                                class="bi bi-chevron-down"></i></a>
                        @if (count(config('app.languages')) > 1)
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @foreach (config('app.languages') as $langLocale => $langName)
                                    <li><a class="nav-link scrollto"
                                            href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ $langName }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>

                    @auth


                        @php
                            
                            $messages = App\Models\Message::select('id', 'created_at', 'content', 'sender', 'receiver')
                                ->where('receiver', Auth::user()->id)
                                ->orderBy('created_at', 'DESC')
                                ->distinct('sender')
                                ->paginate(6);
                            $me = Auth::user();
                        @endphp
                        <div class="dropdown drmsg" style="margin-left: 10px">
                            <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                data-toggle="dropdown" aria-expanded="false">
                                <i class="bx bxs-message mt-3" style="font-size: 25px; color:rgb(41, 41, 236)"><span
                                        class="badge bg-danger"
                                        style="font-size: 8px; margin-bottom:10px; margin-left:-5px">{{ $messages->count() }}</span></i></span>

                            </a>

                            <div class="dropdown-menu dr-menu" aria-labelledby="dropdownMenuLink">

                                @if ($messages->count() > 0)
                                    @foreach ($messages as $message)
                                        @php
                                            $sender = App\Models\User::find($message->sender)->name;
                                            if (Auth::user()->id == $message->sender) {
                                                $sender = __('home.cvsms');
                                            }
                                            
                                        @endphp
                                        <a href="{{ url('dash/mails/open', $message->sender) }}" class="dropdown-item">
                                            <div>

                                                {{ $sender }} <br></small>
                                                <small class="text-primary"
                                                    style="font-size: 10px">{{ mb_substr($message->content, 0, 10, 'UTF-8') }}...</small>

                                            </div>
                                        </a>
                                    @endforeach
                                    <hr>
                                    <a href="{{ route('user.mails') }}" class="text-primary"
                                        style="font-size: 12px;">@lang('home.see_all')</a>
                                @endif
                            </div>
                        </div>
                        </li>

                    @endauth

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->
    <main id="main">
        @yield('content')
    </main>
    <!-- End #main -->
    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row  justify-content-center">
                    <div class="col-lg-6">
                        <img class="img-fluid " width="50" height="50"
                            src="{{ asset('site/assets/img/3dheart_filled.png') }}">
                        <h3>@lang('home.cvsms')</h3>
                        <p>
                            @lang('home.volunteering_is') – <strong>@lang('home.french')</strong>
                        </p>
                    </div>
                </div>
                <div class="row footer-newsletter justify-content-center">
                    <div class="col-lg-6">
                        <form action="" method="post">
                            <input type="email" name="email" placeholder="@lang('home.email_place')"><input type="submit"
                                value="@lang('home.subscribe')">
                        </form>
                    </div>
                </div>
                <div class="social-links">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="container footer-bottom clearfix">
            <div class="copyright">
                &copy; @lang('home.copyright')<strong><span>@lang('home.kind_hearts')</span></strong>. @lang('home.all_rights_reserved')
            </div>
            <div class="credits">
                @lang('home.developed_by')<a href="">ASTU Systems</a>
            </div>
        </div>
    </footer>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <script src="{{ asset('site/assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('site/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('site/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('site/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });
        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/bootstrap.bundle.min.js') }}"></script>

    @livewireScripts
</body>

</html>
