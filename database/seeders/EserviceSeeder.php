<?php

namespace Database\Seeders;

use App\Models\Eservice;
use App\Models\Categorie;
use App\Models\Structure;
use Illuminate\Database\Seeder;

class EserviceSeeder extends Seeder
{
    public function run(): void
    {
        $eservices = [
            [
                'nom' => 'Inscription aux concours de la fonction publique',
                'slug' => 'inscription-concours-fonction-publique',
                'description' => 'Inscrivez-vous en ligne aux concours de recrutement dans la fonction publique.',
                'categorie_slug' => 'emploi-travail',
                'structure_slug' => 'mfptps',
                'icone' => 'briefcase',
                'en_ligne' => true,
                'duree_traitement' => 30,
                'cout' => 2000,
                'champs_formulaire' => [
                    ['name' => 'nom', 'label' => 'Nom', 'type' => 'text', 'required' => true],
                    ['name' => 'prenom', 'label' => 'Prénom', 'type' => 'text', 'required' => true],
                    ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
                    ['name' => 'telephone', 'label' => 'Téléphone', 'type' => 'tel', 'required' => true],
                    ['name' => 'date_naissance', 'label' => 'Date de naissance', 'type' => 'date', 'required' => true],
                    ['name' => 'diplome', 'label' => 'Diplôme', 'type' => 'select', 'required' => true, 'options' => ['BEPC', 'BAC', 'Licence', 'Master', 'Doctorat']],
                    ['name' => 'concours', 'label' => 'Concours souhaité', 'type' => 'select', 'required' => true],
                ],
                'documents_requis' => [
                    'CNI (scan)',
                    'Diplôme (scan)',
                    'Photo d\'identité',
                    'Casier judiciaire',
                ],
            ],
            [
                'nom' => 'Demande de bulletin n°3 du casier judiciaire',
                'slug' => 'demande-casier-judiciaire-en-ligne',
                'description' => 'Demandez votre bulletin n°3 du casier judiciaire en ligne.',
                'categorie_slug' => 'justice-securite',
                'structure_slug' => 'mjdhrc',
                'icone' => 'file-earmark-text',
                'en_ligne' => true,
                'duree_traitement' => 3,
                'cout' => 1000,
                'champs_formulaire' => [
                    ['name' => 'nom', 'label' => 'Nom', 'type' => 'text', 'required' => true],
                    ['name' => 'prenom', 'label' => 'Prénom', 'type' => 'text', 'required' => true],
                    ['name' => 'date_naissance', 'label' => 'Date de naissance', 'type' => 'date', 'required' => true],
                    ['name' => 'lieu_naissance', 'label' => 'Lieu de naissance', 'type' => 'text', 'required' => true],
                    ['name' => 'nom_pere', 'label' => 'Nom du père', 'type' => 'text', 'required' => true],
                    ['name' => 'nom_mere', 'label' => 'Nom de la mère', 'type' => 'text', 'required' => true],
                    ['name' => 'cni', 'label' => 'Numéro CNI', 'type' => 'text', 'required' => true],
                ],
                'documents_requis' => [
                    'CNI (scan)',
                    'Extrait d\'acte de naissance (scan)',
                ],
            ],
            [
                'nom' => 'Publication des offres d\'emploi',
                'slug' => 'publication-offres-emploi',
                'description' => 'Consultez les offres d\'emploi publiées par les entreprises et l\'administration.',
                'categorie_slug' => 'emploi-travail',
                'structure_slug' => 'mfptps',
                'icone' => 'search',
                'en_ligne' => true,
                'duree_traitement' => null,
                'cout' => 0,
                'champs_formulaire' => [],
                'documents_requis' => [],
            ],
            [
                'nom' => 'Demande d\'acte de naissance',
                'slug' => 'demande-acte-naissance',
                'description' => 'Demandez un extrait d\'acte de naissance en ligne.',
                'categorie_slug' => 'acte-naissance',
                'structure_slug' => 'matds',
                'icone' => 'file-text',
                'en_ligne' => true,
                'duree_traitement' => 5,
                'cout' => 500,
                'champs_formulaire' => [
                    ['name' => 'nom', 'label' => 'Nom', 'type' => 'text', 'required' => true],
                    ['name' => 'prenom', 'label' => 'Prénom', 'type' => 'text', 'required' => true],
                    ['name' => 'date_naissance', 'label' => 'Date de naissance', 'type' => 'date', 'required' => true],
                    ['name' => 'lieu_naissance', 'label' => 'Lieu de naissance', 'type' => 'text', 'required' => true],
                    ['name' => 'nom_pere', 'label' => 'Nom du père', 'type' => 'text', 'required' => true],
                    ['name' => 'nom_mere', 'label' => 'Nom de la mère', 'type' => 'text', 'required' => true],
                    ['name' => 'nombre_copies', 'label' => 'Nombre de copies', 'type' => 'number', 'required' => true],
                ],
                'documents_requis' => [
                    'CNI du demandeur (scan)',
                ],
            ],
            [
                'nom' => 'Demande d\'acte de mariage',
                'slug' => 'demande-acte-mariage',
                'description' => 'Demandez un extrait d\'acte de mariage en ligne.',
                'categorie_slug' => 'acte-mariage',
                'structure_slug' => 'matds',
                'icone' => 'heart',
                'en_ligne' => true,
                'duree_traitement' => 5,
                'cout' => 500,
                'champs_formulaire' => [
                    ['name' => 'nom_epoux', 'label' => 'Nom de l\'époux', 'type' => 'text', 'required' => true],
                    ['name' => 'prenom_epoux', 'label' => 'Prénom de l\'époux', 'type' => 'text', 'required' => true],
                    ['name' => 'nom_epouse', 'label' => 'Nom de l\'épouse', 'type' => 'text', 'required' => true],
                    ['name' => 'prenom_epouse', 'label' => 'Prénom de l\'épouse', 'type' => 'text', 'required' => true],
                    ['name' => 'date_mariage', 'label' => 'Date du mariage', 'type' => 'date', 'required' => true],
                    ['name' => 'lieu_mariage', 'label' => 'Lieu du mariage', 'type' => 'text', 'required' => true],
                ],
                'documents_requis' => [
                    'CNI du demandeur (scan)',
                ],
            ],
            [
                'nom' => 'Système ALIAS (informations salariales)',
                'slug' => 'systeme-alias',
                'description' => 'Accédez à vos informations administratives et salariales en ligne.',
                'categorie_slug' => 'emploi-travail',
                'structure_slug' => 'mfptps',
                'icone' => 'cash-stack',
                'en_ligne' => true,
                'url_externe' => 'https://alias.fonctionpublique.gov.bf',
                'duree_traitement' => null,
                'cout' => 0,
                'champs_formulaire' => [],
                'documents_requis' => [],
            ],
            [
                'nom' => 'Impôt Unique sur les Traitements et les Salaires (IUTS)',
                'slug' => 'iuts',
                'description' => 'Déclarez et payez votre IUTS en ligne.',
                'categorie_slug' => 'fiscalite-impots',
                'structure_slug' => 'mefp',
                'icone' => 'calculator',
                'en_ligne' => true,
                'url_externe' => 'https://iuts.dgi.gov.bf',
                'duree_traitement' => null,
                'cout' => 0,
                'champs_formulaire' => [],
                'documents_requis' => [],
            ],
            [
                'nom' => 'Télépaiement des impôts',
                'slug' => 'telepaiement-impots',
                'description' => 'Payez vos impôts en ligne de manière sécurisée.',
                'categorie_slug' => 'fiscalite-impots',
                'structure_slug' => 'mefp',
                'icone' => 'credit-card',
                'en_ligne' => true,
                'url_externe' => 'https://telepaiement.dgi.gov.bf',
                'duree_traitement' => null,
                'cout' => 0,
                'champs_formulaire' => [],
                'documents_requis' => [],
            ],
            [
                'nom' => 'Demande de NIF',
                'slug' => 'demande-nif-en-ligne',
                'description' => 'Demandez votre Numéro d\'Identification Fiscale en ligne.',
                'categorie_slug' => 'nif',
                'structure_slug' => 'mefp',
                'icone' => 'hash',
                'en_ligne' => true,
                'duree_traitement' => 3,
                'cout' => 0,
                'champs_formulaire' => [
                    ['name' => 'nom', 'label' => 'Nom', 'type' => 'text', 'required' => true],
                    ['name' => 'prenom', 'label' => 'Prénom', 'type' => 'text', 'required' => true],
                    ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
                    ['name' => 'telephone', 'label' => 'Téléphone', 'type' => 'tel', 'required' => true],
                    ['name' => 'adresse', 'label' => 'Adresse', 'type' => 'text', 'required' => true],
                    ['name' => 'activite', 'label' => 'Activité', 'type' => 'text', 'required' => true],
                ],
                'documents_requis' => [
                    'CNI (scan)',
                    'RCCM (pour les entreprises)',
                ],
            ],
            [
                'nom' => 'Demande de subvention',
                'slug' => 'demande-subvention',
                'description' => 'Soumettez votre demande de subvention pour votre projet.',
                'categorie_slug' => 'financement-investissement',
                'structure_slug' => 'mefp',
                'icone' => 'cash',
                'en_ligne' => true,
                'duree_traitement' => 90,
                'cout' => 0,
                'champs_formulaire' => [
                    ['name' => 'nom_projet', 'label' => 'Nom du projet', 'type' => 'text', 'required' => true],
                    ['name' => 'description', 'label' => 'Description du projet', 'type' => 'textarea', 'required' => true],
                    ['name' => 'montant', 'label' => 'Montant demandé', 'type' => 'number', 'required' => true],
                    ['name' => 'duree', 'label' => 'Durée du projet (mois)', 'type' => 'number', 'required' => true],
                ],
                'documents_requis' => [
                    'CNI (scan)',
                    'Plan d\'affaires',
                    'Devis détaillé',
                    'Étude de faisabilité',
                ],
            ],
        ];

        foreach ($eservices as $eservice) {
            $categorie = Categorie::where('slug', $eservice['categorie_slug'])->first();
            $structure = Structure::where('slug', $eservice['structure_slug'])->first();
            
            if ($categorie && $structure) {
                Eservice::create([
                    'nom' => $eservice['nom'],
                    'slug' => $eservice['slug'],
                    'description' => $eservice['description'],
                    'contenu' => $this->generateContenu($eservice),
                    'categorie_id' => $categorie->id,
                    'structure_id' => $structure->id,
                    'icone' => $eservice['icone'],
                    'url_externe' => $eservice['url_externe'] ?? null,
                    'en_ligne' => $eservice['en_ligne'],
                    'duree_traitement' => $eservice['duree_traitement'],
                    'cout' => $eservice['cout'],
                    'champs_formulaire' => $eservice['champs_formulaire'],
                    'documents_requis' => $eservice['documents_requis'],
                    'vues' => rand(5, 200),
                    'actif' => true,
                ]);
            }
        }
    }

