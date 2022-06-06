<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Event;
use App\Events\UserCreated;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $dispatchesEvents =[
        'created'=>UserCreated::class
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class,'event_user');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user');
    }


    public function news()
    {
        return $this->hasMany(News::class,'author_id','id');
    }
    public function helpmes()
    {
        return $this->hasMany(Helpme::class,'sender','id');
    }
    public function approves()
    {
        return $this->hasMany(Helpme::class,'approved_by','id');
    }
    public function subscriptionToEvents()
    {
        return $this->hasOne(Subscription_to_Events::class);
    }
    public function subscriptionToHelpmes()
    {
        return $this->hasOne(Subscription_to_Helpme::class);
    }
    public function accepts()
    {
        return $this->hasMany(Helpme::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'locale',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
