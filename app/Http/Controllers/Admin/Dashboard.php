<?php

namespace App\Http\Controllers\admin;
use DateTime;
use Carbon\Carbon;
use App\Models\News;
use App\Models\Role;
use App\Models\User;
use App\Models\Event;
use App\Models\Helpme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\TimeFormatter;

//and even more

class Dashboard extends Controller
{
    public static function oromicDate($month)
    {
        $amh = [
            "፣",
            "ዓ.ም",
            "እሑድ",
            " ሰኞ",
            "ማክሰኞ",
            "ረቡዕ",
            "ሐሙስ",
            "ዓርብ",
            "ቅዳሜ",
            "ቀን",
            "ማታ",
            "መስከረም",
            "ጥቅምት",
            "ኅዳር",
            "ታኅሣሥ",
            "ጥር",
            "የካቲት",
            "መጋቢት",
            "ሚያዝያ",
            "ግንቦት",
            "ሰኔ",
            "ሐምሌ",
            "ነሐሴ",
            "ጳጉሜን",
        ];
        $or = [
            ",",
            "Bara",
            "Sanbata Gudda",
            "Dafnoo",
            "Facaasaa",
            "Roobii",
            "Kamisa",
            "Jimaata",
            "Sanbata Duraa",
            "Gu",
            "Ga",
            "Fuulbana",
            "Onkololeessa",
            "Sadaasa",
            "Muddee",
            "Amajjii",
            "Guraandhala",
            "Bitooteessa",
            "Elba",
            "Caamsa",
            "Waxabajji",
            "Adooleessa",
            "Hagayya",
            "Qaammee",
        ];
        // dd(explode(" ",str_replace($amh, $or, $month)));
        $pre = explode(" ", str_replace($amh, $or, $month));
        $year = $pre[5];
        $bara = $pre[6];
        $pre[5] = $bara;
        $pre[6] = $year;

        return implode(" ", $pre);
    }
    public static function oromicTime($month)
    {
        $amh = ["ቀን", "ማታ"];
        $or = ["Gu", "Ga"];

        return str_replace($amh, $or, $month);
    }
    public static function backToLocalTime($time)
    {
        $am = ["ቀን", "ማታ"];
        $or = ["Gu", "Ga"];
        $en = ["AM", "PM"];

        if (app()->getLocale() == "am") {
            return str_replace($en, $am, $time);
        } elseif (app()->getLocale() == "or") {
            return str_replace($en, $or, $time);
        } else {
            return $time;
        }
    }
// Dashboard
    public function index()
    {
        $volunteers = Role::find(1)->users->count();
        $staff = Role::find(2)->users->count();
        $admins = Role::find(3)->users->count();
    
        return view("admin.dashboard",['volunteers'=>$volunteers,'staff'=>$staff,'admins'=>$admins]);
    }

    // News
    public function news()
    {
        $news = News::orderBy("created_at", "DESC")->paginate(10);

        return view("admin.news", ["news" => $news]);
    }

