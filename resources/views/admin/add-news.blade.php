 @extends('layouts.admin')


 @section('search')


              <li class="d-flex flex-column flex-md-row">
                <label class="text-primary fw-bold mx-1 text-center" style="white-space: nowrap;">Search by:</label>
                <select class="form-select form-select mb-3" aria-label=".form-select-lg example">
                  <option selected>Heading</option>
                  <option value="1">Author</option>
                  <option value="2">Date</option>
                </select>

                            <div class="container-fluid">
                  <form class="d-flex">
                    <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-success text-nowrap" type="submit"><i class="bi bi-search"></i> Search</button>
                  </form>
                </div>
                            
                        </li>


@endsection


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

  @foreach(config('app.languages') as $locale=>$value) 		
   <div class="form-group mb-3 col-md-4 my-1">
    <label for="heading-{{$locale}}" class="text-primary">Heading-{{strtoupper($value)}}</label>
  <input type="text" id="heading-{{$locale}}" class="form-control" name="heading_{{$locale}}" value="{{old('heading')}}">
  
</div>

<div class="form-group my-1 col-md-8">
  <label for="body-{{$locale}}" class="text-primary">Body-{{strtoupper($value)}}</label>
  <textarea class="form-control" id="body-{{$locale}}" name="body_{{$locale}}" style="height: 200px;"></textarea>
  
</div>
@endforeach








<div class="col-md-8 my-1 justify-content-start mx-1 d-flex flex-wrap my-1">
	<label class="col-md-2" for="pic" style="border: solid; border-width: 0.5px; border-color: gray;padding: 3px; border-radius: 5px;">Click Here</label>
  <input type="file" id="pic" name="picture" class="form-control-lg col-md-10" accept="image/*" onchange="preview(event)" style="display: none;">

  <span class="text-primary">Add a good picture of your article to grab readers' attention...</span>
  
  
</div>

<div style="text-align: center;">
  <img src="{{asset('site/assets/img/digital_22.jpg')}}" alt="" class="img-fluid" style="max-height: 150px" id="output">
</div>
<input type="button" class="btn btn-primary" id="click-input" value="Click here" onclick="document.getElementById('file').click();" />
<label for="click-input" id="file-name">Bla bla</label>
<input type="file" style="display:none;" id="file">
<script>
    inputElement = document.getElementById('file')
    labelElement = document.getElementById('file-name')
    inputElement.onchange = function(event) {
        var path = inputElement.value;
        if (path) {
            labelElement.innerHTML = path.split(/(\\|\/)/g).pop()
        } else {
            labelElement.innerHTML = 'Bla bla'
        } 
    }
</script>

      			
      		</div>
      	

      		
      	
   
      </div>
      <div class="text-center mt-2 mb-5">
      
        <button type="submit" class="btn btn-success"><i class="bx bxs-plus-circle bx-md">Save</i></button>
        </form>
     </div>

  <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/other/toastr.min.js') }}"></script>
@include('admin.scripts')
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