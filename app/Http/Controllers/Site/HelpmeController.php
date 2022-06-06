<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Helpme;
use App\Models\Docs;
use Illuminate\Support\Facades\Auth;

class HelpmeController extends Controller
{
    public function sendHelpMe(Request $request)
    {
        $locale = app()->getLocale();
        $helpme = new Helpme();
        if (!Auth::check()) {
            $validated = $request->validate([
                "name_" . $locale => ["required", "string", "max:255"],
                "address_" . $locale => ["required", "string", "max:255"],
                "problem_title_" . $locale => ["required", "string", "max:255"],
                "problem_details_" . $locale => [
                    "required",
                    "string",
                    "max:10000",
                ],
                "document" => ["required"],
                "document.*" => ["image"],
                "phone" => ["required", "max:20"],
            ]);
            $helpme->{"name_" . $locale} = $request->{"name_" . $locale};
            $helpme->{"address_" . $locale} = $request->{"address_" . $locale};
            $helpme->email = $request->email;
            $helpme->phone = $request->phone;
        } else {
            $validated = $request->validate([
                "problem_details_" . $locale => [
                    "required",
                    "string",
                    "max:10000",
                ],
                "document" => ["required"],
                "document.*" => ["image"],
                "email" => ["sometimes", "email", "max:500"],
            ]);
            $helpme->{"name_" . $locale} = Auth::user()->name;
            $helpme->{"address_" . $locale} = Auth::user()->address;
            $helpme->email = Auth::user()->email;
            $helpme->phone = Auth::user()->phone;
        }

        if (Auth::check()) {
            $helpme->sender = Auth::user()->id;
        }

        $helpme->{"problem_title_" . $locale} =
            $request->{"problem_title_" . $locale};
        $helpme->{"problem_details_" . $locale} =
            $request->{"problem_details_" . $locale};
        $helpme->save();
        if ($request->hasFile("document")) {
            foreach ($request->file("document") as $doc) {
                $filename = "";
                $docs = new Docs();
                $extension = $doc->getClientOriginalExtension();
                $filename =
                    md5(time() . $doc) . $request->name . "." . $extension;
                $doc->move("uploads/helpme-pictures", $filename);
                $docs->document = $filename;
                $docs->help_id = Helpme::orderBy("id", "DESC")->first()->id;
                $docs->save();
            }
        }
        return redirect()
            ->back()
            ->with("message", "Helpme application sent successfully!");
    }
}
