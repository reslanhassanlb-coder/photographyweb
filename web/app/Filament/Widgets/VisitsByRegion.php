<?php

namespace App\Filament\Widgets;

use App\Models\VisitorLog;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class VisitsByRegion extends ChartWidget
{
    //protected static ?string $heading = 'Chart';

    protected static string $chartId = 'visitsByRegion';
    protected static ?string $heading = 'Visits by Country/Region';
    protected static ?string $pollingInterval = null; // optional live update

    protected function getData(): array
    {
         $visitsByCountry = VisitorLog::select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->orderByDesc('total')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Visits',
                    'data' => $visitsByCountry->pluck('total'),
                ],
            ],
            'labels' => $visitsByCountry->pluck('country'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
