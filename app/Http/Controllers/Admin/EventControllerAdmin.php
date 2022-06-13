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
        $request->get('searched');
        $events = Event::where('title_'.$locale, 'like','%'.$request->get('searched').'%')->get();
        foreach($events as $event){
          $event->due_date = TimeFormatter::eventDateLocal($event->due_date);
          $event->start_time = TimeFormatter::timeLocal($event->start_time);
          $event->end_time = TimeFormatter::timeLocal($event->end_time);
        }
        return json_encode($events);
    }
}
