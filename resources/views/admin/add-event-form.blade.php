 @extends('layouts.admin')

 @section('content')
 <link rel="stylesheet" type="text/css" href="{{asset('admin/other/toastr.min.css')}}">

     <div class="row d-flex justify-content-center">
     	<form action="{{ route('admin.event.add') }}" method="POST" enctype="multipart/form-data">
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
  <input type="text" class="form-control" name="title" value="{{old('title')}}">
  <label for="title">Title</label>
</div>

<div class="form-floating mb-3 col-md-4 my-1">
  <input type="number" class="form-control" name="needed_vols"  value="{{old('needed_vols')}}">
  <label for="needed_vols">Number of needed volunteers</label>
</div>
<div class="form-floating col-md-2 my-1">
  <input type="time" class="form-control" name="start_time" placeholder="">
  <label for="start_time">Starting time</label>
</div>
<div class="form-floating col-md-2 my-1">
  <input type="time" class="form-control" name="end_time" placeholder="">
  <label for="end_time">Ends at time</label>
</div>
<div class="form-floating col-md-8 my-1">
  <input type="text" class="form-control" name="short_desc" >
  <label for="short_desc">Short Description</label>
</div>



<div class="form-floating col-md-4 my-1">
  <input type="date" class="form-control" name="due_date" placeholder="" min="05/01/2022">
  <label for="due_date">Date</label>
</div>

<div class="form-floating col-md-4 my-1">
  <input type="text" class="form-control" name="location" placeholder="">
  <label for="location">Location</label>
</div>
<div class="form-floating my-1 col-md-8">
  <textarea class="form-control"  name="details" style="height: 100px;"></textarea>
  <label for="details">Details</label>
</div>


<div class="col-md-8 my-1 justify-content-start mx-1 d-flex flex-wrap my-1">
	<label class="col-md-2" for="">Picture</label>
  <input class="col-md-10" type="file" class="form-control-lg"  name="picture"><span class="text-primary">Add a good picture to motivate volunteers...</span>
  
</div>


      			
      		</div>	
   
      </div>
      <div class="text-center mt-2 mb-5">
      
        <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">Save</i></button>
        </form>
     </div>
     <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('admin/other/toastr.min.js') }}"></script>
  <script >
    @if(Session::has('message'))
    toastr.success("{{Session::get('message')}}");

    @endif
  </script>
 @endsection