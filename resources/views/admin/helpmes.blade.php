@extends('layouts.admin')
@section('search')
    <li class="d-flex flex-column flex-md-row">
        <div class="container-fluid">
            <form class="d-flex">
                <input class="form-control" type="search" placeholder="@lang('home.search_place')" aria-label="Search">
                <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
            </form>
        </div>
    </li>
@endsection
<?php $locale = app()->getLocale(); ?>
@section('content')
    <h1 class="h3 mb-3"><strong>@lang('home.help_me_app')</strong> @lang('home.administration')</h1>
    <div class="row d-flex mt-3 justify-content-center">
        <div class="container">
            <div class="row align-items-start justify-content-center">
            </div>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            <i class="bx bx-check bx-md">{{ session()->get('message') }}</i>
        </div>
    @endif
    <div class="" style="overflow-x: auto;">
        <table class="table table-hover my-0 table-responsive" id="eventsTable">
            <thead>
                <tr>
                    <th class=" d-xl-table-cell text-primary"> @lang('home.problem_subject')</th>
                    <th class=" d-xl-table-cell text-center">@lang('home.applicant')</th>
                    <th class=" d-xl-table-cell text-center">@lang('home.phone')</th>
                    <th class=" d-xl-table-cell text-danger">@lang('home.sent_at')</th>
                    <th class=" d-xl-table-cell"> @lang('home.location')</th>
                    <th class=" d-md-table-cell">@lang('home.supplied_docs')</th>
                    <th class=" d-md-table-cell">@lang('home.status')</th>
                    <th class=" d-md-table-cell">@lang('home.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($helpmes as $helpme)
                    <tr>
                        <td class="text-info fw-bold" style="font-family: Times New Roman;">
                            @if ($helpme->seen == 0)
                                <span class="badge bg-danger">@lang('home.new')</span><br>
                            @endif <?php echo $helpme->{'problem_title_' . $locale}; ?>
                        </td>
                        <td class="text-gray-dark">
                            <?php echo $helpme->{'name_' . $locale}; ?>
                        </td>
                        <td class="text-gray-dark">
                            {{ $helpme->phone }}
                        </td>
                        <?php $on = new Carbon\Carbon(new DateTime($helpme->created_at));
                        $formatted = $on->toDayDateTimeString();
                        if (app()->getLocale() == 'am') {
                            $formatted = Andegna\DateTimeFactory::fromDateTime($helpme->created_at)->format(\Andegna\Constants::DATE_ETHIOPIAN);
                        } elseif ($locale == 'or') {
                            $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($helpme->created_at)))->format(\Andegna\Constants::DATE_ETHIOPIAN));
                        } ?>
                        <td class="text-dark">{{ $formatted }}</td>
                        <td><?php echo $helpme->{'address_' . $locale}; ?></td>
                        <td class="text-center">
                            <strong>{{ App\Http\Controllers\Admin\Dashboard::howManyDocuments($helpme->id) }}</strong>
                        </td>
                        <td>
                            @if ($helpme->status == 'Pending')
                                <span class="badge bg-info">@lang('home.pending')</span>
                            @elseif($helpme->status == 'Accepted')
                                <span class="badge bg-success">@lang('home.accepted')</span>
                            @elseif($helpme->status == 'Rejected')
                                <span class="badge bg-danger">@lang('home.rejected')</span>
                            @endif
                        </td>
                        <td class="d-flex flex-column">
                            <a href="{{ url('dash/helpmes/view', $helpme->id) }}"
                                class="my-1 text-success fw-bold">@lang('home.review')</a>
                            <a href="{{ url('dash/helpmes/improve', $helpme->id) }}"
                                class="my-1 text-info fw-bold">@lang('home.improve')</a>
                            <a href="{{ url('dash/helpmes/remove', $helpme->id) }}"
                                class="my-1 text-danger fw-bold">@lang('home.remove')</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-sm-6 mt-3 mb-lg-5">
            <strong>{{ $helpmes->links('pagination::bootstrap-4') }}</strong>
        </div>
        <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
        @if (Session::has('message'))
            <script>
                toastr.success("{!! Session::get('message') !!}");
            </script>
        @endif
    </div>
@endsection
