<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Eservice;
use Illuminate\Support\Str;

class DeduplicateEservicesSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info("Démarrage de la déduplication des e-services...");
        
        $allServices = Eservice::all();
        $uniqueServices = [];
        $duplicates = [];
        
        foreach ($allServices as $service) {
            // Normaliser le nom pour la comparaison (sans espaces, minuscules, sans accents)
            $normalizedName = $this->normalize($service->nom);
            
            if (!isset($uniqueServices[$normalizedName])) {
                // Premier service avec ce nom normalisé
                $uniqueServices[$normalizedName] = $service;
            } else {
                // Doublon détecté
                $existing = $uniqueServices[$normalizedName];
                
                // Garder celui qui a le plus d'informations (description la plus longue)
                if (strlen($service->description) > strlen($existing->description)) {
                    // Le nouveau est plus complet, on supprime l'ancien
                    $duplicates[] = $existing->id;
                    $uniqueServices[$normalizedName] = $service;
                } else {
                    // L'ancien est mieux, on supprime le nouveau
                    $duplicates[] = $service->id;
                }
            }
        }
        
        // Supprimer les doublons
        if (count($duplicates) > 0) {
            Eservice::whereIn('id', $duplicates)->delete();
            $this->command->info("✓ " . count($duplicates) . " doublons supprimés.");
        } else {
            $this->command->info("✓ Aucun doublon détecté.");
        }
        
        $this->command->info("✓ " . count($uniqueServices) . " services uniques conservés.");
    }
    
    private function normalize($string)
    {
        // Supprimer les accents
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        // Minuscules
        $string = strtolower($string);
        // Supprimer espaces et caractères spéciaux
        $string = preg_replace('/[^a-z0-9]/', '', $string);
        return $string;
    }
}
