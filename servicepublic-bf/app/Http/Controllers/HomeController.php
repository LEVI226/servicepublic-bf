<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Eservice;
use App\Models\Document;
use App\Models\Actualite;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categoriesParticuliers = Categorie::particuliers()
            ->racines()
            ->withCount('fiches')
            ->orderBy('ordre')
            ->limit(6)
            ->get();

        $categoriesEntreprises = Categorie::entreprises()
            ->racines()
            ->withCount('fiches')
            ->orderBy('ordre')
            ->limit(6)
            ->get();

        $eservices = Eservice::enLigne()
            ->with('structure')
            ->orderBy('vues', 'desc')
            ->limit(6)
            ->get();

        $documents = Document::actifs()
            ->orderBy('date_signature', 'desc')
            ->limit(6)
            ->get();

        $actualites = Actualite::actives()
            ->publiees()
            ->recentes(3)
            ->get();

        $stats = [
            'services' => Eservice::enLigne()->count(),
            'demandes' => '10K+',
            'structures' => \App\Models\Structure::actives()->count(),
            'documents' => Document::actifs()->count(),
        ];

        return view('pages.home.index', compact(
            'categoriesParticuliers',
            'categoriesEntreprises',
            'eservices',
            'documents',
            'actualites',
            'stats'
        ));
    }

    public function recherche(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return redirect()->route('home');
        }

        $fiches = \App\Models\Fiche::actives()
            ->where(function($q) use ($query) {
                $q->where('titre', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('contenu', 'like', "%{$query}%");
            })
            ->with('categorie')
            ->paginate(10, ['*'], 'fiches_page');

        $eservices = Eservice::enLigne()
            ->where(function($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->with('structure')
            ->paginate(10, ['*'], 'eservices_page');

        $documents = Document::actifs()
            ->where(function($q) use ($query) {
                $q->where('titre', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(10, ['*'], 'documents_page');

        $structures = \App\Models\Structure::actives()
            ->where(function($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                  ->orWhere('sigle', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->paginate(10, ['*'], 'structures_page');

        return view('pages.recherche.index', compact('query', 'fiches', 'eservices', 'documents', 'structures'));
    }

    public function suivi()
    {
        return view('pages.suivi.index');
    }

    public function verifierSuivi(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:50',
        ]);

        $demande = \App\Models\Demande::where('reference', $request->reference)->first();

        if (!$demande) {
            return back()->with('error', 'Aucune demande trouvée avec cette référence.');
        }

        return view('pages.suivi.resultat', compact('demande'));
    }

    public function contact(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'sujet' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Ici, vous pouvez envoyer l'email ou sauvegarder le message
        // Mail::to('contact@servicepublic.gov.bf')->send(new ContactMessage($validated));

        return back()->with('success', 'Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.');
    }
}