    public function events()
    {
        $events = Event::orderBy("created_at", "DESC")->paginate(8);

        return view("admin.events", ["events" => $events]);
    }
    public function addEventView()
    {
        return view("admin.add-event-form");
    }
    public function addEvent(Request $request)
    {
        $locale = app()->getLocale();
        $validated = $request->validate([
           
            "title_am" => [
                "required_without_all:title_or,title_en",
                "sometimes:string",
                "max:255",
            ],
            "title_or" => [
                "required_without_all:title_am,title_en",
                "string",
                "max:255",
            ],
            "title_en" => [
                "required_without_all:title_am,title_en",
                "sometimes:string",
                "max:255",
            ],
            "location_am" => [
                "required_without_all:location_or,location_en",
                "sometimes:string",
                "max:255",
            ],
            "location_or" => [
                "required_without_all:location_en,location_am",
                "sometimes:string",
                "max:255",
            ],
            "location_en" => [
                "required_without_all:location_am,location_or",
                "sometimes:string",
                "max:255",
            ],
            "short_desc_am" => [
                "required_without_all:short_desc_or,short_desc_en",
                "sometimes:string",
                "max:500",
                "min:1",
            ],
            "short_desc_or" => [
                "required_without_all:short_desc_en,short_desc_am",
                "sometimes:string",
                "max:500",
                "min:1",
            ],
            "short_desc_en" => [
                "required_without_all:short_desc_am,short_desc_or",
                "sometimes:string",
                "max:500",
                "min:1",
            ],
            "details_am" => [
                "required_without_all:details_or,details_en",
                "sometimes:string",
                "max:1024",
                "min:3",
            ],
            "details_or" => [
                "required_without_all:details_am.details_en",
                "sometimes:string",
                "max:1024",
                "min:3",
            ],
            "details_en" => [
                "required_without_all:details_am,details_or",
                "sometimes:string",
                "max:1024",
                "min:3",
            ],
            "due_date" => ["required", "date", "max:20"],
            "needed_vols" => ["required", "integer", "min:1"],
            "picture" => "required|image|mimes:jpg,jpeg,png,gif|max:2048",
        ]);

        $event = new Event();
        if ($request->hasFile("picture")) {
            $file = $request->file("picture");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/event-pictures", $filename);
            $event->picture = $filename;
        }

        $event->needed_vols = $request->needed_vols;
        $event->due_date = $request->due_date;
        if ($locale == "am" || $locale == "or") {
            $arr = explode("-", $request->due_date);
            $event->due_date = \Andegna\DateTimeFactory::of(
                $arr[0],
                $arr[1],
                $arr[2]
            )
                ->toGregorian()
                ->format("Y-m-d");
        }

        $amor = ["ቀን", "ማታ", "Gu", "Ga"];
        $en = ["AM", "PM", "AM", "PM"];
        $event->start_time = str_replace($amor, $en, $request->start_time);
        $event->end_time = str_replace($amor, $en, $request->end_time);
        foreach (config("app.available_locales") as $locale) {
            $event->{"title_" . $locale} = $request->{"title_" . $locale};
            $event->{"short_desc_" . $locale} =
                $request->{"short_desc_" . $locale};
            $event->{"details_" . $locale} = $request->{"details_" . $locale};

            $event->{"location_" . $locale} = $request->{"location_" . $locale};
        }

        $event->save();

        return redirect()
            ->back()
            ->with("message", __("home.event_added"));
        // dd($request);
    }
    public function updateEventView($id)
    {
        $status = ["Upcoming", "Past", "Cancelled"];
        $event = Event::find($id);
        return view("admin.update-event-form", [
            "event" => $event,
            "status" => $status,
        ]);
    }

    public function updateEvent(Request $request, $id)
    { 
        // dd($request);
        $event = Event::find($id);
        $locale = app()->getLocale();
        $validated = $request->validate([
            "title_am" => ["required", "string", "max:255"],
            "title_or" => ["required", "string", "max:255"],
            "title_en" => ["required", "string", "max:255"],
            "status" => ["required", "string", "max:255"],
            "location_am" => ["required", "string", "max:255"],
            "location_or" => ["required", "string", "max:255"],
            "location_en" => ["required", "string", "max:255"],
            "short_desc_am" => ["required", "string", "max:500", "min:1"],
            "short_desc_or" => ["required", "string", "max:500", "min:1"],
            "short_desc_en" => ["required", "string", "max:500", "min:1"],
            "details_am" => ["required", "string", "max:1024", "min:3"],
            "details_or" => ["required", "string", "max:1024", "min:3"],
            "details_en" => ["required", "string", "max:1024", "min:3"],
            "due_date" => ["required", "date", "max:20"],
            "needed_vols" => ["required", "integer", "min:1"],
            "picture" => "image|mimes:jpg,jpeg,png,gif|max:2048",
        ]);

        if ($request->hasFile("picture")) {
            $file = $request->file("picture");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/event-pictures", $filename);
            $event->picture = $filename;
        }

        $event->needed_vols = $request->needed_vols;
        $event->status = ucfirst(array_search ($request->status, __('home')));
        $event->due_date = $request->due_date;
        if ($locale == "am" || $locale == "or") {
            $arr = explode("-", $request->due_date);
            $event->due_date = \Andegna\DateTimeFactory::of(
                $arr[0],
                $arr[1],
                $arr[2]
            )
                ->toGregorian()
                ->format("Y-m-d");
        }

        $amor = ["ቀን", "ማታ", "Gu", "Ga"];
        $en = ["AM", "PM", "AM", "PM"];
        $event->start_time = str_replace($amor, $en, $request->start_time);
        $event->end_time = str_replace($amor, $en, $request->end_time);
        foreach (config("app.available_locales") as $locale) {
            $event->{"title_" . $locale} = $request->{"title_" . $locale};
            $event->{"short_desc_" . $locale} =
                $request->{"short_desc_" . $locale};
            $event->{"details_" . $locale} = $request->{"details_" . $locale};

            $event->{"location_" . $locale} = $request->{"location_" . $locale};
        }

        $event->update();

        return redirect(route("admin.events"))->with(
            "message",
            __("home.event_updated")
        );
    }

