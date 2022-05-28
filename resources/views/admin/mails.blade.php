@extends('layouts.admin')
@section('content')
    <style>
        .right {
            position: relative;
            background: darkgreen;

            min-width: 45%;
            padding: 10px 15px;
            border-radius: 6px;
            border: 1px solid #ccc;

        }

        .right::before {
            content: '';
            position: absolute;
            visibility: visible;
            top: -1px;
            right: -10px;
            border: 10px solid transparent;
            border-top: 10px solid #ccc;
        }

        .right::after {
            content: '';
            position: absolute;
            visibility: visible;
            top: 0px;
            right: -8px;
            border: 10px solid transparent;
            border-top: 10px solid darkgreen;
            clear: both;
        }

    </style>

    <?php $messages = App\Http\Controllers\Messages::partialMessages(Auth::user()->id); ?>
    <div class="list-group">

        @foreach ($messages as $mail)
            <div class="list-group right">
                <a href="{{ url('dash/mails/view', $mail->id) }}" class="list-group-item">
                    <div class="row g-0 align-items-center ">
                        <div class="col-2">

                            <i class="bx bxs-envelope bx-md"></i>
                        </div>
                        <div class="col-8 ps-2">
                            <?php $sender = App\Http\Controllers\Messages::sender($mail->sender);
                            if ($mail->sender == $mail->receiver) {
                                $sender = 'Charity Team';
                            }
                            ?>
                            <div class="text-dark">{{ $sender }}</div>
                            <div class="text-muted small mt-1">{{ mb_substr($mail->content, 0, 30, 'UTF-8') }} ...</div>
                            <div class="text-muted small mt-1">{{ $mail->created_at }}</div>

                        </div>
                        <div class="col-2 text-right">

                            @if ($mail->status == 0)
                                <span class="badge bg-info">New</span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

        <div class="col-md-6">
            {{ $messages->links('pagination::bootstrap-4') }}
        </div>
    @endsection
