<?php

namespace Database\Seeders;

use App\Models\Fiche;
use App\Models\Categorie;
use Illuminate\Database\Seeder;

class FicheSeeder extends Seeder
{
    public function run(): void
    {
        $fiches = [
            // État civil - CNI
            [
                'titre' => 'Demande de Carte Nationale d\'Identité (CNI)',
                'slug' => 'demande-cni',
                'description' => 'Obtenez votre Carte Nationale d\'Identité Burkinabè.',
                'categorie_slug' => 'cni',
                'icone' => 'card-text',
                'duree_traitement' => 15,
                'cout' => 2500,
                'documents_requis' => [
                    'Extrait d\'acte de naissance',
                    'Certificat de nationalité',
                    'Photo d\'identité (fond blanc)',
                    'Ancienne CNI (en cas de renouvellement)',
                ],
                'etapes' => [
                    ['titre' => 'Rassembler les documents', 'description' => 'Préparez tous les documents requis.'],
                    ['titre' => 'Rendez-vous au guichet', 'description' => 'Présentez-vous au guichet ONI avec vos documents.'],
                    ['titre' => 'Prise d\'empreintes', 'description' => 'Vos empreintes digitales seront prises.'],
                    ['titre' => 'Paiement des frais', 'description' => 'Payez les frais de 2 500 FCFA.'],
                    ['titre' => 'Retrait de la CNI', 'description' => 'Retirez votre CNI après 15 jours ouvrables.'],
                ],
                'contact' => 'ONI: (+226) 25 30 64 00',
                'lieu' => 'Guichets ONI dans toutes les communes',
            ],
            [
                'titre' => 'Renouvellement de la CNI',
                'slug' => 'renouvellement-cni',
                'description' => 'Renouvelez votre Carte Nationale d\'Identité expirée.',
                'categorie_slug' => 'cni',
                'icone' => 'arrow-repeat',
                'duree_traitement' => 15,
                'cout' => 2500,
                'documents_requis' => [
                    'Ancienne CNI',
                    'Extrait d\'acte de naissance',
                    'Photo d\'identité (fond blanc)',
                ],
                'etapes' => [
                    ['titre' => 'Préparer les documents', 'description' => 'Rassemblez votre ancienne CNI et les autres documents.'],
                    ['titre' => 'Se rendre au guichet', 'description' => 'Présentez-vous au guichet ONI.'],
                    ['titre' => 'Paiement', 'description' => 'Payez les frais de renouvellement.'],
                    ['titre' => 'Retrait', 'description' => 'Retirez votre nouvelle CNI.'],
                ],
                'contact' => 'ONI: (+226) 25 30 64 00',
                'lieu' => 'Guichets ONI',
            ],

            // Passeport
            [
                'titre' => 'Demande de passeport biométrique',
                'slug' => 'demande-passeport',
                'description' => 'Obtenez votre passeport biométrique pour voyager à l\'étranger.',
                'categorie_slug' => 'passeport',
                'icone' => 'passport',
                'duree_traitement' => 30,
                'cout' => 50000,
                'documents_requis' => [
                    'CNI valide',
                    'Extrait d\'acte de naissance',
                    'Certificat de nationalité',
                    'Photo d\'identité (fond blanc)',
                    'Quittance de paiement',
                ],
                'etapes' => [
                    ['titre' => 'Constituer le dossier', 'description' => 'Rassemblez tous les documents requis.'],
                    ['titre' => 'Paiement', 'description' => 'Payez les frais de 50 000 FCFA à la DGI.'],
                    ['titre' => 'Dépôt du dossier', 'description' => 'Déposez votre dossier à la DNP.'],
                    ['titre' => 'Prise de photo', 'description' => 'Photo biométrique prise sur place.'],
                    ['titre' => 'Retrait', 'description' => 'Retirez votre passeport après 30 jours.'],
                ],
                'contact' => 'DNP: (+226) 25 30 65 00',
                'lieu' => 'Direction Nationale des Passeports, Ouagadougou',
            ],

            // Justice - Casier judiciaire
            [
                'titre' => 'Demande de bulletin n°3 du casier judiciaire',
                'slug' => 'demande-casier-judiciaire',
                'description' => 'Obtenez votre bulletin n°3 du casier judiciaire pour vos démarches administratives.',
                'categorie_slug' => 'justice-securite',
                'icone' => 'file-earmark-text',
                'duree_traitement' => 3,
                'cout' => 1000,
                'documents_requis' => [
                    'CNI valide',
                    'Extrait d\'acte de naissance',
                    'Timbre fiscal de 1000 FCFA',
                ],
                'etapes' => [
                    ['titre' => 'Acheter le timbre fiscal', 'description' => 'Achetez le timbre fiscal à la DGI.'],
                    ['titre' => 'Se rendre au tribunal', 'description' => 'Présentez-vous au greffe du tribunal.'],
                    ['titre' => 'Dépôt de la demande', 'description' => 'Déposez votre demande avec les documents.'],
                    ['titre' => 'Retrait', 'description' => 'Retirez votre bulletin après 3 jours.'],
                ],
                'contact' => 'Greffe du Tribunal',
                'lieu' => 'Tribunal de grande instance',
            ],

            // Éducation - Bourses
            [
                'titre' => 'Demande de bourse d\'études',
                'slug' => 'demande-bourse',
                'description' => 'Demandez une bourse d\'études pour poursuivre vos études supérieures.',
                'categorie_slug' => 'education-formation',
                'icone' => 'mortarboard',
                'duree_traitement' => 60,
                'cout' => 0,
                'documents_requis' => [
                    'Attestation d\'admission ou d\'inscription',
                    'Relevés de notes des deux derniers années',
                    'CNI du demandeur',
                    'Fiche de renseignements',
                    'Certificat de scolarité',
                ],
                'etapes' => [
                    ['titre' => 'Constituer le dossier', 'description' => 'Rassemblez tous les documents requis.'],
                    ['titre' => 'Remplir le formulaire', 'description' => 'Remplissez le formulaire de demande de bourse.'],
                    ['titre' => 'Dépôt du dossier', 'description' => 'Déposez votre dossier au MENAPLN.'],
                    ['titre' => 'Attente de la décision', 'description' => 'Attendez la décision de la commission.'],
                    ['titre' => 'Notification', 'description' => 'Vous serez notifié du résultat.'],
                ],
                'contact' => 'MENAPLN: (+226) 25 30 45 00',
                'lieu' => 'Ministère de l\'Éducation nationale',
            ],

            // Emploi - Concours
            [
                'titre' => 'Inscription aux concours de la fonction publique',
                'slug' => 'inscription-concours-fonction-publique',
                'description' => 'Inscrivez-vous aux concours de recrutement dans la fonction publique.',
                'categorie_slug' => 'emploi-travail',
                'icone' => 'briefcase',
                'duree_traitement' => 30,
                'cout' => 2000,
                'documents_requis' => [
                    'CNI valide',
                    'Diplômes requis',
                    'Extrait d\'acte de naissance',
                    'Certificat de nationalité',
                    'Casier judiciaire bulletin n°3',
                    'Certificat médical',
                    'Photos d\'identité',
                ],
                'etapes' => [
                    ['titre' => 'Consulter l\'avis de concours', 'description' => 'Lisez attentivement l\'avis de concours.'],
                    ['titre' => 'Constituer le dossier', 'description' => 'Préparez tous les documents requis.'],
                    ['titre' => 'Paiement des frais', 'description' => 'Payez les frais d\'inscription.'],
                    ['titre' => 'Dépôt du dossier', 'description' => 'Déposez votre dossier avant la date limite.'],
                    ['titre' => 'Convocation', 'description' => 'Attendez votre convocation aux épreuves.'],
                ],
                'contact' => 'MFPTPS: (+226) 25 30 51 00',
                'lieu' => 'Ministère de la Fonction publique',
            ],

            // Transports - Permis
            [
                'titre' => 'Demande de permis de conduire',
                'slug' => 'demande-permis-conduire',
                'description' => 'Obtenez votre permis de conduire pour la première fois.',
                'categorie_slug' => 'transports-mobilite',
                'icone' => 'car-front',
                'duree_traitement' => 45,
                'cout' => 15000,
                'documents_requis' => [
                    'CNI valide',
                    'Certificat médical',
                    'Photo d\'identité',
                    'Attestation de formation (auto-école)',
                    'Quittance de paiement',
                ],
                'etapes' => [
                    ['titre' => 'Formation en auto-école', 'description' => 'Suivez la formation théorique et pratique.'],
                    ['titre' => 'Examen théorique', 'description' => 'Passez l\'examen du code de la route.'],
                    ['titre' => 'Examen pratique', 'description' => 'Passez l\'examen de conduite.'],
                    ['titre' => 'Paiement', 'description' => 'Payez les frais de délivrance.'],
                    ['titre' => 'Retrait', 'description' => 'Retirez votre permis de conduire.'],
                ],
                'contact' => 'DGT: (+226) 25 30 66 00',
                'lieu' => 'Direction Générale des Transports',
            ],

            // Entreprises - RCCM
            [
                'titre' => 'Immatriculation au RCCM',
                'slug' => 'immatriculation-rccm',
                'description' => 'Immatriculez votre entreprise au Registre du Commerce et du Crédit Mobilier.',
                'categorie_slug' => 'rccm',
                'icone' => 'file-earmark-text',
                'duree_traitement' => 7,
                'cout' => 15000,
                'documents_requis' => [
                    'Statuts de l\'entreprise',
                    'Procès-verbal d\'assemblée constitutive',
                    'CNI du gérant ou des associés',
                    'Plan de localisation',
                    'Quittance de paiement',
                ],
                'etapes' => [
                    ['titre' => 'Rédiger les statuts', 'description' => 'Faites rédiger les statuts par un notaire ou un juriste.'],
                    ['titre' => 'Paiement des frais', 'description' => 'Payez les frais d\'immatriculation.'],
                    ['titre' => 'Dépôt du dossier', 'description' => 'Déposez votre dossier au Guichet Unique des Formalités d\'Entreprises.'],
                    ['titre' => 'Attente de traitement', 'description' => 'Attendez le traitement de votre dossier.'],
                    ['titre' => 'Retrait', 'description' => 'Retirez votre RCCM.'],
                ],
                'contact' => 'GUFE: (+226) 25 30 67 00',
                'lieu' => 'Guichet Unique des Formalités d\'Entreprises',
            ],

            // Entreprises - NIF
            [
                'titre' => 'Attribution du Numéro d\'Identification Fiscale (NIF)',
                'slug' => 'attribution-nif',
                'description' => 'Obtenez votre NIF pour vos obligations fiscales.',
                'categorie_slug' => 'nif',
                'icone' => 'hash',
                'duree_traitement' => 3,
                'cout' => 0,
                'documents_requis' => [
                    'RCCM',
                    'CNI du gérant',
                    'Attestation de localisation',
                ],
                'etapes' => [
                    ['titre' => 'Constituer le dossier', 'description' => 'Rassemblez les documents requis.'],
                    ['titre' => 'Se rendre à la DGI', 'description' => 'Présentez-vous au centre des impôts.'],
                    ['titre' => 'Remplir le formulaire', 'description' => 'Remplissez le formulaire de demande de NIF.'],
                    ['titre' => 'Attribution', 'description' => 'Recevez votre NIF immédiatement ou sous 3 jours.'],
                ],
                'contact' => 'DGI: (+226) 25 30 61 00',
                'lieu' => 'Direction Générale des Impôts',
            ],
        ];

        foreach ($fiches as $fiche) {
            $categorie = Categorie::where('slug', $fiche['categorie_slug'])->first();
            
            if ($categorie) {
                Fiche::create([
                    'titre' => $fiche['titre'],
                    'slug' => $fiche['slug'],
                    'description' => $fiche['description'],
                    'contenu' => $this->generateContenu($fiche),
                    'categorie_id' => $categorie->id,
                    'icone' => $fiche['icone'],
                    'duree_traitement' => $fiche['duree_traitement'],
                    'cout' => $fiche['cout'],
                    'documents_requis' => $fiche['documents_requis'],
                    'etapes' => $fiche['etapes'],
                    'contact' => $fiche['contact'],
                    'lieu' => $fiche['lieu'],
                    'vues' => rand(10, 500),
                    'actif' => true,
                ]);
            }
        }
    }