    public function deleteEvent(Request $request)
    {
        $event = Event::find($request->event_id);
        $path = "uploads/event-pictures/" . $event->picture;
        if (File::exists($path)) {
            File::delete($path);
        }
        $event->delete();

        return redirect()
            ->back()
            ->with("message",__('home.event_deleted'));
    }
    function searchEvent(Request $request)
    { $locale = app()->getLocale();
        $key = $request->input('keyword');
        $events = Event::
        where("title_" . $locale, "LIKE", "%" . $key . "%")
        ->orWhere("short_desc_" . $locale, "LIKE", "%" . $key . "%")
        ->orWhere("id", "LIKE", "%" . $key . "%")
        ->paginate(5);
        
        return view('admin.events',['events'=>$events]);
    }
    //search news
    function searchNews(Request $request)
    { $locale = app()->getLocale();
        $key = $request->input('keyword');
        $news = News::
        where("heading_" . $locale, "LIKE", "%" . $key . "%")
        ->orWhere("body_" . $locale, "LIKE", "%" . $key . "%")
        ->orWhere("id" , "LIKE", "%" . $key . "%")
        ->paginate(5);
        
        return view('admin.news',['news'=>$news]);
        
    }
    //search users
    function searchUsers(Request $request)
    { $locale = app()->getLocale();
        $key = $request->input('keyword');
        $users = User::
        where("name", "LIKE", "%" . $key . "%")
        ->where('id','<>',Auth::user()->id)
        ->orWhere("address", "LIKE", "%" . $key . "%")
        ->orWhere("phone", "LIKE", "%" . $key . "%")
        ->orWhere("email", "LIKE", "%" . $key . "%")
        ->orWhere("id" , "LIKE", "%" . $key . "%")
        ->paginate(5);
        
        return view('admin.users',['users'=>$users]);
        
    }
    function searchHelpmes(Request $request)
    { $locale = app()->getLocale();
        $key = $request->input('keyword');
        $helpmes = Helpme::
        where("name", "LIKE", "%" . $key . "%")
        ->orWhere("address", "LIKE", "%" . $key . "%")
        ->orWhere("phone", "LIKE", "%" . $key . "%")
        ->orWhere("email", "LIKE", "%" . $key . "%")
        ->orWhere("id" , "LIKE", "%" . $key . "%")
        ->paginate(5);
        
        return view('admin.helpmes',['helpmes'=>$helpmes]);
        
    }
    // return members of specific event
    public function viewMembers($id)
    {
        return view("admin.view-joined-volunteers", ["event" => $id]);
    }

    public function addNewsForm()
    {
        return view("admin.add-news");
    }
    public function addNews(Request $request)
    {
        $locale = app()->getLocale();

        $validated = $request->validate([
            "heading_am" => ["required", "string", "min:3", "max:400"],
            "body_am" => ["required", "string", "max:10000", "min:10"],
            "heading_or" => ["required", "string", "min:3", "max:400"],
            "body_or" => ["required", "string", "max:10000", "min:10"],
            "heading_en" => ["required", "string", "min:3", "max:400"],
            "body_en" => ["required", "string", "max:10000", "min:10"],

            __("home.picture") => ["required", "image"],
        ]);
        $news = new News();
        if ($request->hasFile(__("home.picture"))) {
            $file = $request->file(__("home.picture"));
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/news-pictures", $filename);
            $news->picture = $filename;
        }
        foreach (config("app.available_locales") as $value => $locale) {
            $news->{"heading_" . $locale} = $request->{"heading_" . $locale};
            $news->{"body_" . $locale} = $request->{"body_" . $locale};
            $news->author_id = Auth::user()->id;
        }
        $news->save();

        return redirect()
            ->back()
            ->with("message", __("home.news_added"));
        dd($request);
    }

