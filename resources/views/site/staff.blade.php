@extends('layouts.site',['myevents'=>$myevents,'myEventsList'=>$myEventsList])

@section('content')


<section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title" style="margin-top: 140px;">
          <span>Staff</span>
          <h2>Our Kind Hearted Staff</h2>
          <p>Know about our good-hearted staff behind all this humanitarian effort...</p>
        </div>


        <div class="row d-flex justify-content-center">
        @foreach($staff as $member)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch container-fluid">
            <div class="member container-fluid">
            @if($member->profile_photo_path == null)
            <img class="rounded-circle" src="{{asset('site/assets/img/user.jpg')}}" alt="" height="200" width="200">
             @else
              <img class="rounded-circle" src="{{asset('uploads/profile-photos')}}/{{$member->profile_photo_path}}" alt="" height="200" width="200">
             @endif
              <h4>{{$member->name}}</h4>
              <span>Staff</span>
              <div  style="text-align: center; align-self: center;">
                <p>
              <i class="bx bxs-envelope"></i> {{$member->email}}
              </p>
              <p>
              <i class="bx bxs-phone"></i> {{$member->phone}}
              </p>
              <p>
               <i class="bx bxs-map"></i>{{$member->address}}
              </p>
              </div>
              
              <div class="social">
                <a href=""><i class="bx bxs-message text-primary"></i></a>
                
              </div>
            </div>
          </div>
          @endforeach


          

          

        </div>

      </div>
    </section>

@endsection