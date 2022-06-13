<?php

namespace App\Http\Controllers\Site;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\News;
use App\Models\Helpme;
use App\Models\Role;
use App\Models\Docs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    public static function localizer()
    {
        $lang = DB::table("users")
            ->where("id", Auth::user()->id)
            ->value("locale");
        return redirect(url()->current() . "? change_language=" . $lang);
    }
    public function profile()
    {
        $my = Auth::user();
        return view("profile.profile", ["my" => $my]);
    }
    public function updateProfile(Request $request)
    {
        $me = Auth::user();

        $validated = $request->validate([
            "name" => ["required", "string", "max:255"],
            "address" => ["required", "string", "max:255", "min:1"],
            "phone" => ["required", "string", "max:20", "min:10"],
            "email" => ["required", "email", "max:255"],
            "password" => ["nullable", "string", "min:6"],
            "password_confirmation" => [
                "nullable",
                "required_with:password",
                "same:password",
            ],
            "old_password" => [
                "nullable",
                "required_with:password",
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        return $fail(__("The current password is incorrect."));
                    }
                },
            ],
        ]);

        if (
            $request->password_confirmation !== null and
            $request->password !== null
        ) {
            $me->password = Hash::make($request->password_confirmation);
        }
        if ($request->hasFile("profile_photo_path")) {
            $path = "uploads/profile-photos/" . $me->profile_photo_path;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file("profile_photo_path");
            $ext = $file->getClientOriginalExtension();
            $filename = time() . "." . $ext;
            $file->move("uploads/profile-photos/", $filename);
            $me->profile_photo_path = $filename;
        }
        $me->name = $request->name;
        $me->phone = $request->phone;
        $me->email = $request->email;
        $me->address = $request->address;
        $me->update();
        return redirect()
            ->back()
            ->with("message", __("home.info_updated"));
    }
    // Delete profile
    public function deleteProfile()
    {
        $me = Auth::user();
        $me->delete();
        return redirect(route('login'))->with('message',__('home.your_profile_deleted'));
    }
    // Event counter method
    public static function myevents()
    {
        if (Auth::check()) {
            $myevents = User::find(Auth::user()->id)->events->count();
            return $myevents;
        } else {
            return 0;
        }
    }

    // Event lister method
    public static function myEventLister()
    {
        if (Auth::check()) {
            $id = Auth::user()->id;
            $myEventsList = DB::table("event_user")
                ->where("user_id", "=", $id)
                ->pluck("event_id")
                ->toArray();

            return $myEventsList;
        } else {
            return [];
        }
    }

    public static function fetchMyEvents($id)
    {
        return Event::find($id);
    }
    // home renderer method
    public function home()
    {
        $locale = app()->getLocale();
        if (Auth::check()) {
            $myevents = $this->myevents();
        }
        $news = News::select([
            "id",
            "heading_" . $locale,
            "body_" . $locale,
            "created_at",
            "author_id",
            "picture",
        ])
            ->latest()
            ->whereNotNull("heading_" . $locale)
            ->where("heading_" . $locale, "!=", "")
            ->paginate(5);

        return view("site.home", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
            "news" => $news,
        ]);
    }
    // Search news
    public function searchNews(Request $request)
    {
        $locale = App::getLocale();
        $key = $request->input("key");
        $news = News::where("heading_" . $locale, "LIKE", "%" . $key . "%")
            ->orWhere("body_" . $locale, "LIKE", "%" . $key . "%")
            ->paginate(5);
        $count = $news->count();
        Session::flash("result", $key);
        return view("site.home", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
            "news" => $news,
            "count" => $count,
        ]);
    }
    public function searchEvents(Request $request)
    {
        $locale = App::getLocale();
        $key = $request->input("key");
        $events = Event::where("title_" . $locale, "LIKE", "%" . $key . "%")
            ->orWhere("short_desc_" . $locale, "LIKE", "%" . $key . "%")
            ->orWhere("location_" . $locale, "LIKE", "%" . $key . "%")
            ->paginate(5);
        $count = $events->count();
        Session::flash("result", $key);
        return view("site.events", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
            "events" => $events,
            "count" => $count,
        ]);
    }

    // Events page renderer method
    public function events()
    {
        $events = Event::orderBy("status", "ASC")->paginate(6);
        return view("site.events", [
            "events" => $events,
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }
    // View Event details
    public function viewEvent($id)
    {
        $event = Event::find($id);
        return view("site.view-event", [
            "event" => $event,
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }

    // Donate materials view

    public function donateMaterialsForm()
    {
        return view("site.donate-materials", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }
    // Contact form
    public function contactForm()
    {
        return view("site.contact-form", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }
    // read news page
    public function news($id)
    {
        $main = News::find($id);
        $latest = News::where("id", "!=", $id)
            ->orderBy("created_at", "DESC")
            ->first();

        $rest = News::where("id", "!=", $id)
            ->orderBy("id", "DESC")
            ->paginate(6);

        if (News::count() < 2) {
            $latest = $main;
        }

        return view("site.read-news", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
            "main" => $main,
            "rest" => $rest,
            "latest" => $latest,
        ]);
    }

    // let's help page renderer method
    public function letsHelp()
    {
        $locale = app()->getLocale();
        $helpme = Helpme::where("status", "=", "Accepted")
            ->orderBy("id", "DESC")
            ->paginate(10);
        return view("site.lets-help", [
            "helpme" => $helpme,
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }

    // view help me information for anyone

    public function viewLetsHelp($id)
    {
        $helpme = Helpme::find($id);
        $docs = Docs::whereHas("helpmes", function ($subQuery) use ($id) {
            $subQuery->where("id", $id);
        })
            ->latest()
            ->paginate(6);

        $others = Helpme::where("id", "!=", $id)
            ->where('status','Accepted')
            ->orderBy("id", "DESC")
            ->paginate(5);
        return view("site.view-help-me", [
            "helpme" => $helpme,
            "docs" => $docs,
            "others" => $others,
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }

    // help me form renderer
    public function helpmeForm()
    {
        return view("site.help-me-form", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }

    // Event joining method
    public function joinEvent($id)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;

            DB::table("event_user")
                ->where("event_id", "=", $id)
                ->where("user_id", "=", $user_id)
                ->delete();

            DB::table("event_user")->insert([
                "event_id" => $id,
                "user_id" => $user_id,
            ]);
            return redirect()
                ->back()
                ->with("message", __("home.you_joined"));
        } else {
            return redirect("/login");
        }
    }

    public function leaveEvent($id)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;

            DB::table("event_user")
                ->where("event_id", "=", $id)
                ->where("user_id", "=", $user_id)
                ->delete();
        }
        return redirect()
            ->back()
            ->with("message", __("home.you_left"));
    }

    // REgistration page renderer method
    public function registrationView()
    {
        return view("auth.register", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }

    // Login page renderer method
    public function loginView()
    {
        return view("auth.login", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }
    // a method to find how many people have joinde each event
    public static function howManyJoined($id)
    {
        $number = Event::find($id)->users->count();

        // $number =  DB::table('event_user')->where('event_id', '=', $id,)->count();

        return $number;
    }

    // List volunteers who have joined a specific event
    public static function listJoindeVolunteers($id)
    {
        $event = Event::find($id);
        $users = $event->users()->paginate(20);
        return $users;
    }
    // List all my events
    public function allMyEvents()
    {
        return view("site.all-my-events", [
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }
    // How many days left for the event
    public static function calculateDays($id)
    {
        $eventDate = new Carbon(new DateTime(Event::find($id)->due_date));
        $today = Carbon::now();
        if ($today->greaterThan($eventDate)) {
            $difference = $eventDate->diff($today)->format("%a");
            if ($difference == 0) {
                return __("home.today");
            } else {
                return __("home.from") .
                    $difference .
                    " " .
                    __("home.days_ago");
            }
        } else {
            $difference = $eventDate->diff($today)->format("%a");
            if ($difference == 0) {
                return __("home.today");
            } else {
                return $difference . " " . __("home.days_left");
            }
        }
    }

    public function staff()
    {
        $role = Role::where("role", "Staff")->first();
        $staff = $role->users;
        return view("site.staff", [
            "staff" => $staff,
            "myevents" => $this->myevents(),
            "myEventsList" => $this->myEventLister(),
        ]);
    }
}
