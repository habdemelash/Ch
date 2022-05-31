<?php


namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Messages extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * getLoadLatestMessages
     *
     *
     * @param Request $request
     */

    public function chat()
    {
        $main = Message::first();
        return view("admin.chat",['main'=>$main]);
    }

    public function open( $id)
    {
       
        $latestMessages = Message::where(function($query) use ($id) {
            $query->where('sender', Auth::user()->id)->where('receiver', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('sender', $id)->where('receiver', Auth::user()->id);
        })->orderBy('created_at', 'DESC')->limit(10)->get();
        $return = [];
        foreach ($latestMessages->reverse() as $message) {
            
            $return[] = $message;
           
        }
        return view("admin.chat",['open'=>$return]);
    }
    public function reply(Request $request)
    {

       $message = new Message();
       if(isset($request->message)){
           $message->content = $request->message;
           $message->receiver = $request->receiver;
           $message->sender = Auth::user()->id;
           $message->save();
       }
       return redirect()->back();
    }
}
