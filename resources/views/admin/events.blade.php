@extends('layouts.admin')
@section('search')
<li class="d-flex flex-column flex-md-row">
   <span id="option-container" style="visibility: hidden; position:absolute;"></span>
   <div class="container-fluid">
      <form class="d-flex">
         <input class="form-control" id="searchfield" type="search" placeholder="{{__('home.search_place')}}" aria-label="Search">
         <button class="btn btn-success text-nowrap" type="submit"><i class="bi bi-search"></i> </button>
      </form>
   </div>
</li>
@endsection
@section('content')
@include('admin.styles')
<link rel="stylesheet" type="text/css" href="{{asset('admin/other/toastr.min.css')}}">
<h1 class="h3 mb-3"><strong>{{__('home.events_nav')}}</strong> {{__('home.administration')}}</h1>
<div class="row d-flex mt-3 justify-content-center">
   <div class="container">
      <div class="row align-items-start justify-content-center">
         <a href="{{route('admin.event.addform')}}" class="btn btn-success col-2">
         {{__('home.add_new')}}
         </a>
      </div>
   </div>
</div>
<div class="" style="overflow-x: auto;">
   <table class="table table-hover my-0 table-responsive" id="eventsTable">
      <thead>
         <tr >
            <th>{{__('home.title')}}</th>
            <th class=" d-xl-table-cell text-center"> {{__('home.date')}}</th>
            <th class=" d-xl-table-cell"> {{__('home.start_time')}}</th>
            <th class=" d-xl-table-cell">{{__('home.end_time')}}</th>
            <th class=" d-xl-table-cell"> {{__('home.short_desc')}}</th>
            <th>{{__('home.status')}}</th>
            <th class=" d-md-table-cell">{{__('home.needed_vols')}}</th>
            <th class=" d-md-table-cell">{{__('home.joined_by')}}</th>
            <th>{{__('home.picture')}}</th>
            <th>{{__('home.actions')}}</th>
         </tr>
      </thead>
      <tbody>
         @foreach($events as $event)
         <?php $on = new Carbon\Carbon(new DateTime($event->due_date));
            $start = (new Carbon\Carbon(new DateTime($event->start_time)))->format('g:i A');
            $end = (new Carbon\Carbon(new DateTime($event->end_time)))->format('g:i A');
            $formatted_date = $on->toFormattedDateString();
            if(app()->getLocale() == 'am'){
            	$gregorian = new DateTime($event->due_date);
            $formatted_date = Andegna\DateTimeFactory::fromDateTime($gregorian)->format(\Andegna\Constants::DATE_ETHIOPIAN_PART);
            $start = Andegna\DateTimeFactory::fromDateTime(new DateTime($event->start_time))->format('g:i A');
            $end = Andegna\DateTimeFactory::fromDateTime(new DateTime($event->end_time))->format('g:i A');
            }
            elseif(app()->getLocale() == 'or'){
            $formatted_date = App\Http\Controllers\Admin\Dashboard::oromicDate( (new Andegna\DateTime(new DateTime($event->due_date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART));
            $start = App\Http\Controllers\Admin\Dashboard::oromicTime(Andegna\DateTimeFactory::fromDateTime(new DateTime($event->start_time))->format('g:i A'));
            $end = App\Http\Controllers\Admin\Dashboard::oromicTime(Andegna\DateTimeFactory::fromDateTime(new DateTime($event->end_time))->format('g:i A'));
            }
            ?>
         <tr id="eid{{$event->id}}">
            <?php $members = App\Http\Controllers\Site\Home::howManyJoined($event->id); ?>
            <td class="text-dark" style="font-style: initial;"><?php echo $event->{'title_'.app()->getLocale()}; ?></td>
            <td class=" d-xl-table-cell text-primary" style="white-space: nowrap;">{{ $formatted_date }}</td>
            <td class=" d-xl-table-cell text-primary">{{ $start }}</td>
            <td class="text-primary">{{ $end}}</td>
            <td class=" d-md-table-cell text-dark">{{ $event->short_desc }}</td>
            <td class="">
               @if($event->status == 'Upcoming')
               <span class="badge bg-primary">{{__('home.upcoming')}}</span>
               @elseif($event->status == 'Cancelled')
               <span class="badge bg-danger">{{__('home.cancelled')}}</span>
               @else
               <span class="badge bg-dark">{{__('home.past')}}</span>
               @endif
            </td>
            <td>{{$event->needed_vols}}</td>
            <td>@if($members>= $event->needed_vols)
               <span class="badge bg-danger">{{__('home.full')}}</span><br>
               @endif
               @if($members<1)
               <span class="text-danger">{{__('home.no_one_yet')}}</span>
               @elseif($members == 1)
               <a href="{{url('dash/event/viewmembers',$event->id)}}" style="white-space: nowrap; font-weight: 700">
               {{$members}} {{__('home.vol')}} </a>
               @else
               <a href="{{url('dash/event/viewmembers',$event->id)}}" style="white-space: nowrap; font-weight: 700">
               {{$members}} {{__('home.vols')}} </a>
               @endif
            </td>
            <td><img src="{{ asset('uploads/event-pictures') }}/{{ $event->picture}}" class="rounded-circle rounded me-1" alt="{{__('home.no_pic')}}" style="height: 60px;width: 60px;" /></td>
            <td class="d-flex flex-row">
               <a href="{{url('dash/event/updateform',$event->id)}}" class="mx-1"><i class="bx bxs-edit bx-md"></i></a>
               <button value="{{$event->id}}" type="button" class="btn deleteEvent" data-bs-toggle="modal" data-bs-target="#deleteEventModal"><i class="bx bxs-trash bx-md text-danger"></i>
               </button>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
<div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <form action="{{url('/events/delete')}}" method="POST">
         @csrf
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title text-danger" id="ModalLabel">{{__('home.delete_event')}}</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="event_id" id="event_id" >
               <p class="fw-bold">{{__('home.do_u_delete_event')}}</p>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('home.no')}}</button>
               <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">{{__('home.yes_delete')}}</button>
            </div>
         </div>
      </form>
   </div>
</div>
<div class="row">
   <div class="col-sm-6 mt-3 mb-lg-5">
      <strong>{{ $events->links('pagination::bootstrap-4')}}</strong>
   </div>
</div>
</div>
</div>
</div>
@include('admin.scripts')
<script src="{{ asset('site/assets/js/ec.js') }}"></script>
<script src="{{ asset('admin/other/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/other/toastr.min.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/ethiopian-calendar-date-converter@%5E1" ></script>
<script >
   $(document).ready(function(){
   	$(document).on('click','.deleteEvent',function(e) {
   		e.preventDefault();
   		var event_id = $(this).val();
   		$('#event_id').val(event_id);
   		$('#deleteEventModal').modal('show');
   			// Ethiopian calendar instance
   	});
   });
   
</script>
@if(Session::has('message'))
<script >
   toastr.success("{!! Session::get('message') !!}");
   
</script>
@endif
@endsection