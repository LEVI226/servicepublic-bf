<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Procedure;
use App\Models\LifeEvent;
use App\Models\Article;
use App\Models\Eservice;
use App\Models\Faq;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $lifeEvents = Cache::remember('home.life_events', 3600, fn() => LifeEvent::withCount('procedures')->active()
            ->ordered()
            ->limit(10)
            ->get());

        $categories = Cache::remember('home.categories', 3600, fn() => Category::active()
            ->has('procedures')
            ->ordered()
            ->withCount('procedures')
            ->limit(12)
            ->get());

        $procedures = Cache::remember('home.popular', 3600, fn() => Procedure::active()
            ->orderByDesc('views_count')
            ->with('category')
            ->limit(6)
            ->get());

        $articles = Cache::remember('home.articles', 3600, fn() => Article::with('category')->published()
            ->orderByDesc('published_at')
            ->limit(3)
            ->get());

        $eservices = Cache::remember('home.eservices', 3600, fn() => Eservice::active()
            ->ordered()
            ->limit(6)
            ->get());

        $stats = Cache::remember('home.stats', 3600, fn() => [
            'procedures' => Procedure::active()->count(),
            'eservices' => Eservice::active()->count(),
            'regions' => \App\Models\Region::count() ?: 17,
            'provinces' => \App\Models\Province::count() ?: 47,
        ]);

        return view('pages.home.index', compact(
            'lifeEvents', 'categories', 'procedures', 'articles', 'eservices', 'stats'
        ));
    }

    public function planDuSite()
    {
        $categories = Cache::remember('plan_du_site.categories', 3600, fn() => Category::active()->ordered()
            ->with('subcategories')->get());
        $lifeEvents = Cache::remember('plan_du_site.life_events', 3600, fn() => LifeEvent::active()->ordered()->with('procedures')->get());

        return view('pages.plan-du-site', compact('categories', 'lifeEvents'));
    }

    public function faq()
    {
        $faqs = Cache::remember('home.faq', 3600, fn() => Faq::with('category')->active()->orderBy('order')->get());
        return view('pages.faq', compact('faqs'));
    }
}
