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
        // Nettoyage de la requête : retrait des caractères non alphanumériques (sauf espaces et accents)
        $qRaw = $request->get('q', '');
        $qClean = trim(preg_replace('/[^a-zA-Z0-9\sàâäéèêëîïôöùûüçÀÂÄÉÈÊËÎÏÔÖÙÛÜÇ\'-]/u', ' ', $qRaw));
        
        // Découpage par espaces et suppression des éléments vides
        $mots = array_values(array_filter(explode(' ', $qClean)));
        $q = implode(' ', $mots); // Pour réaffichage propre dans la vue

        $resultats = collect();

        if (count($mots) > 0) {
            
            // Préparation des sous-requêtes de scoring
            $scoreProcedures = '0';
            $bindingsProcedures = [];
            
            $scoreOrganismes = '0';
            $bindingsOrganismes = [];
            
            $scoreEservices = '0';
            $bindingsEservices = [];

            foreach ($mots as $mot) {
                // Scoring Procedures
                $scoreProcedures .= " + (CASE WHEN title LIKE ? THEN 10 ELSE 0 END)";
                $bindingsProcedures[] = "%{$mot}%";
                $scoreProcedures .= " + (CASE WHEN description LIKE ? THEN 5 ELSE 0 END)";
                $bindingsProcedures[] = "%{$mot}%";
                
                // Scoring Organismes
                $scoreOrganismes .= " + (CASE WHEN acronym LIKE ? THEN 15 ELSE 0 END)";
                $bindingsOrganismes[] = "%{$mot}%";
                $scoreOrganismes .= " + (CASE WHEN name LIKE ? THEN 10 ELSE 0 END)";
                $bindingsOrganismes[] = "%{$mot}%";
                $scoreOrganismes .= " + (CASE WHEN description LIKE ? THEN 5 ELSE 0 END)";
                $bindingsOrganismes[] = "%{$mot}%";

                // Scoring E-services
                $scoreEservices .= " + (CASE WHEN title LIKE ? THEN 10 ELSE 0 END)";
                $bindingsEservices[] = "%{$mot}%";
                $scoreEservices .= " + (CASE WHEN description LIKE ? THEN 5 ELSE 0 END)";
                $bindingsEservices[] = "%{$mot}%";
            }

            // 1. Procédures
            $proceduresQuery = Procedure::active()->select('procedures.*')->selectRaw("({$scoreProcedures}) as score", $bindingsProcedures);
            foreach ($mots as $mot) {
                $proceduresQuery->where(function($sub) use ($mot) {
                    $sub->where('title', 'LIKE', "%{$mot}%")
                        ->orWhere('description', 'LIKE', "%{$mot}%")
                        ->orWhere('documents_required', 'LIKE', "%{$mot}%");
                });
            }
            $procedures = $proceduresQuery->orderBy('score', 'desc')
                ->orderBy('views_count', 'desc')
                ->with('category')
                ->limit(20)
                ->get()
                ->map(fn($p) => [
                    'type' => 'procedure',
                    'titre' => $p->title,
                    'description' => Str::limit($p->description, 150),
                    'score' => $p->score,
                    'url' => $p->category ? route('fiches.show', [$p->category->slug, $p->slug]) : '#',
                ]);

            // 2. Organismes
            $organismesQuery = Organisme::active()->select('organismes.*')->selectRaw("({$scoreOrganismes}) as score", $bindingsOrganismes);
            foreach ($mots as $mot) {
                $organismesQuery->where(function($sub) use ($mot) {
                    $sub->where('name', 'LIKE', "%{$mot}%")
                        ->orWhere('acronym', 'LIKE', "%{$mot}%")
                        ->orWhere('description', 'LIKE', "%{$mot}%");
                });
            }
            $organismes = $organismesQuery->orderBy('score', 'desc')
                ->limit(10)
                ->get()
                ->map(fn($o) => [
                    'type' => 'organisme',
                    'titre' => $o->full_name,
                    'description' => $o->description ? Str::limit($o->description, 150) : null,
                    'score' => $o->score,
                    'url' => route('annuaire.show', $o->slug),
                ]);

            // 3. E-services
            $eservicesQuery = Eservice::active()->select('eservices.*')->selectRaw("({$scoreEservices}) as score", $bindingsEservices);
            foreach ($mots as $mot) {
                $eservicesQuery->where(function($sub) use ($mot) {
                    $sub->where('title', 'LIKE', "%{$mot}%")
                        ->orWhere('description', 'LIKE', "%{$mot}%");
                });
            }
            $eservices = $eservicesQuery->orderBy('score', 'desc')
                ->limit(10)
                ->get()
                ->map(fn($e) => [
                    'type' => 'eservice',
                    'titre' => $e->title,
                    'description' => $e->description ? Str::limit($e->description, 150) : null,
                    'score' => $e->score,
                    'url' => $e->url,
                ]);

            // Regrouper et trier le résultat final par score global
            $resultats = $procedures->concat($organismes)->concat($eservices)->sortByDesc('score')->values();
        }

        return view('pages.recherche.index', compact('q', 'resultats'));
    }
}
