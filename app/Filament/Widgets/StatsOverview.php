<?php

namespace App\Filament\Widgets;

use App\Models\Procedure;
use App\Models\Organisme;
use App\Models\LifeEvent;
use App\Models\Eservice;
use App\Models\Article;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    protected int|string|array $columnSpan = 'full';

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Fiches pratiques', Procedure::where('is_active', true)->count())
                ->description('Démarches publiées')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('E-Services', Eservice::where('is_active', true)->count())
                ->description('Services en ligne actifs')
                ->descriptionIcon('heroicon-m-computer-desktop')
                ->color('primary'),

            Stat::make('Organismes', Organisme::where('is_active', true)->count())
                ->description('Annuaire de l\'administration')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('info'),

            Stat::make('Événements de vie', LifeEvent::where('is_active', true)->count())
                ->description('Parcours « Comment faire si ? »')
                ->descriptionIcon('heroicon-m-light-bulb')
                ->color('warning'),

            Stat::make('Total Consultations', number_format(Procedure::sum('views_count'), 0, ',', ' '))
                ->description('Vues cumulées des fiches')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),

            Stat::make('Actualités', Article::where('is_published', true)->count())
                ->description('Articles de presse')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('gray'),
        ];
    }
}