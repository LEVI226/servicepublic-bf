<?php

namespace App\Http\Controllers;

use App\Models\Eservice;
use App\Models\Demande;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EserviceController extends Controller
{
    public function index()
    {
        $eservices = Eservice::enLigne()
            ->with('structure')
            ->with('categorie')
            ->orderBy('nom')
            ->paginate(12);

        $categories = Categorie::whereHas('eservices', function($q) {
                $q->where('en_ligne', true)->where('actif', true);
            })
            ->where('actif', true)
            ->orderBy('nom')
            ->get();

        return view('pages.eservices.index', compact('eservices', 'categories'));
    }

    public function show($slug)
    {
        $eservice = Eservice::enLigne()
            ->where('slug', $slug)
            ->with(['structure', 'categorie'])
            ->firstOrFail();

        $eservice->incrementerVues();

        // Si le service est externe, rediriger
        if ($eservice->est_externe) {
            return redirect()->away($eservice->url_externe);
        }

        $eservicesSimilaires = Eservice::enLigne()
            ->where('categorie_id', $eservice->categorie_id)
            ->where('id', '!=', $eservice->id)
            ->limit(3)
            ->get();

        return view('pages.eservices.show', compact('eservice', 'eservicesSimilaires'));
    }

    public function demande($slug)
    {
        $eservice = Eservice::enLigne()
            ->where('slug', $slug)
            ->firstOrFail();

        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('info', 'Veuillez vous connecter ou créer un compte pour effectuer cette demande.');
        }

        return view('pages.eservices.demande', compact('eservice'));
    }

    public function soumettreDemande(Request $request, $slug)
    {
        $eservice = Eservice::enLigne()
            ->where('slug', $slug)
            ->firstOrFail();

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Validation dynamique basée sur les champs du formulaire
        $rules = [];
        $champs = $eservice->champs_formulaire ?? [];
        
        foreach ($champs as $champ) {
            $fieldName = 'champ_' . $champ['name'];
            $fieldRules = [];
            
            if ($champ['required'] ?? false) {
                $fieldRules[] = 'required';
            } else {
                $fieldRules[] = 'nullable';
            }
            
            switch ($champ['type']) {
                case 'email':
                    $fieldRules[] = 'email';
                    break;
                case 'number':
                    $fieldRules[] = 'numeric';
                    break;
                case 'date':
                    $fieldRules[] = 'date';
                    break;
                case 'file':
                    $fieldRules[] = 'file|max:10240'; // 10MB max
                    break;
                default:
                    $fieldRules[] = 'string';
            }
            
            $rules[$fieldName] = implode('|', $fieldRules);
        }

        $validated = $request->validate($rules);

        // Traiter les fichiers uploadés
        $donneesFormulaire = [];
        $documentsJoints = [];

        foreach ($champs as $champ) {
            $fieldName = 'champ_' . $champ['name'];
            
            if ($champ['type'] === 'file' && $request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $path = $file->store('demandes/documents', 'public');
                $documentsJoints[] = [
                    'nom' => $champ['label'],
                    'fichier' => $path,
                    'original_name' => $file->getClientOriginalName(),
                ];
                $donneesFormulaire[$champ['name']] = $path;
            } else {
                $donneesFormulaire[$champ['name']] = $validated[$fieldName] ?? null;
            }
        }

        // Créer la demande
        $demande = Demande::create([
            'reference' => 'DEM-' . strtoupper(Str::random(8)),
            'user_id' => auth()->id(),
            'eservice_id' => $eservice->id,
            'donnees_formulaire' => $donneesFormulaire,
            'documents_joints' => $documentsJoints,
            'statut' => 'soumise',
            'date_soumission' => now(),
        ]);

        // Créer une notification
        \App\Models\Notification::create([
            'user_id' => auth()->id(),
            'titre' => 'Demande soumise avec succès',
            'message' => "Votre demande pour \"{$eservice->nom}\" a été soumise. Référence : {$demande->reference}",
            'type' => 'success',
            'lien' => route('dashboard.demandes.show', $demande->id),
        ]);

        return redirect()->route('dashboard.demandes.show', $demande->id)
            ->with('success', 'Votre demande a été soumise avec succès. Votre référence est : ' . $demande->reference);
    }
}
