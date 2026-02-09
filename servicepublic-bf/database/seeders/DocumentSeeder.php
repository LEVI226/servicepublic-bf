<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Structure;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run(): void
    {
        $documents = [
            [
                'titre' => 'Loi n° 010-2014/CNT portant Code électoral',
                'slug' => 'loi-010-2014-code-electoral',
                'description' => 'Loi portant Code électoral au Burkina Faso.',
                'type' => 'loi',
                'structure_slug' => 'assemblee',
                'numero' => '010-2014/CNT',
                'date_signature' => '2014-07-01',
                'date_publication' => '2014-07-15',
                'fichier' => 'loi_010_2014_code_electoral.pdf',
                'format' => 'pdf',
                'taille' => 2048000,
            ],
            [
                'titre' => 'Décret n° 2018-0611/PRES/PM/MATDS portant création de communes',
                'slug' => 'decret-2018-0611-creation-communes',
                'description' => 'Décret portant création de nouvelles communes.',
                'type' => 'decret',
                'structure_slug' => 'primature',
                'numero' => '2018-0611/PRES/PM/MATDS',
                'date_signature' => '2018-05-15',
                'date_publication' => '2018-05-30',
                'fichier' => 'decret_2018_0611_creation_communes.pdf',
                'format' => 'pdf',
                'taille' => 1024000,
            ],
            [
                'titre' => 'Arrêté n° 2020-001/MENAPLN portant organisation des examens',
                'slug' => 'arrete-2020-001-examens',
                'description' => 'Arrêté portant organisation des examens scolaires.',
                'type' => 'arrete',
                'structure_slug' => 'menapln',
                'numero' => '2020-001/MENAPLN',
                'date_signature' => '2020-01-15',
                'date_publication' => '2020-01-20',
                'fichier' => 'arrete_2020_001_examens.pdf',
                'format' => 'pdf',
                'taille' => 512000,
            ],
            [
                'titre' => 'Loi n° 061-2015/CNT portant régime des marchés publics',
                'slug' => 'loi-061-2015-marches-publics',
                'description' => 'Loi portant régime des marchés publics au Burkina Faso.',
                'type' => 'loi',
                'structure_slug' => 'assemblee',
                'numero' => '061-2015/CNT',
                'date_signature' => '2015-11-20',
                'date_publication' => '2015-12-01',
                'fichier' => 'loi_061_2015_marches_publics.pdf',
                'format' => 'pdf',
                'taille' => 3072000,
            ],
            [
                'titre' => 'Décret n° 2019-0322/PRES/PM/MFPTPS portant statut général des fonctionnaires',
                'slug' => 'decret-2019-0322-statut-fonctionnaires',
                'description' => 'Décret portant statut général des fonctionnaires.',
                'type' => 'decret',
                'structure_slug' => 'mfptps',
                'numero' => '2019-0322/PRES/PM/MFPTPS',
                'date_signature' => '2019-03-20',
                'date_publication' => '2019-04-01',
                'fichier' => 'decret_2019_0322_statut_fonctionnaires.pdf',
                'format' => 'pdf',
                'taille' => 4096000,
            ],
            [
                'titre' => 'Circulaire n° 001/MEFP relative à la gestion budgétaire',
                'slug' => 'circulaire-001-mefp-gestion-budgetaire',
                'description' => 'Circulaire relative à la gestion budgétaire des ministères.',
                'type' => 'circulaire',
                'structure_slug' => 'mefp',
                'numero' => '001/MEFP',
                'date_signature' => '2023-01-10',
                'date_publication' => '2023-01-15',
                'fichier' => 'circulaire_001_mefp_gestion_budgetaire.pdf',
                'format' => 'pdf',
                'taille' => 1536000,
            ],
            [
                'titre' => 'Loi n° 081-2015/CNT portant charte des partis politiques',
                'slug' => 'loi-081-2015-charte-partis-politiques',
                'description' => 'Loi portant charte des partis politiques.',
                'type' => 'loi',
                'structure_slug' => 'assemblee',
                'numero' => '081-2015/CNT',
                'date_signature' => '2015-12-15',
                'date_publication' => '2016-01-01',
                'fichier' => 'loi_081_2015_charte_partis_politiques.pdf',
                'format' => 'pdf',
                'taille' => 2560000,
            ],
            [
                'titre' => 'Arrêté n° 2021-045/MCIA fixant les tarifs douaniers',
                'slug' => 'arrete-2021-045-tarifs-douaniers',
                'description' => 'Arrêté fixant les tarifs douaniers pour l\'importation.',
                'type' => 'arrete',
                'structure_slug' => 'mcia',
                'numero' => '2021-045/MCIA',
                'date_signature' => '2021-03-15',
                'date_publication' => '2021-03-20',
                'fichier' => 'arrete_2021_045_tarifs_douaniers.pdf',
                'format' => 'pdf',
                'taille' => 2048000,
            ],
            [
                'titre' => 'Décret n° 2022-0123/PRES/PM/MSHP portant création du CNHU',
                'slug' => 'decret-2022-0123-cnhu',
                'description' => 'Décret portant création du Centre National Hospitalier Universitaire.',
                'type' => 'decret',
                'structure_slug' => 'mshp',
                'numero' => '2022-0123/PRES/PM/MSHP',
                'date_signature' => '2022-02-10',
                'date_publication' => '2022-02-20',
                'fichier' => 'decret_2022_0123_cnhu.pdf',
                'format' => 'pdf',
                'taille' => 1024000,
            ],
            [
                'titre' => 'Note de service n° 005/MENAPLN relative aux inscriptions scolaires',
                'slug' => 'note-005-menapln-inscriptions-scolaires',
                'description' => 'Note de service relative aux modalités d\'inscription pour l\'année scolaire.',
                'type' => 'note',
                'structure_slug' => 'menapln',
                'numero' => '005/MENAPLN',
                'date_signature' => '2023-08-01',
                'date_publication' => '2023-08-05',
                'fichier' => 'note_005_menapln_inscriptions_scolaires.pdf',
                'format' => 'pdf',
                'taille' => 768000,
            ],
        ];

        foreach ($documents as $document) {
            $structure = Structure::where('slug', $document['structure_slug'])->first();
            
            if ($structure) {
                Document::create([
                    'titre' => $document['titre'],
                    'slug' => $document['slug'],
                    'description' => $document['description'],
                    'type' => $document['type'],
                    'structure_id' => $structure->id,
                    'numero' => $document['numero'],
                    'date_signature' => $document['date_signature'],
                    'date_publication' => $document['date_publication'],
                    'fichier' => $document['fichier'],
                    'format' => $document['format'],
                    'taille' => $document['taille'],
                    'telechargements' => rand(5, 100),
                    'actif' => true,
                ]);
            }
        }
    }
}
