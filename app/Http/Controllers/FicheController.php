<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Procedure;

class FicheController extends Controller
{
    public function show(string $themeSlug, string $ficheSlug)
    {
        $category = Category::where('slug', $themeSlug)->firstOrFail();
        $procedure = Procedure::where('slug', $ficheSlug)
            ->active()
            ->firstOrFail();

        $procedure->incrementViews();

        $relatedProcedures = Procedure::active()
            ->where('category_id', $procedure->category_id)
            ->where('id', '!=', $procedure->id)
            ->where('title', '!=', 'Unknown Title')
            ->whereNotNull('description')
            ->orderBy('views_count', 'desc')
            ->limit(5)
            ->get();

        $breadcrumb = [
            ['name' => 'Accueil', 'url' => route('home')],
            ['name' => 'Fiches par thème', 'url' => route('thematiques.index')],
            ['name' => $category->name, 'url' => route('thematiques.show', $category->slug)],
            ['name' => $procedure->title, 'url' => null],
        ];

        return view('pages.fiches.show', compact('procedure', 'category', 'relatedProcedures', 'breadcrumb'));
    }

    public function avis()
    {
        // Feedback feature removed in PRD v2 — placeholder for future implementation
        return back()->with('info', 'Fonctionnalité bientôt disponible.');
    }
}
