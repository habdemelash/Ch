<?php

declare(strict_types = 1);

namespace App\Charts;

use Carbon\Carbon;
use App\Models\News;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class NewsChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
       $this_month = News::whereMonth('created_at', date('m'))
       ->whereYear('created_at', date('Y'))
       ->count();
       $this_week = News::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $todays = News::whereDate('created_at', Carbon::today())->count();
        
        return Chartisan::build()
            ->labels([__('home.this_month'), __('home.this_week'), __('home.todays')])
            ->dataset('Events', [$this_month, $this_week, $todays]);
    }
}