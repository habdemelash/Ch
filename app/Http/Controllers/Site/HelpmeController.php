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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'problem_title' => ['required', 'string', 'max:255'],
            'problem_details' => ['required', 'string', 'max:10000'],
            'document' => ['required'],
            'document.*' => ['image'],
            'email' => ['required', 'email', 'max:500'],
            'phone' => ['required'],
            
        ]);
        $helpme = new Helpme();
       

        

        $helpme->name = $request->name;
        if(Auth::check())
        {
        $helpme->sender = Auth::user()->id;
            }
        $helpme->address = $request->address;
        $helpme->problem_title = $request->problem_title;
        $helpme->email = $request->email;
        $helpme->phone = $request->phone;
        $helpme->problem_details = $request->problem_details;
       
        $helpme->save();
        if($request->hasFile('document'))
        {
         
         foreach($request->file('document') as $doc)
         {
         	$docs=new Docs();
            $extension = $doc->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $doc->move('uploads/helpme-pictures',$filename);
           	$docs->document= $filename;
           	$docs->help_id = (Helpme::orderBy('id','DESC')->first())->id;
         
         	$docs->save();
         }   

        }
        return redirect()->back()->with('message','Helpme application sent successfully!');
    }

}
