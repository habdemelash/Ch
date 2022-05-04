 @extends('layouts.admin')


 @section('content')

     <div class="row d-flex justify-content-center">
     	<form action="{{ url('dash/event/update',$event->id) }}" method="POST" enctype="multipart/form-data">
      		@csrf
      		<div class="row d-flex justify-content-start">
      			@if($errors->any())
      			<div class="alert alert-danger">

      			@foreach($errors->all() as $error)


      			<i class="bx bxs-error"></i>{{$error}}<br>

      			@endforeach
      			</div>
      			@endif
      			@if(session()->has('message'))
					<div class="alert alert-success">
						<i class="bx bx-check bx-md mt-1">{{session()->get('message')}} </i><br><strong><a href="{{route('admin.events')}}" style="text-decoration: none;">go back</a> </strong> to the list or you can add more events here...
					</div>

					@endif

   <div class="form-floating mb-3 col-md-4 my-1">
  <input type="text" class="form-control" name="title" value="{{$event->title}}">
  <label class="text-primary" for="title">Title</label>
</div>

<div class="form-floating mb-3 col-md-4 my-1">
  <input type="number" class="form-control" name="needed_vols"  value="{{$event->needed_vols}}">
  <label class="text-primary" for="needed_vols">Number of needed volunteers</label>
</div>
<div class="form-floating col-md-2 my-1">
  <input type="time" class="form-control" name="start_time" value="{{$event->start_time}}">
  <label class="text-primary" for="start_time">Starting time</label>
</div>
<div class="form-floating col-md-2 my-1">
  <input type="time" class="form-control" name="end_time" value="{{$event->end_time}}">
  <label class="text-primary" for="end_time">Ends at time</label>
</div>
<div class="form-floating col-md-8 my-1">
  <input type="text" class="form-control" name="short_desc" value="{{$event->short_desc}}" >
  <label class="text-primary" for="short_desc">Sort Description</label>
</div>



<div class="form-floating col-md-4 my-1">
  <input type="date" class="form-control" name="due_date" value="{{$event->due_date}}">
  <label class="text-primary" for="due_date">Date</label>
</div>



<div class="col-md-4 my-1">
<div class="form-floating  my-1">
  <input type="text" class="form-control" name="location" value="{{$event->location}}">
  <label class="text-primary"for="location">Location</label>
</div>
<div class="form-floating my-1">
<select class="form-select" name="status">
	
  <option style="font-weight: 800;">{{$event->status}}</option>
  @if($event->status == 'Upcoming')
  <option style="font-weight: 800;">{{$status[1]}}</option>
  <option style="font-weight: 800;">{{$status[2]}}</option>
  @endif
  @if($event->status == 'Past')
  <option  style="font-weight: 800;">{{$status[0]}}</option>
  <option style="font-weight: 800;">{{$status[2]}}</option>
  @endif
  @if($event->status == 'Cancelled')
  <option  style="font-weight: 800;">{{$status[0]}}</option>
  <option  style="font-weight: 800;">{{$status[1]}}</option>
  @endif

  
  
 
</select>
<label class="text-primary" for="status">Status</label>
</div>
</div>

<div class="form-floating my-2 col-md-8">
  <textarea class="form-control"  name="details" style="height: 125px;">{{$event->details}}</textarea>
  <label class="text-primary" for="details">Details</label>
</div>

<div class="text-right">
</div>

<div class="col-md-4 my-1 justify-content-start mx-1 d-flex flex-wrap my-1">

	<label class="text-primary" class="col-md-2" for="">Picture</label>
  <input class="col" type="file" class="form-control-lg"  name="picture">
  <img class="rounded-circle col-md-4" src="{{asset('uploads/event-pictures')}}/{{$event->picture}}" alt="No picture" style="height: 80px; width: 80px;">
  
</div>


      			
      		</div>
      	

      		
      	
   
      </div>
      <div class="text-center mt-2 mb-5">
      
        <button type="submit" class="btn btn-primary"><i class="bx bxs-edit bx-md">Update</i></button>

        </form>

     </div>
 @endsection