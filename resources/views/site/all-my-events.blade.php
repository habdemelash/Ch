 @extends('layouts.site')


 @section('content')
<section id="hero" class="d-flex align-items-center">
  

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>We strive for good cause...</h1>
           <h2>

            “Volunteering is at the very core of being a human.  No one has made it through life without someone else’s help.” – <strong>Heather French Henry</strong></h2>
         <div class="d-flex">
            @guest
            <a href="/join-us" class="btn-get-started scrollto">Joins us now</a>
            @endguest
            @auth
             <a href="{{route('logout')}}" class="btn-get-started bg-danger "><i class="bx bxs-log-out"></i> Logout</a>
            @endauth
            
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="{{asset('site/assets/img/digital_22.jpg')}}" class="img-fluid animated" alt="" style="border-radius:30px;">
        </div>
      </div>
    </div>

  </section>
  <div class="row">
    <h1 class="text-center">Your Events</h1>
  </div>
<section  class="d-flex align-items-center" >
  
  @for($i=0; $i<count($myEventsList);$i++)
    <?php $ev = App\Http\Controllers\Site\Home::fetchMyEvents($myEventsList[$i]); ?>

    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" style="text-align: center;">
          <h3>{{$ev->title}}<span class="badge" style="background-color: blue;">{{$i+1}}</span></h3>
          <h2>{{$ev->short_desc}}</h2>
          <p class="text-success">{{mb_substr($ev->details,0,50,'UTF-8')}}</p>
          <div class="justify-content-center" style="text-align: center;">
          	<div><strong class="text-primary">Date:<span class="text-info">{{$ev->due_date}}</span></strong></div>
          	<div><strong class="text-primary">Location:<span class="text-info">{{$ev->location}}</span></strong></div>
          	<div><strong class="text-primary">Starting time:<span class="text-info">{{$ev->start_time}}</span></strong></div>
          	<div><strong class="text-primary">Ending time:<span class="text-info">{{$ev->end_time}}</span></strong></div>
            <a href="{{url('leave-event',$ev->id)}}" class="btn btn-danger btn-sm"><i class="bi-x-circle"></i>Leave it</a>
           
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">

        <a href="{{url('events/view',$ev->id)}}">  <img src="{{asset('uploads/event-pictures')}}/{{$ev->picture}}" class="img-fluid rounded animated" alt=""></a>
        </div>
      </div>
       <hr class="text-success" style="height: 2px;">
    </div>
@endfor
</section>





  
  @endsection