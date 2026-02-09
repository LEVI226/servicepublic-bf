<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Eservice;
use App\Models\Structure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CsvDataImportSeeder extends Seeder
{
    public function run(): void
    {
        // Liste des fichiers CSV à importer
        $csvFiles = [
            'extract-data-2026-01-31.csv',
            'extract-data-2026-01-31 (1).csv',
        ];

        foreach ($csvFiles as $filename) {
            $filepath = base_path($filename);
            
            if (!file_exists($filepath)) {
                $this->command->warn("Fichier non trouvé : $filename");
                continue;
            }

            $this->command->info("Import de $filename...");
            $this->importEservices($filepath);
        }

        $this->command->info("Import terminé avec succès !");
    }

    private function importEservices($filepath)
    {
        // Trouver ou créer une catégorie par défaut pour les e-services importés
        $defaultCategory = \App\Models\Categorie::firstOrCreate(
            ['slug' => 'services-en-ligne-importes'],
            [
                'nom' => 'Services en ligne',
                'type' => 'particulier',
                'description' => 'Services administratifs en ligne',
                'actif' => true,
                'ordre' => 999,
            ]
        );

        $file = fopen($filepath, 'r');
        
        // Lire l'en-tête
        $header = fgetcsv($file);
        
        $imported = 0;
        $skipped = 0;

        while (($row = fgetcsv($file)) !== false) {
            // Mapper les colonnes
            $data = array_combine($header, $row);
            
            $serviceName = trim($data['service_name'] ?? '');
            $description = trim($data['description'] ?? '');
            $requirements = trim($data['requirements'] ?? '');
            $ministryName = trim($data['ministry_or_department'] ?? '');
            
            if (empty($serviceName)) {
                $skipped++;
                continue;
            }

            // Générer un slug unique
            $slug = Str::slug($serviceName);
            $originalSlug = $slug;
            $counter = 1;
            
            while (Eservice::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Trouver ou créer la structure (ministère)
            $structure = null;
            if (!empty($ministryName)) {
                $structure = Structure::where('nom', 'LIKE', '%' . substr($ministryName, 0, 30) . '%')
                    ->orWhere('sigle', 'LIKE', '%' . substr($ministryName, 0, 10) . '%')
                    ->first();
                
                // Si pas trouvé, créer une structure générique
                if (!$structure) {
                    $structureSlug = Str::slug($ministryName);
                    $originalStructureSlug = $structureSlug;
                    $structureCounter = 1;
                    
                    while (Structure::where('slug', $structureSlug)->exists()) {
                        $structureSlug = $originalStructureSlug . '-' . $structureCounter;
                        $structureCounter++;
                    }

                    $structure = Structure::create([
                        'nom' => Str::limit($ministryName, 200),
                        'slug' => $structureSlug,
                        'type' => 'ministere',
                        'actif' => true,
                    ]);
                }
            }

            // Préparer le contenu HTML
            $contenu = "<h3>Description</h3>\n<p>" . e($description) . "</p>\n";
            if (!empty($requirements)) {
                $contenu .= "<h3>Pièces requises</h3>\n<p>" . e($requirements) . "</p>\n";
            }

            // Créer l'e-service
            Eservice::create([
                'nom' => $serviceName,
                'slug' => $slug,
                'description' => $description ?: 'Service en ligne disponible.',
                'contenu' => $contenu,
                'categorie_id' => $defaultCategory->id,
                'structure_id' => $structure?->id,
                'en_ligne' => true,
                'actif' => true,
                'cout' => 0,
                'duree_traitement' => null,
            ]);

            $imported++;
        }

        fclose($file);

        $this->command->info("✓ $imported services importés, $skipped ignorés.");
    }
}
