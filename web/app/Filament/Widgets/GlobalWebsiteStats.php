<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\VisitorLog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GlobalWebsiteStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalVisits = VisitorLog::count();

         $uniqueVisitors = VisitorLog::distinct('visitor_uuid')->count('visitor_uuid');

        $totalTimeSpent = VisitorLog::sum('time_spent');

        $avgTimePerVisit = $totalVisits > 0
            ? round($totalTimeSpent / $totalVisits, 2)
            : 0;


        $now = Carbon::now();
        $lastWeekStart = $now->copy()->subWeek()->startOfWeek();
        $lastWeekEnd = $now->copy()->subWeek()->endOfWeek();

        // This week
        $thisWeekVisits = VisitorLog::whereBetween('visited_at', [$now->startOfWeek(), $now->endOfWeek()])->count();

        // Last week
        $lastWeekVisits = VisitorLog::whereBetween('visited_at', [$lastWeekStart, $lastWeekEnd])->count();

        // Determine trend
        $visitTrend = $thisWeekVisits >= $lastWeekVisits ? '↑' : '↓';

        return [
             Stat::make('Total Visits', number_format($totalVisits))
                ->description('All page views recorded')
                ->color('primary')
                ->icon('heroicon-o-eye'),

            Stat::make('Unique Visitors', number_format($uniqueVisitors))
                ->description('Different users who visited')
                ->color('success')
                ->icon('heroicon-o-user'),

            Stat::make('Total Time Spent', gmdate("H:i:s", $totalTimeSpent))
                ->description('Cumulative time across all visits')
                ->color('warning')
                ->icon('heroicon-o-clock'),

            Stat::make('Avg. Time per Visit', $avgTimePerVisit . ' sec')
                ->description('Average session duration')
                ->color('info')
                ->icon('heroicon-o-chart-bar'),
        ];
    }
}
