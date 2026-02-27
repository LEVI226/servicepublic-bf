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
            Stat::make('Fiches pratiques', Procedure::where('is_active', true)->count())
                ->description('Démarches publiées sur le site')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Organismes', Organisme::where('is_active', true)->count())
                ->description('Services publics dans l\'annuaire')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('info'),

            Stat::make('Événements de vie', LifeEvent::where('is_active', true)->count())
                ->description('Parcours « Comment faire si ? »')
                ->descriptionIcon('heroicon-m-light-bulb')
                ->color('primary'),

            Stat::make('Actualités', Article::where('is_published', true)->count())
                ->description('Articles publiés sur le site')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('warning'),
        ];
    }
}