    private function generateContenu($fiche): string
    {
        $contenu = "<h2>Description</h2>\n";
        $contenu .= "<p>{$fiche['description']}</p>\n\n";
        
        $contenu .= "<h2>Documents requis</h2>\n<ul>\n";
        foreach ($fiche['documents_requis'] as $doc) {
            $contenu .= "<li>{$doc}</li>\n";
        }
        $contenu .= "</ul>\n\n";
        
        $contenu .= "<h2>Étapes de la procédure</h2>\n<ol>\n";
        foreach ($fiche['etapes'] as $etape) {
            $contenu .= "<li><strong>{$etape['titre']}</strong> : {$etape['description']}</li>\n";
        }
        $contenu .= "</ol>\n\n";
        
        $contenu .= "<h2>Informations pratiques</h2>\n";
        $contenu .= "<p><strong>Durée de traitement :</strong> {$fiche['duree_traitement']} jours ouvrables</p>\n";
        $contenu .= "<p><strong>Coût :</strong> " . number_format($fiche['cout'], 0, ',', ' ') . " FCFA</p>\n";
        $contenu .= "<p><strong>Contact :</strong> {$fiche['contact']}</p>\n";
        $contenu .= "<p><strong>Lieu :</strong> {$fiche['lieu']}</p>\n";
        
        return $contenu;
    }
}
