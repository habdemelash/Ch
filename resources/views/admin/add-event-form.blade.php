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
						<i class="bx bx-check bx-md mt-1">{{session()->get('message')}} </i><br><strong><a href="{{route('admin.events')}}" style="text-decoration: none;">{{__('home.go_back')}}</a> </strong> {{__('home.to_the_list')}}
					</div>

					@endif

   <div class="form-floating mb-3 col-md-4 my-1">
  <input type="text" class="form-control" name="title" value="{{old('title')}}">
  <label for="title">{{__('home.title')}}</label>
</div>

<div class="form-floating mb-3 col-md-4 my-1">
  <input type="number" class="form-control" name="needed_vols"  value="{{old('needed_vols')}}">
  <label for="needed_vols">{{__('home.needed_vols')}}</label>
</div>
<div class="form-floating col-md-2 my-1">
  <input type="time" class="form-control" name="start_time" placeholder="">
  <label for="start_time">{{__('home.start_time')}}</label>
</div>
<div class="form-floating col-md-2 my-1">
  <input type="time" class="form-control" name="end_time" placeholder="">
  <label for="end_time">{{__('home.end_time')}}</label>
</div>
<div class="form-floating col-md-8 my-1">
  <input type="text" class="form-control" name="short_desc" >
  <label for="short_desc">{{__('home.short_desc')}}</label>
</div>



<div class="form-floating col-md-4 my-1">
  <input type="date" class="form-control" name="due_date" placeholder="" min="05/01/2022">
  <label for="due_date">{{__('home.date')}}</label>
</div>

<div class="form-floating col-md-4 my-1">
  <input type="text" class="form-control" name="location" placeholder="">
  <label for="location">{{__('home.location')}}</label>
</div>
<div class="form-floating my-1 col-md-8">
  <textarea class="form-control"  name="details" style="height: 100px;"></textarea>
  <label for="details">{{__('home.details')}}</label>
</div>


<div class="col-md-8 my-1 justify-content-start mx-1 d-flex flex-wrap my-1">
	<label class="col-md-2" for="">{{__('home.picture')}}</label>
  <input class="col-md-10" type="file" class="form-control-lg"  name="picture"><span class="text-primary">{{__('home.a_good_pic')}}</span>
  
</div>


      			
      		</div>	
   
      </div>
      <div class="text-center mt-2 mb-5">
      
        <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">{{__('home.save')}}</i></button>
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