<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;

class TimeFormatter extends Controller
{
    // $formatted = (new Carbon\Carbon(new DateTime($event->due_date)))->toFormattedDateString();
    // $start = (new Carbon\Carbon(new DateTime($event->start_time)))->format('g:i A');
    // $end = (new Carbon\Carbon(new DateTime($event->end_time)))->format('g:i A');
    // if (app()->getLocale() == 'am') {
    //     $formatted = (new Andegna\DateTime(new DateTime($event->due_date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART);
    //     $start = Andegna\DateTimeFactory::fromDateTime(new DateTime($event->start_time))->format('g:i A');
    //     $end = Andegna\DateTimeFactory::fromDateTime(new DateTime($event->end_time))->format('g:i A');
    // } elseif (app()->getLocale() == 'or') {
    //     $formatted = App\Http\Controllers\Admin\Dashboard::oromicDate((new Andegna\DateTime(new DateTime($event->due_date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART));
    //     $start = App\Http\Controllers\Admin\Dashboard::oromicTime(Andegna\DateTimeFactory::fromDateTime(new DateTime($event->start_time))->format('g:i A'));
    //     $end = App\Http\Controllers\Admin\Dashboard::oromicTime(Andegna\DateTimeFactory::fromDateTime(new DateTime($event->end_time))->format('g:i A'));
    // }
    // echo $formatted;

    public static function timeLocal($time)
    {
        if (app()->getLocale() == 'am') {  
            return \Andegna\DateTimeFactory::fromDateTime(new DateTime($time))->format('g:i A');
        } elseif (app()->getLocale() == 'or') {
            
            return \App\Http\Controllers\Admin\Dashboard::oromicTime(\Andegna\DateTimeFactory::fromDateTime(new DateTime($time))->format('g:i A'));
        }
        return $time;
       
    }
    public static function eventDateLocal($date)
    {
        
                                         
        if (app()->getLocale() == 'am') {
            return (new \Andegna\DateTime(new DateTime($date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART);
           
        } elseif (app()->getLocale() == 'or') {
            return \App\Http\Controllers\Admin\Dashboard::oromicDate((new \Andegna\DateTime(new DateTime($date)))->format(\Andegna\Constants::DATE_ETHIOPIAN_PART));
            
        }
        return (new \Carbon\Carbon(new DateTime($date)))->toFormattedDateString();
        // return  TimeFormatter::englishDateTime($date);
    }
    public static function fullDateTime($datetime)
    {
         $on = new \Carbon\Carbon(new DateTime($datetime));
         if (app()->getLocale() == 'am') {
            return (new \Andegna\DateTime(new DateTime($datetime)))->format(\Andegna\Constants::DATE_ETHIOPIAN);
           
        } elseif (app()->getLocale() == 'or') {
            return \App\Http\Controllers\Admin\Dashboard::oromicDate((new \Andegna\DateTime(new DateTime($datetime)))->format(\Andegna\Constants::DATE_ETHIOPIAN));
            
        }
        return $on->toDayDateTimeString();
        
    }

}
