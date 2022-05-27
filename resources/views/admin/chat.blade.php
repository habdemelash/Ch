@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('chat/assets/css/bootstrap.min.css') }}">
    <style>
        #chat2 .form-control {
            border-color: transparent;
        }

        #chat2 .form-control:focus {
            border-color: transparent;
            box-shadow: inset 0px 0px 0px 1px transparent;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

    </style>
    <section style="margin-top: 20px">
        <div class="container py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md{{ isset($main) ? -4 : '' }}">
                    <h4>People contacted you</h4>
                    <ul class="list-group">
                        @forelse($mails as $mail)
                            <?php $sender = App\Http\Controllers\Messages::sender($mail->id); ?>
                            <a href="{{ url('contacted/read', $mail->sender) }}">
                                <li class="list-group-item">
                                    <strong class="text-left">Abebe </strong>
                                    <p>Hello habte o...</p>
                                </li>
                            </a>
                        @empty
                            <a href="" title="">
                                <li>No one yet</li>
                            </a>
                        @endforelse

                    </ul>
                    {{-- {{ $mails->links('pagination::bootstrap-4') }} --}}
                </div>
                @isset($mains)
                    <div class="col-md-8">
                        <div class="card" id="chat2">
                            <div class="card-header d-flex justify-content-between align-items-center p-3">
                                <h5 class="mb-0">{{ App\Http\Controllers\Messages::sender($mains->id) }}
                                </h5> With
                                <h5 class="badge bg-primary">You</h5>
                            </div>
                            <div class="card-body" data-mdb-perfect-scrollbar="true"
                                style="position: relative; height: 400px; overflow-y: scroll;">
                                @forelse($mains as $main)
                                    <div class="d-flex flex-row justify-content-start">


                                        @if (!$main->sender !== Auth::user()->id && $main->receiver == Auth::user()->id)
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp"
                                                alt="avatar 1" style="width: 45px; height: 100%;">
                                            <div>
                                                <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">
                                                    {{ $main->content }}
                                                </p>

                                                <p class="small ms-3 mb-3 rounded-3 text-muted">{{ $main->created_at }}</p>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="divider d-flex align-items-center mb-4">

                                    </div>
                                    @if ($main->sender == Auth::user()->id && $main->sender !== Auth::user()->id)
                                        <div class="d-flex flex-row justify-content-end mb-4 pt-1">
                                            <div>
                                                <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">
                                                    {{ $main->content }}</p>
                                                <p class="small ms-3 mb-3 rounded-3 text-muted">{{ $main->created_at }}</p>

                                            </div>
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava4-bg.webp"
                                                alt="avatar 1" style="width: 45px; height: 100%;">
                                        </div>
                                    @endif
                                @empty
                                    <p>Nothing yet</p>
                                @endforelse
                            </div>
                             <form >
                            <div class="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3-bg.webp"
                                    alt="avatar 3" style="width: 40px; height: 100%;">
                               
                                    <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1"
                                        placeholder="Type message">
                                    <button type="submit" style="border-style: none;s"><i class="bx bxs-paper-plane text-primary"></i></button>
                                
                            </div>
                            </form>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </section>
    <script src="{{ asset('chat/assets/js/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('chat/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $('.card-body').scrollTop($('.card-body')[0].scrollHeight);
    </script>
@endsection
