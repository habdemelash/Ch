@extends('layouts.site',['myevents'=>$myevents])

@section('content')

<div class="container">
<section id="hero" class="d-flex align-items-center">
  <style >
    @media  (max-width: 768px) {

      .single-definition, .wrapper
      {
        text-align: center;
      }
      .separator{
      	display: block;
      }

      
    }
    @media (min-width: 768px) {
    	.separator{
    		display: none;
    	}
    	
    }
    .wrapper{
    	border-bottom: solid;
    	border-color: #4EC5EF;
    	border-width: 1px;
    }
  
  </style>

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
<section id="about" class="about" style="">
 <div class="section-top-border">
                <h3 class="mb-30 title_color">Hands waiting for your help</h3>
                <hr>
                <div class="row">
                	
                	@foreach($helpme as $help)

                    <div class="col-md-6 col-lg-4 wrapper my-2">
                       <a href="{{url('lets-help/view',$help->id)}}">
                       	 <div class="single-definition">
                            <strong class="text-info"><i class="bx bxs-user-circle bx-md"></i>{{$help->name}}</strong><br>
                            <?php $on = new Carbon\Carbon(new DateTime($help->created_at));
											$formatted = $on->toDayDateTimeString(); ?>
                            <span class="text-secondary">On: {{$formatted}}</span><br>
                            <strong class="badge bg-danger">{{$help->problem_title}}</strong><br>
                            <p>{{mb_substr($help->problem_details,0,100,'UTF-8')}} ...</p>
                            <a href="">See full information</a>
                        </div>  
                       </a>
                    </div>
                   
                    @endforeach
                   
                </div>
                {{$helpme->links('pagination::bootstrap-5')}}
            </div>
      
    
          
   </section>
    </div>
    @endsection