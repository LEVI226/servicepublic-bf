<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Procedure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProcedureSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(database_path('data/procedures.json'));
        $procedures = json_decode($json, true);

        if (!$procedures) {
            $this->command->error('Impossible de lire procedures.json');
            return;
        }

        $this->command->info("Import de " . count($procedures) . " procédures...");

        // Charger le mapping catégorie name → id
        $categoryMap = Category::pluck('id', 'name')->toArray();

        // Aussi mapper par slug pour fallback
        $categorySlugMap = Category::pluck('id', 'slug')->toArray();

        $count = 0;
        $skipped = 0;
        $noCat = 0;

        foreach ($procedures as $proc) {
            $title = trim($proc['title'] ?? '');
            $slug = trim($proc['slug'] ?? '');

            // Ignorer les entrées sans titre ni slug
            if (empty($title) && empty($slug)) {
                $skipped++;
                continue;
            }

            // Si le titre est encore "CatégorieLes procedures", reconstruire depuis le slug
            if (empty($title) || str_contains($title, 'Les procedures')) {
                $title = $this->titleFromSlug($slug, $proc['category'] ?? '');
            }

            // Trouver la catégorie
            $categoryName = trim($proc['category'] ?? '');
            $categoryId = null;

            if ($categoryName) {
                $categoryId = $categoryMap[$categoryName] ?? null;

                // Fallback par slug
                if (!$categoryId) {
                    $catSlug = Str::slug($categoryName);
                    $categoryId = $categorySlugMap[$catSlug] ?? null;
                }
            }

            if (!$categoryId) {
                $noCat++;
                // Assigner à "Autres" par défaut
                $categoryId = $categoryMap['Autres'] ?? Category::first()?->id;
            }

            // Normaliser le coût
            $cost = trim($proc['cost'] ?? '');
            $isFree = false;
            if (empty($cost) || strtolower($cost) === 'gratuit' || $cost === '0') {
                $isFree = true;
                $cost = 'Gratuit';
            }

            // Garantir un slug unique
            if (empty($slug)) {
                $slug = Str::slug($title);
            }

            // Tronquer le slug si trop long
            $slug = Str::limit($slug, 200, '');

            $procModel = Procedure::updateOrCreate(
                ['slug' => $slug],
                [
                    'category_id' => $categoryId,
                    'subcategory_id' => null,
                    'title' => $title,
                    'slug' => $slug,
                    'description' => $proc['description'] ?? '',
                    'documents_required' => $proc['documents_required'] ?? '',
                    'cost' => $cost,
                    'conditions' => $proc['conditions'] ?? '',
                    'delay' => $proc['delay'] ?? '',
                    'more_info' => $proc['more_info'] ?? '',
                    'is_free' => $isFree,
                    'is_active' => true,
                    'is_featured' => false,
                    'views_count' => 0,
                    'meta_title' => Str::limit($title, 60),
                    'meta_description' => Str::limit($proc['description'] ?? '', 160),
                ]
            );

            // Gérer les documents associés
            if (isset($proc['documents']) && is_array($proc['documents'])) {
                foreach ($proc['documents'] as $doc) {
                    $docTitle = $doc['title'] ?? 'Document attaché';
                    $docUrl = $doc['url'] ?? '';
                    if ($docUrl) {
                        \App\Models\Document::updateOrCreate(
                            ['procedure_id' => $procModel->id, 'file_path' => $docUrl],
                            [
                                'title' => $docTitle,
                                'file_path' => $docUrl,
                            ]
                        );
                    }
                }
            }

            $count++;
        }

        $this->command->info("✅ {$count} procédures importées.");
        if ($skipped > 0) $this->command->warn("⚠️ {$skipped} entrées ignorées (sans titre/slug).");
        if ($noCat > 0) $this->command->warn("⚠️ {$noCat} procédures sans catégorie → assignées à 'Autres'.");
    }

    /**
     * Reconstruit un titre lisible depuis le slug.
     */
    private function titleFromSlug(string $slug, string $category = ''): string
    {
        // Retirer le préfixe catégorie du slug
        if ($category) {
            $catSlug = Str::slug($category);
            if (str_starts_with($slug, $catSlug . '-')) {
                $slug = substr($slug, strlen($catSlug) + 1);
            }
        }

        // Convertir le slug en titre lisible
        $title = str_replace('-', ' ', $slug);
        $title = ucfirst(trim($title));

        // Corrections d'accents courantes
        $replacements = [
            'dagrement' => "d'agrément",
            'dautorisation' => "d'autorisation",
            'dattestation' => "d'attestation",
            'dinscription' => "d'inscription",
            'dimportation' => "d'importation",
            'dexportation' => "d'exportation",
            'detablissement' => "d'établissement",
            'dexercer' => "d'exercer",
            'detudes' => "d'études",
            'demploi' => "d'emploi",
            'dassurance' => "d'assurance",
            'dobtention' => "d'obtention",
            'didentite' => "d'identité",
            'dactivites' => "d'activités",
            'denquetes' => "d'enquêtes",
            'dhuiles' => "d'huiles",
        ];

        foreach ($replacements as $old => $new) {
            $title = str_ireplace($old, $new, $title);
        }

        return $title;
    }
}
