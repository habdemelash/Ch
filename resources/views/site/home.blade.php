@extends('layouts.site',['myevents'=>$myevents])
@section('search')
<div class="container-fluid">
                  <form class="d-flex">
                    <input class="form-control" type="search" placeholder="@lang('home.search_place')" aria-label="Search">
                    <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
                  </form>
                </div>


@endsection
@section('search')



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
          <h1>@lang('home.we_strive')</h1>
           <h2>

            @lang('home.volunteering_is') – <strong>@lang('home.french')</strong></h2>
         <div class="d-flex">
            @guest
            <a href="{{route('joinus')}}" class="btn-get-started scrollto"> @lang('home.join_btn') </a>
            @endguest
            @auth
             <a href="{{route('logout')}}" class="btn-get-started bg-danger "><i class="bx bxs-log-out"></i> @lang('home.logout')</a>
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
    <h4 class="text-center text-success"><i class="bx bxs-news bx-md"></i>@lang('home.spend_afew')</h4>
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
              <div class="text-center col"><a href="{{url('read-news',$article->id)}}" class="btn btn-primary col-sm-6 read-more d-inline"><i class="bx bxs-book-reader mx-1"></i>@lang('home.read_more')</a></div>
              
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