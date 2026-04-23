<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

return new class extends Migration
{
    protected $newCategories = [
        ['name' => 'État Civil, Identité & Famille', 'slug' => 'etat-civil-identite-famille', 'is_pro' => 0],
        ['name' => 'Éducation & Recherche', 'slug' => 'education-recherche', 'is_pro' => 0],
        ['name' => 'Culture, Jeunesse & Sports', 'slug' => 'culture-jeunesse-sports', 'is_pro' => 0],
        ['name' => 'Emploi & Carrière', 'slug' => 'emploi-carriere', 'is_pro' => 0],
        ['name' => 'Santé & Protection Sociale', 'slug' => 'sante-protection-sociale', 'is_pro' => 0],
        ['name' => 'Justice, Sécurité & Droits', 'slug' => 'justice-securite-droits', 'is_pro' => 0],
        ['name' => 'Transport, Logement & Urbanisme', 'slug' => 'transport-logement-urbanisme', 'is_pro' => 0],
        ['name' => 'Environnement & Cadre de vie', 'slug' => 'environnement-cadre-de-vie', 'is_pro' => 0],
        ['name' => 'Création & Gestion d\'Entreprise', 'slug' => 'creation-gestion-entreprise', 'is_pro' => 1],
        ['name' => 'Fiscalité, Finances & Douanes', 'slug' => 'fiscalite-finances-douanes', 'is_pro' => 1],
        ['name' => 'Travail & Employeurs', 'slug' => 'travail-employeurs', 'is_pro' => 1],
        ['name' => 'Secteurs d\'Activités Spécifiques', 'slug' => 'secteurs-activites-specifiques', 'is_pro' => 1],
        ['name' => 'Commandes Publiques & Institutions', 'slug' => 'commandes-publiques-institutions', 'is_pro' => 1],
    ];

    protected $keywordMapping = [
        'etat-civil-identite-famille' => ['etat', 'papier', 'citoyennete', 'famille', 'sociale', 'femme'],
        'education-recherche' => ['education', 'recherche', 'enseignement', 'bourse', 'formation', 'etude'],
        'culture-jeunesse-sports' => ['culture', 'art', 'jeunesse', 'sport', 'loisir', 'tourisme'],
        'emploi-carriere' => ['emploi', 'carriere', 'recrutement'],
        'sante-protection-sociale' => ['sante', 'protection sociale', 'handicap'],
        'justice-securite-droits' => ['justice', 'droit', 'securite', 'contentieux', 'protection civile', 'constitution'],
        'transport-logement-urbanisme' => ['transport', 'logement', 'urbanisme', 'amenagement', 'batiment', 'construction', 'logistique', 'mobilite'],
        'environnement-cadre-de-vie' => ['environnement', 'eau', 'assainissement', 'energie', 'faune', 'peche', 'geographique', 'nature'],
        'creation-gestion-entreprise' => ['entreprise', 'commerce', 'commercial', 'activite'],
        'fiscalite-finances-douanes' => ['fiscalite', 'finance', 'impot', 'taxe', 'depense', 'comptabilite', 'pret', 'don'],
        'travail-employeurs' => ['travail', 'employeur', 'professionnel'],
        'secteurs-activites-specifiques' => ['agriculture', 'elevage', 'mine', 'tic', 'communication', 'secteur'],
        'commandes-publiques-institutions' => ['commande', 'gouvernance', 'institution', 'diplomatie', 'diaspora', 'mediation', 'partis', 'revision', 'autre'],
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $now = Carbon::now();
        $newCategoryIds = [];

        // Création de la table temporaire AVANT la transaction (évite le commit implicite MySQL)
        if (!Schema::hasTable('temp_category_migrations_log')) {
            Schema::create('temp_category_migrations_log', function ($table) {
                $table->id();
                $table->string('table_name');
                $table->unsignedBigInteger('record_id');
                $table->unsignedBigInteger('old_category_id')->nullable();
                $table->unsignedBigInteger('new_category_id')->nullable();
            });
        }

        DB::beginTransaction();
        try {
            // 1. Insertion des nouvelles catégories parentes
            foreach ($this->newCategories as $cat) {
                // Idempotence : on vérifie d'abord si elle n'existe pas déjà
                $existing = DB::table('categories')->where('slug', $cat['slug'])->first();
                if (!$existing) {
                    $id = DB::table('categories')->insertGetId(array_merge($cat, [
                        'is_active' => 1,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]));
                    $newCategoryIds[$cat['slug']] = $id;
                } else {
                    $newCategoryIds[$cat['slug']] = $existing->id;
                }
            }

            // 2. Récupération des anciennes catégories
            $oldCategories = DB::table('categories')
                ->whereNotIn('slug', array_column($this->newCategories, 'slug'))
                ->where('is_active', 1)
                ->get();

            // 3. Mapping sémantique et réaffectation
            foreach ($oldCategories as $oldCat) {
                $targetSlug = 'commandes-publiques-institutions'; // Valeur par défaut
                
                // Trouver le slug correspondant via les mots clés
                $normalizedName = Str::ascii(Str::lower($oldCat->name));
                foreach ($this->keywordMapping as $slug => $keywords) {
                    foreach ($keywords as $keyword) {
                        if (Str::contains($normalizedName, $keyword)) {
                            $targetSlug = $slug;
                            break 2; // Sort des deux boucles
                        }
                    }
                }

                $newId = $newCategoryIds[$targetSlug];

                // Mettre à jour les eservices
                $eservices = DB::table('eservices')->where('category_id', $oldCat->id)->get();
                foreach ($eservices as $eservice) {
                    DB::table('temp_category_migrations_log')->insert([
                        'table_name' => 'eservices', 'record_id' => $eservice->id,
                        'old_category_id' => $oldCat->id, 'new_category_id' => $newId
                    ]);
                }
                DB::table('eservices')->where('category_id', $oldCat->id)->update(['category_id' => $newId]);

                // Mettre à jour les procedures
                $procedures = DB::table('procedures')->where('category_id', $oldCat->id)->get();
                foreach ($procedures as $procedure) {
                    DB::table('temp_category_migrations_log')->insert([
                        'table_name' => 'procedures', 'record_id' => $procedure->id,
                        'old_category_id' => $oldCat->id, 'new_category_id' => $newId
                    ]);
                }
                DB::table('procedures')->where('category_id', $oldCat->id)->update(['category_id' => $newId]);

                // Soft-deactivate de l'ancienne catégorie
                DB::table('categories')->where('id', $oldCat->id)->update(['is_active' => 0]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::beginTransaction();
        try {
            if (Schema::hasTable('temp_category_migrations_log')) {
                // Restauration des eservices
                $eservicesLogs = DB::table('temp_category_migrations_log')->where('table_name', 'eservices')->get();
                foreach ($eservicesLogs as $log) {
                    DB::table('eservices')->where('id', $log->record_id)->update(['category_id' => $log->old_category_id]);
                }

                // Restauration des procedures
                $proceduresLogs = DB::table('temp_category_migrations_log')->where('table_name', 'procedures')->get();
                foreach ($proceduresLogs as $log) {
                    DB::table('procedures')->where('id', $log->record_id)->update(['category_id' => $log->old_category_id]);
                }

                // Réactivation des anciennes catégories
                $oldCategoryIds = DB::table('temp_category_migrations_log')->select('old_category_id')->distinct()->pluck('old_category_id');
                DB::table('categories')->whereIn('id', $oldCategoryIds)->update(['is_active' => 1]);
            }

            // Suppression des 13 catégories parentes si elles n'ont plus rien d'attaché
            $newSlugs = array_column($this->newCategories, 'slug');
            DB::table('categories')->whereIn('slug', $newSlugs)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        // Suppression de la table de log en dehors de la transaction
        if (Schema::hasTable('temp_category_migrations_log')) {
            Schema::dropIfExists('temp_category_migrations_log');
        }
    }
};