    private function generateContenu($eservice): string
    {
        $contenu = "<h2>Description du service</h2>\n";
        $contenu .= "<p>{$eservice['description']}</p>\n\n";
        
        if (!empty($eservice['champs_formulaire'])) {
            $contenu .= "<h2>Informations requises</h2>\n<ul>\n";
            foreach ($eservice['champs_formulaire'] as $champ) {
                $required = $champ['required'] ? ' (obligatoire)' : '';
                $contenu .= "<li><strong>{$champ['label']}</strong>{$required}</li>\n";
            }
            $contenu .= "</ul>\n\n";
        }
        
        if (!empty($eservice['documents_requis'])) {
            $contenu .= "<h2>Documents à fournir</h2>\n<ul>\n";
            foreach ($eservice['documents_requis'] as $doc) {
                $contenu .= "<li>{$doc}</li>\n";
            }
            $contenu .= "</ul>\n\n";
        }
        
        if ($eservice['duree_traitement']) {
            $contenu .= "<p><strong>Durée de traitement :</strong> {$eservice['duree_traitement']} jours ouvrables</p>\n";
        }
        
        if ($eservice['cout']) {
            $contenu .= "<p><strong>Coût :</strong> " . number_format($eservice['cout'], 0, ',', ' ') . " FCFA</p>\n";
        }
        
        if (!empty($eservice['url_externe'])) {
            $contenu .= "<p><strong>Accès direct :</strong> <a href=\"{$eservice['url_externe']}\" target=\"_blank\">{$eservice['url_externe']}</a></p>\n";
        }
        
        return $contenu;
    }
}
