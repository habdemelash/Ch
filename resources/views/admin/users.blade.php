@extends('layouts.admin')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('admin/other/toastr.min.css')}}">

<h1 class="h3 mb-3"><strong>Users'</strong> Management</h1>
<div class="row d-flex mt-3 justify-content-center">
	
	<div class="container">
		        		

	</div>

</div>
					@if(session()->has('message'))
					<script>
						toastr.success("{{'Done'}}");
					</script>

					@endif

                    <div class="" style="overflow-x: auto;">
                    	<table class="table table-hover my-0 table-responsive" id="eventsTable">
									<thead>
										<tr >
										
											<th class=" d-xl-table-cell"> Name</th>
											<th class=" d-xl-table-cell"> Phone</th>
											<th class=" d-xl-table-cell"> Email</th>
											<th class=" d-xl-table-cell"> Address</th>
										
											<th class=" d-md-table-cell text-center">Roles</th>
											<th class=" d-md-table-cell">Photo</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										@foreach($users as $user)
										<tr id="uid{{$user->id}}">

										<?php $roleList = App\Http\Controllers\Admin\Dashboard::userRoles($user->id); ?>
							
											
											<td class="text-dark" style="font-style: initial;">{{ $user->name }}</td>
											<td class=" d-xl-table-cell text-info">{{ $user->phone }}</td>
											
											
											<td>{{ $user->email }}</td>
											<td>{{ $user->address }}

											</td>
											<td>
												<div class="col d-flex flex-column">
													@if(in_array('Volunteer',$roleList))
													<a class="btn btn-sm btn-success my-1"  style="text-align: left;"><span><i class="bi bi-check-circle"></i> Volunteer</span></a>
													@else
													<a class="btn btn-sm btn-danger my-1" href="" style="text-align: left;"><span><i class="bi bi-circle"></i> Volunteer</span></a>

													@endif
													@if(in_array('Staff',$roleList))
													<a class="btn btn-sm btn-success my-1" href="{{url('dash/users/staffdown',$user->id)}}" style="text-align: left;"><span><i class="bi bi-check-circle"></i> Staff</span></a>
													@else
													<a class="btn btn-sm btn-danger my-1" href="{{url('dash/users/staffup',$user->id)}}" style="text-align: left;"><span><i class="bi bi-circle"></i> Staff</span></a>

													@endif
													@if(in_array('Admin',$roleList))
													<a class="btn btn-sm btn-success my-1" href="{{url('dash/users/admindown',$user->id)}}" style="text-align: left;"><span><i class="bi bi-check-circle"></i> Admin</span></a>
													@else
													<a class="btn btn-sm btn-danger my-1" href="{{url('dash/users/adminup',$user->id)}}" style="text-align: left;"><span><i class="bi bi-circle"></i> Admin</span></a>

													@endif



													
												
												</div>

											</td>
											<td>


												@if($user->profile_photo_path == null)
									                <img class="img-thumbnail rounded-circle" height="50" width="50" src="{{asset('site/assets/img/user.png')}}" >
									                @else
									          <img class="img-thumbnail rounded-circle" height="50" width="50" src="{{asset('uploads/profile-photos')}}/{{$user->profile_photo_path}}" alt="">
									           @endif





												</td>
											<td class="">
												<button value="{{$user->id}}" type="button" class="btn deleteUser" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bx bxs-trash bx-md text-danger"></i>
												  
												</button>
												
												




			
											
											</td>
										</tr>
										@endforeach
										
										
									</tbody>
					</table>

                    	
                    </div>
				   <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				  	<form action="{{url('/users/delete')}}" method="POST">
				  		@csrf
				  		  <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title text-danger" id="exampleModalLabel">Delete User</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
				      <div class="modal-body">
				        <input type="hidden" name="user_id" id="user_id" >
				        <p class="fw-bold">Do you really want to delete this user?</p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
				        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes, delete</button>
				      </div>
				    </div>
				  	</form>
				  
				  </div>
				</div>



                    <!-- Modal -->

                    <div class="row">
                    	<div class="col-sm-6 mt-3 mb-lg-5">
                    <strong>{{ $users->links('pagination::bootstrap-5')}}</strong>
                    	</div>
                    	
 @if(Session::has('message'))
 <script >
 	toastr.success("{!! Session::get('message') !!}");
 	
 </script>
	
	@endif
</div>
<script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/other/toastr.min.js') }}"></script>
<script >
	$(document).ready(function(){
		$(document).on('click','.deleteUser',function(e) {
			e.preventDefault();
			var user_id = $(this).val();
			$('#user_id').val(user_id);
			$('#deleteModal').modal('show');
		});
	});
	
</script>

	<script>
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>


	@if(Session::has('message'))
 <script >
 	toastr.success("{!! Session::get('message') !!}");
 	
 </script>
	
	@endif


	@if(Session::has('error'))
 <script >
 	toastr.error("{!! Session::get('info') !!}");
 	
 </script>
	
	@endif




	<script src="{{ asset('admin/other/toastr.min.js') }}"></script>
	


@endsection