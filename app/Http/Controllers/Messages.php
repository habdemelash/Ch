<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageBox;
use App\Models\User;

class Messages extends Controller
{
    public static function partialMessages($id)
    {
    	return MessageBox::where('receiver','=',$id)->paginate(4);
        
    }
    public static function allMessages($id)
    {
        return MessageBox::where('receiver','=',$id)->get();
        
    }
    public static function sender($id)
    {
    	$sender = User::where('id','=',$id)->first();
    	$name = $sender->name;

    	return $name;
    }
}
