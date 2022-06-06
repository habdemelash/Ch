<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helpme extends Model
{
    use HasFactory;
    protected $fillable = [
    	'document'
    ];
    public function documents()
    {
    	return $this->hasMany(Docs::class,'help_id','id');
    }
    public function from()
    {
    	return $this->belongsTo(User::class,'sender','id');
    }
    public function acceptedBy()
    {
        return $this->belongsTo(User::class);
    }  

}
