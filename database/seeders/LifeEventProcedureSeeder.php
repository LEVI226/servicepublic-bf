<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LifeEvent;
use App\Models\Procedure;
use Illuminate\Support\Facades\DB;

class LifeEventProcedureSeeder extends Seeder
{
    /**
     * Associe les procédures aux événements de vie par recherche de mots-clés
     * dans les titres de procédures existantes.
     */
    public function run(): void
    {
        DB::table('life_event_procedure')->delete();

        $this->command->info('Linking life events to procedures...');

        $map = [
            // life_event_id => [mots-clés pour rechercher dans les titres de procédures]
            1  => ['entreprise', 'créer', 'RCCM', 'CEFORE', 'commercial', 'artisan', 'commerce', 'activité commerciale', 'registre', 'société', 'SARL', 'SA ', 'GIE'],
            2  => ['naissance', 'acte de naissance', 'état civil', 'neonatal', 'maternité', 'acte', 'nouveau-né'],
            3  => ['mariage', 'marier', 'acte de mariage', 'union', 'livret de famille'],
            4  => ['passeport', 'titre de voyage', 'laissez-passer'],
            5  => ['CNIB', 'carte nationale', 'carte d\'identité', 'identité nationale', 'biométrique'],
            6  => ['emploi', 'recrutement', 'travail', 'contrat de travail', 'embauche', 'chômage', 'demandeur', 'offre d\'emploi'],
            7  => ['construction', 'permis de construire', 'bâtiment', 'permis d\'urbanisme', 'lotissement', 'terrain', 'logement', 'permis'],
            8  => ['décès', 'acte de décès', 'inhumation', 'funéraire', 'succession'],
            9  => ['retraite', 'pension', 'CNSS', 'CARFO', 'vieillesse'],
            10 => ['scolarité', 'inscription', 'école', 'scolaire', 'établissement', 'enseignement', 'bourse', 'examen', 'BAC', 'BEPC', 'CEP'],
            11 => ['import', 'export', 'douane', 'transit', 'commerce extérieur', 'dédouanement', 'carnet'],
            12 => ['casier judiciaire', 'bulletin', 'extrait', 'judiciaire'],
        ];

        $total = 0;
        foreach ($map as $lifeEventId => $keywords) {
            $lifeEvent = LifeEvent::find($lifeEventId);
            if (!$lifeEvent) {
                continue;
            }

            // Build a query matching ANY keyword in title or description
            $query = Procedure::where('is_active', true);
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $kw) {
                    $q->orWhere('title', 'like', "%{$kw}%")
                      ->orWhere('description', 'like', "%{$kw}%");
                }
            });

            $procedures = $query->orderBy('views_count', 'desc')->limit(20)->get();

            $order = 0;
            foreach ($procedures as $procedure) {
                DB::table('life_event_procedure')->insertOrIgnore([
                    'life_event_id' => $lifeEventId,
                    'procedure_id'  => $procedure->id,
                    'order'         => $order++,
                ]);
                $total++;
            }

            $this->command->info("  [{$lifeEventId}] {$lifeEvent->title}: {$procedures->count()} procédures liées.");
        }

        $this->command->info("Done. Total links created: {$total}");
    }
}
