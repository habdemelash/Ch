@extends('layouts.site')

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
  <style >
	.act{
		text-decoration: none;
	}
	.act:hover{
		text-decoration: none;
	}

	.single-definition{
		padding: 10px;
		border-radius: 10px;
		border-color: green;
        border-width: 0.5px;
		margin-top: 10px;
	}
	.main{
		;
	}
	.others{
		border: solid;
		border-color: green;
		border-width: 0.5px;
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
            <a href="/register" class="btn-get-started scrollto">Joins us now</a>
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


 	<div class="row">
 		<div class="col-lg-9 col-md-9 col-sm-12 main">
 			<div class="container">
	   
            <div class="section-top-border">
                <h3 class="mb-30 title_color"><strong class="text-info"><i class="bx bxs-user-circle bx-md"></i>{{$helpme->name}} </strong> really needs your help!</h3>

                <div class="row">
                    <div class="col-md-4">
                        <div class="single-definition">
                            <h4 class="mb-20 text-success">Applicant name</h4>
                            <p>{{$helpme->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-definition">
                            <h4 class="mb-20 text-success">Address details</h4>
                            <p>{{$helpme->address}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-definition">
                            <h4 class="mb-20 text-success">Problem subject</h4>
                            <p>{{$helpme->problem_title}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-definition ">
                            <h4 class="mb-20 text-success">Phone</h4>
                            <p>{{$helpme->phone}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-definition">
                            <h4 class="mb-20  text-success">Email</h4>
                            <p>{{$helpme->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="text-success">
            <div class="section-top-border single-definition">
                <h3 class="mb-30 title_color">Problem details and helping mechanisms</h3>
                <div class="row">
                    <div class="col-lg-12 ">
                        <blockquote class="generic-blockquote">
                            “{{$helpme->problem_details}}” 
                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="section-top-border single-definition">
                <h3 class="mb-30 title_color text-center">Supplied documents</h3>
                <div class="row d-flex justify-content-center">
       			@foreach($docs as $doc)
                     <div class="col-md-4">
                        <a href="{{asset('uploads/helpme-pictures')}}/{{$doc->document}}" class="img-gal"><div><img src="{{asset('uploads/helpme-pictures')}}/{{$doc->document}}" alt="" class="img-fluid"></div></a>
                    </div>
                   @endforeach
                    
                  
                   
            
                </div>
            </div>
		

	
</div>
 			
 		</div>









 		<div class="col-lg-3 col-md-3 col-sm-12 text-center mt-sm-4 mt-md-2 others">
 			
 			<div><strong class="text-danger">These people need you!</strong></div>
 			@foreach($others as $other)

                    <div class="col my-2">
                       <a href="{{url('lets-help/view',$other->id)}}">
                       	 <div class="single">
                            <strong class="text-info"><i class="bx bxs-user-circle"></i>{{$other->name}}</strong><br>
                            <?php $on = new Carbon\Carbon(new DateTime($other->created_at));
											$formatted = $on->toDayDateTimeString(); ?>
                            <span class="text-secondary">On: {{$formatted}}</span><br>
                            <strong class="badge bg-danger">{{$other->problem_title}}</strong><br>
                            <p>{{mb_substr($other->problem_details,0,100,'UTF-8')}} ...</p>
                            <a href="">See full information</a>
                        </div>  
                       </a>
                    </div>
                    <hr>
                   
                    @endforeach
                    {{$others->links('pagination::bootstrap-5')}}
 		</div>
 	</div>
               
      
    
          
   </section>
    </div>
    @endsection