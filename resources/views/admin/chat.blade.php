@extends('layouts.admin')
@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('admin/css/bootstrap4.min.css')}}" >
<link rel="stylesheet" href="{{asset('admin/css/chat.css')}}">

</head>
<body>
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list" >
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            @php
                            $users = App\Models\User::paginate(10);
                            @endphp
                            @forelse($users as $user)
                            <li class="clearfix">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                <div class="about">
                                    <a  href="{{url('dash/mails/open',$user->id)}}">
                                    <div class="name">{{$user->name}}</div>
                                   
                                    </a>
                                    
                                    <div class="status"> <i class="fa fa-circle offline"></i> {{$user->created_at}} </div>                                            
                                </div>
                            </li>
                            @empty
                            <div class="about">
                                No users                                            
                            </div>

                            @endforelse
                            <li class="clearfix active">
                                <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                <div class="about">
                                    <div class="name">Aiden Chavez</div>
                                    <div class="status"> <i class="fa fa-circle online"></i> online </div>
                                </div>
                            </li>
                            {{$users->links('pagination::bootstrap-4')}}
                        </ul>
                    </div>
                    @isset($open)
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">{{App\Models\User::find($open[0]->sender)->name}}</h6>
                                        <small>Last seen: 2 hours ago</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-sm text-right">
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history" >
                            <ul class="m-b-0" style="overflow-y: scroll">
                                @forelse($open as $mail)
                                @if(Auth::user()->id == App\Models\User::find($mail->sender)->id)
                                <li class="clearfix">
                                    <div class="message-data text-right">
                                        <span class="message-data-time">{{$mail->created_at}}</span>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                    </div>              
                                    {{-- <div class="message other-message float-right"> Hi Aiden, how are you? How is the project coming along? </div> --}}
                                    <div class="message other-message float-right"> {{$mail->content}}</div>
                                </li>
                                @else
                                <li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">{{$mail->created_at}}</span>
                                    </div>
                                    <div class="message my-message">{{$mail->content}}</div>                                    
                                </li>  
                                @endif                             
                                {{-- <li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">{{$mail->created_at}}</span>
                                    </div>
                                    <div class="message my-message">Project has been already finished and I have results to show you.</div>
                                </li> --}}
                                @empty

                                @endforelse
                                
                            </ul>
                            
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Enter text here...">                                    
                            </div>
                        </div>
                    </div>
                    @endisset
                </div>
            </div>
        </div>
        </div>
        <script src="{{asset('admin/other/bootstrap.bundle.min.js')}}" ></script>
@endsection

