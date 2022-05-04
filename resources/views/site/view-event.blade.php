 @extends('layouts.site',['myevents'=>$myevents,'myEventsList'=>$myEventsList])

<div class="container" style="margin-top: 130px;">
 @section('content')
 <link rel="stylesheet" type="text/css" href="{{asset('admin/other/toastr.min.css')}}">
<div class="d-flex align-items-center">
 <?php $members = App\Http\Controllers\Site\Home::howManyJoined($event->id); ?>  
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center" style="text-align: center;">
        	
          <h3>{{$event->title}}</h3>
          <h2>{{$event->short_desc}}</h2>
          <p class="text-dark text-muted">{{$event->details}}</p>
          <p class="text-success"> We need <strong class="text-danger"><?php echo($event->needed_vols);?></strong> volunteers</p>
              	<p class="text-success"> <strong class="text-primary fw-bold"><?php echo($members);?></strong> volunteer(s) joined 
                @if($members>=$event->needed_vols)
                <span class="badge bg-danger">Full</span>
                @endif
                </p>
                
                <strong>Status: 
                  @if($event->status == 'Upcoming')
                  <span class="badge bg-info">{{$event->status}}</span> 
                  @elseif($event->status == 'Past')
                  <span class="badge bg-dark">{{$event->status}}</span> 
                  @else
                  <span class="badge bg-danger">{{$event->status}}</span> 
                  @endif
                </strong>
                 <?php $on = new Carbon\Carbon(new DateTime($event->due_date));
              $start = new Carbon\Carbon(new DateTime($event->start_time));
              $end = new Carbon\Carbon(new DateTime($event->end_time));
              $st = $start->format('g:i A');
              $en = $end->format('g:i A');?>
          <div class="justify-content-center" style="text-align: center;">
          	<div><?php $c = new Carbon\Carbon( new DateTime($event->due_date));
                 $c2 = $c->toFormattedDateString();
                ?>

                 <strong class="text-primary">Date:<span class="text-info">{{$c2}}</span></strong></div>
          	<div><strong class="text-primary">Location:<span class="text-info">{{$event->location}}</span></strong></div>
          	<div><strong class="text-primary">Starting time:<span class="text-info">{{$st}}</span></strong></div>
          	<div><strong class="text-primary">Ending time:<span class="text-info">{{$en}}</span></strong></div>
           @if(!in_array($event->id, $myEventsList))
              <div class="mt-3">
                @if($event->status == 'Upcoming' and $members<$event->needed_vols)
                <a href="{{url('join-event',$event->id)}}" class="fancy fw-bold" style="margin-top: 15px;" ><i class="bi-person-plus mx-1" style="font-size:20px;"></i> Join this event</a>
                @else
                <a class="fancy fw-bold fw-bold" href="" style="margin-top: 15px;pointer-events: none; background-color: red;">You can't join this</a>
                 <br>
                @endif
              </div>
              @else
              <div class="mt-3">
               
                 <a class="leave-btn fw-bold" href="{{url('leave-event',$event->id)}}" style="margin-top: 15px;"><i class="bi-x-lg mx-1" style="font-size:20px;"></i>Leave this event</a>
                 <br>

                 
              </div>

              @endif           
              
           
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="{{asset('uploads/event-pictures')}}/{{$event->picture}}" class="img-fluid rounded animated" alt="">
          @if(in_array($event->id, $myEventsList))
            <span id="yours-tag" class="col-3 badge bg-danger my-3">Your event</span>
             
            @endif
        </div>
      </div>
       <hr class="text-success" style="height: 2px;">
    </div>

</div>
</div>
<script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
  @if(Session::has('message'))
  <script type="text/javascript">
    toastr.success("{{Session::get('message')}}");
  </script>
  @endif

  @endsection