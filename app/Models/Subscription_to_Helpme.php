<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription_to_Helpme extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];
    public function subscribers(){
        return $this->belongsTo(User::class);
    }
}
