 @extends('layouts.admin')


 @section('content')

     <div class="row d-flex justify-content-center">
     	<h3>Update this News</h3>
     	<form action="{{ url('dash/news/update',$news->id) }}" method="POST" enctype="multipart/form-data">
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
						<i class="bx bx-check bx-md mt-1">{{session()->get('message')}} </i><br><strong><a href="{{route('admin.news')}}" style="text-decoration: none;">go back</a> </strong> to the list or you can add more events here...
					</div>

					@endif

  <div class="form-floating mb-3 col-md-4 my-1">
  <input type="text" class="form-control" name="heading" value="{{$news->heading}}">
  <label for="title" class="text-danger fw-bold">Heading</label>
  <div class="col justify-content-start mx-1 d-flex flex-wrap my-1">
	<label class="col-md-2 text-danger fw-bold" for="picture">Picture</label>
  <input class="col-md-10" type="file" class="form-control-lg"  name="picture"><span class="text-primary">Add a good picture of your article to grab readers' attention...</span>

	
  <img class="rounded-circle col-md-4" src="{{asset('uploads/news-pictures')}}/{{$news->picture}}" alt="No picture" style="height: 80px; width: 80px;">
  
</div>
</div>

<div class="form-floating my-1 col-md-8">
  <textarea class="form-control"  name="body" style="height: 200px;">{{$news->body}}</textarea>
  <label for="details" class="text-danger fw-bold">Body</label>
</div>




      			
  </div>
      	

      		
      	
   
      </div>
      <div class="text-center mt-2 mb-5">
      
        <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">Save</i></button>
        </form>
     </div>
 @endsection