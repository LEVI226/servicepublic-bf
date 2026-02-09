<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Comment créer un compte sur le portail Service Public ?',
                'reponse' => 'Pour créer un compte, cliquez sur le bouton "Connexion" en haut à droite de la page, puis sélectionnez "Créer un compte". Remplissez le formulaire avec vos informations personnelles (nom, prénom, email, téléphone) et choisissez un mot de passe sécurisé. Un email de confirmation vous sera envoyé pour activer votre compte.',
                'ordre' => 1,
            ],
            [
                'question' => 'Comment suivre l\'état de ma demande ?',
                'reponse' => 'Vous pouvez suivre l\'état de votre demande de deux façons : 1) En vous connectant à votre espace personnel dans la section "Mes demandes", ou 2) En utilisant la fonction "Suivi" sur la page d\'accueil avec votre numéro de référence. Vous recevrez également des notifications par email à chaque changement de statut.',
                'ordre' => 2,
            ],
            [
                'question' => 'Quels sont les délais de traitement des demandes ?',
                'reponse' => 'Les délais de traitement varient selon le type de demande. Ils sont indiqués sur chaque fiche de procédure et sur les pages des e-services. En général, les demandes simples sont traitées en 3 à 5 jours ouvrables, tandis que les demandes complexes peuvent prendre jusqu\'à 30 jours ouvrables.',
                'ordre' => 3,
            ],
            [
                'question' => 'Comment obtenir un acte de naissance ?',
                'reponse' => 'Pour obtenir un acte de naissance, vous devez vous rendre à la mairie de votre lieu de naissance avec votre CNI et payer les frais de 500 FCFA par copie. Vous pouvez également faire une demande en ligne via notre e-service "Demande d\'acte de naissance" si votre commune est connectée au système.',
                'ordre' => 4,
            ],
            [
                'question' => 'Comment renouveler ma Carte Nationale d\'Identité ?',
                'reponse' => 'Pour renouveler votre CNI, présentez-vous au guichet de l\'ONI (Office National d\'Identification) avec votre ancienne CNI, un extrait d\'acte de naissance et une photo d\'identité. Le coût du renouvellement est de 2 500 FCFA et la nouvelle CNI est disponible après 15 jours ouvrables.',
                'ordre' => 5,
            ],
            [
                'question' => 'Comment s\'inscrire aux concours de la fonction publique ?',
                'reponse' => 'Les inscriptions aux concours de la fonction publique se font en ligne sur notre portail. Créez un compte, consultez les avis de concours en cours, choisissez le concours qui vous intéresse et suivez les instructions pour déposer votre candidature. Les frais d\'inscription sont de 2 000 FCFA.',
                'ordre' => 6,
            ],
            [
                'question' => 'Comment créer une entreprise au Burkina Faso ?',
                'reponse' => 'Pour créer une entreprise, vous devez : 1) Choisir la forme juridique, 2) Rédiger les statuts chez un notaire, 3) Immatriculer au RCCM au Guichet Unique des Formalités d\'Entreprises, 4) Obtenir un NIF à la DGI, 5) S\'inscrire à la CNSS. Le coût total varie selon le type d\'entreprise.',
                'ordre' => 7,
            ],
            [
                'question' => 'Comment obtenir un bulletin n°3 du casier judiciaire ?',
                'reponse' => 'Vous pouvez demander votre bulletin n°3 au greffe du tribunal de votre lieu de naissance ou de résidence. Présentez votre CNI, un extrait d\'acte de naissance et un timbre fiscal de 1 000 FCFA. Le bulletin est disponible après 3 jours ouvrables. La demande en ligne est également disponible.',
                'ordre' => 8,
            ],
            [
                'question' => 'Quels sont les documents nécessaires pour un passeport ?',
                'reponse' => 'Pour demander un passeport, vous avez besoin de : CNI valide, extrait d\'acte de naissance, certificat de nationalité, photo d\'identité (fond blanc), quittance de paiement de 50 000 FCFA. Déposez votre dossier à la Direction Nationale des Passeports. Le délai de délivrance est de 30 jours.',
                'ordre' => 9,
            ],
            [
                'question' => 'Comment contacter le service client ?',
                'reponse' => 'Vous pouvez contacter notre service client par : Téléphone au (+226) 25 30 66 30 du lundi au vendredi de 7h30 à 17h30, par email à contact@servicepublic.gov.bf, ou via le formulaire de contact sur notre site. Nous vous répondrons dans les 48 heures ouvrables.',
                'ordre' => 10,
            ],
            [
                'question' => 'Comment trouver une information sur un ministère ?',
                'reponse' => 'Utilisez notre annuaire numérique accessible depuis le menu "Annuaire". Vous y trouverez les coordonnées de tous les ministères, institutions et directions. Vous pouvez rechercher par nom, type de structure ou parcourir la liste alphabétique.',
                'ordre' => 11,
            ],
            [
                'question' => 'Les e-services sont-ils sécurisés ?',
                'reponse' => 'Oui, tous nos e-services utilisent un chiffrement SSL/TLS pour sécuriser vos données. Vos informations personnelles sont protégées conformément à la loi sur la protection des données. Nous vous recommandons d\'utiliser un mot de passe fort et de ne jamais partager vos identifiants.',
                'ordre' => 12,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
