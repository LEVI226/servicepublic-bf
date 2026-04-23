<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Procedure;
use App\Models\EService;
use App\Models\Category;

/**
 * ScrapedDataSeeder
 *
 * Source : servicepublic.gov.bf (site officiel)
 * Données récupérées le 2026-02-26
 *
 * Ce seeder :
 *  1. Enrichit les procédures populaires avec des données réelles (coût, délai, description précise)
 *  2. Met à jour les e-services avec les vrais liens
 */
class ScrapedDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('=== Import données scrapées (servicepublic.gov.bf) ===');

        $this->enrichPopularProcedures();
        $this->importEServices();

        $this->command->info('=== Terminé ===');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 1. Enrichissement des procédures populaires avec données réelles
    // ─────────────────────────────────────────────────────────────────────────
    private function enrichPopularProcedures(): void
    {
        $this->command->info('Enrichissement des procédures populaires...');

        $enriched = [
            [
                'slug_search'        => 'casier',
                'description'        => 'Le bulletin N°3 du casier judiciaire est le relevé des condamnations à des peines privatives de liberté prononcées par une juridiction répressive contre une personne. Il est délivré à la personne concernée sur demande. Lorsqu\'il n\'existe pas de condamnation prononcée contre une personne, son bulletin N°3 est matérialisé par un trait oblique.',
                'cost'               => '300 FCFA',
                'delay'              => 'Le jour même (selon disponibilité du registre)',
                'conditions'         => '<p>Être majeur (18 ans révolus). Le bulletin est délivré uniquement à la personne concernée.</p>',
                'documents_required' => '<ul><li>CNIB ou Passeport en cours de validité</li><li>Acte de naissance (copie)</li><li>Timbre fiscal de 300 FCFA</li></ul>',
                'more_info'          => 'S\'adresser au greffe du Tribunal de Grande Instance (TGI) ou au Casier judiciaire central de Ouagadougou.',
                'views_count'        => 2910,
                'is_featured'        => 1,
            ],
            [
                'slug_search'        => 'nationalite',
                'description'        => 'Le certificat de nationalité est un document administratif délivré par le Président du Tribunal de Grande Instance qui atteste officiellement de la nationalité burkinabè d\'une personne. Il est nécessaire pour de nombreuses démarches, notamment l\'établissement du passeport.',
                'cost'               => 'Variable (timbre fiscal selon le TGI)',
                'delay'              => '72 heures à 2 semaines selon le tribunal',
                'conditions'         => '<p>Être de nationalité burkinabè par filiation, par le mariage ou par naturalisation.</p>',
                'documents_required' => '<ul><li>Acte de naissance de l\'intéressé</li><li>Actes de naissance du père et de la mère</li><li>Acte de mariage des parents</li><li>CNIB ou autre pièce d\'identité</li><li>Timbre fiscal (montant variable)</li></ul>',
                'more_info'          => 'S\'adresser au TGI du lieu de résidence ou de naissance. Obligatoire pour l\'obtention du passeport.',
                'views_count'        => 1850,
                'is_featured'        => 1,
            ],
            [
                'slug_search'        => 'passeport-ordinaire',
                'description'        => 'Le passeport ordinaire est un titre de voyage officiel biométrique délivré par l\'État burkinabè à ses ressortissants pour se déplacer à l\'étranger. Il intègre une puce électronique avec les données d\'identité et les empreintes digitales du titulaire.',
                'cost'               => '50 000 FCFA',
                'delay'              => '15 à 30 jours ouvrables',
                'conditions'         => '<p>Être de nationalité burkinabè. Avoir un certificat de nationalité. Les mineurs doivent être accompagnés d\'un parent ou tuteur légal.</p>',
                'documents_required' => '<ul><li>Certificat de nationalité burkinabè (original + copie)</li><li>Extrait d\'acte de naissance</li><li>2 photos d\'identité fond blanc</li><li>CNIB en cours de validité</li><li>Quittance de paiement de 50 000 FCFA</li><li>Ancien passeport si renouvellement</li></ul>',
                'more_info'          => 'Demande à effectuer à la Direction Générale de la Police Nationale (DGPN) ou dans les commissariats provinciaux. Site : http://www.police.bf',
                'views_count'        => 3200,
                'is_featured'        => 1,
            ],
            [
                'slug_search'        => 'concours',
                'description'        => 'Cette prestation permet aux candidats aux concours de la fonction publique de s\'inscrire en ligne via la plateforme e-Concours. Elle évite les déplacements et permet de gérer son dossier à distance depuis n\'importe quelle connexion internet.',
                'cost'               => '800 FCFA',
                'delay'              => 'Immédiat (inscription en ligne)',
                'conditions'         => '<p>Remplir les conditions d\'âge, de diplôme et de nationalité fixées par le communiqué d\'ouverture du concours.</p>',
                'documents_required' => '<ul><li>CNIB ou passeport (numérique)</li><li>Photo d\'identité JPG fond blanc</li><li>Copies numérisées des diplômes requis</li><li>Paiement de 800 FCFA (Orange Money / Moov Money acceptés)</li></ul>',
                'more_info'          => 'Les admissibles doivent fournir un dossier physique lors des épreuves. Plateforme : http://www.econcours.bf',
                'views_count'        => 1560,
                'is_featured'        => 1,
            ],
            [
                'slug_search'        => 'alias',
                'description'        => 'ALIAS (Accès en Ligne aux Informations Administratives et Salariales) permet aux agents de la fonction publique burkinabè de consulter leur situation administrative et salariale en ligne à tout moment, sans se déplacer à leur Direction des Ressources Humaines.',
                'cost'               => 'Gratuit',
                'delay'              => 'Immédiat (accès en ligne)',
                'conditions'         => '<p>Être agent de la fonction publique burkinabè disposant d\'un matricule et d\'un code d\'accès ALIAS délivré par la DRH.</p>',
                'documents_required' => '<ul><li>Matricule d\'agent de la fonction publique</li><li>Code d\'accès ALIAS (à retirer à la DRH ou Direction régionale)</li></ul>',
                'more_info'          => 'Code d\'accès à retirer à la Direction des Ressources Humaines (central) ou à la Direction régionale de la Fonction Publique. Plateforme : http://www.alias.gov.bf',
                'views_count'        => 1200,
                'is_featured'        => 0,
            ],
        ];

        $updated = 0;
        foreach ($enriched as $data) {
            $search = $data['slug_search'];
            unset($data['slug_search']);

            // Use raw DB to bypass $fillable and SoftDeletes scope
            $data['updated_at'] = now();
            $count = DB::table('procedures')
                ->where('slug', 'like', "%{$search}%")
                ->update($data);

            if ($count === 0) {
                $count = DB::table('procedures')
                    ->where('title', 'like', "%{$search}%")
                    ->update($data);
            }

            $this->command->info("  [{$search}] — {$count} procédure(s) mise(s) à jour.");
            $updated += $count;
        }

        $this->command->info("Total procédures enrichies : {$updated}");
    }

    // ─────────────────────────────────────────────────────────────────────────
    // 2. Import des e-services officiels depuis servicepublic.gov.bf
    // ─────────────────────────────────────────────────────────────────────────
    private function importEServices(): void
    {
        $this->command->info('Import des e-services officiels...');

        // Map catégorie site source → category_id local
        $categoryMap = [
            'Commerce/Artisanat'                      => $this->getCatId('Commerce'),
            'Jeunesse/Emploi/Formation Professionnelle'=> $this->getCatId('Emploi'),
            'Environnement, Eau et Assainissement'    => $this->getCatId('Environnement'),
            'Education/Recherche scientifique'        => $this->getCatId('éducation'),
            'Ressources humaines'                     => $this->getCatId('Fonction publique'),
            'Gouvernance'                             => $this->getCatId('Administration'),
            'Economie Numérique/Postes'               => $this->getCatId('Numérique'),
            'Travaux publics'                         => $this->getCatId('Construction'),
            'Transport/ logistique'                   => $this->getCatId('Transport'),
            'Travail/Protection sociale'              => $this->getCatId('Travail'),
            'Economie/Finances'                       => $this->getCatId('Fiscalité'),
            'Autres'                                  => null,
        ];

        $eservices = [
            // Page 1
            ['name' => '1 étudiant, 1 ordinateur',                     'url' => 'https://servicepublic.gov.bf/eservice/1-etudiant1-ordinateur',                    'category' => 'Education/Recherche scientifique'],
            ['name' => 'Agrément Bureau Privé de Placement',           'url' => 'https://servicepublic.gov.bf/eservice/agrement-de-bureau-prive-de-placement-etou-dentreprise-de-travail-temporaire', 'category' => 'Jeunesse/Emploi/Formation Professionnelle'],
            ['name' => 'Agrément technique eau et assainissement',     'url' => 'https://servicepublic.gov.bf/eservice/agrement-technique-eau-et-assainissement',   'category' => 'Environnement, Eau et Assainissement'],
            ['name' => 'Agrément Technique Informatique',              'url' => 'https://servicepublic.gov.bf/eservice/agrement-technique-en-matiere-dinformatique', 'category' => 'Economie Numérique/Postes'],
            ['name' => 'ALIAS — Informations administratives/salariales','url' => 'https://servicepublic.gov.bf/eservice/alias',                                   'category' => 'Ressources humaines'],
            ['name' => 'Authentification diplômes et attestations',    'url' => 'https://servicepublic.gov.bf/eservice/authentification-des-diplomes-et-attestations','category' => 'Education/Recherche scientifique'],
            ['name' => 'Authentification immatriculations véhicules',  'url' => 'https://servicepublic.gov.bf/eservice/authentification-des-immatriculations-provisoires-et-temporaires','category' => 'Transport/ logistique'],
            ['name' => 'Autorisation d\'enseigner au post-primaire/secondaire','url' => 'https://servicepublic.gov.bf/eservice/autorisation-denseigner-au-post-primaire-et-au-secondaire','category' => 'Education/Recherche scientifique'],
            ['name' => 'Autorisation d\'Exercer le Commerce (AEC)',    'url' => 'https://servicepublic.gov.bf/eservice/autorisation-dexercer-le-commerce-aec',     'category' => 'Commerce/Artisanat'],
            ['name' => 'Autorisation de gestion des déchets solides',  'url' => 'https://servicepublic.gov.bf/eservice/autorisation-de-gestion-des-dechets-solides','category' => 'Environnement, Eau et Assainissement'],
            ['name' => 'Autorisation Spéciale d\'Importation (ASI)',   'url' => 'https://servicepublic.gov.bf/eservice/autorisation-speciale-dimportation-asi',    'category' => 'Commerce/Artisanat'],
            ['name' => 'CAMPUSFASO — Inscription universitaire',       'url' => 'https://servicepublic.gov.bf/eservice/campusfaso',                                 'category' => 'Education/Recherche scientifique'],
            ['name' => 'CEFORE — Création d\'entreprise',              'url' => 'https://servicepublic.gov.bf/eservice/cefore-creation-dentreprise',               'category' => 'Commerce/Artisanat'],
            ['name' => 'Certificat d\'Origine des marchandises (CO)',  'url' => 'https://servicepublic.gov.bf/eservice/certificat-dorigine-des-marchandises-co',   'category' => 'Commerce/Artisanat'],
            ['name' => 'Déclaration Préalable d\'Importation (DPI)',   'url' => 'https://servicepublic.gov.bf/eservice/declaration-prealable-dimportation-dpi',   'category' => 'Commerce/Artisanat'],
            ['name' => 'CIL — Gestion de Plainte et Déclaration',     'url' => 'https://servicepublic.gov.bf/eservice/cil-gestion-de-plainte-et-de-declaration',  'category' => 'Gouvernance'],
            ['name' => 'Déclaration d\'Intérêt et de Patrimoine',     'url' => 'https://servicepublic.gov.bf/eservice/declaration-dinteret-et-de-patrimoine',     'category' => 'Gouvernance'],
            // Page 2
            ['name' => 'Demande Attestation Soumission Marché Public', 'url' => 'https://servicepublic.gov.bf/eservice/demande-attestation-de-soumission-au-marche-public','category' => 'Autres'],
            ['name' => 'Demande d\'Attestation de Travail',            'url' => 'https://servicepublic.gov.bf/eservice/attestation-de-travail',                    'category' => 'Jeunesse/Emploi/Formation Professionnelle'],
            ['name' => 'Demande d\'avis de conformité environnementale','url' => 'https://servicepublic.gov.bf/eservice/demande-davis-de-conformite-environnementale','category' => 'Environnement, Eau et Assainissement'],
            ['name' => 'Demande d\'étude de sols et fondations',       'url' => 'https://servicepublic.gov.bf/eservice/demande-detude-de-sols-et-fondations',      'category' => 'Travaux publics'],
            ['name' => 'Demande d\'audiences à la Primature',          'url' => 'https://servicepublic.gov.bf/eservice/demande-daudiences-a-la-primature',         'category' => 'Gouvernance'],
            ['name' => 'e-Concours — Inscription concours fonction publique','url' => 'https://servicepublic.gov.bf/eservice/inscription-en-ligne-aux-concours-de-la-fp','category' => 'Ressources humaines'],
            ['name' => 'e-RCCM — Registre du Commerce (CEFORE)',       'url' => 'https://www.cefore.bf',                                                          'category' => 'Commerce/Artisanat'],
            ['name' => 'IFU — Identifiant Financier Unique (DGI)',     'url' => 'https://www.dgi.gov.bf',                                                         'category' => 'Economie/Finances'],
            ['name' => 'Impôt IUTS — Déclaration en ligne (DGI)',      'url' => 'https://www.dgi.gov.bf/iuts',                                                    'category' => 'Economie/Finances'],
        ];

        $imported = 0;
        $skipped  = 0;
        foreach ($eservices as $es) {
            $catId = $categoryMap[$es['category']] ?? null;
            $slug  = Str::slug($es['name']);

            try {
                $created = EService::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title'       => $es['name'],
                        'url'         => $es['url'],
                        'category_id' => $catId,
                        'is_active'   => true,
                        'description' => 'Service en ligne officiel — ' . $es['category'],
                    ]
                );
                $created->wasRecentlyCreated ? $imported++ : $skipped++;
            } catch (\Exception $e) {
                $this->command->warn("  Erreur pour [{$es['name']}]: " . $e->getMessage());
            }
        }

        $this->command->info("E-services importés : {$imported} nouveaux, {$skipped} déjà existants.");
    }

    private function getCatId(string $term): ?int
    {
        $cat = Category::where('name', 'like', "%{$term}%")->first();
        return $cat?->id;
    }
}
