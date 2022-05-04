@extends('layouts.admin')

@section('content')

<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 order-md-1 order-last">
                <h3>You can have details of volunteers who have joinded this event.</h3>
                <p class="text-subtitle text-muted">Use this information only for good cause and volunteering. Thanks!<strong>&nbsp;<a href="{{route('admin.events')}}">Back</a> &nbsp;</strong>  to the event list?</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
               
            </div>
        </div>

    </div>
    <section class="tasks">
        <div class="row">
            <div class="col">
                <div class="card widget-todo">
                    
                    <div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">All volunteers of this event... </h4>
      </div>
      <div class="card-content">
      	<?php
            $users = App\Http\Controllers\Site\Home::listJoindeVolunteers($event);
            ?>
              
        @if($users == null)

        <div class="alert alert-danger"> No one has joined this event so far!</div>

        @endif
        <div class="table-responsive table-secondary">
          <table class="table table-bordered mb-0">
            <thead>
              <tr>
                <th><i class="bx bxs-user text-success text-nowrap" style="font-size: 25px;">Name</i></th>
                <th><i class="bx bxs-phone  text-danger text-nowrap" style="font-size: 25px;"> Phone</i></th>
                <th><i class="bx bxs-map  text-primary text-nowrap" style="font-size: 25px;">Address</i></th>
                <th><i class="bx bxs-envelope  text-info text-nowrap" style="font-size: 25px;"> E-mail</i></th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                <td class="text-success" style="font-weight: 600;">{{$user->name}}</td>
                <td class="text-danger">{{$user->phone}}</td>
                <td class="text-primary">{{$user->address}}</td>
                
                <td class="text-info">{{$user->email}}</td>
              </tr>
              @endforeach
              
            </tbody>
          </table>

        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-6 my-3">
             {{$users->links('pagination::bootstrap-5')}}
          </div>
         
        </div>
      </div>
    </div>
  </div>
</div>
                    
                </div>
            </div>

@endsection