@extends('layouts.admin')
@section('search')
    <li class="d-flex flex-column flex-md-row">
        <div class="container-fluid" id="searchForm">
            <form class="d-flex" action="{{route('admin.users.search')}}" method="GET">
                @csrf
                <input class="form-control" type="text" name="keyword" value="{{old('keyword')}}" placeholder="@lang('home.search_place')" aria-label="Search">
                <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
            </form>
        </div>
    </li>
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/other/toastr.min.css') }}">
    <h1 class="h3 mb-3"><strong>@lang("home.users'")</strong> @lang('home.administration')</h1>
    <div class="row d-flex mt-3 justify-content-center">
        <div class="container">
        </div>
    </div>
    @if (session()->has('message'))
        <script>
            toastr.success("{{ 'User deleted.' }}");
        </script>
    @endif
    <div class="" style="overflow-x: auto;">
        <table class="table table-hover my-0 table-responsive" id="eventsTable">
            <thead>
                <tr>
                    <th class=" d-xl-table-cell"> @lang('home.full_name')</th>
                    <th class=" d-xl-table-cell"> @lang('home.phone')</th>
                    <th class=" d-xl-table-cell"> @lang('home.email')</th>
                    <th class=" d-xl-table-cell"> @lang('home.location')</th>
                    <th class=" d-md-table-cell text-center">@lang('home.roles')</th>
                    <th class=" d-md-table-cell">@lang('home.photo')</th>
                    <th>@lang('home.actions')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr id="uid{{ $user->id }}">
                        <?php $roleList = App\Http\Controllers\Admin\Dashboard::userRoles($user->id); ?>
                        <td class="text-dark" style="font-style: initial;">
                            
                           <strong> {{ $user->name }}</strong><br>
                            @if(Cache::has('user-is-online-' . $user->id))
                            <span class="badge bg-success">@lang('home.online')</span>
                        @else
                            <span class="badge bg-danger">@lang('home.offline')</span>
                        @endif
                          
                        </td>
                        <td class=" d-xl-table-cell text-info">{{ $user->phone }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}
                        </td>
                        <td>
                            <div class="col d-flex flex-column">
                                @if (in_array('Volunteer', $roleList))
                                    <span class=" btn-sm btn-success my-1" style="text-align: left;"><span><i
                                                class="bi bi-check-circle"></i> @lang('home.volunteer')</span></span>
                                @else
                                    <a class="btn btn-sm btn-danger my-1" href="" style="text-align: left;"><span><i
                                                class="bi bi-circle"></i> @lang('home.volunteer')</span></a>
                                @endif
                                @if (in_array('Staff', $roleList))
                                    <a class="btn btn-sm btn-success my-1"
                                        href="{{ url('dash/users/staffdown', $user->id) }}"
                                        style="text-align: left;"><span><i class="bi bi-check-circle"></i>
                                            @lang('home.staff')</span></a>
                                @else
                                    <a class="btn btn-sm btn-danger my-1"
                                        href="{{ url('dash/users/staffup', $user->id) }}"
                                        style="text-align: left;"><span><i class="bi bi-circle"></i>
                                            @lang('home.staff')</span></a>
                                @endif
                                @if (in_array('Admin', $roleList))
                                    <a class="btn btn-sm btn-success my-1"
                                        href="{{ url('dash/users/admindown', $user->id) }}"
                                        style="text-align: left;"><span><i class="bi bi-check-circle"></i>
                                            @lang('home.admin')</span></a>
                                @else
                                    <a class="btn btn-sm btn-danger my-1"
                                        href="{{ url('dash/users/adminup', $user->id) }}"
                                        style="text-align: left;"><span><i class="bi bi-circle"></i>
                                            @lang('home.admin')</span></a>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if ($user->profile_photo_path == null)
                                <img class="img-thumbnail rounded-circle" height="50" width="50"
                                    src="{{ asset('site/assets/img/user.png') }}">
                            @else
                                <img class="img-thumbnail rounded-circle" height="50" width="50"
                                    src="{{ asset('uploads/profile-photos') }}/{{ $user->profile_photo_path }}"
                                    alt="">
                            @endif
                        </td>
                        <td class="">
                            <button value="{{ $user->id }}" type="button" class="btn deleteUser" data-bs-toggle="modal"
                                data-bs-target="#deleteModal"><i class="bx bxs-trash bx-md text-danger"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ url('/users/delete') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalLabel">@lang('home.delete_user')</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">
                        <p class="fw-bold">@lang('home.do_you_delete_user')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('home.no')</button>
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">@lang('home.yes_delete')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="row">
        <div class="col-sm-6 mt-3 mb-lg-5">
            <strong>{{ $users->links('pagination::bootstrap-4') }}</strong>
        </div>

    </div>
    <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteUser', function(e) {
                e.preventDefault();
                var user_id = $(this).val();
                $('#user_id').val(user_id);
                $('#deleteModal').modal('show');
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
    @if (Session::has('message'))
        <script>
            toastr.success("{!! Session::get('message') !!}");
        </script>
    @endif
@endsection
