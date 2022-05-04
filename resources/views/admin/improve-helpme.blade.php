 @extends('layouts.admin')


 @section('content')

     <div class="row d-flex justify-content-center">
     	<h3>Update this News</h3>
     	<form action="{{ url('dash/helpmes/update',$helpme->id) }}" method="POST" enctype="multipart/form-data">
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
						<i class="bx bx-check bx-md mt-1">{{session()->get('message')}} </i><br><strong><a href="{{route('admin.helpmes')}}" style="text-decoration: none;">go back</a> </strong>
					</div>

					@endif

  <div class="form-floating mb-3 col-md-4 my-1">
  <input type="text" class="form-control" name="problem_title" value="{{$helpme->problem_title}}">
  <label for="title" class="text-danger fw-bold">Subject</label>
  
</div>

<div class="form-floating my-1 col-md-8">
  <textarea class="form-control"  name="problem_details" style="height: 200px;">{{$helpme->problem_details}}</textarea>
  <label for="details" class="text-danger fw-bold">Details</label>
</div>
      			
  </div>
      	

      	    	
   
      </div>
      <div class="text-center mt-2 mb-5">
      
        <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">Save</i></button>
        </form>
     </div>
 @endsection