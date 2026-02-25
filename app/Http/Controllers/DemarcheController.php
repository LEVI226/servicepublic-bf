<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use App\Models\Eservice;

class DemarcheController extends Controller
{
    public function index()
    {
        $procedures = Procedure::active()
            ->orderByDesc('views_count')
            ->with('category')
            ->limit(10)
            ->get();

        $eservices = Eservice::active()
            ->ordered()
            ->limit(10)
            ->get();

        return view('pages.demarches.index', compact('procedures', 'eservices'));
    }

    public function formulaires()
    {
        // Formulaires feature — will be handled via Documents model in future sprint
        return view('pages.demarches.formulaires', ['documents' => collect()]);
    }

    public function download(string $slug)
    {
        abort(404, 'Téléchargement non disponible.');
    }
}
