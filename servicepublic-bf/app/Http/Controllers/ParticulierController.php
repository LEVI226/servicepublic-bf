<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Fiche;
use Illuminate\Http\Request;

class ParticulierController extends Controller
{
    public function index()
    {
        $categories = Categorie::particuliers()
            ->racines()
            ->with(['enfants' => function($q) {
                $q->where('actif', true)->orderBy('ordre');
            }])
            ->withCount('fiches')
            ->orderBy('ordre')
            ->get();

        $fichesPopulaires = Fiche::actives()
            ->whereHas('categorie', function($q) {
                $q->where('type', 'particulier');
            })
            ->populaires(5)
            ->get();

        return view('pages.particuliers.index', compact('categories', 'fichesPopulaires'));
    }

    public function categorie($slug)
    {
        $categorie = Categorie::where('slug', $slug)
            ->where('type', 'particulier')
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

        return view('pages.particuliers.categorie', compact('categorie', 'fiches'));
    }

    public function fiche($categorieSlug, $ficheSlug)
    {
        $categorie = Categorie::where('slug', $categorieSlug)
            ->where('type', 'particulier')
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

        return view('pages.particuliers.fiche', compact('categorie', 'fiche', 'fichesSimilaires'));
    }
}
