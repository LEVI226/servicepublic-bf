<?php

namespace App\Providers;

use App\Models\LifeEvent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Share nav life events with the layout instead of querying in Blade
        View::composer('layouts.app', function ($view) {
            $view->with('navLifeEvents', LifeEvent::active()->ordered()->limit(5)->get());
        });
    }

    public function register(): void
    {
        //
    }
}
