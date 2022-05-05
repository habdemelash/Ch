@extends('layouts.site',['myevents'=>$myevents])
@section('search')
<div class="container-fluid">
                  <form class="d-flex">
                    <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
                  </form>
                </div>


@endsection
@section('search')
<div class="container-fluid">
                  <form class="d-flex">
                    <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
                  </form>
                </div>


@endsection

@section('content')
<style >
    @media  (max-width: 768px) {

      #author-date
      {
        text-align: center;
      }
      .read-more{
        background-color: green;
        border: none;
      }
      
    }
  
  </style>
<div class="container">
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
<section id="about" class="about" style="">
  <div>
    <h4 class="text-center text-success"><i class="bx bxs-news bx-md"></i>Spend a few seconds reading our latest news, you may find yourself in love for others...</h4>
  </div>
  <hr class="text-success">
  
      
    
       @foreach($news as $article)
      <div class="container">
       
        <div class="row my-2 d-flex justify-content-center">
          <?php $on = new Carbon\Carbon(new DateTime($article->created_at));
                      $formatted = $on->toDayDateTimeString(); ?>
          <div class="col-lg-6 text-center">
            <a href="{{url('read-news',$article->id)}}"><img class="img-fluid" src="{{ asset('uploads/news-pictures') }}/{{ $article->picture}}" class="img-fluid" style="border-radius:30px;" width="500"></a>
            
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content">
            <a  href="{{url('read-news',$article->id)}}"><h3 >{{$article->heading}}</h3></a>
            
            <p class="fst-italic">
              {{-- {{$article->body}} --}}
              <div id="author-date" class="row d-flex justify-content-md-between">
                <p class="col-md-6 fw-bold text-primary"><span class="badge bg-danger">By:</span><a href="">{{$article->author->name}}</a></p>
                <p class="col-md-6 text-info">{{$formatted}}</p>
            
                @if(mb_detect_encoding($article->body) == 'UTF-8')
                {{$st = mb_substr($article->body,0,100,'UTF-8')}}
                <p>{{$st}} ...</p>
                @else
                <p>{{substr($article->body,0,100)}} ...</p>
                @endif

              </div>
              <div class="text-center col"><a href="{{url('read-news',$article->id)}}" class="btn btn-primary col-sm-6 read-more d-inline"><i class="bx bxs-book-reader mx-1"></i>Read all</a></div>
              
            </p>
          </div>
        </div>
        <hr class="text-success">
        

      </div>
      @endforeach
      <div class="row d-flex justify-content-center">

        <div class="col-md-6">
           {{$news->links('pagination::bootstrap-5')}}
        </div>
        
      </div>

     
     
    </section>
    </div>
    @endsection