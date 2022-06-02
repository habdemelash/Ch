@extends('layouts.site')
@section('content')
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    <section id="contact" class="contact mt-5">
        <div class="container">

            <div class="section-title">
                <span>@lang('home.login')</span>
                <h2>@lang('home.login_here')</h2>
                <p>@lang('home.you_are_welcome')</p>
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
                    <form action="{{ route('login') }}" method="POST" role="form" class="php-email-form">
                        @csrf





                        <hr>
                        <span class="text-primary">@lang('home.credential_info')</span>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <x-jet-validation-errors class="mb-4" />
                            </div>
                        @endif

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email"><i class="bx bxs-envelope text-danger"></i>@lang('home.email_or_phone')</label>
                                <input type="email" name="email" class="form-control" id="email" required
                                    :value="old('email')">
                            </div>
                            <div class="form-group col-md-6 mt-3 mt-md-0">
                                <label for="password"><i class="bx bxs-lock text-danger"></i> @lang('home.password')</label>
                                <input type="password" class="form-control" name="password" id="password-confirmation"
                                    required :value="old('password')">
                            </div>
                        </div>


                        <div class="text-center"><button type="submit"><i
                                    class="bx bx-lock-open text-white mx-1"></i>@lang('home.login')</button> <a
                                href="{{ route('password.request') }}"
                                class="text-primary fw-bold mx-1">@lang('home.forgot_password')</a></div>
                        <div><span class="text-info">@lang('home.if_you_havent_joined')</span><strong><a
                                    href="{{ route('joinus') }}">@lang('home.here')</a> </strong> <span
                                class="text-info"> @lang('home.please')</span> </div>
                    </form>
                </div>

            </div>

        </div>
    </section>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>

    @if (Session::has('message'))
        <script>
            toastr.success("{!! Session::get('message') !!}");
        </script>
    @endif
@endsection
