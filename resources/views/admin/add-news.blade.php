 @extends('layouts.admin')


 @section('content')

     <div class="row d-flex justify-content-center">
      <span><strong><a href="{{route('admin.news')}}">Back</a> to the list</strong></span>
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
  <input type="file" name="picture" class="form-control-lg col-md-10" accept="image/*" onchange="preview(event)">

  <span class="text-primary">Add a good picture of your article to grab readers' attention...</span>
  <img src="{{asset('site/assets/img/3dheart.png')}}" alt="" class="img-thumbnail rounded-circle" width="150" height="150" id="output">
  
</div>


      			
      		</div>
      	

      		
      	
   
      </div>
      <div class="text-center mt-2 mb-5">
      
        <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">Save</i></button>
        </form>
     </div>

  <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/other/toastr.min.js') }}"></script>
 @if(Session::has('message'))
 <script >
  toastr.success("{!! Session::get('message') !!}");
  
 </script>
 
  
  @endif
  <script type='text/javascript'>
function preview(event) 
{
 var reader = new FileReader();
 reader.onload = function()
 {
  var output = document.getElementById('output');
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}
</script>
 @endsection