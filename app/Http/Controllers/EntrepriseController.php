<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Procedure;
use App\Models\LifeEvent;

class EntrepriseController extends Controller
{
    public function index()
    {
        // For Enterprise, we filter life events that make sense for businesses (or just leave it empty if there are none specific yet)
        // Hard-coding slugs known to be enterprise-related or filtering by a flag if it exists.
        // For now, we'll fetch only categories relevant to Business/Commerce (Entreprises & Commerce, Fiscalité, etc.)
        $b2bCategories = ['entreprises-commerce', 'fiscalite-finances', 'travail-emploi'];
        
        $categories = Category::active()
            ->whereIn('slug', $b2bCategories)
            ->ordered()
            ->withCount('procedures')
            ->get();
        
        $popularProcedures = Procedure::active()
            ->whereHas('category', function ($q) use ($b2bCategories) {
                $q->whereIn('slug', $b2bCategories);
            })
            ->orderByDesc('views_count')
            ->limit(6)
            ->get();

        $b2bCategoriesIds = $categories->pluck('id')->toArray();
        $eservices = \App\Models\Eservice::active()
            ->whereIn('category_id', $b2bCategoriesIds)
            ->ordered()
            ->limit(6)
            ->get();

        // Fetch Business Life Events specifically
        $lifeEvents = LifeEvent::withCount('procedures')->active()
            ->where('title', 'LIKE', '%entreprise%')
            ->orWhere('title', 'LIKE', '%société%')
            ->orWhere('title', 'LIKE', '%export%')
            ->orWhere('title', 'LIKE', '%import%')
            ->get();

        return view('pages.entreprises.index', compact('lifeEvents', 'categories', 'popularProcedures', 'eservices'));
    }

    public function thematiques()
    {
        // Filter subcategories and themes only relevant to businesses
        $b2bCategories = ['entreprises-commerce', 'fiscalite-finances', 'travail-emploi', 'agriculture-elevage', 'transport-mobilite'];
        
        $categories = Category::active()
            ->whereIn('slug', $b2bCategories)
            ->ordered()
            ->withCount('procedures')
            ->with(['subcategories' => fn($q) => $q->active()->withCount('procedures')])
            ->get();

        return view('pages.entreprises.thematiques', compact('categories'));
    }

    public function thematiqueShow(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $procedures = Procedure::with('category')->active()
            ->where('category_id', $category->id)
            ->orderBy('title')
            ->paginate(20);

        return view('pages.entreprises.thematique-show', compact('category', 'procedures'));
    }

    public function ficheShow(string $themeSlug, string $ficheSlug)
    {
        $category = Category::where('slug', $themeSlug)->firstOrFail();
        $procedure = Procedure::where('slug', $ficheSlug)->active()->firstOrFail();
        $procedure->incrementViews();

        return view('pages.fiches.show', compact('procedure', 'category'));
    }

    public function evenements()
    {
        // B2B missing specific life events right now
        $lifeEvents = collect([]);
        return view('pages.entreprises.evenements', compact('lifeEvents'));
    }

    public function evenementShow(string $slug)
    {
        $lifeEvent = LifeEvent::where('slug', $slug)->firstOrFail();
        $procedures = $lifeEvent->procedures()->with('category')->active()->get();

        return view('pages.evenements.show', compact('lifeEvent', 'procedures'));
    }

    public function annuaire()
    {
        return redirect()->route('annuaire.index');
    }
}
