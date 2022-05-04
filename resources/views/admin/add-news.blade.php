 @extends('layouts.admin')


 @section('content')

     <div class="row d-flex justify-content-center">
     	<form action="{{ route('admin.news.add') }}" method="POST" enctype="multipart/form-data">
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
  <input type="text" class="form-control" name="heading" value="{{old('heading')}}">
  <label for="title">Heading</label>
</div>

<div class="form-floating my-1 col-md-8">
  <textarea class="form-control"  name="body" style="height: 200px;"></textarea>
  <label for="details">Body</label>
</div>

<div class="col-md-8 my-1 justify-content-start mx-1 d-flex flex-wrap my-1">
	<label class="col-md-2" for="">Picture</label>
  <input class="col-md-10" type="file" class="form-control-lg"  name="picture"><span class="text-primary">Add a good picture of your article to grab readers' attention...</span>
  
</div>


      			
      		</div>
      	

      		
      	
   
      </div>
      <div class="text-center mt-2 mb-5">
      
        <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">Save</i></button>
        </form>
     </div>
 @endsection