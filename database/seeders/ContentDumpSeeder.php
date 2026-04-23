<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Procedure;

class ContentDumpSeeder extends Seeder
{
    public function run(): void
    {
        $mockData = [
            'Demande d\'un passeport ordinaire' => [
                'cost' => '50 000 F CFA',
                'delay' => '72 heures ouvrables',
                'description' => 'Le passeport burkinabè ordinaire est délivré à tout citoyen burkinabè qui en fait la demande. Il est exigible pour franchir les frontières nationales.',
                'conditions' => '<p>Être de nationalité burkinabè et s\'acquitter des frais de timbre fiscal ou récépissé de paiement en ligne.</p>',
                'documents_required' => '<ul><li>Un formulaire rempli et signé ou reçu de demande en ligne</li><li>Copie légalisée de la CNIB ou acte de naissance</li><li>Trois (3) photos d\'identité récentes, fond blanc</li><li>Attestation de profession</li><li>Quittance de paiement de 50 000 FCFA</li></ul>',
            ],
            'Demande d\'établissement ou de renouvellement de la CNIB' => [
                'cost' => '2 500 F CFA',
                'delay' => '2 à 3 semaines',
                'description' => 'La Carte Nationale d\'Identité Burkinabè (CNIB) est un document officiel qui prouve l\'identité et la nationalité de la personne.',
                'conditions' => '<p>Être âgé de 15 ans révolus ou plus. Être de nationalité burkinabè.</p>',
                'documents_required' => '<ul><li>Un extrait d\'acte de naissance ou jugement supplétif</li><li>Un certificat de nationalité</li><li>Une photocopie légalisée de la profession (le cas échéant)</li><li>Timbres fiscaux de 2 500 F CFA</li></ul>',
            ],
            'Demande de célébration de mariage civil' => [
                'cost' => 'Gratuit (Frais de célébration selon la Mairie)',
                'delay' => '1 mois (délai de publication des bans inclus)',
                'description' => 'L\'union civile contractée devant l\'officier d\'état civil de la commune de résidence ou du domicile.',
                'conditions' => '<p>Avoir 18 ans pour les deux conjoints. Ne pas être déjà marié sous le régime monogamique.</p>',
                'documents_required' => '<ul><li>Copie intégrale de l\'acte de naissance des conjoints (-3 mois)</li><li>Photocopie des CNIB des futurs époux</li><li>Certificat de célibat ou de non-remariage (-3 mois)</li><li>Photocopies CNIB des témoins majeurs</li></ul>',
            ],
            'Demande de titre foncier (PUH)' => [
                'cost' => 'Variable selon la superficie',
                'delay' => '6 à 12 mois',
                'description' => 'Le Permis Urbain d\'Habiter donne un droit de jouissance pérenne sur un terrain en zone aménagée.',
                'conditions' => '<p>Être attributaire d\'une parcelle ou justifier d\'une mutation valide. Avoir mis la parcelle en valeur.</p>',
                'documents_required' => '<ul><li>Demande manuscrite timbrée à 200F</li><li>Photocopie légalisée de la CNIB</li><li>L\'attestation d\'attribution originale</li><li>Le procès-verbal d\'évaluation des mises en valeur</li><li>Croquis de la parcelle timbré</li></ul>',
            ],
            'Demande de permis de construire' => [
                'cost' => 'Frais de dossiers administratifs (variable)',
                'delay' => '30 à 45 jours',
                'description' => 'Autorisation administrative obligatoire délivrée par le Maire ou le Ministre permettant à quiconque de construire un édifice.',
                'conditions' => '<p>Disposer d\'un titre de propriété ou d\'un PUH et soumettre des plans architecturaux valides.</p>',
                'documents_required' => '<ul><li>Formulaire de demande timbré</li><li>Titre de propriété foncière</li><li>Plan de situation et plan de masse</li><li>Plan d\'exécution des travaux (architecte agréé)</li><li>Devis estimatif et descriptif</li></ul>',
            ],
            'Délivrance de la carte de demandeur d’emploi' => [
                'cost' => 'Gratuit',
                'delay' => 'Immédiat',
                'description' => 'La carte de demandeur d\'emploi est délivrée par l\'ANPE à toute personne à la recherche d\'une insertion professionnelle.',
                'conditions' => '<p>Être âgé d\'au moins 16 ans et ne pas exercer une activité professionnelle salariée.</p>',
                'documents_required' => '<ul><li>Photocopie légalisée de la CNIB</li><li>Curriculum Vitae à jour</li><li>Copies des diplômes et attestations de travail</li><li>Deux (2) photos d\'identité</li></ul>',
            ],
            'Déclaration de naissance à l\'État Civil' => [
                'cost' => 'Gratuit',
                'delay' => 'Séance tenante',
                'description' => 'Procédure obligatoire et gratuite consistant à déclarer la naissance d\'un enfant auprès des services de l\'état civil.',
                'conditions' => '<p>La déclaration doit être faite dans un délai strict de deux (02) mois à compter du jour de la naissance.</p>',
                'documents_required' => '<ul><li>Le certificat de naissance délivré par la maternité</li><li>Les pièces d\'identité (CNIB) des parents</li><li>Le livret de famille (si existant)</li><li>La pièce d\'identité du déclarant (si différent des parents)</li></ul>',
            ],
            'Obtention de la déclaration préalable d\'importation (DPI)' => [
                'cost' => 'Variable',
                'delay' => '48 heures',
                'description' => 'Document administratif permettant de tracer et de contrôler toutes les importations commerciales au Burkina Faso.',
                'conditions' => '<p>Effectuer une importation dont la valeur FOB est supérieure ou égale à 500 000 FCFA. Être enregistré au RCCM et posséder un IFU.</p>',
                'documents_required' => '<ul><li>Formulaire DPI dûment rempli</li><li>Facture pro forma du fournisseur ou contrat commercial</li><li>Copie de la carte professionnelle de commerçant</li><li>Attestation de Situation Fiscale (ASF) à jour</li></ul>',
            ],
            'Retraite pour limite d\'âge' => [
                'cost' => 'Gratuit',
                'delay' => 'Avant départ à la retraite (6 mois conseillés)',
                'description' => 'Démarche permettant de préparer et valider son dossier de retraite auprès de la CARFO afin de bénéficier de sa pension.',
                'conditions' => '<p>Avoir atteint la limite d\'âge de sa catégorie professionnelle. Avoir cotisé le nombre d\'annuités requis par la loi.</p>',
                'documents_required' => '<ul><li>Une demande de liquidation de pension de retraite</li><li>Copie légalisée de la CNIB</li><li>Acte de naissance ou jugement supplétif</li><li>Un relevé général des services</li><li>Le dernier bulletin de paie et acte d\'admission à la retraite</li></ul>',
            ],
            'Demande d\'allocations d\'aides et de prêts aux étudiants' => [
                'cost' => 'Gratuit',
                'delay' => 'Variable',
                'description' => 'Assistance financière octroyée sous forme d\'allocation ou de prêt aux étudiants burkinabè par le FONER.',
                'conditions' => '<p>Être de nationalité burkinabè, être régulièrement inscrit dans un établissement d\'enseignement supérieur reconnu au Burkina Faso, avoir un âge et un revenu inférieur au plafond fixé.</p>',
                'documents_required' => '<ul><li>Un formulaire de demande renseigné en ligne</li><li>Une photocopie légalisée de la CNIB</li><li>Le reçu d\'inscription de l\'année académique en cours</li><li>Une attestation ou relevé de notes certifiant le passage en année supérieure</li></ul>',
            ],
            'Demande de création d\'entreprises pour les personnes morales' => [
                'cost' => 'Environ 47 500 F CFA',
                'delay' => '24 à 48 heures',
                'description' => 'Immatriculation d\'une société (SARL, SA, SAS...) au Registre du Commerce et du Crédit Mobilier via le dispositif du CEFORE.',
                'conditions' => '<p>La domiciliation de l\'entreprise doit être établie au Burkina Faso. Le capital social doit être déposé selon la norme OHADA.</p>',
                'documents_required' => '<ul><li>Les statuts originaux signés par les associés</li><li>Procès Verbal de l\'Assemblée Générale constitutive</li><li>Trois (3) photos d\'identité du gérant</li><li>Photocopie de la CNIB ou passeport du gérant</li><li>Certificat de déclaration de non condamnation</li></ul>',
            ],
            'Demande d\'un bulletin n°3 du casier judiciaire' => [
                'cost' => '300 F CFA (+ 200F Timbre)',
                'delay' => '24 à 48 heures',
                'description' => 'Document délivré par le Tribunal de Grande Instance constatant les condamnations pénales prononcées contre le requérant.',
                'conditions' => '<p>Seule la personne concernée (ou son représentant légal pour un mineur) peut demander un bulletin numéro 3 la concernant.</p>',
                'documents_required' => '<ul><li>Une photocopie simple de l\'acte de naissance ou jugement supplétif</li><li>Une photocopie de la CNIB ou Passeport valide</li><li>Un timbre fiscal de 200 F CFA</li><li>Le paiement d\'une quittance de 300 F CFA</li></ul>',
            ]
        ];

        $count = 0;
        foreach ($mockData as $title => $data) {
            $procedure = Procedure::where('title', 'LIKE', "%$title%")->first();
            if ($procedure) {
                // Force high views count to make it appear in "Voir aussi"
                $data['views_count'] = rand(1000, 5000);
                
                $procedure->update($data);
                $this->command->info("Procédure mise à jour : $title");
                $count++;
            } else {
                $this->command->warn("Procédure introuvable : $title");
            }
        }
        
        $this->command->info("Terminé. $count procédures hydratées avec des données factices premium.");
    }
}
