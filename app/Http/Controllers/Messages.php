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

    /**
     * postSendMessage
     *
     * @param Request $request
     */
    public function postSendMessage(Request $request)
    {
        if(!$request->receiver || !$request->message) {
            return;
        }

        $message = new Message();

        $message->sender = Auth::user()->id;

        $message->receiver = $request->receiver;

        if($request->message != '' && $request->message != null && $request->message != 'null')  {

            $message->content = $request->message;
        } else {
            if($request->hasFile("image")) {
                $filename = $this->uploadImage($request);
                $message->image = $filename;
            }
        }
        $message->save();


        // prepare the message object along with the relations to send with the response
        $message = Message::with(['fromUser', 'toUser'])->find($message->id);

       

        return response()->json(['state' => 1, 'message' => $message]);
    }

    /**
     * getOldMessages
     *
     * we will fetch the old messages using the last sent id from the request
     * by querying the created at date
     *
     * @param Request $request
     */
    public function getOldMessages(Request $request)
    {
        if(!$request->old_message_id || !$request->receiver)
            return;

        $message = Message::find($request->old_message_id);

        $previousMessages = $this->getPreviousMessages($request, $message);

        $return = [];

        $noMoreMessages = true;

        if($previousMessages->count() > 0) {

            foreach ($previousMessages as $message) {

                $return[] = view('message-line')->with('message', $message)->render();
            }

            $noMoreMessages = !($this->getPreviousMessages($request, $previousMessages[$previousMessages->count() - 1])->count() > 0);
        }

        return response()->json(['state' => 1, 'messages' => $return, 'no_more_messages' => $noMoreMessages]);
    }

    /**
     * @param Request $request
     * @param $message
     * @return mixed
     */
    private function getPreviousMessages(Request $request, $message)
    {
        $previousMessages = Message::where(function ($query) use ($request, $message) {
            $query->where('sender', Auth::user()->id)
                ->where('receiver', $request->receiver)
                ->where('created_at', '<', $message->created_at);
        })
            ->orWhere(function ($query) use ($request, $message) {
                $query->where('sender', $request->receiver)
                    ->where('receiver', Auth::user()->id)
                    ->where('created_at', '<', $message->created_at);
            })
            ->orderBy('created_at', 'DESC')->limit(10)->get();

        return $previousMessages;
    }

    private function uploadImage($request)
    {
        $file = $request->file('image');
        $filename = md5(uniqid()) . "." . $file->getClientOriginalExtension();

        $file->move(public_path('uploads'), $filename);

        return $filename;
    }
}
