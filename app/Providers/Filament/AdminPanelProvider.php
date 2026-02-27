<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Service Public BF')
            ->brandLogo(asset('img/armoirie.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('img/favicon.png'))
            ->colors([
                'primary' => '#009E49', // BF Green
                'danger' => '#EF2B2D',  // BF Red
                'warning' => '#FCD116', // BF Yellow
                'info' => '#0063CB',    // Blue
                'success' => '#18753C', // Dark Green
            ])
            ->font('Outfit')
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Contenu éditorial')
                    ->icon('heroicon-o-document-text')
                    ->collapsed(false),
                NavigationGroup::make()
                    ->label('Événements de vie')
                    ->icon('heroicon-o-light-bulb'),
                NavigationGroup::make()
                    ->label('Administration')
                    ->icon('heroicon-o-building-office-2'),
                NavigationGroup::make()
                    ->label('Outils & Médias')
                    ->icon('heroicon-o-wrench-screwdriver'),
                NavigationGroup::make()
                    ->label('Paramètres')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsed(true),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->pages([
                Pages\Dashboard::class,
                \App\Filament\Pages\ImportData::class,
            ])
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\ProceduresParCategorieChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn () => new HtmlString('<script src="' . asset('js/admin-tooltips.js') . '"></script>')
            );
    }
}
