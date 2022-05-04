@extends('layouts.admin')


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
                    	
 @if(Session::has('message'))
 <script >
 	toastr.success("{!! Session::get('message') !!}");
 	
 </script>
	
	@endif
</div>
<script >

</script>
                    	     
 @endsection