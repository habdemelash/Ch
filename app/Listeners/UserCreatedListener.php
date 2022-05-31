<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UserCreatedListener
{
    /**
     * Create the event listener.
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
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
         $id = $event->user->id;
        if($id == 1)
        {


            $roles = [
                 ['role_id'=>1, 'user_id'=> $id],
                 ['role_id'=>2, 'user_id'=> $id],
                 ['role_id'=>3, 'user_id'=> $id],
    
            ];
            DB::table('role_user')->insert($roles);

        }
        else
        {
             DB::table('role_user')->insert([
            'role_id'=>1,
            'user_id'=>$id
        ]);
        }
        
        $content = '';
        if($event->user->locale == 'am'){
            $content = "ወደ ድርጅታችን እንኳን በደህና መጡ። ከእኛ ጋር የተቀላቀሉት ለበጎ ምክንያት ነው፣ ሌሎችን እንዲኖሩ ለማድረግ በተቻለ መጠን ከእኛ ጋር እንደሚቆዩ ተስፋ እናደርጋለን...";
        }
        elseif($event->user->locale == 'or'){
           $content = "Baga gara dhaabbata keenyaa gara kaayyoo gaariitti dhuftan. Kaayyoo gaariif, namoota biroo jiraachisuuf nutti makamteetta hanga danda'ametti nu bira akka turtan abdii qabna";
        }
        else{
            $content = 'Welcome to our organization to good cause. You have joined us for good cause, for making others live and we hope you will stay with us as long as possible...';

        }

        $welcome = Message::create([

            'content'=>$content,
            'receiver'=>$event->user->id,
            'sender'=>$event->user->id,

        ]);

        
    }
}
