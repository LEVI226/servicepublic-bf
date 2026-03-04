<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use App\Models\Eservice;
use App\Models\Document;

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
        $documents = Document::whereNotNull('file_path')
            ->orderBy('title')
            ->paginate(20);

        return view('pages.demarches.formulaires', compact('documents'));
    }

    public function download(string $slug)
    {
        $document = Document::where('slug', $slug)
            ->firstOrFail();

        $path = storage_path('app/public/' . $document->file_path);

        if (!file_exists($path)) {
            abort(404, 'Fichier non disponible.');
        }

        $document->increment('downloads_count');

        return response()->download($path, $document->title . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION));
    }
}
