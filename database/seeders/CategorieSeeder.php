<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        // Catégories pour les particuliers
        $categoriesParticuliers = [
            [
                'nom' => 'État civil et Identification',
                'slug' => 'etat-civil-identification',
                'description' => 'Démarches liées à l\'état civil (naissance, mariage, décès) et aux documents d\'identité.',
                'icone' => 'person-vcard',
                'type' => 'particulier',
                'ordre' => 1,
            ],
            [
                'nom' => 'Justice et Sécurité',
                'slug' => 'justice-securite',
                'description' => 'Services liés à la justice, au casier judiciaire et à la sécurité.',
                'icone' => 'shield-check',
                'type' => 'particulier',
                'ordre' => 2,
            ],
            [
                'nom' => 'Éducation et Formation',
                'slug' => 'education-formation',
                'description' => 'Services éducatifs, bourses d\'études et formations professionnelles.',
                'icone' => 'mortarboard',
                'type' => 'particulier',
                'ordre' => 3,
            ],
            [
                'nom' => 'Santé et Protection sociale',
                'slug' => 'sante-protection-sociale',
                'description' => 'Services de santé, d\'assurance maladie et de protection sociale.',
                'icone' => 'heart-pulse',
                'type' => 'particulier',
                'ordre' => 4,
            ],
            [
                'nom' => 'Emploi et Travail',
                'slug' => 'emploi-travail',
                'description' => 'Services liés à l\'emploi, au travail et à la protection sociale.',
                'icone' => 'briefcase',
                'type' => 'particulier',
                'ordre' => 5,
            ],
            [
                'nom' => 'Logement et Urbanisme',
                'slug' => 'logement-urbanisme',
                'description' => 'Services liés au logement, à l\'urbanisme et au foncier.',
                'icone' => 'house',
                'type' => 'particulier',
                'ordre' => 6,
            ],
            [
                'nom' => 'Transports et Mobilité',
                'slug' => 'transports-mobilite',
                'description' => 'Services liés aux transports, au permis de conduire et à la mobilité.',
                'icone' => 'car-front',
                'type' => 'particulier',
                'ordre' => 7,
            ],
            [
                'nom' => 'Citoyenneté et Élections',
                'slug' => 'citoyennete-elections',
                'description' => 'Services liés à la citoyenneté, aux élections et à la participation citoyenne.',
                'icone' => 'check-square',
                'type' => 'particulier',
                'ordre' => 8,
            ],
        ];

        // Catégories pour les entreprises
        $categoriesEntreprises = [
            [
                'nom' => 'Création d\'entreprise',
                'slug' => 'creation-entreprise',
                'description' => 'Démarches pour créer et immatriculer une entreprise.',
                'icone' => 'building-add',
                'type' => 'entreprise',
                'ordre' => 1,
            ],
            [
                'nom' => 'Fiscalité et Impôts',
                'slug' => 'fiscalite-impots',
                'description' => 'Services liés à la fiscalité des entreprises et aux impôts.',
                'icone' => 'calculator',
                'type' => 'entreprise',
                'ordre' => 2,
            ],
            [
                'nom' => 'Douanes et Commerce extérieur',
                'slug' => 'douanes-commerce-exterieur',
                'description' => 'Services liés aux douanes et au commerce international.',
                'icone' => 'globe',
                'type' => 'entreprise',
                'ordre' => 3,
            ],
            [
                'nom' => 'Marchés publics',
                'slug' => 'marches-publics',
                'description' => 'Accès aux marchés publics et appels d\'offres.',
                'icone' => 'file-earmark-text',
                'type' => 'entreprise',
                'ordre' => 4,
            ],
            [
                'nom' => 'Ressources humaines',
                'slug' => 'ressources-humaines',
                'description' => 'Services liés à la gestion des ressources humaines.',
                'icone' => 'people',
                'type' => 'entreprise',
                'ordre' => 5,
            ],
            [
                'nom' => 'Environnement et Normes',
                'slug' => 'environnement-normes',
                'description' => 'Services liés à l\'environnement et aux normes de qualité.',
                'icone' => 'tree',
                'type' => 'entreprise',
                'ordre' => 6,
            ],
            [
                'nom' => 'Propriété intellectuelle',
                'slug' => 'propriete-intellectuelle',
                'description' => 'Services liés aux brevets, marques et droits d\'auteur.',
                'icone' => 'lightbulb',
                'type' => 'entreprise',
                'ordre' => 7,
            ],
            [
                'nom' => 'Financement et Investissement',
                'slug' => 'financement-investissement',
                'description' => 'Services liés au financement et à l\'investissement des entreprises.',
                'icone' => 'cash-stack',
                'type' => 'entreprise',
                'ordre' => 8,
            ],
        ];

        foreach (array_merge($categoriesParticuliers, $categoriesEntreprises) as $categorie) {
            Categorie::create($categorie);
        }

        // Sous-catégories pour les particuliers
        $etatCivil = Categorie::where('slug', 'etat-civil-identification')->first();
        if ($etatCivil) {
            $sousCategories = [
                ['nom' => 'Acte de naissance', 'slug' => 'acte-naissance', 'icone' => 'file-text'],
                ['nom' => 'Acte de mariage', 'slug' => 'acte-mariage', 'icone' => 'heart'],
                ['nom' => 'Acte de décès', 'slug' => 'acte-deces', 'icone' => 'file-text'],
                ['nom' => 'Carte Nationale d\'Identité', 'slug' => 'cni', 'icone' => 'card-text'],
                ['nom' => 'Passeport', 'slug' => 'passeport', 'icone' => 'passport'],
            ];

            foreach ($sousCategories as $sousCategorie) {
                Categorie::create([
                    'nom' => $sousCategorie['nom'],
                    'slug' => $sousCategorie['slug'],
                    'description' => 'Services liés à ' . strtolower($sousCategorie['nom']),
                    'icone' => $sousCategorie['icone'],
                    'type' => 'particulier',
                    'parent_id' => $etatCivil->id,
                    'ordre' => 1,
                ]);
            }
        }

        // Sous-catégories pour les entreprises
        $creation = Categorie::where('slug', 'creation-entreprise')->first();
        if ($creation) {
            $sousCategories = [
                ['nom' => 'RCCM', 'slug' => 'rccm', 'icone' => 'file-earmark-text'],
                ['nom' => 'NIF', 'slug' => 'nif', 'icone' => 'hash'],
                ['nom' => 'CNSS', 'slug' => 'cnss', 'icone' => 'shield'],
                ['nom' => 'Autorisations d\'exercice', 'slug' => 'autorisations', 'icone' => 'check-circle'],
            ];

            foreach ($sousCategories as $sousCategorie) {
                Categorie::create([
                    'nom' => $sousCategorie['nom'],
                    'slug' => $sousCategorie['slug'],
                    'description' => 'Services liés à ' . strtolower($sousCategorie['nom']),
                    'icone' => $sousCategorie['icone'],
                    'type' => 'entreprise',
                    'parent_id' => $creation->id,
                    'ordre' => 1,
                ]);
            }
        }
    }
}
