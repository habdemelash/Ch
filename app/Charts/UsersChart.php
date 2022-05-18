<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

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
        
        
        
        
        return Chartisan::build()
            ->labels([__('home.volunteer'), __('home.staff'), __('home.admin')])
            ->dataset('Users', [$volunteers, $staff, $admins]);
            
    }
}