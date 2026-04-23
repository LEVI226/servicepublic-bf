<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $mapping = [
            15 => ['url' => 'https://www.environnement.gov.bf/', 'cat' => 114],
            18 => ['url' => 'https://www.creer-entreprise.gov.bf/', 'cat' => 115],
            22 => ['url' => 'https://www.douanes.bf/', 'cat' => 116],
            27 => ['url' => 'https://www.douanes.bf/', 'cat' => 116],
            31 => ['url' => 'https://www.asce-lc.bf/', 'cat' => 112],
            32 => ['url' => 'https://www.douanes.bf/', 'cat' => 116],
            34 => ['url' => 'https://www.primature.gov.bf/', 'cat' => 119],
            36 => ['url' => 'https://www.environnement.gov.bf/', 'cat' => 114],
            48 => ['url' => 'https://www.urbanisme.gov.bf/', 'cat' => 113],
            127 => ['url' => 'https://www.travail.gov.bf/', 'cat' => 110],
            130 => ['url' => 'https://www.mesrsi.gov.bf/', 'cat' => 108],
            131 => ['url' => 'https://www.dgttm.bf/', 'cat' => 113],
            132 => ['url' => 'https://www.education.gov.bf/', 'cat' => 108],
            134 => ['url' => 'https://www.cil.bf/', 'cat' => 112],
            135 => ['url' => 'https://www.dgcmp.gov.bf/', 'cat' => 119],
            136 => ['url' => 'https://www.travail.gov.bf/', 'cat' => 110],
        ];

        DB::beginTransaction();
        try {
            foreach ($mapping as $id => $data) {
                DB::table('eservices')->where('id', $id)->update([
                    'url' => $data['url'],
                    'category_id' => $data['cat'],
                    'fail_count' => 0,
                    'is_online' => true,
                ]);
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
        //
    }
};
