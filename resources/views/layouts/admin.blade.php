<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('site/assets/img/3dheart.png') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>CVSMS - Administration</title>

    <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
     <link href="{{ asset('site/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
     <link href="{{ asset('site/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('admin/other/toastr.min.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<?php $address = Request::url(); 

$countUnseen = App\Http\Controllers\Admin\Dashboard::countUnseenHelpmes();
$unseen = App\Http\Controllers\Admin\Dashboard::unseenHelpmes();
$messages = App\Http\Controllers\Messages::partialMessages(Auth::user()->id);
$all = App\Http\Controllers\Messages::allMessages(Auth::user()->id);
$messageCount= $all->count();
?>
<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="" style="text-decoration: none;">
          <span class="align-middle">CVSMS</span>
        </a>

                <ul class="sidebar-nav">
                   

                    <li class="sidebar-item {{ Request::is('dash') ? 'active' : '';}}">
                        <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
              <i class="bx bx-stats bx-md" ></i> <span class="align-middle">Dashboard</span>
            </a>
                    </li>

                    <li class="sidebar-item {{ strpos($address,'dash/event') ? 'active' : '';}}">
                        <a class="sidebar-link" href="{{ route('admin.events')}}">
              <i class="bx bxs-calendar-check bx-md" ></i> <span class="align-middle">Events</span>
            </a>
                    </li>

                    <li class="sidebar-item {{ strpos($address,'dash/news') ? 'active' : '';}}">
                        <a class="sidebar-link" href="{{route('admin.news')}}">
              <i class="bx bxs-news bx-md" ></i> <span class="align-middle">News</span>
            </a>
                    </li>

                    <li class="sidebar-item {{ strpos($address,'dash/helpmes') ? 'active' : '';}}">
                        <a class="sidebar-link" href="{{route('admin.helpmes')}}">
              <i class="bx bxs-hand bx-md" ></i> <span class="align-middle">Help me</span>

            @if($countUnseen>0) <span class="badge bg-primary">{{$countUnseen}}</span> @endif
        </a>
                    </li>

                    <li class="sidebar-item {{ strpos($address,'dash/mails') ? 'active' : '';}}">
                        <a class="sidebar-link" href="{{route('user.mails')}}">
              <i class="bx bxs-message bx-md" ></i> <span class="align-middle">Mails<span class="badge bg-info ml-1">{{$messageCount}}</span> </span>
            </a>
                    </li>

                    

                    <li class="sidebar-item {{ strpos($address,'dash/users') ? 'active' : '';}}">
                        <a class="sidebar-link" href="{{route('admin.users')}}">
              <i class="bx bxs-group bx-md"></i> <span class="align-middle">Users</span>
            </a>
                    </li>
                    
                </ul>

            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li></li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="bx bxs-hand"></i>
                                    @if($countUnseen>0)
                                    <span class="indicator">{{$countUnseen}}</span>
                                    @endif
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown" style="width: 300px;">
                                <div class="dropdown-menu-header">
                                    @if($countUnseen>0)
                                    <span class="badge bg-danger">{{$countUnseen}}</span> New Help-me application(s)
                                    @else
                                    No new Help-me applications
                                    @endif

                                </div>
                                <div class="list-group">
                                    @foreach($unseen as $un)
                                    <a href="{{url('dash/helpmes/view',$un->id)}}" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="bx bxs-hand text-danger" ></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-info fw-bold">{{$un->name}}</div>
                                                <div class="text-muted small mt-1">{{$un->problem_title}}</div>
                                                <?php $on = new Carbon\Carbon(new DateTime($un->created_at));
                                            $formatted = $on->toDayDateTimeString(); ?>
                                                <div class="text-dark small mt-1">{{$formatted}}</div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    
                                </div>
                                <div class="dropdown-menu-footer">
                                    {{$unseen->links('pagination::bootstrap-5')}}
                                   
                                    
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i><span class="indicator">{{$messageCount}}</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0 " aria-labelledby="messagesDropdown" style="width: 300px;">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        <span class="badge bg-primary">{{$messageCount}}</span> New contact mail(s) for you
                                    </div>
                                </div>
                                <div class="list-group">
                                    @foreach($messages as $mail )
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                              {{--   <img src="{{ asset('admin/img/avatars/avatar-5.jpg') }}" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker"> --}}
                                              <i class="bx bxs-user-circle bx-md"></i>
                                            </div>
                                            <div class="col-10 ps-2">
                                                <?php $sender = App\Http\Controllers\Messages::sender($mail->sender); 
                                                if($mail->sender == $mail->receiver){
                                                    $sender = 'Charity Team';
                                                }
                                                ?>
                                                <div class="text-dark">{{$sender}}</div>
                                                <div class="text-muted small mt-1">{{mb_substr($mail->content,0,30,'UTF-8')}} ...</div>
                                                <div class="text-muted small mt-1">{{$mail->created_at}}</div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

            

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                @if(Auth::user()->profile_photo_path == null)
                <img class="img-thumbnail rounded-circle" height="50" width="50" src="{{asset('site/assets/img/user.png')}}" >
                @else
          <img class="img-thumbnail rounded-circle" height="50" width="50" src="{{asset('uploads/profile-photos')}}/{{Auth::user()->profile_photo_path}}" alt="">
           @endif <span class="text-dark">
                    @auth
                    {{Auth::user()->name}}@endauth</span>
              </a>
                            <div class="dropdown-menu dropdown-menu-">
                                <a class="dropdown-item" href="{{route('profile')}}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                               
                                <a class="dropdown-item" href="{{route('site.home')}}"><i class="bx bxs-home-heart"></i> Site</a>
                                <a class="dropdown-item" href="{{route('logout')}}"><i class="bx bx-lock"></i>Log out</a>
                                
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content" >
                <div class="container-fluid p-0" >

                   @yield('content')

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                       
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="{{route('site.home')}}" >Site</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="{{route('profile')}}" >Profile</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="{{route('logout')}}" target="_blank">Logout</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{asset('admin/js/app.js') }}"></script>
    
         
         <script type="text/javascript" src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
         <script type="text/javascript" src="{{ asset('admin/other/popper.min.js') }}"></script>
         <script type="text/javascript" src="{{ asset('admin/other/toastr.min.js') }}"></script>
         <script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>

         
   

</body>

</html>