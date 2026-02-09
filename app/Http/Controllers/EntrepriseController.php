<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Fiche;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    public function index()
    {
        $categories = Categorie::entreprises()
            ->racines()
            ->with(['enfants' => function($q) {
                $q->where('actif', true)->orderBy('ordre');
            }])
            ->withCount('fiches')
            ->orderBy('ordre')
            ->get();

        $fichesPopulaires = Fiche::actives()
            ->whereHas('categorie', function($q) {
                $q->where('type', 'entreprise');
            })
            ->populaires(5)
            ->get();

        return view('pages.entreprises.index', compact('categories', 'fichesPopulaires'));
    }

    public function categorie($slug)
    {
        $categorie = Categorie::where('slug', $slug)
            ->where('type', 'entreprise')
            ->where('actif', true)
            ->with(['enfants' => function($q) {
                $q->where('actif', true)->orderBy('ordre');
            }, 'parent'])
            ->firstOrFail();

        $fiches = Fiche::actives()
            ->where('categorie_id', $categorie->id)
            ->orWhereIn('categorie_id', $categorie->enfants->pluck('id'))
            ->orderBy('vues', 'desc')
            ->paginate(12);

        return view('pages.entreprises.categorie', compact('categorie', 'fiches'));
    }

    public function fiche($categorieSlug, $ficheSlug)
    {
        $categorie = Categorie::where('slug', $categorieSlug)
            ->where('type', 'entreprise')
            ->where('actif', true)
            ->firstOrFail();

        $fiche = Fiche::actives()
            ->where('slug', $ficheSlug)
            ->where('categorie_id', $categorie->id)
            ->firstOrFail();

        $fiche->incrementerVues();

        $fichesSimilaires = Fiche::actives()
            ->where('categorie_id', $categorie->id)
            ->where('id', '!=', $fiche->id)
            ->limit(3)
            ->get();

        return view('pages.entreprises.fiche', compact('categorie', 'fiche', 'fichesSimilaires'));
    }
}
