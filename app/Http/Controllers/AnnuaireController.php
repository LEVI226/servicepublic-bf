<?php

namespace App\Http\Controllers;

use App\Models\Organisme;
use Illuminate\Http\Request;

class AnnuaireController extends Controller
{
    public function index(Request $request)
    {
        $query = Organisme::active();

        if ($lettre = $request->get('lettre')) {
            $query->where('name', 'LIKE', "{$lettre}%");
        }

        if ($region = $request->get('region')) {
            $query->where('region', $region);
        }

        if ($recherche = $request->get('q')) {
            $query->where(function($q) use ($recherche) {
                $q->where('name', 'LIKE', "%{$recherche}%")
                  ->orWhere('acronym', 'LIKE', "%{$recherche}%")
                  ->orWhere('description', 'LIKE', "%{$recherche}%");
            });
        }

        $organismes = $query->orderBy('name')->orderBy('id')->paginate(20);
        $lettres = range('A', 'Z');

        return view('pages.annuaire.index', compact('organismes', 'lettres', 'lettre', 'recherche'));
    }

    public function show(string $slug)
    {
        $organisme = Organisme::where('slug', $slug)->active()->firstOrFail();

        return view('pages.annuaire.show', compact('organisme'));
    }
}
