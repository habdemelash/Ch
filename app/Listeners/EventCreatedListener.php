<?php

namespace App\Listeners;

use App\Events\EventCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Event;
use App\Models\User;
use App\Models\MessageBox;

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

     foreach($users as $user){
        $welcome = MessageBox::create([

            'content'=>'Have you heard? A new event has been scheduled. \n'. $event->event->title.' '.'at '.$event->event->location,
            'receiver'=>$user->id,
            'sender'=>$user->id,

        ]);


     }

        
    }
}
