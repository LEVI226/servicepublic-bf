<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Dictionnaire des nouveaux liens (URL directes).
     * Les autres pourront être ajoutés au fur et à mesure.
     */
    protected $linksMapping = [
        'campusfaso' => 'https://www.campusfaso.bf/',
        'inscription-en-ligne-aux-concours-de-la-fp' => 'https://www.econcours.gov.bf/',
        'cefore-creation-dentreprise' => 'https://www.creer-entreprise.gov.bf/',
        'alias' => 'https://alias.finances.gov.bf/',
        'agrement-technique-eau-et-assainissement' => 'https://agrement.eau.gov.bf/',
        // D'autres liens pourront être ajoutés ici par la suite
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::beginTransaction();
        try {
            foreach ($this->linksMapping as $oldUrlSlug => $newUrl) {
                DB::table('eservices')
                    ->where('url', 'LIKE', "%servicepublic.gov.bf/eservice/{$oldUrlSlug}%")
                    ->update(['url' => $newUrl]);
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
            foreach ($this->linksMapping as $oldUrlSlug => $newUrl) {
                $oldUrl = "https://servicepublic.gov.bf/eservice/{$oldUrlSlug}";
                DB::table('eservices')
                    ->where('url', $newUrl) // Sécurité : on restaure seulement si ça correspond au nouveau lien
                    ->update(['url' => $oldUrl]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
};
