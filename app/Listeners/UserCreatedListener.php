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
        $welcome = Message::create([

            'content'=>'Welcome to our coalition to good cause. You have joined us for good cause, for making others live and we hope you will stay with us as long as possible----->',
            'receiver'=>$event->user->id,
            'sender'=>$event->user->id,

        ]);

        
    }
}
