<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admins', function ( $user) {
            $roles = $user->roles;
            $hasRole = false;
            foreach($roles as $role){
                if($role->role == 'Admin'){
                    $hasRole = true;
                    
                }
                   
                
            }
            return $hasRole; 
        
    });

        Gate::define('staffs', function ( $user) {
            $roles = $user->roles;
            $hasRole = false;
            foreach($roles as $role){
                if($role->role == 'Staff'){
                    $hasRole = true;
                    
                }
                   
                
            }
            return $hasRole; 
        
    });
    }
}
