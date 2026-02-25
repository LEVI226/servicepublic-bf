<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');
        $defaultCategory = $categories->first();

        $articles = [
            [
                'title' => 'Lancement du portail Service Public BF v2',
                'excerpt' => 'Le nouveau portail des services publics du Burkina Faso est désormais en ligne, offrant une interface moderne et un accès simplifié à toutes les démarches administratives.',
                'content' => '<p>Le Gouvernement du Burkina Faso annonce le lancement officiel de la version 2 du portail Service Public BF. Cette refonte majeure vise à offrir aux citoyens un accès plus simple, plus rapide et plus intuitif à l\'ensemble des services administratifs.</p><h3>Les nouveautés</h3><ul><li>Interface entièrement repensée avec un design moderne</li><li>Recherche améliorée couvrant fiches pratiques, e-services et organismes</li><li>Événements de vie : des guides pas-à-pas pour vos démarches courantes</li><li>Annuaire complet de l\'administration burkinabè</li></ul><p>Ce portail s\'inscrit dans la vision de modernisation de l\'administration publique et de transformation numérique du Burkina Faso.</p>',
                'published_at' => now(),
            ],
            [
                'title' => 'E-CasierJudiciaire : demandez votre casier en ligne',
                'excerpt' => 'La plateforme e-CasierJudiciaire permet désormais d\'obtenir un extrait de casier judiciaire sans se déplacer, directement depuis votre téléphone ou ordinateur.',
                'content' => '<p>Le Ministère de la Justice met à la disposition des citoyens la plateforme <strong>e-CasierJudiciaire</strong>, permettant de demander un extrait de casier judiciaire (bulletin n°3) entièrement en ligne.</p><h3>Comment ça marche ?</h3><ol><li>Rendez-vous sur la plateforme e-CasierJudiciaire</li><li>Remplissez le formulaire avec vos informations personnelles</li><li>Payez les frais via mobile money</li><li>Recevez votre document par voie électronique</li></ol>',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'CEFORE : créer votre entreprise en 48h',
                'excerpt' => 'Grâce au Centre de Formalités des Entreprises (CEFORE), les entrepreneurs peuvent désormais créer leur entreprise en seulement 48 heures.',
                'content' => '<p>Le CEFORE simplifie les démarches de création d\'entreprise au Burkina Faso. En regroupant toutes les formalités en un seul lieu, le centre permet aux entrepreneurs de lancer leur activité rapidement.</p><h3>Documents requis</h3><ul><li>Copie de la CNIB</li><li>Plan de localisation</li><li>Statuts de la société (pour les personnes morales)</li></ul><p>Pour plus d\'informations, consultez la fiche pratique dédiée dans la rubrique « Entreprises & Commerce ».</p>',
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'eSINTAX : déclarez vos impôts en ligne',
                'excerpt' => 'La Direction Générale des Impôts lance eSINTAX, la plateforme de déclaration et de paiement des impôts en ligne pour les entreprises et particuliers.',
                'content' => '<p>eSINTAX est la plateforme numérique de la Direction Générale des Impôts du Burkina Faso. Elle permet aux contribuables de :</p><ul><li>Télédéclarer leurs impôts</li><li>Effectuer le paiement en ligne</li><li>Suivre leurs dossiers fiscaux</li><li>Obtenir des attestations fiscales électroniques</li></ul><p>L\'utilisation d\'eSINTAX contribue à la modernisation de l\'administration fiscale et à la lutte contre la fraude.</p>',
                'published_at' => now()->subDays(14),
            ],
            [
                'title' => 'Guide : obtenir votre passeport burkinabè',
                'excerpt' => 'Découvrez les étapes à suivre pour obtenir ou renouveler votre passeport burkinabè, les pièces à fournir et les délais de traitement.',
                'content' => '<p>L\'obtention du passeport burkinabè nécessite de suivre une procédure précise auprès de la Direction de l\'Immigration et de la Police des Frontières.</p><h3>Pièces à fournir</h3><ul><li>CNIB en cours de validité</li><li>Extrait d\'acte de naissance</li><li>4 photos d\'identité récentes</li><li>Timbre fiscal</li></ul><h3>Délais</h3><p>Le délai de traitement est généralement de 2 à 4 semaines selon la période.</p>',
                'published_at' => now()->subDays(21),
            ],
            [
                'title' => 'Campusfaso : inscription universitaire en ligne',
                'excerpt' => 'La plateforme Campusfaso permet aux bacheliers et étudiants de s\'inscrire en ligne dans les universités publiques du Burkina Faso.',
                'content' => '<p>Campusfaso est la plateforme officielle d\'inscription et de gestion académique des universités publiques du Burkina Faso. Elle permet :</p><ul><li>Les pré-inscriptions et inscriptions en ligne</li><li>Le choix des filières et des universités</li><li>La consultation des résultats</li><li>La demande d\'hébergement en résidence universitaire</li></ul>',
                'published_at' => now()->subDays(30),
            ],
        ];

        $count = 0;
        foreach ($articles as $data) {
            Article::updateOrCreate(
                ['title' => $data['title']],
                [
                    'slug' => Str::slug($data['title']),
                    'excerpt' => $data['excerpt'],
                    'content' => $data['content'],
                    'category_id' => $defaultCategory?->id,
                    'published_at' => $data['published_at'],
                    'is_published' => true,
                    'is_featured' => $count < 3,
                    'views_count' => rand(50, 500),
                ]
            );
            $count++;
        }

        $this->command->info("ArticleSeeder: {$count} articles créés.");
    }
}
