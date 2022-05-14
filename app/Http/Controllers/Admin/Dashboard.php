<?php

namespace App\Http\Controllers\admin;
use Carbon\Carbon;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Event;
use App\Models\News;
use App\Models\User;
use App\Models\Helpme;
use App\Models\Docs;



//and even more


class Dashboard extends Controller
{
    public static function oromicDate($month)
    {

    $amh = ["ጠዋት","ቀን","ሌሊት","መስከረም", "ጥቅምት", "ኅዳር","ታኅሣሥ","ጥር","የካቲት","መጋቢት","ሚያዝያ","ግንቦት","ሰኔ","ሐምሌ","ነሐሴ","ጳጉሜን"];
    $or   = ["Ganama","Guyyaa", "Galgala","Fuulbana", "Onkololeessa", "Sadaasa","Muddee","Amajjii","Guraandhala","Bitooteessa","Elba","Caamsa","Waxabajji","Adooleessa","Hagayya","Qaammee"];

    return str_replace($amh, $or, $month);
    }
    public static function oromicTime($month)
    { 

    $amh = ["ጠዋት","ቀን","ሌሊት"];
    $or   = ["Ganama","Guyyaa", "Galgala"];

    return str_replace($amh, $or, $month);
    }
    public static  function backToLocalTime($time)
    {  
        $am = ["ቀን","ማታ"];
        $or   = ["Gu", "Ga"];
        $en  = ["AM", "PM"];

         if(app()->getLocale() == 'am')
         {
            return str_replace($en, $am, $time);
         }
         elseif(app()->getLocale() == 'or')
         {
            return str_replace($en, $or, $time);
         }
         else
         {
            return $time;
         }   
    }
   

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
         
    	$events = Event::orderBy('created_at','DESC')->paginate(8);

