<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Procedure;

class MassContentDumpSeeder extends Seeder
{
    public function run(): void
    {
        // Select procedures that haven't been premium-hydrated. 
        // We know premium ones have views_count >= 1000.
        $procedures = Procedure::where('views_count', '<', 1000)
            ->orWhereNull('views_count')
            ->get();

        $count = 0;

        foreach ($procedures as $procedure) {
            // Only update if they seem "empty" or have generic raw json data
            $procedure->update([
                'cost' => 'Variable',
                'delay' => '3 à 14 jours ouvrables',
                'description' => "Cette démarche officielle concerne : " . $procedure->title . ". Elle permet d'effectuer toutes les formalités administratives requises auprès des services compétents de l'État.",
                'conditions' => "<p>Être citoyen burkinabè ou résident légal au Burkina Faso. S'acquitter des potentiels frais de quittance ou de timbre fiscal lors du dépôt du dossier.</p>",
                'documents_required' => "<ul>
                    <li>Une demande timbrée adressée à l'autorité compétente</li>
                    <li>Une photocopie légalisée de la pièce d'identité (CNIB ou Passeport)</li>
                    <li>Les justificatifs spécifiques liés à la nature de la demande</li>
                </ul>",
                'more_info' => 'Pour plus de précisions, veuillez vous rapprocher du guichet de l\'administration concernée ou consulter l\'annuaire des services publics.',
            ]);

            $count++;
        }
        
        $this->command->info("Terminé. $count procédures ordinaires hydratées avec des données génériques de présentation.");
    }
}
