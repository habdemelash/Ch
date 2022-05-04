<!DOCTYPE html>
<html lang="en">

<head> 
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>CVSMS Site- {{Request::is('/') ? 'Home' : ''}}{{Request::is('events') ? 'Events' : ''}} {{Request::is('all-my-events') ? 'All my events':''}} {{Request::is('register') ? 'Join us' : ''}}{{Request::is('login') ? 'Login' : ''}}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
   <?php $address = Request::url(); ?>
  <!-- Favicons -->
  <link href="{{ asset('site/assets/img/3dheart.png') }}" rel="icon">
  <link href="{{ asset('site/assets/img/3dheart.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('site/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  {{-- <link href="{{ asset('admin/other/toastr.min.css') }}" rel="stylesheet"> --}}
  <link href="{{ asset('site/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('site/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('site/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('site/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/other/toastr.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('site/assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  @toastr_css


  <style>
 .more {
  display: none;
}

.service-item.open .more {
  display: inline;
}

.service-item.open .dots {
  display: none;
}
</style>
@livewireStyles
</head>

<body>


  
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo "><a class="text-success" href="/"><img src="{{ asset('site/assets/img/3dheart.png') }}" class="mx-3">Kind Hearts</a></h1>
     
<?php $address = Request::url(); ?>
      <nav id="navbar" class="navbar">
        <ul>
          <li ><a class="nav-link scrollto {{Request::is('/') ? 'active' : ''}}" href="/">Home<i class="bi-house-fill"></i></a></li>
          
          <li><a class="nav-link scrollto {{Request::is('events') ? 'active' : ''}}" href="{{route('site.events')}}">Events</a></li>
          <li><a class="nav-link scrollto {{ strpos($address,'lets-help') ? 'active' : '';}} " href="{{route('site.letshlep')}}">Let's Help<i class="bi-calendar-event-fill"></i></a></li>
          <li class="dropdown "><a class="nav nav-link {{Request::is('all-my-events') ? 'active' : ''}}" href="{{route('all.my.events')}}"><span>My Events
            @if(Auth::check())
            <span class="badge bg-primary">{{$myevents}}</span>
            @endif
          </span></a>
           
            <ul >

           <?php $arr = array_reverse($myEventsList); ?>
              @for($i=0; $i<count($myEventsList) and $i<3;$i++)
              <?php $ev = App\Http\Controllers\Site\Home::fetchMyEvents($arr[$i]); ?>
              <li class="dropdown"><a href="#" style="pointer-events: none">
              <div>
                <span class="badge bg-primary">{{$i+1}}</span><strong>{{$ev->title}}</strong><br>
                <small>Date:<span class="text-primary">{{' '.$ev->due_date}}</span></small><br>
                <small>Location:<span class="text-primary">{{' '.$ev->location}}</span></small>
                
              </div>
               
                
                <a id="leave-span" href="{{url('leave-event',$ev->id)}}"><span class="badge" style="background: rgb(255, 0, 0);">Leave<i class="bi-x-circle"></i></span></a>

              
                
                <hr class="text-success">
             </a>             
              </li>
              
              @endfor
              @if($myevents>3)
              <a href="{{route('all.my.events')}}" style="text-decoration: none;" class="text-primary">See all</a>
              @endif            
            </ul>
       
          </li>
          
           
          <li class="dropdown"><a href="#"><span>More<i class="bi-plus-circle-fill font-weight-bold"></i></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route('site.helpmeform')}}">Help me form<i class="bx bxs-send"></i></a></li>
              <li><a class="nav-link scrollto" href="{{route('site.staff')}}">Our Staff<i class="bi-people-fill"></i></a></li>

             
              
              <li><a class="nav-link scrollto" href="{{route('contact.form')}}">Contact us<i class="bi-send-fill"></i></a></li>
              <li><a href="#about">About<i class="bx bxs-info-square"></i></a></li>
              <li><a href="{{route('profile')}}">Profile<i class="bx bxs-info-square"></i></a></li>
              <li><a href="{{route('admin.events')}}">Administration<i class="bx bxs-info-square"></i></a></li>
              <li><a href="/logout">Sign out<i class="bx bxs-info-square"></i></a></li>
            </ul>
          </li>

          

          @auth
         <li class="dropdown"><a href="#"><span>{{Auth::user()->name}}
          @if(Auth::user()->profile_photo_path == null)
          <img class="img-thumbnail rounded-circle" height="50" width="50" src="{{asset('site/assets/img/user.png')}}" >

         @else
          <img class="img-thumbnail rounded-circle" height="50" width="50" src="{{asset('uploads/profile-photos')}}/{{Auth::user()->profile_photo_path}}" alt="">
           @endif
         </a>
            <ul>
              <li><a href="{{route('profile')}}">Profile<i class="bx bxs-user"></i></a></li>
              <li><a class="nav-link scrollto" href="{{route('logout')}}">Logout<i class="bx bxs-log-out"></i></a></li>

            </ul>
          </li>
          @endauth
          @guest
         
          <li><a class="getstarted scrollto fw-bold" href="/login"><i class="bx bxs-log-in mx-1" style="font-size:20px;"></i>Login</a></li>
          @endguest
         
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->



  <main id="main">

    

@yield('content')

  
    
    

   
   
    
    


  

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">

      <div class="container">

        <div class="row  justify-content-center">
          <div class="col-lg-6">
            <img class="img-fluid " width="50" height="50" src="{{ asset('site/assets/img/3dheart_filled.png') }}">
            <h3>CVSMS</h3>
            <p>Et aut eum quis fuga eos sunt ipsa nihil. Labore corporis magni eligendi fuga maxime saepe commodi placeat.</p>
          </div>
        </div>

        <div class="row footer-newsletter justify-content-center">
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email" placeholder="Enter your Email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>

        <div class="social-links">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>

      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>eNno</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        
         Developed by <a href="">ASTU Systems</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('site/assets/vendor/purecounter/purecounter.js') }}"></script>
  <script src="{{ asset('site/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('site/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('site/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('site/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <script src="{{ asset('site/assets/js/main.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
@livewireScripts

</body>

</html>