<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docs extends Model
{
    use HasFactory;
    public function helpmes()
    {
    	return $this->belongsTo(Helpme::class,'help_id','id');
    }
}
