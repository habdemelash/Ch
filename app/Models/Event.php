<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\EventCreated;

class Event extends Model
{
    use HasFactory;
    protected $dispatchesEvents = [
    	'created'=>EventCreated::class
    ];
    public function users()
    {
    	return $this->belongsToMany(User::class,'event_user');
    }
}
