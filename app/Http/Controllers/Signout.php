<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class Signout extends Controller
{
    public function signout()
    {
    	Session::flush();
    	Auth::logout();
    	return redirect(url('/login'));
    }
}
