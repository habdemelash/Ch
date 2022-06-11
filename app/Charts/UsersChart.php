<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Role;
use App\Models\User;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Support\Facades\Cache;

class UsersChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $volunteers = Role::find(1)->users->count();
        $staff = Role::find(2)->users->count();
        $admins = Role::find(3)->users->count();
        $count = 0;
        $active = User::whereNotNull('last_seen')
                        ->orderBy('last_seen', 'DESC')
                        ->get();
        foreach($active as $user){
            if(Cache::has('user-is-online-'.$user->id)){
                $count++;
            }
        }
        
        return Chartisan::build()
            ->labels([__('home.volunteer'), __('home.staff'), __('home.admin'),__('home.active_users')])
            ->dataset('Users', [$volunteers, $staff, $admins,$count]);
            
    }
}