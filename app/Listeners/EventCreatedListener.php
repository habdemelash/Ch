<?php

namespace App\Listeners;

use App\Events\EventCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Event;
use App\Models\User;
use App\Models\Message;

class EventCreatedListener
{
    /**
     * 
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EventCreated  $event
     * @return void
     */
    public function handle(EventCreated $event)
    {
     $users = User::all();
    $content = '';
    
     foreach($users as $user){
         $locale = $user->locale;
        if($locale == 'am'){
            $content = 'ሰምተዋል? አዲስ መርኃ ግብር ተዘጋጅቷል።'.$event->event->{'title_'.$locale}.' '.__('home.location').': '.$event->event->{'location_'.$locale}.' '."<a href='".'http://127.0.0.1:8000/events/view/'.$event->event->id."'>-".__('home.view')."</a>";
        }
        elseif($locale == 'or'){
            $content = 'Dhageessanii beektuu? Sagantaan haaraan beellamamee jira.'.$event->event->{'title_'.$locale}.' '.__('home.location').': '.$event->event->{'location_'.$locale}.' '."<a href='".'http://127.0.0.1:8000/events/view/'.$event->event->id."'>-".__('home.view')."</a>";
        }
        else{
            $content = 'Have you heard? A new event has been scheduled.'.$event->event->{'title_'.$locale}.' '.__('home.location').': '.$event->event->{'location_'.$locale}.' '."<a href='".'http://127.0.0.1:8000/events/view/'.$event->event->id."'>-".__('home.view')."</a>";
        }
        $welcome = Message::create([

            'content'=>$content,
            'receiver'=>$user->id,
            'sender'=>$user->id,

        ]);


     }

        
    }
}
