@extends('layouts.admin')


@section('content')

<style >
	.act{
		text-decoration: none;
	}
	.act:hover{
		text-decoration: none;
	}

	.single-definition{
		border: solid;
		padding: 10px;
		border-radius: 10px;
		border-color: green;
        border-width: 0.5px;
		margin-top: 10px;
	}
</style>
<div class="row d-flex justify-content-center">

	<div class="col-md-6">
		<strong class="mx-2"><a href="{{route('admin.helpmes')}}"><i class="bx bx-arrow-back"></i> Back</a> to the list</strong><h1 class="h3 mb-3"><strong>Application from  <span class="text-info">{{$helpme->phone}}</span></strong></h1></div>
	<div class="col-md-6"><span class="badge bg-info">Status:</span><span class="fw-bold">{{$helpme->status}}</span>
		@if($helpme->status == 'Pending')
		<a href="{{url('dash/helpmes/accept',$helpme->id)}}" class="btn-success btn-sm mx-1 act"><i class="bx bxs-check-circle"></i> Accept</a>
		<a href="{{url('dash/helpmes/reject',$helpme->id)}}" class="btn-sm btn-danger mx-1 act"><i class="bx bxs-shield-x"></i> Reject</a>
		@elseif($helpme->status == 'Accepted')

		<a href="{{url('dash/helpmes/reject',$helpme->id)}}" class="btn-sm btn-danger mx-1 act"><i class="bx bxs-shield-x"></i> Re-reject</a>
		@elseif($helpme->status == 'Rejected')
		<a href="{{url('dash/helpmes/accept',$helpme->id)}}" class="btn-success btn-sm mx-1 act"><i class="bx bxs-check-circle"></i> Re-accept</a>
		@endif
		<a href="{{url('dash/helpmes/remove',$helpme->id)}}" class="btn-sm btn-danger mx-1 act"><i class="bx bxs-trash"></i> Remove</a>
	</div>
</div>
 

<div class="container">
	   
            <div class="section-top-border">
                <h3 class="mb-30 title_color">Applicant Informations</h3>

                <div class="row">
                    <div class="col-md-4">
                        <div class="single-definition">
                            <h4 class="mb-20">Applicant name</h4>
                            <p>{{$helpme->name}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-definition">
                            <h4 class="mb-20">Address</h4>
                            <p>{{$helpme->address}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-definition">
                            <h4 class="mb-20">Subject</h4>
                            <p>{{$helpme->problem_title}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-definition">
                            <h4 class="mb-20">Email</h4>
                            <p>{{$helpme->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="text-success">
            <div class="section-top-border single-definition">
                <h3 class="mb-30 title_color">Problem details and helping mechanisms</h3>
                <div class="row">
                    <div class="col-lg-12 ">
                        <blockquote class="generic-blockquote">
                            “{{$helpme->problem_details}}” 
                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="section-top-border single-definition">
                <h3 class="mb-30 title_color text-center">Supplied documents</h3>
                <div class="row d-flex justify-content-center">
       			@foreach($docs as $doc)
                     <div class="col-md-4">
                        <a href="{{asset('uploads/helpme-pictures')}}/{{$doc->document}}" class="img-gal"><div><img src="{{asset('uploads/helpme-pictures')}}/{{$doc->document}}" alt="" class="img-fluid"></div></a>
                    </div>
                   @endforeach
                    
                  
                   
            
                </div>
            </div>
		

	
</div>

                    	     
 @endsection