@extends('layouts.admin')

@section('content')

<h1 class="h3 mb-3"><strong>Users'</strong> Management</h1>
<div class="row d-flex mt-3 justify-content-center">
	
	<div class="container">
		<div class="row align-items-start justify-content-center">
	
<a href="{{route('admin.event.addform')}}" class="btn btn-success col-2">
 Add new user
</a>



		
	
	
</div>                		

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

										<?php $roleList = App\Http\Controllers\Admin\Dashboard::userRoles($user->id); ?>
							
											
											<td class="text-dark" style="font-style: initial;">{{ $user->name }}</td>
											<td class=" d-xl-table-cell text-info">{{ $user->phone }}</td>
											
											
											<td>{{ $user->email }}</td>
											<td>{{ $user->address }}

											</td>
											<td>
												<div class="col d-flex flex-column">
													@foreach($roleList as $role)
													@if($role->role == 'Volunteer')

													@endif
													

													

													@endforeach
													<a class="btn btn-sm btn-success my-1" href="" style="text-align: left;"><span><i class="bi bi-check-circle"></i> Volunteer</span></a>
													<a class="btn btn-sm btn-danger my-1" href="" style="text-align: left;"><span><i class="bi bi-circle"></i>Staff</span></a>
													<a class="btn btn-sm btn-danger my-1" href="" style="text-align: left;"><span><i class="bi bi-circle"></i>Admin</span></a>
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
												
												<a class="col" href="javascript:void(0)" onclick="deleteEvent({{$user->id}})" class="mx-1"><i class="bx bxs-trash bx-md text-danger"></i></a>
			
											
											</td>
										</tr>
										@endforeach
										
										
									</tbody>
					</table>
                    	
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
	function deleteEvent(id){
		if(confirm("Do you really want to delete this user?")){
			$.ajax({
				url: '/events/delete/'+id,
				type: 'GET',
				data: {
					_token : $("input[name=_token]").val()
				},
				success:function(response)
				{
					$("#eid"+id).remove();
				}
			});
		}
	</script>
	


@endsection