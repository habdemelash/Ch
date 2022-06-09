@extends('layouts.site', ['myevents' => $myevents, 'myEventsList' => $myEventsList])
@section('content')

    <?php $locale = app()->getLocale(); ?>
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/other/toastr.min.css') }}">
    <section id="contact" class="contact mt-5" style="margin-top: 30px;">
        <div class="container">
            <div class="section-title">
                <span>@lang('home.help_me_form_link')</span>
                <h2>@lang('home.send_us')</h2>
                <p>@lang('home.we_may_find')</p>
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
                            <p>info@cvsms.com</p>
                        </div>
                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>@lang('home.call'):</h4>
                            <p>+251920763031</p>
                        </div>
                        <div class="container-fluid">@lang('home.fill_in')
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                    <form action="{{ route('site.helpme.send') }}" method="POST" class="php-email-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                            @if (!Auth::check())
                                <div class="form-group">
                                    <label for="name"><i class="bx bxs-user mx-1 text-danger"></i>@lang('home.full_name')</label>
                                    <input type="text" name="{{ 'name_' . $locale }}" class="form-control" id="name"
                                        required placeholder="@lang('home.full_name')*">
                                </div>
                                <div class="form-group col-md-6 mt-3 mt-md-0">
                                    <label for="name"><i
                                            class="bx bxs-envelope mx-1 text-danger"></i>@lang('home.email')</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="@lang('home.email')*">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone"><i
                                            class="bx bxs-phone mx-1 text-danger"></i>@lang('home.phone')</label>
                                    <input type="tel" class="form-control" name="phone" id="phone" required
                                        placeholder="@lang('home.phone')*">
                                </div>
                            @endif
                        </div>
                        @auth
                            <span class="text-success">@lang('home.how_are_you')</span> <strong class="text-info">
                                {{ Auth::user()->name }}?</strong> <span>@lang('home.we_have_taken')</span>
                        @endauth
                        <hr>
                        <div class="form-group mt-3">
                            <label for="name"><i class="bx bx-question-mark mx-1 text-danger"></i>@lang('home.your_problem')</label>
                            <p><small class="text-primary">@lang('home.problem_exp')</small></p>
                            <input type="text" class="form-control" name="{{ 'problem_title_' . $locale }}" id="subject"
                                required placeholder="@lang('home.your_problem')*">
                        </div>
                        @if (!Auth::check())
                            <div class="form-group mt-3">
                                <label for="address"><i class="bx bxs-map mx-1 text-danger"></i>@lang('home.location')</label>
                                <p><small class="text-primary">@lang('home.address_exp')</small></p>
                                <input type="text" class="form-control" name="{{ 'address_' . $locale }}" id="address"
                                    required placeholder="@lang('home.location')*">
                            </div>
                        @endif

                        <a class="btn btn-success col-2" type="button">@lang('home.add')</a>
                        <div class="form-group mt-3 realprocode increment">
                            <label for="document"><i class="bx bxs-file-pdf mx-1 text-danger"></i><i
                                    class="bx bxs-image mx-1 text-danger"></i>@lang('home.your_legal_docs')</label>
                            <p><small class="text-primary">@lang('home.document_exp')</small></p>
                            
                            <input type="file" class="form-control-lg inner" onchange="fetch()" class="  form-control-lg"
                                name="document[]" id="document" placeholder="@lang('home.your_legal_docs')*">
                            <span class="namer"> </span>
                        </div>
                        <div class="form-group mt-3 clone hide" style="display: none;">
                            <div class="realprocode">

                                <div><input type="file" class="form-control-lg" name="document[]" id="document"
                                        placeholder="@lang('home.your_legal_docs')*">
                                    <a class="btn btn-danger" type="button">@lang('home.remove')</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name"><i class="bx bx-list-plus mx-1 text-danger"></i>@lang('home.help_me_details')</label>
                            <p><small class="text-primary">@lang('home.help_me_details_exp')</small></p>
                            <textarea class="form-control" name="{{ 'problem_details_' . $locale }}" rows="6" required
                                placeholder="@lang('home.help_me_details')*"></textarea>
                        </div>
                        <div class="text-center"><button type="submit">@lang('home.send')</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function() {
                var lsthtml = $(".clone").html();
                $(".increment").after(lsthtml);
            });
            $("body").on("click", ".btn-danger", function() {
                $(this).parents(".realprocode").remove();
            });
        });
    </script>
    @if (Session::has('message'))
        <script type="text/javascript">
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif
@endsection
