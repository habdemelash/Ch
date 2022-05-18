<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Event;
// use App\Models\News;
// use App\Models\User;
// use App\Models\Helpme;
// use App\Models\Docs;
class EventsChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
      
        $countUpcoming = Event::where('status','=','Upcoming')->count();
        $countCancelled = Event::where('status','=','Cancelled')->count();
        $countPast = Event::where('status','=','Past')->count();
        
        
        return Chartisan::build()
            ->labels([__('home.upcoming'), __('home.cancelled'), __('home.past')])
            ->dataset('Events', [$countUpcoming, $countCancelled, $countPast]);
            
    }
}