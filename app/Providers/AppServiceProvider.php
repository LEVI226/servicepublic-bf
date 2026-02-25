<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use App\Models\Article;
use App\Models\Category;
use App\Models\Eservice;
use App\Models\Faq;
use App\Models\LifeEvent;
use App\Models\Procedure;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        if (str_contains(request()->getHost(), 'ngrok')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // --- Cache Invalidation logic for the frontend ---
        $clearHomeCache = function () {
            Cache::forget('home.life_events');
            Cache::forget('home.categories');
            Cache::forget('home.popular');
            Cache::forget('home.articles');
            Cache::forget('home.eservices');
            Cache::forget('plan_du_site.categories');
            Cache::forget('plan_du_site.life_events');
            Cache::forget('home.faq');
        };

        Article::saved($clearHomeCache);
        Article::deleted($clearHomeCache);
        Category::saved($clearHomeCache);
        Category::deleted($clearHomeCache);
        Eservice::saved($clearHomeCache);
        Eservice::deleted($clearHomeCache);
        Faq::saved($clearHomeCache);
        Faq::deleted($clearHomeCache);
        LifeEvent::saved($clearHomeCache);
        LifeEvent::deleted($clearHomeCache);
        Procedure::saved($clearHomeCache);
        Procedure::deleted($clearHomeCache);
    }
}
