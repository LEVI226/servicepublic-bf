<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('faqs')->delete();
        
        \DB::table('faqs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'category_id' => NULL,
                'question' => 'Comment puis-je suivre l\'état d\'avancement de ma demande de passeport ?',
            'answer' => 'Une fois votre dépôt effectué, vous recevrez un numéro de suivi sur votre récépissé. Vous pourrez utiliser ce numéro dans la section "Suivi de dossier" très prochainement, ou contacter directement l\'Office National d\'Identification (ONI).',
                'order' => 1,
                'is_active' => 1,
                'created_at' => '2026-02-20 22:42:35',
                'updated_at' => '2026-02-20 22:42:35',
            ),
            1 => 
            array (
                'id' => 2,
                'category_id' => NULL,
                'question' => 'Où et comment dois-je payer les frais liés à ma démarche ?',
            'answer' => 'Le portail national Service Public a pour objectif principal de vous informer. Les paiements de timbres fiscaux, de quittances ou de frais de dossiers s\'effectuent directement auprès des guichets des institutions compétentes (Trésor Public, Commissariats, Mairies, etc.) mentionnées sur chaque fiche de procédure.',
                'order' => 2,
                'is_active' => 1,
                'created_at' => '2026-02-20 22:42:35',
                'updated_at' => '2026-02-20 22:42:35',
            ),
            2 => 
            array (
                'id' => 3,
                'category_id' => NULL,
                'question' => 'Quelle est la durée de validité d\'un extrait d\'acte de naissance ?',
            'answer' => 'D\'une manière générale, pour les procédures administratives courantes (comme le mariage ou la demande de CNIB), il est exigé que l\'extrait d\'acte de naissance date de moins de trois (3) mois.',
                'order' => 3,
                'is_active' => 1,
                'created_at' => '2026-02-20 22:42:35',
                'updated_at' => '2026-02-20 22:42:35',
            ),
            3 => 
            array (
                'id' => 4,
                'category_id' => NULL,
                'question' => 'Je n\'arrive pas à trouver la démarche que je cherche, que faire ?',
                'answer' => 'Vous pouvez utiliser la barre de recherche intelligente située sur la page d\'accueil. Si votre démarche n\'est pas encore dématérialisée, n\'hésitez pas à consulter l\'Annuaire pour trouver les coordonnées de l\'institution publique compétente.',
                'order' => 4,
                'is_active' => 1,
                'created_at' => '2026-02-20 22:42:35',
                'updated_at' => '2026-02-20 22:42:35',
            ),
            4 => 
            array (
                'id' => 5,
                'category_id' => NULL,
                'question' => 'Comment obtenir un duplicata en cas de perte de ma CNIB ?',
                'answer' => 'En cas de perte, vous devez d\'abord faire une déclaration de perte au commissariat de police ou à la gendarmerie. Munissez-vous de cette déclaration et d\'un timbre fiscal de 2500 FCFA pour constituer un dossier de renouvellement auprès de l\'ONI.',
                'order' => 5,
                'is_active' => 1,
                'created_at' => '2026-02-20 22:42:35',
                'updated_at' => '2026-02-20 22:42:35',
            ),
            5 => 
            array (
                'id' => 6,
                'category_id' => NULL,
            'question' => 'Puis-je effectuer une démarche administrative pour un proche (enfant mineur) ?',
            'answer' => 'Oui, les parents ou les tuteurs légaux peuvent engager la plupart des démarches pour les mineurs (acte de naissance, passeport). Il faudra cependant prouver le lien de filiation avec un livret de famille ou un jugement d\'adoption.',
                'order' => 6,
                'is_active' => 1,
                'created_at' => '2026-02-20 22:42:35',
                'updated_at' => '2026-02-20 22:42:35',
            ),
        ));
        
        
    }
}