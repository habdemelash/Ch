<?php

namespace App\Providers;

use Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\MigrationsEnded;
use App\Models\Role;

class CommandListenerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(MigrationsEnded::class, function (MigrationsEnded $event) {
            
    Role::create([
        'role'=>'Volunteer',
    ]);
    Role::create([
        'role'=>'Staff',
    ]);
    Role::create([
        'role'=>'Admin',
    ]);

        dd('Roles Created');
        });
    }
}