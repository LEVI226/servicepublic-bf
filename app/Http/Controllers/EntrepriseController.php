<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Procedure;
use App\Models\LifeEvent;

class EntrepriseController extends Controller
{
    public function index()
    {
        $categories = Category::active()->pro()
            ->ordered()
            ->withCount('procedures')
            ->get();

        $proCategoryIds = $categories->pluck('id');
        $popularProcedures = Procedure::active()
            ->whereIn('category_id', $proCategoryIds)
            ->orderByDesc('views_count')
            ->limit(6)
            ->get();

        $eservices = \App\Models\Eservice::active()
            ->whereIn('category_id', $proCategoryIds)
            ->ordered()
            ->limit(6)
            ->get();

        // Fetch Business Life Events specifically
        $lifeEvents = LifeEvent::withCount('procedures')->active()
            ->where(function ($q) {
                $q->where('title', 'LIKE', '%entreprise%')
                    ->orWhere('title', 'LIKE', '%commerce%')
                    ->orWhere('title', 'LIKE', '%société%');
            })
            ->get();

        $metaTitle = 'Espace Entreprises — Services et démarches pour les professionnels | Service Public BF';
        $metaDescription = 'Retrouvez toutes les démarches administratives, e-services et procédures dédiées aux entreprises et professionnels du Burkina Faso.';

        return view('pages.entreprises.index', compact('lifeEvents', 'categories', 'popularProcedures', 'eservices', 'metaTitle', 'metaDescription'));
    }

    public function thematiques()
    {
        $categories = Category::active()->pro()
            ->ordered()
            ->withCount('procedures')
            ->get();

        $metaTitle = 'Thématiques Professionnelles — Espace Entreprises | Service Public BF';
        
        return view('pages.entreprises.thematiques', compact('categories', 'metaTitle'));
    }

    public function thematiqueShow(string $slug)
    {
        $category = Category::where('slug', $slug)->pro()->firstOrFail();
        
        $procedures = Procedure::active()
            ->where('category_id', $category->id)
            ->orderByDesc('views_count')
            ->paginate(20);

        $metaTitle = $category->name . ' — Espace Entreprises | Service Public BF';

        return view('pages.entreprises.thematique-show', compact('category', 'procedures', 'metaTitle'));
    }

    public function ficheShow(string $themeSlug, string $ficheSlug)
    {
        $category = Category::where('slug', $themeSlug)->pro()->firstOrFail();
        $procedure = Procedure::where('slug', $ficheSlug)
            ->where('category_id', $category->id)
            ->active()
            ->firstOrFail();
            
        $procedure->incrementViews();

        return view('pages.fiches.show', compact('procedure', 'category'));
    }

    public function evenements()
    {
        $lifeEvents = LifeEvent::active()
            ->whereIn('slug', ['je-cree-mon-entreprise', 'j-importe-ou-j-exporte'])
            ->withCount('procedures')
            ->get();
            
        return view('pages.entreprises.evenements', compact('lifeEvents'));
    }

    public function evenementShow(string $slug)
    {
        $lifeEvent = LifeEvent::where('slug', $slug)->active()->firstOrFail();
        $procedures = $lifeEvent->procedures()->with('category')->active()->get();

        return view('pages.evenements.show', compact('lifeEvent', 'procedures'));
    }

    public function annuaire()
    {
        return redirect()->route('annuaire.index');
    }
}
