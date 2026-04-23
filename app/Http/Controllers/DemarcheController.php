<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Procedure;
use App\Models\Eservice;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;

class DemarcheController extends Controller
{
    public function index()
    {
        $procedures = Procedure::active()
            ->orderByDesc('views_count')
            ->orderBy('title', 'asc')
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
        $document = Document::where('slug', $slug)->firstOrFail();

        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'Le fichier n\'existe pas sur le serveur.');
        }

        $document->increment('downloads_count');

        return Storage::disk('public')->download($document->file_path, $document->title);
    }
}
