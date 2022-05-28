@extends('layouts.admin')
@section('content')
    <div class="main-content container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 order-md-1 order-last">
                    <h3>@lang('home.see_details_of_joined_vols') </h3>
                    <p class="text-subtitle text-muted">@lang('home.use_this_info')<strong>&nbsp;<a
                                href="{{ route('admin.events') }}">@lang('home.back')</a></strong> @lang('home.to_the_list')</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                </div>
            </div>
        </div>
        <section class="tasks">
            <div class="row">
                <div class="col">
                    <div class="card widget-todo">
                        <div class="row" id="table-bordered">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">@lang('home.all_joined_this') </h4>
                                    </div>
                                    <div class="card-content">
                                        <?php
                                        $users = App\Http\Controllers\Site\Home::listJoindeVolunteers($event);
                                        ?>
                                        <div class="table-responsive table-secondary">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th><i class="bx bxs-user text-success text-nowrap"
                                                                style="font-size: 25px;">@lang('home.full_name')</i></th>
                                                        <th><i class="bx bxs-phone  text-danger text-nowrap"
                                                                style="font-size: 25px;"> @lang('home.phone')</i></th>
                                                        <th><i class="bx bxs-map  text-primary text-nowrap"
                                                                style="font-size: 25px;">@lang('home.location')</i></th>
                                                        <th><i class="bx bxs-envelope  text-info text-nowrap"
                                                                style="font-size: 25px;"> @lang('home.email')</i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td class="text-success" style="font-weight: 600;">
                                                                {{ $user->name }}</td>
                                                            <td class="text-danger">{{ $user->phone }}</td>
                                                            <td class="text-primary">{{ $user->address }}</td>
                                                            <td class="text-info">{{ $user->email }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-6 my-3">
                                                {{ $users->links('pagination::bootstrap-5') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
