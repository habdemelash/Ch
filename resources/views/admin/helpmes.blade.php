@extends('layouts.admin')


@section('search')


 							<li class="d-flex flex-column flex-md-row">
 								<label class="text-primary fw-bold mx-1 text-center" style="white-space: nowrap;">Search by:</label>
 								<select class="form-select mb-3 select" aria-label=".form-select-lg example" id="searchType" onchange="filterRole();">
								  <option selected>Applicant</option>
								  <option value="1">Subject</option>
								  <option value="2">Date</option>
								  <option value="3">Location</option>
								</select>
								<select class="select form-select mb-3" id="status" disabled style="display: none"  >
								  <option data-searchType="Status" value="1">Pendeing</option>
								  <option data-searchType="Status" value="2">Accepted</option>
								  <option data-searchType="Status" value="3">Rejected</option>
								</select>
						<span id="option-container" style="visibility: hidden; position:absolute;"></span>

                            <div class="container-fluid">
							    <form class="d-flex">
							      <input class="form-control" type="search" placeholder="Search..." aria-label="Search">
							      <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
							    </form>
							  </div>


							  
						
                            
                        </li>


@endsection


@section('content')

 
<h1 class="h3 mb-3"><strong>Help-me Applications</strong> Management</h1>
<div class="row d-flex mt-3 justify-content-center">
	
	<div class="container">
		<div class="row align-items-start justify-content-center">

	
</div>                		

	</div>

</div>
					@if(session()->has('message'))
					<div class="alert alert-success">
						<i class="bx bx-check bx-md">{{session()->get('message')}}</i>
					</div>

					@endif

                    <div class="" style="overflow-x: auto;">

                    	<table class="table table-hover my-0 table-responsive" id="eventsTable">
									<thead>
										<tr>
										
											<th class=" d-xl-table-cell text-primary" > Subject</th>
											<th class=" d-xl-table-cell text-center">Sent by</th>
											<th class=" d-xl-table-cell text-center">Phone</th>
											<th class=" d-xl-table-cell text-danger"> Sent at</th>
											<th class=" d-xl-table-cell"> Location</th>
											<th class=" d-md-table-cell">Related Documents</th>
											<th class=" d-md-table-cell">Status</th>
											<th class=" d-md-table-cell">Chioces</th>
											
										</tr>
									</thead>
									<tbody>
										@foreach($helpmes as $helpme)
										<tr>
											
											<td class="text-info fw-bold" style="font-family: Times New Roman;"> @if($helpme->seen==0) <span class="badge bg-danger">New</span><br> @endif {{$helpme->problem_title}}</td>
											<td class="text-gray-dark">
								                {{$helpme->name}}
								                
								                </td>
								                <td class="text-gray-dark">
								                {{$helpme->phone}}
								                
								                </td>
											<?php $on = new Carbon\Carbon(new DateTime($helpme->created_at));
											$formatted = $on->toDayDateTimeString(); ?>
											<td class="text-dark" >{{$formatted}}</td>
											<td>{{$helpme->address}}</td>


											<td class="text-center"><strong>{{App\Http\Controllers\Admin\Dashboard::howManyDocuments($helpme->id)}}</strong></td>
											<td>@if($helpme->status == 'Pending')

												<span class="badge bg-info">{{$helpme->status}}</span>
												@elseif($helpme->status == 'Accepted')

												<span class="badge bg-success">{{$helpme->status}}</span>

												@elseif($helpme->status == 'Rejected')

												<span class="badge bg-danger">{{$helpme->status}}</span>

												@endif

											</td>
												<td class="d-flex flex-column">
												<a href="{{url('dash/helpmes/view',$helpme->id)}}" class="my-1 text-warning fw-bold">Review</a>
											
												<a href="{{url('dash/helpmes/improve',$helpme->id)}}" class="my-1 text-info fw-bold">Improve</a>
												<a href="{{url('dash/helpmes/remove',$helpme->id)}}" class="my-1 text-danger fw-bold">Remove</a>
												
			
											
											</td>
											
											
											
										</tr>
										@endforeach
										
										
									</tbody>
					</table>
	
                    	
                    </div>
                    <div class="row">
                    	<div class="col-sm-6 mt-3 mb-lg-5">
                    <strong>{{ $helpmes->links('pagination::bootstrap-5')}}</strong>
                   	</div>
  <script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
                  	
 @if(Session::has('message'))
 <script >
 	toastr.success("{!! Session::get('message') !!}");
 	
 </script>	
	@endif
</div>
<script>

    function filterRole(){
      var searchType = $("#searchType").find('option:selected').text();
      if (searchType == 'Status') { // stores searchType
      $("#option-container").children().appendTo("#status"); // moves <option> contained in #option-container back to their <select>
      var toMove = $("#status").children("[data-searchType!='"+searchType+"']"); // selects role elements to move out
      toMove.appendTo("#option-container"); // moves role elements in #option-container
      $("#status").removeAttr("disabled"); // enables select
      document.getElementById("status").style.display = "block";
      }
      else{
      	document.getElementById("status").style.display = "none";

      }
};
</script>
                    	     
 @endsection