    	return view('admin.events',['events'=>$events]);
    }
    public function addEventView()
    {
        return view('admin.add-event-form');
    	
    	
    }
    public function addEvent(Request $request)
    {
        $locale = app()->getLocale();
        $validated = $request->validate([
            'title_am' => ['required_without_all:title_or,title_en', 'sometimes:string', 'max:255'],
            'title_or' => ['required_without_all:title_am,title_en', 'string', 'max:255'],
            'title_en' => ['required_without_all:title_am,title_en', 'string', 'max:255'],
            'location_am' => ['required_without_all:location_or,location_en', 'string', 'max:255'],
            'location_or' => ['required', 'string', 'max:255'],
            'location_en' => ['required', 'string', 'max:255'],
            'short_desc_am' => ['required', 'string', 'max:500','min:1'],
            'short_desc_or' => ['required', 'string', 'max:500','min:1'],
            'short_desc_en' => ['required', 'string', 'max:500','min:1'],
            'details_am' => ['required', 'string', 'max:1024','min:3'],
            'details_or' => ['required', 'string', 'max:1024','min:3'],
            'details_en' => ['required', 'string', 'max:1024','min:3'],
            'due_date' => ['required', 'date', 'max:20'],
            'needed_vols' => ['required', 'integer', 'min:1'],
            'picture' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            
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
    
        $event->needed_vols = $request->needed_vols;
        $event->due_date = $request->due_date;
         if ($locale == 'am' || $locale == 'or') 
        {
        $arr = explode('-',$request->due_date);
        $event->due_date = (\Andegna\DateTimeFactory::of($arr[0],$arr[1],$arr[2]))->toGregorian()->format('Y-m-d');              
        }
         


        $amor   = ["ቀን","ማታ","Guyyaa","Galgala"];
        $en   = ["AM","PM","AM","PM"];
        $event->start_time = str_replace($amor,$en,$request->start_time);
        $event->end_time = str_replace($amor,$en,$request->end_time);
        foreach (config('app.available_locales') as $locale) 
        {
        
        $event->{'title_'.$locale} = $request->{'title_'.$locale};
        $event->{'short_desc_'.$locale} = $request->{'short_desc_'.$locale};
        $event->{'details_'.$locale} = $request->{'details_'.$locale};
            
        $event->{'location_'.$locale} = $request->{'location_'.$locale};
        }
   
        $event->save();
         
         return redirect()->back()->with('message',__('home.event_added'));
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
        $event = Event::find($id);
        $locale = app()->getLocale();
        $validated = $request->validate([
            'title_am' => ['required', 'string', 'max:255'],
            'title_or' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'location_am' => ['required', 'string', 'max:255'],
            'location_or' => ['required', 'string', 'max:255'],
            'location_en' => ['required', 'string', 'max:255'],
            'short_desc_am' => ['required', 'string', 'max:500','min:1'],
            'short_desc_or' => ['required', 'string', 'max:500','min:1'],
            'short_desc_en' => ['required', 'string', 'max:500','min:1'],
            'details_am' => ['required', 'string', 'max:1024','min:3'],
            'details_or' => ['required', 'string', 'max:1024','min:3'],
            'details_en' => ['required', 'string', 'max:1024','min:3'],
            'due_date' => ['required', 'date', 'max:20'],
            'needed_vols' => ['required', 'integer', 'min:1'],
            'picture' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            
        ]);
        
        if($request->hasFile('picture'))
        {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/event-pictures',$filename);
            $event->picture = $filename;
        }
    
        $event->needed_vols = $request->needed_vols;
        $event->due_date = $request->due_date;
         if ($locale == 'am' || $locale == 'or') 
        {
        $arr = explode('-',$request->due_date);
        $event->due_date = (\Andegna\DateTimeFactory::of($arr[0],$arr[1],$arr[2]))->toGregorian()->format('Y-m-d');              
        }
         


        $amor   = ["ቀን","ማታ","Gu","Ga"];
        $en   = ["AM","PM","AM","PM"];
        $event->start_time = str_replace($amor,$en,$request->start_time);
        $event->end_time = str_replace($amor,$en,$request->end_time);
        foreach (config('app.available_locales') as $locale) 
        {
        
        $event->{'title_'.$locale} = $request->{'title_'.$locale};
        $event->{'short_desc_'.$locale} = $request->{'short_desc_'.$locale};
        $event->{'details_'.$locale} = $request->{'details_'.$locale};
            
        $event->{'location_'.$locale} = $request->{'location_'.$locale};
        }
   
        $event->update();
         
         
        return redirect(route('admin.events'))->with('message',__('home.event_updated'));
    }


    public function deleteEvent(Request $request)
    {
        $event = Event::find($request->event_id);
        $path = 'uploads/event-pictures/'.$event->picture;
            if(File::exists($path))
            {
                File::delete($path);
            }
        $event->delete();
       
        return redirect()->back()->with('message','Event has been deleted!');
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
        $locale = app()->getLocale();
       
        $validated = $request->validate([ 
           
            __('home.heading').'_'.'አማርኛ' => ['required', 'string', 'min:3','max:400'],
            __('home.body').'_'.'አማርኛ'=> ['required', 'string', 'max:10000','min:10'],
            __('home.heading').'_'.'afaan_oromoo' => ['required', 'string', 'min:3','max:400'],
            __('home.body').'_'.'afaan_oromoo' =>['required', 'string', 'max:10000','min:10'],
            __('home.heading').'_'.'english' => ['required', 'string', 'min:3','max:400'],
            __('home.body').'_'.'english' =>['required', 'string', 'max:10000','min:10'],
            
            
        
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
        foreach (config('app.available_locales') as $value => $locale) {
        $news->{'heading_'.$locale} = $request->{'heading_'.$value};
        $news->{'body_'.$locale }= $request->{'body_'.$value};
        $news->author_id = Auth::user()->id;
       
        }
         $news->save();
        
        
        return redirect()->back()->with('message',__('home.news_added'));
        dd($request);

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
        $locale = app()->getLocale();
        $validated = $request->validate([
            'heading_am' => ['required', 'string', 'max:255'],
            'heading_or' => ['required', 'string', 'max:255'],
            'heading_en' => ['required', 'string', 'max:255'],
            
            'body_am' => ['required', 'string', 'max:8024','min:3'],
            'body_or' => ['required', 'string', 'max:8024','min:3'],
            'body_en' => ['required', 'string', 'max:8024','min:3'],
           
            'picture' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            
        ]);
        
        if($request->hasFile('picture'))
        {
            $file = $request->file('picture');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/news-pictures',$filename);
            $news->picture = $filename;
        }
    
       
         


       
        foreach (config('app.available_locales') as $locale) 
        {
        
        $news->{'heading_'.$locale} = $request->{'heading_'.$locale};
        $news->{'body_'.$locale} = $request->{'body_'.$locale};
        }
        $news->update();
        return redirect(route('admin.news'))->with('message',__('home.news_updated'));

    }
    public function deleteNews(Request $request)
    {
       $news = News::find($request->article_id);
       $path = 'uploads/news-pictures/'.$news->picture;
            if(File::exists($path))
            {
                File::delete($path);
            }
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
        $users = User::where('id','!=',Auth::user()->id)->orderBy('id','DESC')->paginate(10);
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

         return redirect()->back()->with('message','You have taken the Admin role from the user.');

    }
    public function deleteUser(Request $request)
    {
        if($request->user_id == Auth::user()->id)
        {
        return redirect()->back()->with('message','Sorry you are logged in!');
        
        }
        else
        {
        $user = User::find($request->user_id);
        $user->delete();
        $path = 'uploads/profile-photos/'.$user->profile_photo_path;
            if(File::exists($path))
            {
                File::delete($path);
            }
         return redirect()->back()->with('message','You have deleted the user.');
            
        }


    }



}