    // Render news update form for a desired news article
    public function updateNewsForm($id)
    {
        $news = News::find($id);
        return view("admin.update-news", ["news" => $news]);
    }

    // save news update
    public function updateNews(Request $request, $id)
    {
        $news = News::find($id);
        $locale = app()->getLocale();
        $validated = $request->validate([
            "heading_am" => ["required", "string", "max:255"],
            "heading_or" => ["required", "string", "max:255"],
            "heading_en" => ["required", "string", "max:255"],

            "body_am" => ["required", "string", "max:8024", "min:3"],
            "body_or" => ["required", "string", "max:8024", "min:3"],
            "body_en" => ["required", "string", "max:8024", "min:3"],

            "picture" => "image|mimes:jpg,jpeg,png,gif|max:2048",
        ]);

        if ($request->hasFile("picture")) {
            $file = $request->file("picture");
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move("uploads/news-pictures", $filename);
            $news->picture = $filename;
        }

        foreach (config("app.available_locales") as $locale) {
            $news->{"heading_" . $locale} = $request->{"heading_" . $locale};
            $news->{"body_" . $locale} = $request->{"body_" . $locale};
        }
        $news->update();
        return redirect(route("admin.news"))->with(
            "message",
            __("home.news_updated")
        );
    }
    public function deleteNews(Request $request)
    {
        $news = News::find($request->article_id);
        $path = "uploads/news-pictures/" . $news->picture;
        if (File::exists($path)) {
            File::delete($path);
        }
        $news->delete();
        return redirect()
            ->back()
            ->with("message", __("home.news_deleted"));
    }
    public static function findAuthor($id)
    {
        return User::find($id);
    }

    public function helpmes()
    {
        $helpmes = Helpme::orderBy("id", "DESC")->paginate(5);

        return view("admin.helpmes", ["helpmes" => $helpmes]);
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
        $helpme->seen = 1;
        $helpme->update();
        
       
        return view("admin.view-helpme", [
            "helpme" => $helpme,
            "docs" => $docs,
        ]);
       
    }
    public function acceptHelpme($id)
    {
        $helpme = Helpme::find($id);
        $helpme->status = "Accepted";
        $helpme->update();
        return redirect()
            ->back()
            ->with("message", __("home.app_accepted"));
    }
    public function rejectHelpme($id)
    {
        $helpme = Helpme::find($id);
        $helpme->status = "Rejected";
        $helpme->update();
        return redirect()
            ->back()
            ->with("message", __("home.app_rejected"));
    }
    public function removeHelpme($id)
    {
        $helpme = Helpme::find($id);
        $helpme->delete();

        return redirect(route("admin.helpmes"))->with(
            "message",
            __("home.app_removed")
        );
    }
    public function improveHelpme($id)
    {
        $helpme = Helpme::find($id);
        $helpme->seen = 1;
        $helpme->update();
     
        return view("admin.improve-helpme", ["helpme" => $helpme]);
        
    }
    public function updateHelpme(Request $request, $id)
    {
        // dd($request);
        $helpme = Helpme::find($id);
        $locale = app()->getLocale();
        $validated = $request->validate([
            "name_am" => [
                "required_without_all: name_or,name_en",
                "string",
                "max:255",
            ],
            "name_or" => [
                "required_without_all: name_am,name_en",
                "string",
                "max:255",
            ],
            "name_en" => [
                "required_without_all: name_am,name_or",
                "string",
                "max:255",
            ],
            "proble_title_am" => [
                "required_without_all:problem_title_or, problem_title_en",
                "string",
                "max:255",
            ],
            "problem_title_or" => [
                "required_without_all:problem_title_or, problem_title_am",
                "string",
                "max:255",
            ],
            "problem_title_en" => ["required", "string", "max:255"],
            "address_am" => [
                "required_without_all: address_or,address_en",
                "string",
                "max:255",
            ],
            "address_or" => [
                "required_without_all: address_am,address_en",
                "string",
                "max:255",
            ],
            "address_en" => [
                "required_without_all: address_or,address_am",
                "string",
                "max:255",
            ],
            "problem_details_am" => [
                "required_without_all: problem_details_or, problem_title_en",
                "string",
                "max:10024",
                "min:3",
            ],
            "problem_details_or" => [
                "required_without_all: problem_details_en,problem_details_am",
                "string",
                "max:10024",
                "min:3",
            ],
            "problem_details_en" => [
                "required_without_all:problem_details_am.problem_details_or",
                "string",
                "max:10024",
                "min:3",
            ],
        ]);

        foreach (config("app.available_locales") as $locale) {
            $helpme->{"name_" . $locale} = $request->{"name_" . $locale};
            $helpme->{"problem_title_" . $locale} =
                $request->{"problem_title_" . $locale};
            $helpme->{"address_" . $locale} = $request->{"address_" . $locale};
            $helpme->{"problem_details_" . $locale} =
                $request->{"problem_details_" . $locale};
        }
        $helpme->update();
        return redirect(route("admin.helpmes"))->with(
            "message",
            __("home.app_improved")
        );
    }

