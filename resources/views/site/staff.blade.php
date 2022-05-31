@extends('layouts.site', ['myevents' => $myevents, 'myEventsList' => $myEventsList])
@section('search')
    <div class="container-fluid">
        <form class="d-flex">
            <input class="form-control" type="search" placeholder="@lang('home.search_place')" aria-label="Search">
            <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
        </form>
    </div>
@endsection
@section('content')
    <section id="team" class="team section-bg">
        <div class="container">
            <div class="section-title" style="margin-top: 140px;">
                <span>@lang('home.staff')</span>
                <h2>{{ __('Our Kind Hearted Staff') }}</h2>
                <p>{{ __('Know about our good-hearted staff behind all this humanitarian effort...') }}</p>
            </div>
            <div class="row d-flex justify-content-center">
                @foreach ($staff as $member)
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch container-fluid">
                        <div class="member container-fluid">
                            @if ($member->profile_photo_path == null)
                                <img class="rounded-circle" src="{{ asset('site/assets/img/user.jpg') }}" alt=""
                                    height="200" width="200">
                            @else
                                <img class="rounded-circle"
                                    src="{{ asset('uploads/profile-photos') }}/{{ $member->profile_photo_path }}" alt=""
                                    height="200" width="200">
                            @endif
                            <h4>{{ $member->name }}</h4>
                            <div style="text-align: center; align-self: center;">
                                <p class="text-primary">
                                    <i class="bx bxs-envelope"></i> {{ $member->email }}
                                </p>
                                <p class="text-dark">
                                    <i class="bx bxs-phone"></i> {{ $member->phone }}
                                </p class="text-dark">
                                <p class="text-dark">
                                    <i class="bx bxs-map"></i>{{ $member->address }}
                                </p>
                            </div>
                            <div class="social">
                                <a href="{{ url('dash/mails/open', $member->id) }}"><i
                                        class="bx bxs-message text-primary"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
