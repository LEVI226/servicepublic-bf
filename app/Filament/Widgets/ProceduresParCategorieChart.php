<?php

namespace App\Filament\Widgets;

use App\Models\Procedure;
use App\Models\Category;
use Filament\Widgets\ChartWidget;

class ProceduresParCategorieChart extends ChartWidget
{
    protected static ?string $pollingInterval = null;
    protected static ?string $heading = 'Fiches pratiques par thématique';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $categories = Category::withCount('procedures')
            ->where('is_active', true)
            ->orderBy('procedures_count', 'desc')
            ->limit(6)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Fiches pratiques',
                    'data' => $categories->pluck('procedures_count')->toArray(),
                    'backgroundColor' => [
                        '#009E49',
                        '#FCD116',
                        '#EF2B2D',
                        '#004B87',
                        '#18753C',
                        '#F59E0B',
                        '#8B5CF6',
                        '#EC4899',
                    ],
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}