    public static function countUnseenHelpmes()
    {
        return Helpme::where("seen", "=", 0)->count();
    }

    public static function unseenHelpmes()
    {
        return Helpme::where("seen", "=", 0)->paginate(5);
    }

    
    public function users()
    {
        $users = User::where("id", "!=", Auth::user()->id)
            ->orderBy("id", "DESC")
            ->paginate(10);
            
             return view("admin.users", ["users" => $users]);
       
    }

    public static function userRoles($id)
    {
        $user = User::find($id);
        $roles = [];
        foreach ($user->roles as $r) {
            $roles[] = $r->role;
        }
        return $roles;
    }
    public function staffup($id)
    {
        DB::table("role_user")
            ->where("user_id", "=", $id)
            ->where("role_id", "=", 2)
            ->delete();
        DB::table("role_user")
            ->where("user_id", "=", $id)
            ->where("role_id", "=", 1)
            ->delete();
        DB::table("role_user")->insert([
            "role_id" => 1,
            "user_id" => $id,
        ]);

        DB::table("role_user")->insert([
            "role_id" => 2,
            "user_id" => $id,
        ]);

        return redirect()
            ->back()
            ->with("message", __('home.staffrole_given'));
    }
    public function staffdown($id)
    {
        DB::table("role_user")
            ->where("user_id", "=", $id)
            ->where("role_id", "=", 2)
            ->delete();
        DB::table("role_user")
            ->where("user_id", "=", $id)
            ->where("role_id", "=", 3)
            ->delete();

        return redirect()
            ->back()
            ->with("message", __('home.staffrole_taken'));
    }

    public function adminup($id)
    {
        DB::table("role_user")
            ->where("user_id", "=", $id)
            ->where("role_id", "=", 2)
            ->delete();
        DB::table("role_user")
            ->where("user_id", "=", $id)
            ->where("role_id", "=", 1)
            ->delete();
        DB::table("role_user")
            ->where("user_id", "=", $id)
            ->where("role_id", "=", 3)
            ->delete();

        DB::table("role_user")->insert([
            "role_id" => 1,
            "user_id" => $id,
        ]);

        DB::table("role_user")->insert([
            "role_id" => 2,
            "user_id" => $id,
        ]);
        DB::table("role_user")->insert([
            "role_id" => 3,
            "user_id" => $id,
        ]);

        return redirect()
            ->back()
            ->with("message", __('home.adminrole_given'));
    }
    public function admindown($id)
    {
        DB::table("role_user")
            ->where("user_id", "=", $id)
            ->where("role_id", "=", 3)
            ->delete();

        return redirect()
            ->back()
            ->with("message", __('home.adminrole_taken'));
    }
    public function deleteUser(Request $request)
    {
        if ($request->user_id == Auth::user()->id) {
            return redirect()
                ->back()
                ->with("message", __('home.cant_delete_yourself'));
        } else {
            $user = User::find($request->user_id);
            $user->delete();
            $path = "uploads/profile-photos/" . $user->profile_photo_path;
            if (File::exists($path)) {
                File::delete($path);
            }
            return redirect()
                ->back()
                ->with("message", __('home.user_deleted'));
        }
    }
}
