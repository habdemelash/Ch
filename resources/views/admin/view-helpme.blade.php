@extends('layouts.admin')
@section('content')
    @include('admin.styles')
    <style>
        .act {
            text-decoration: none;
            white-space: nowrap;
        }

        .act:hover {
            text-decoration: none;
        }

        @media screen and (max-width: 768px) {
            .bxs-edit {
                margin-top: 8px;
            }
        }

        .single-definition {
            border: solid;
            padding: 10px;
            border-radius: 10px;
            border-color: green;
            border-width: 0.5px;
        }

    </style>
    <div class="row d-flex justify-content-center">
        <?php $locale = app()->getLocale(); ?>
        <div class="col-md-6">
            <strong class="mx-2"><a href="{{ route('admin.helpmes') }}"><i class="bx bx-arrow-back"></i>
                    @lang('home.back')</a> @lang('home.to_the_list')</strong>
            <h1 class="h3 mb-3"><strong>@lang('home.app_sent_from')<span
                        class="text-info">{{ $helpme->phone }}</span></strong></h1>
        </div>
        <div class="col-md-6 text-center"><span class="badge bg-info">@lang('home.status'):</span><span
                class="fw-bold">@lang('home.' . strtolower($helpme->status))</span>
            @if ($helpme->status == 'Pending')
                <a href="{{ url('dash/helpmes/accept', $helpme->id) }}" class="btn-success btn-sm mx-1 act"><i
                        class="bx bxs-check-circle"></i> @lang('home.accept')</a>
                <a href="{{ url('dash/helpmes/reject', $helpme->id) }}" class="btn-sm btn-danger mx-1 act"><i
                        class="bx bxs-shield-x"></i> @lang('home.reject')</a>
            @elseif($helpme->status == 'Accepted')
                <a href="{{ url('dash/helpmes/reject', $helpme->id) }}" class="btn-sm btn-danger mx-1 act"><i
                        class="bx bxs-shield-x"></i> @lang('home.re_reject')</a>
            @elseif($helpme->status == 'Rejected')
                <a href="{{ url('dash/helpmes/accept', $helpme->id) }}" class="btn-success btn-sm mx-1 act"><i
                        class="bx bxs-check-circle"></i> @lang('home.re_accept')</a>
            @endif
            <a href="{{ url('dash/helpmes/remove', $helpme->id) }}" class="btn-sm btn-danger mx-1 act"><i
                    class="bx bxs-trash"></i> @lang('home.remove')</a>
        </div>
    </div>
    <?php $on = new Carbon\Carbon(new DateTime($helpme->created_at));
    $formatted = $on->toDayDateTimeString();
    if (app()->getLocale() == 'am') {
        $formatted = Andegna\DateTimeFactory::fromDateTime($helpme->created_at)->format(\Andegna\Constants::DATE_ETHIOPIAN);
    } elseif ($locale == 'or') {
        $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($helpme->created_at)))->format(\Andegna\Constants::DATE_ETHIOPIAN));
    } ?>
    <div class="container">
        <div class="section-top-border">
            <h3 class="mb-30 title_color">@lang('home.applicant_info')</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="single-definition">
                        <h4 class="mb-20">@lang('home.applicant_name')</h4>
                        <p><?php echo $helpme->{'name_' . $locale}; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-definition">
                        <h4 class="mb-20">@lang('home.address_town')</h4>
                        <p><?php echo $helpme->{'address_' . $locale}; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-definition">
                        <h4 class="mb-20">@lang('home.problem_subject')</h4>
                        <p><?php echo $helpme->{'problem_title_' . $locale}; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-definition">
                        <h4 class="mb-20">@lang('home.email')</h4>
                        <p>{{ $helpme->email }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="single-definition">
                        <h4 class="mb-20">@lang('home.sent_at')</h4>
                        <p>{{ $formatted }}</p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="text-success">
        <div class="section-top-border single-definition">
            <h3 class="mb-30 title_color">@lang('home.problem_details_and')</h3>
            <div class="row">
                <div class="col-lg-12 ">
                    <blockquote class="generic-blockquote">
                        <?php echo $helpme->{'problem_details_' . $locale}; ?>
                    </blockquote>
                </div>
            </div>
        </div>
        <div class="section-top-border single-definition text-center">
            <h3 class="mb-30 title_color text-center">@lang('home.supplied_docs')</h3>
            <div class="row d-flex justify-content-center">
                @foreach ($docs as $doc)
                    <div class="col-md-4">
                        <a href="{{ asset('uploads/helpme-pictures') }}/{{ $doc->document }}" class="img-gal">
                            <div><img src="{{ asset('uploads/helpme-pictures') }}/{{ $doc->document }}" alt=""
                                    class="img-fluid"></div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-2">
                <a href="{{ url('dash/helpmes/improve', $helpme->id) }}" class="btn-sm btn-primary fw-bold"
                    style="margin-top: 10px"><i class="bx bxs-edit"></i> @lang('home.improve')</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    @include('admin.scripts')
    @if (Session::has('message'))
        <script>
            toastr.success("{{ Session::get('message') }}");
        </script>
    @endif
@endsection
