<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type');
        $categorie = $request->input('categorie');

        $query = Document::actifs()
            ->with(['categorie', 'structure']);

        if ($type) {
            $query->where('type', $type);
        }

        if ($categorie) {
            $query->where('categorie_id', $categorie);
        }

        $documents = $query->orderBy('date_signature', 'desc')
            ->paginate(15);

        $types = [
            'loi' => 'Lois',
            'decret' => 'Décrets',
            'arrete' => 'Arrêtés',
            'circulaire' => 'Circulaires',
            'note' => 'Notes de service',
            'autre' => 'Autres documents',
        ];

        $categories = Categorie::where('actif', true)
            ->orderBy('nom')
            ->get();

        return view('pages.documents.index', compact('documents', 'types', 'categories', 'type', 'categorie'));
    }

    public function show($slug)
    {
        $document = Document::actifs()
            ->where('slug', $slug)
            ->with(['categorie', 'structure'])
            ->firstOrFail();

        return view('pages.documents.show', compact('document'));
    }

    public function download($slug)
    {
        $document = Document::actifs()
            ->where('slug', $slug)
            ->firstOrFail();

        $document->incrementerTelechargements();

        $path = 'documents/' . $document->fichier;
        
        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'Fichier non trouvé');
        }

        return Storage::disk('public')->download($path, $document->titre . '.' . $document->format);
    }
}
