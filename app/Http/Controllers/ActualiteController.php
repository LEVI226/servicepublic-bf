<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    public function show($slug)
    {
        $actualite = Actualite::where('slug', $slug)
            ->where('actif', true)
            ->where('date_publication', '<=', now())
            ->firstOrFail();

        $actualitesSimilaires = Actualite::where('id', '!=', $actualite->id)
            ->where('actif', true)
            ->where('date_publication', '<=', now())
            ->orderBy('date_publication', 'desc')
            ->limit(3)
            ->get();

        return view('pages.actualites.show', compact('actualite', 'actualitesSimilaires'));
    }
}
