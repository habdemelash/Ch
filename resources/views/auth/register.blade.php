@extends('layouts.site')

@section('content')
    <section id="contact" class="contact mt-5">
        <div class="container">

            <div class="section-title">
                <span>@lang('home.registration')</span>
                <h2>@lang('home.join_us_here')</h2>
                <p>@lang('home.you_may_work')</p>
            </div>

            <div class="row">

                <div class="col-lg-5 d-flex align-items-stretch">
                    <div class="info">
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>@lang('home.location'):</h4>
                            <p>@lang('home.adama')</p>
                        </div>

                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>@lang('home.email'):</h4>
                            <a href="mailto:info@cvsms.com">info@cvsms.com</a>
                        </div>

                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>@lang('home.call'):</h4>
                            <a href="tel:+251920763031">+251920763031</a>
                        </div>




                    </div>

                </div>

                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">

                    <form action="{{ route('register') }}" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="row">
                            <span class="text-primary"> @lang('home.personal_info')</span>
                            <div class="alert-danger rounded">
                                <x-jet-validation-errors class="mb-4" />
                            </div>
                            <div class="form-group col">
                                <label for="name"><i class="bx bxs-user text-danger"></i>@lang('home.full_name')</label>
                                <input type="text" name="name" class="form-control" id="first-name" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email"><i class="bx bxs-envelope text-danger"></i>@lang('home.email')</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="phone"><i class="bx bxs-phone text-danger"></i>@lang('home.phone')</label>
                                <input type="tel" class="form-control" name="phone" id="phone" required>
                            </div>
                        </div>


                        <div class="form-group mt-2">
                            <label for="address"><i class="bx bxs-map text-danger"></i>@lang('home.address_town')</label>
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>

                        <hr>
                        <span class="text-primary">@lang('home.credential_info')</span>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password"><i class="bx bxs-lock text-danger"></i>@lang('home.new_password')</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="password-confirmation"><i
                                        class="bx bxs-lock text-danger"></i>@lang('home.confirm_password')</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="password-confirmation" required>
                            </div>
                        </div>


                        <div class="row mx-1"><button class="col-sm-6"
                                type="submit">@lang('home.join_us_now')</button><a class="col-sm-6 mt-1"
                                href="/login">@lang('home.already_joined')</a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </section>
@endsection
