<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\News;
use App\Models\User;
use App\Models\Helpme;
use App\Models\Docs;

//and even more


class Dashboard extends Controller
{
    public function index()
    {
    	return view('admin.dashboard');
    }
    public function news()
    {
        $news = News::orderBy('created_at','DESC')->paginate(10);

        return view('admin.news',['news'=>$news]);
    }

    public function events()
    {
         // $this->dateUpdater();
    	$events = Event::orderBy('created_at','DESC')->paginate(8);

    	return view('admin.events',['events'=>$events]);
    }
    public function addEventView()
    {
        return view('admin.add-event-form');
    	
    	
    }
    public function addEvent(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'short_desc' => ['required', 'string', 'max:500','min:1'],
            'details' => ['required', 'string', 'max:1024','min:3'],
            'due_date' => ['required', 'date', 'max:20'],
            'needed_vols' => ['required', 'integer', 'min:1'],
            
        ]);
        $event = new Event();
        if($request->hasFile('picture'))
        {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/event-pictures',$filename);
            $event->picture = $filename;

        }
    $eventDate = new Carbon( new DateTime($request->due_date));
    $today = Carbon::now();
    if($today->greaterThan($eventDate)){
       $difference = $eventDate->diff($today)->format('%a');
       $event->status = 'Past';
    }
        $event->title = $request->title;
        $event->short_desc = $request->short_desc;
        $event->details = $request->details;
        $event->due_date = $request->due_date;
        $event->needed_vols = $request->needed_vols;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->save();
         
         return redirect()->back()->with('message','Event added successfully!');
    }
    public function updateEventView($id)
    {
        $status = ['Upcoming','Past','Cancelled'
        ];
        $event = Event::find($id);
        return view('admin.update-event-form',['event'=>$event,'status'=>$status]);
    }


    public function updateEvent(Request $request,$id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string'],
            'short_desc' => ['required', 'string', 'max:500','min:1'],
            'picture' => [ 'image'],
            'details' => ['required', 'string', 'max:1024','min:3'],
            'due_date' => ['required', 'string', 'max:20'],
            'needed_vols' => ['required', 'integer', 'min:1'],
            
            
        ]);
        $event = Event::find($id);
        if($request->hasFile('picture'))
        {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/event-pictures',$filename);
            $event->picture = $filename;

        }
        $event->title = $request->title;
        $event->status = $request->status;
        if($event->status == 'Cancelled')
        {
            $leave = DB::table('event_user')->where('event_id','=',$id)->delete();
        }
        $event->short_desc = $request->short_desc;
        $event->details = $request->details;
        $event->due_date = $request->due_date;
        $event->needed_vols = $request->needed_vols;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->update();
        return redirect(route('admin.events'))->with('message','Event has been updated successfully!');
    }


    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json(['success'=>'Record has been deleted.']);
        // return redirect(route('admin.events'))->with('message','Event has been deleted!');
    }
    public function viewMembers($id)
    {
       return view('admin.view-joined-volunteers',['event'=>$id]);
    }


