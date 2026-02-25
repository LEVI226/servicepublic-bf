<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(database_path('data/categories.json'));
        $categories = json_decode($json, true);

        if (!$categories) {
            $this->command->error('Impossible de lire categories.json');
            return;
        }

        $this->command->info("Import de " . count($categories) . " catégories...");

        // Mapping des icônes par défaut par catégorie (à adapter selon tes données)
        $defaultIcons = [
            'Activités commerciales' => 'fas fa-store',
            'Administration du travail' => 'fas fa-briefcase',
            'Aménagements urbains' => 'fas fa-city',
            'Arts et culture' => 'fas fa-palette',
            'Assainissement' => 'fas fa-recycle',
            'Bâtiments' => 'fas fa-building',
            'Bourses d\'études/Prêts et Aides' => 'fas fa-graduation-cap',
            'Commandes publiques' => 'fas fa-file-contract',
            'Communication' => 'fas fa-bullhorn',
            'Communication audio-visuelle' => 'fas fa-tv',
            'Comptabilité publique' => 'fas fa-calculator',
            'Concurrence' => 'fas fa-balance-scale',
            'Construction d\'ouvrages' => 'fas fa-hard-hat',
            'Contentieux Électoraux' => 'fas fa-gavel',
            'Contrôle de constitutionnalité' => 'fas fa-landmark',
            'Contrôle des Partis Politiques' => 'fas fa-users',
            'Création d\'entreprise' => 'fas fa-rocket',
            'Décentralisation' => 'fas fa-map-marked-alt',
            'Dépenses publiques' => 'fas fa-money-bill-wave',
            'Diplomatie' => 'fas fa-globe-africa',
            'Distinction honorifique' => 'fas fa-medal',
            'Eau' => 'fas fa-tint',
            'Emploi' => 'fas fa-user-tie',
            'Enseignement' => 'fas fa-chalkboard-teacher',
            'Etat civil' => 'fas fa-id-card',
            'Faune' => 'fas fa-paw',
            'Femme et Genre' => 'fas fa-female',
            'Formation' => 'fas fa-book-reader',
            'Formation professionnelle' => 'fas fa-tools',
            'Gestion de carrière' => 'fas fa-chart-line',
            'Gouvernance administrative' => 'fas fa-university',
            'Gouvernance économique' => 'fas fa-coins',
            'Gouvernance politique' => 'fas fa-flag',
            'Impôts et taxes' => 'fas fa-file-invoice-dollar',
            'Information géographique' => 'fas fa-map',
            'Logistique' => 'fas fa-truck',
            'Loisirs' => 'fas fa-futbol',
            'Médiation dans le public' => 'fas fa-handshake',
            'Mines' => 'fas fa-mountain',
            'Pêche' => 'fas fa-fish',
            'Promotion de la jeunesse' => 'fas fa-child',
            'Promotion de la justice' => 'fas fa-balance-scale-right',
            'Promotion des droits humains' => 'fas fa-hand-holding-heart',
            'Promotion des énergies renouvelables' => 'fas fa-solar-panel',
            'Promotion du sport' => 'fas fa-running',
            'Protection civile' => 'fas fa-shield-alt',
            'Protection de l\'environnement' => 'fas fa-leaf',
            'Protection sociale' => 'fas fa-hands-helping',
            'Prêts, aides et dons' => 'fas fa-hand-holding-usd',
            'Recherche scientifique' => 'fas fa-flask',
            'Recrutement' => 'fas fa-user-plus',
            'Régulation Institutions/Politiques' => 'fas fa-landmark',
            'Révision constitutionnelle' => 'fas fa-scroll',
            'Santé humaine' => 'fas fa-heartbeat',
            'Secteur agricole' => 'fas fa-seedling',
            'Secteur de l\'élevage' => 'fas fa-horse',
            'Services sociaux' => 'fas fa-people-carry',
            'Sécurité' => 'fas fa-lock',
            'TIC' => 'fas fa-laptop-code',
            'Tourisme' => 'fas fa-plane',
            'Transport' => 'fas fa-bus',
            'Autres' => 'fas fa-folder-open',
        ];

        // Couleurs pour varier les catégories
        $colors = ['#009E49', '#2563EB', '#DC2626', '#D97706', '#7C3AED', '#0891B2', '#BE185D', '#059669', '#4F46E5', '#CA8A04'];

        $count = 0;
        foreach ($categories as $i => $cat) {
            $name = trim($cat['name'] ?? '');
            if (empty($name)) continue;

            $slug = $cat['slug'] ?? Str::slug($name);

            Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'slug' => $slug,
                    'icon' => $defaultIcons[$name] ?? 'fas fa-folder',
                    'color' => $colors[$i % count($colors)],
                    'description' => $cat['description'] ?? "Procédures liées à : {$name}",
                    'order' => $cat['order'] ?? ($i + 1),
                    'is_active' => ($cat['procedures_count'] ?? 0) > 0,
                ]
            );
            $count++;
        }

        $this->command->info("✅ {$count} catégories importées.");
    }
}
