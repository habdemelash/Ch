@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/chat.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="plist" class="people-list">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="@lang('home.search_place')">
                    </div>
                    @php
                        $messages = App\Models\Message::select('id', 'created_at', 'content', 'sender', 'receiver')
                            ->where('receiver', Auth::user()->id)
                            ->orderBy('created_at', 'DESC')
                            ->distinct('sender')
                            ->paginate(6);
                        $me = Auth::user();
                    @endphp
                    @forelse($messages as $message)
                        @php
                            $senderID = $message->sender;
                        $sender = App\Models\User::find($message->sender); @endphp
                        <li class="clearfix" style="list-style-type: none">
                            @if ($senderID !== Auth::user()->id)
                                @if ($sender->profile_photo_path == null)
                                    <img class="img-thumbnail rounded-circle" height="50" width="50"
                                        src="{{ asset('site/assets/img/user.png') }}">
                                    @if ($message->sender == $message->receiver)
                                        <span>@lang('home.cvsms')</span>
                                    @else
                                        <span>{{ $sender->name }}</span>
                                    @endif
                                @else
                                    <img class="img-thumbnail rounded-circle" height="50" width="50"
                                        src="{{ asset('uploads/profile-photos') }}/{{ $sender->profile_photo_path }}"
                                        alt="">
                                    @if ($message->sender == $message->receiver)
                                        <span>@lang('home.cvsms')</span>
                                    @else
                                        <span>{{ $sender->name }}</span>
                                    @endif
                                @endif
                            @else
                                <img class="img-thumbnail rounded-circle" height="50" width="50"
                                    src="{{ asset('site/assets/img/3dheart.png') }}">
                                <span> @lang('home.cvsms') </span>
                            @endif
                            <span class="text-dark ">
                                <div class="about">
                                    <a href="{{ url('dash/mails/open', $message->sender) }}">
                                        <div class="name">{{ mb_substr($message->content, 0, 20, 'UTF-8') }} ...
                                        </div>

                                    </a>

                                    <div class="status">
                                        @if ($message->seen == 0)
                                            <span class="badge bg-primary">New</span>
                                        @endif
                                        <small>
                                            {{ App\Http\Controllers\TimeFormatter::fullDateTime($message->created_at) }}</small>
                                    </div>
                                </div>
                        </li>
                    @empty
                        <div class="about">
                            @lang('home.no_mails_yet')

                        </div>
                    @endforelse

                    <div class="col-4">
                        {{ $messages->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>
            <div class="col-sm"
                style="border-style:dashed;border-radius:10px; border-color:rgb(11, 85, 85); border-width:0.6px">
                @isset($open)
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-12">
                                    @php
                                        $talking = App\Models\User::find(Request::segment(4));
                                    @endphp

                                    <div class="row">
                                        <div class="chat-about col-6">
                                            @if ($me->id !== $talking->id)
                                                @if ($talking->profile_photo_path == null)
                                                    <img class="img-thumbnail rounded-circle" height="50" width="50"
                                                        src="{{ asset('site/assets/img/user.png') }}">
                                                @else
                                                    <img class="img-thumbnail rounded-circle" height="50" width="50"
                                                        src="{{ asset('uploads/profile-photos') }}/{{ $talking->profile_photo_path }}"
                                                        alt="">
                                                @endif

                                                <span class="m-b-2 text-sucess">{{ $talking->name }}</span>
                                            @else
                                                <span class="m-b-2 text-sucess">@lang('home.cvsms')</span>
                                            @endif

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
                        <div class="chat-history" style="">

                            @forelse($open as $mail)
                                @if ($me->id == App\Models\User::find($mail->sender)->id)
                                    <div class=" text-center offset-5"
                                        style="border-radius: 10px; width:60%;  background:rgb(149, 177, 204)">

                                        @if ($me->id == $mail->sender && $mail->sender == $mail->receiver)
                                            <span>@lang('home.cvsms')</span>
                                        @else
                                            <span>{{ $sender->name }}</span>
                                        @endif
                                        <br>
                                        <span
                                            style="font-size: 11px; border-radius:5px">{{ App\Http\Controllers\TimeFormatter::fullDateTime($mail->created_at) }}</span>
                                        <hr>
                                        <p class="">@php echo $mail->content; @endphp </p>

                                    </div>
                                @else
                                    <div class=" text-center"
                                        style="border-radius: 10px; width:60%; background:rgb(136, 190, 172)">
                                        <span class="fw-bold">{{ $talking->name }}</span>
                                        <span
                                            style="font-size: 11px; border-radius:5px">{{ App\Http\Controllers\TimeFormatter::fullDateTime($mail->created_at) }}</span>
                                        <hr>

                                        <p class="">@php echo $mail->content; @endphp</p>
                                    </div>
                                @endif
                            @empty
                                <div class="">@lang('home.no_mails_yet')</div>
                            @endforelse
                        </div>
                        <div class="input-group mb-0 row">
                            <form action="{{ route('mail.reply') }}" method="POST">
                                @csrf
                                <div class="input-group mb-3 ms-3">

                                    <input type="text" name="message" class="form-control block" placeholder="@lang('home.your_message')"
                                        aria-label="" aria-describedby="basic-addon2">
                                    <input value="{{ Request::segment(4) }}" name="receiver" hidden>
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text" id="basic-addon2"><i
                                                class="fa fa-envelope text-primary"></i></button>
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
