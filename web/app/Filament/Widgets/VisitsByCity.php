<?php

namespace App\Filament\Widgets;

use App\Models\VisitorLog;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class VisitsByCity extends ChartWidget
{
    protected static string $chartId = 'visitsByCity';
    protected static ?string $heading = 'Visits by City';
    protected static ?string $pollingInterval = null;


    protected function getData(): array
    {
        // Aggregate visits by city
        $visitsByCity = VisitorLog::select('city', DB::raw('count(*) as total'))
            ->whereNotNull('city') // ignore null values
            ->groupBy('city')
            ->orderByDesc('total')
            ->take(10) // top 10 cities
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Visits',
                    'data' => $visitsByCity->pluck('total'),
                ],
            ],
            'labels' => $visitsByCity->pluck('city'),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