public function addNewsForm()
{
    return view('admin.add-news');
}
public function addNews(Request $request)
    {
        $validated = $request->validate([
            'heading' => ['required', 'string', 'min:3','max:400'],
            'body' => ['required', 'string', 'max:10000','min:10'],
            'picture' => ['required','image'],
            
            
        ]);
        $news = new News();
        if($request->hasFile('picture'))
        {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/news-pictures',$filename);
            $news->picture = $filename;

        }
        $news->heading = $request->heading;
        $news->author_id = Auth::user()->id;
        $news->body = $request->body;
        $news->save();
        return redirect()->back()->with('message','News added successfully!');
    }

    // Render news update form for a desired news article
    public function updateNewsForm($id)
    {
        $news = News::find($id);
        return view('admin.update-news',['news'=>$news]);
    }

    // save news update
    public function updateNews(Request $request, $id)
    {
        $news = News::find($id);
        $validated = $request->validate([
            'heading' => ['required', 'string', 'min:3','max:400'],
            'body' => ['required', 'string', 'max:10000','min:1'],
            'picture' => ['image'],
            
            
        ]);
        if($request->hasFile('picture'))
        {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/news-pictures',$filename);
            $news->picture = $filename;

        }
        $news->heading = $request->heading;
        $news->author_id = Auth::user()->id;
        $news->body = $request->body;
        $news->save();
        return redirect()->back()->with('message','News updated successfully!');

    }
    public function deleteNews($id)
    {
       $news = News::find($id);
       $news->delete();
       return redirect()->back()->with('message','News deleted successfully!');


    }
    public static function findAuthor($id)
    {
        return User::find($id);
    }

    public function helpmes()
    {
        $helpmes = Helpme::orderBy('id','DESC')->paginate(5);

        return view('admin.helpmes',['helpmes'=>$helpmes]);
    }
    public static function howManyDocuments($id)
    {
       $helpme = Helpme::find($id);
       $docs = $helpme->documents->count();
       return $docs;
    }
    public function viewHelpme($id)
    {
        $helpme = Helpme::find($id);
         $docs = $helpme->documents;
         $helpme->seen=1;
         $helpme->update();
        return view('admin.view-helpme',['helpme'=>$helpme,'docs'=>$docs]);
    }
     public function acceptHelpme($id)
    {
        $helpme = Helpme::find($id);
        $helpme->status='Accepted';
        $helpme->update();
        return redirect()->back()->with('message','Application has been accepted!');
    }
    public function rejectHelpme($id)
    {
        $helpme = Helpme::find($id);
        $helpme->status='Rejected';
        $helpme->update();
        return redirect()->back()->with('message','Application has been rejected!');
    }
    public function removeHelpme($id)
    {

        $helpme = Helpme::find($id);
        $helpme->delete();
   
        return redirect(route('admin.helpmes'))->with('message','Application has been removed!');
    }
    public function improveHelpme($id)
    {

        $helpme = Helpme::find($id);
        $helpme->seen=1;
         $helpme->update();
   
        return view('admin.improve-helpme',['helpme'=>$helpme]);
    }
    public function updateHelpme(Request $request, $id)
    {
        $helpme = Helpme::find($id);
        $validated = $request->validate([
            'problem_title' => ['required', 'string', 'min:3','max:400'],
            'problem_details' => ['required', 'string', 'max:10000','min:3'],
                  
        ]);
       
        $helpme->problem_title = $request->problem_title;
        $helpme->problem_details = $request->problem_details;
        $helpme->update();
        return redirect()->back()->with('message','Application Improved successfully!');
    }

    public static function countUnseenHelpmes()
    {
        return Helpme::where('seen','=',0)->count();

    }

    public static function unseenHelpmes()
    {
        return Helpme::where('seen','=',0)->paginate(5);

    }

    public function mails()
    {
        return view('admin.mails');
    }
    public function viewMail($id)
    {
        return view('admin.reply');
    }

    public function reply($id)
    {
        return view('admin.mails');
    }
    public function users()
    {
        $users = User::orderBy('id','DESC')->paginate(10);
        return view('admin.users',['users'=>$users]);
    }

    public static function userRoles($id)
    {
        $user = User::find($id);
        $roles = [];
        foreach($user->roles as $r)
        {
            $roles[] = $r->role;
        }
        return $roles;
    }
    public function staffup($id)
    {
        DB::table('role_user')->where('user_id','=',$id)->where('role_id','=',2)->delete();
        DB::table('role_user')->where('user_id','=',$id)->where('role_id','=',1)->delete();
         DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => $id
        ]);
        
         DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => $id
        ]);

         return redirect()->back()->with('success','You have given this user a Staff role.');

    }
    public function staffdown($id)
    {
        DB::table('role_user')->where('user_id','=',$id)->where('role_id','=',2)->delete();
         DB::table('role_user')->where('user_id','=',$id)->where('role_id','=',3)->delete();

         return redirect()->back()->with('success','You have taken the Staff role from the user.');

    }

    public function adminup($id)
    {
        DB::table('role_user')->where('user_id','=',$id)->where('role_id','=',2)->delete();
        DB::table('role_user')->where('user_id','=',$id)->where('role_id','=',1)->delete();
        DB::table('role_user')->where('user_id','=',$id)->where('role_id','=',3)->delete();

        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => $id
        ]);

        
         DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => $id
        ]);
         DB::table('role_user')->insert([
            'role_id' => 3,
            'user_id' => $id
        ]);

         return redirect()->back()->with('success','You have given this user a Admin role.');

    }
    public function admindown($id)
    {
        DB::table('role_user')->where('user_id','=',$id)->where('role_id','=',3)->delete();

         return redirect()->back()->with('success','You have taken the Admin role from the user.');

    }
    public function deleteUser($id)
    {
        User::find($id)->delete();
         return redirect()->back()->with('success','You have deleted the user.');


    }



}
