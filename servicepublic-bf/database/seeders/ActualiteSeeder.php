<?php

namespace Database\Seeders;

use App\Models\Actualite;
use App\Models\Structure;
use Illuminate\Database\Seeder;

class ActualiteSeeder extends Seeder
{
    public function run(): void
    {
        $actualites = [
            [
                'titre' => 'Lancement du nouveau portail des services publics',
                'slug' => 'lancement-nouveau-portail',
                'resume' => 'Le Gouvernement du Burkina Faso lance le nouveau portail des services publics pour faciliter l\'accès aux démarches administratives.',
                'contenu' => '<p>Le Gouvernement du Burkina Faso est fier de présenter le nouveau portail des services publics, une plateforme moderne et intuitive qui permet aux citoyens et aux entreprises d\'accéder facilement aux services administratifs.</p>
                <p>Ce portail offre :</p>
                <ul>
                    <li>Un accès simplifié aux démarches administratives</li>
                    <li>Des e-services disponibles 24h/24 et 7j/7</li>
                    <li>Un suivi en temps réel des demandes</li>
                    <li>Une base de données complète des structures administratives</li>
                    <li>Un espace personnel sécurisé pour chaque utilisateur</li>
                </ul>
                <p>Le Premier Ministre a souligné l\'importance de cette initiative dans la modernisation de l\'administration publique et l\'amélioration des services aux citoyens.</p>',
                'structure_slug' => 'primature',
                'type' => 'communique',
                'a_la_une' => true,
                'date_publication' => now(),
            ],
            [
                'titre' => 'Recrutement dans la fonction publique : ouverture des inscriptions',
                'slug' => 'recrutement-fonction-publique-2024',
                'resume' => 'Le Ministère de la Fonction publique annonce l\'ouverture des inscriptions aux concours de recrutement pour l\'année 2024.',
                'contenu' => '<p>Le Ministère de la Fonction publique, du Travail et de la Protection sociale informe le public que les inscriptions aux concours de recrutement dans la fonction publique pour l\'année 2024 sont ouvertes du 15 janvier au 15 février 2024.</p>
                <p>Les concours concernent les corps suivants :</p>
                <ul>
                    <li>Administrateurs civils</li>
                    <li>Attachés d\'administration</li>
                    <li>Secrétaires administratifs</li>
                    <li>Agents de service</li>
                </ul>
                <p>Les candidats sont invités à consulter les avis de concours sur le portail et à déposer leurs candidatures en ligne.</p>',
                'structure_slug' => 'mfptps',
                'type' => 'avis',
                'a_la_une' => true,
                'date_publication' => now()->subDays(5),
            ],
            [
                'titre' => 'Modernisation des services de l\'état civil',
                'slug' => 'modernisation-etat-civil',
                'resume' => 'Le Ministère de l\'Administration Territoriale lance un programme de modernisation des services de l\'état civil.',
                'contenu' => '<p>Dans le cadre de la modernisation de l\'administration, le Ministère de l\'Administration Territoriale, de la Décentralisation et de la Sécurité lance un programme ambitieux de modernisation des services de l\'état civil.</p>
                <p>Ce programme comprend :</p>
                <ul>
                    <li>La digitalisation des registres d\'état civil</li>
                    <li>La mise en place de guichets uniques dans les mairies</li>
                    <li>La formation des agents</li>
                    <li>L\'interopérabilité avec les autres services administratifs</li>
                </ul>
                <p>Cette initiative vise à réduire les délais de délivrance des actes d\'état civil et à améliorer la qualité du service rendu aux citoyens.</p>',
                'structure_slug' => 'matds',
                'type' => 'actualite',
                'a_la_une' => false,
                'date_publication' => now()->subDays(10),
            ],
        ];

        foreach ($actualites as $actualite) {
            $structure = Structure::where('slug', $actualite['structure_slug'])->first();
            
            if ($structure) {
                Actualite::create([
                    'titre' => $actualite['titre'],
                    'slug' => $actualite['slug'],
                    'resume' => $actualite['resume'],
                    'contenu' => $actualite['contenu'],
                    'structure_id' => $structure->id,
                    'type' => $actualite['type'],
                    'a_la_une' => $actualite['a_la_une'],
                    'date_publication' => $actualite['date_publication'],
                    'vues' => rand(10, 100),
                    'actif' => true,
                ]);
            }
        }
    }
}
