<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Comment puis-je suivre l\'état d\'avancement de ma demande de passeport ?',
                'answer' => 'Une fois votre dépôt effectué, vous recevrez un numéro de suivi sur votre récépissé. Vous pourrez utiliser ce numéro dans la section "Suivi de dossier" très prochainement, ou contacter directement l\'Office National d\'Identification (ONI).',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => 'Où et comment dois-je payer les frais liés à ma démarche ?',
                'answer' => 'Le portail national Service Public a pour objectif principal de vous informer. Les paiements de timbres fiscaux, de quittances ou de frais de dossiers s\'effectuent directement auprès des guichets des institutions compétentes (Trésor Public, Commissariats, Mairies, etc.) mentionnées sur chaque fiche de procédure.',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'question' => 'Quelle est la durée de validité d\'un extrait d\'acte de naissance ?',
                'answer' => 'D\'une manière générale, pour les procédures administratives courantes (comme le mariage ou la demande de CNIB), il est exigé que l\'extrait d\'acte de naissance date de moins de trois (3) mois.',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'question' => 'Je n\'arrive pas à trouver la démarche que je cherche, que faire ?',
                'answer' => 'Vous pouvez utiliser la barre de recherche intelligente située sur la page d\'accueil. Si votre démarche n\'est pas encore dématérialisée, n\'hésitez pas à consulter l\'Annuaire pour trouver les coordonnées de l\'institution publique compétente.',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'question' => 'Comment obtenir un duplicata en cas de perte de ma CNIB ?',
                'answer' => 'En cas de perte, vous devez d\'abord faire une déclaration de perte au commissariat de police ou à la gendarmerie. Munissez-vous de cette déclaration et d\'un timbre fiscal de 2500 FCFA pour constituer un dossier de renouvellement auprès de l\'ONI.',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'question' => 'Puis-je effectuer une démarche administrative pour un proche (enfant mineur) ?',
                'answer' => 'Oui, les parents ou les tuteurs légaux peuvent engager la plupart des démarches pour les mineurs (acte de naissance, passeport). Il faudra cependant prouver le lien de filiation avec un livret de famille ou un jugement d\'adoption.',
                'is_active' => true,
                'order' => 6,
            ]
        ];

        DB::table('faqs')->truncate(); // Clean up just in case
        
        foreach ($faqs as $faq) {
            $faq['created_at'] = now();
            $faq['updated_at'] = now();
            DB::table('faqs')->insert($faq);
        }

        $this->command->info("FaqSeeder: " . count($faqs) . " questions ajoutées avec succès !");
    }
}
