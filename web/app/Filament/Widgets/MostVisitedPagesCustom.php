<?php

namespace App\Filament\Widgets;

use App\Models\VisitorLog;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class MostVisitedPagesCustom extends Widget
{
    protected static ?string $heading = 'Most Visited Pages';
    protected static string $view = 'filament.widgets.most-visited-pages-custom';

    public $topPages = [];

    public function mount(): void
    {
        $this->topPages = VisitorLog::select('page_url', DB::raw('COUNT(*) AS visits'))
            ->groupBy('page_url')
            ->orderByDesc('visits')
            ->take(10)
            ->get()
            ->toArray();
    }
}
