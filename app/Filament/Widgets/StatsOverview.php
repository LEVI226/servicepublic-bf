<?php

namespace App\Filament\Widgets;

use App\Models\Procedure;
use App\Models\Organisme;
use App\Models\LifeEvent;
use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Procédures actives', Procedure::where('is_active', true)->count())
                ->description('Fiches pratiques en ligne')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Organismes', Organisme::where('is_active', true)->count())
                ->description('Dans l\'annuaire')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('info'),

            Stat::make('Événements de vie', LifeEvent::where('is_active', true)->count())
                ->description('Parcours guidés')
                ->descriptionIcon('heroicon-m-light-bulb')
                ->color('primary'),

            Stat::make('Articles publiés', Article::where('is_published', true)->count())
                ->description('Actualités en ligne')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning'),
        ];
    }
}