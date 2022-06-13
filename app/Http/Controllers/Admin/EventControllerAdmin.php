<?php

namespace App\Http\Controllers\admin;


use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TimeFormatter;


class EventControllerAdmin extends Controller
{

   
    function searchEvent(Request $request)
    { $locale = app()->getLocale();
        $key = $request->input('keyword');
        $events = Event::
        where("title_" . $locale, "LIKE", "%" . $key . "%")
        ->orWhere("short_desc_" . $locale, "LIKE", "%" . $key . "%")
        ->orWhere("id", "LIKE", "%" . $key . "%")
        ->paginate(5);
        // foreach($events as $event){
        //   $event->due_date = TimeFormatter::eventDateLocal($event->due_date);
        //   $event->start_time = TimeFormatter::timeLocal($event->start_time);
        //   $event->end_time = TimeFormatter::timeLocal($event->end_time);
        //   // $event->status = __('home.'.strtolower($event->status));
        // }
        // return json_encode($events);
        return view('admin.events',['events'=>$events]);
    }
}
