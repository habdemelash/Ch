@extends('layouts.admin')
@section('content')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/chat.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div id="plist" class="people-list">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="@lang('home.search_place')">
                    </div>
                    <ul class="list-unstyled chat-list mt-2 mb-0">
                        @php
                            $users = App\Models\User::paginate(6);
                            $me = Auth::user();
                        @endphp
                        @forelse($users as $user)
                            <li class="clearfix">
                                @if ($user->profile_photo_path == null)
                                    <img class="img-thumbnail rounded-circle" height="50" width="50"
                                        src="{{ asset('site/assets/img/user.png') }}">
                                @else
                                    <img class="img-thumbnail rounded-circle" height="50" width="50"
                                        src="{{ asset('uploads/profile-photos') }}/{{ $user->profile_photo_path }}"
                                        alt="">
                                @endif
                                <span class="text-dark ">
                                    <div class="about">
                                        <a href="{{ url('dash/mails/open', $user->id) }}">
                                            <div class="name">{{ $user->name }}</div>

                                        </a>

                                        <div class="status"> <i class="fa fa-circle offline"></i>
                                            {{ $user->created_at }} </div>
                                    </div>
                            </li>
                        @empty
                            <div class="about">
                                @lang('home.no_messages')
                            </div>
                        @endforelse

                        {{ $users->links('pagination::bootstrap-4') }}
                    </ul>
                </div>
            </div>
            <div class="col-sm">
                @isset($open)
                    <div class="chat" style="overflow-y: scroll">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-12">
                                    @php
                                        $talking = App\Models\User::find(Request::segment(4));
                                    @endphp

                                    <div class="row">
                                        <div class="chat-about col-6">

                                            @if ($talking->profile_photo_path == null)
                                                <img class="img-thumbnail rounded-circle" height="50" width="50"
                                                    src="{{ asset('site/assets/img/user.png') }}">
                                            @else
                                                <img class="img-thumbnail rounded-circle" height="50" width="50"
                                                    src="{{ asset('uploads/profile-photos') }}/{{ $talking->profile_photo_path }}"
                                                    alt="">
                                            @endif

                                            <span class="m-b-2 text-sucess">{{ $talking->name }}</span>

                                        </div>
                                        <div class="col-6 text-right">
                                            <span class="m-b-2 text-primary">{{ $me->name }}</span>
                                            @if (!$me->profile_photo_path)
                                                <img class="img-thumbnail rounded-circle" height="50" width="50"
                                                    src="{{ asset('site/assets/img/user.png') }}">
                                            @else
                                                <img class="img-thumbnail rounded-circle" height="50" width="50"
                                                    src="{{ asset('uploads/profile-photos') }}/{{ $me->profile_photo_path }}"
                                                    alt="">
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                @forelse($open as $mail)
                                    @if ($me->id == App\Models\User::find($mail->sender)->id)
                                        <div class="text-right" style="">



                                        </div>
                                        <div class=" text-center offset-5" style="border-radius: 10px; width:50%;  background:rgb(149, 177, 204)">

                                            <span class="fw-bold">{{ $me->name }}</span><br>
                                            <span style="font-size: 11px; border-radius:5px">{{ App\Http\Controllers\TimeFormatter::eventDateLocal($mail->created_at).' '.App\Http\Controllers\TimeFormatter::timeLocal($mail->created_at) }}</span>
                                            <hr>
                                            <p class="">{{ $mail->content }}</p>

                                        </div>
                                    @else
                                        <div class=" text-center" style="border-radius: 10px; width:50%; background:rgb(136, 190, 172)">
                                            <span class="fw-bold">{{ $talking->name }}</span>
                                            <span style="font-size: 11px; border-radius:5px">{{ App\Http\Controllers\TimeFormatter::eventDateLocal($mail->created_at).' '.App\Http\Controllers\TimeFormatter::timeLocal($mail->created_at) }}</span>
                                            <hr>

                                            <p class="">{{ $mail->content }}</p>
                                        </div>
                                    @endif
                                @empty

                                    <div class="">@lang('home.no_mails_yet')</div>
                                @endforelse

                            </ul>

                        </div>
                        <div class="input-group mb-0 row">
                            <form action="{{ route('mail.reply') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3 ms-3">
                                    <input type="text" name="message" class="form-control block" placeholder="@lang('home.your_message')"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <input value="{{ Request::segment(4) }}" name="receiver" hidden>
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text" id="basic-addon2"><i
                                                class="fa fa-envelope"></i></button>
                                    </div>
                            </form>
                        </div>


                    </div>
                @endisset
            </div>

        </div>
    </div>
    <div class="container" style="postion: absolute;">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">



                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/other/bootstrap.bundle.min.js') }}"></script>
@endsection
