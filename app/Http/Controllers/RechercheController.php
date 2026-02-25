<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use App\Models\Organisme;
use App\Models\Eservice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RechercheController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q', '');
        $resultats = collect();

        if (strlen($q) >= 2) {
            $procedures = Procedure::active()
                ->where(function($query) use ($q) {
                    $query->where('title', 'LIKE', "%{$q}%")
                          ->orWhere('description', 'LIKE', "%{$q}%")
                          ->orWhere('documents_required', 'LIKE', "%{$q}%");
                })
                ->with('category')
                ->limit(20)
                ->get()
                ->map(fn($p) => [
                    'type' => 'procedure',
                    'titre' => $p->title,
                    'description' => Str::limit($p->description, 150),
                    'url' => $p->category
                        ? route('fiches.show', [$p->category->slug, $p->slug])
                        : '#',
                ]);

            $organismes = Organisme::active()
                ->where(function($query) use ($q) {
                    $query->where('name', 'LIKE', "%{$q}%")
                          ->orWhere('acronym', 'LIKE', "%{$q}%");
                })
                ->limit(10)
                ->get()
                ->map(fn($o) => [
                    'type' => 'organisme',
                    'titre' => $o->full_name,
                    'description' => $o->description ? Str::limit($o->description, 150) : null,
                    'url' => route('annuaire.show', $o->slug),
                ]);

            $eservices = Eservice::active()
                ->where(function($query) use ($q) {
                    $query->where('title', 'LIKE', "%{$q}%")
                          ->orWhere('description', 'LIKE', "%{$q}%");
                })
                ->limit(10)
                ->get()
                ->map(fn($e) => [
                    'type' => 'eservice',
                    'titre' => $e->title,
                    'description' => $e->description ? Str::limit($e->description, 150) : null,
                    'url' => $e->url,
                ]);

            $resultats = $procedures->concat($organismes)->concat($eservices);
        }

        return view('pages.recherche.index', compact('q', 'resultats'));
    }
}
