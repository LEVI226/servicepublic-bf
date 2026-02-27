<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProvincesTableSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            'Boucle du Mouhoun' => ['Balé', 'Banwa', 'Kossi', 'Mouhoun', 'Nayala', 'Sourou'],
            'Cascades'          => ['Comoé', 'Léraba'],
            'Centre'            => ['Kadiogo'],
            'Centre-Est'        => ['Boulgou', 'Koulpélogo', 'Kouritenga'],
            'Centre-Nord'       => ['Bam', 'Namentenga', 'Sanmatenga'],
            'Centre-Ouest'      => ['Boulkiemdé', 'Sanguié', 'Sissili', 'Ziro'],
            'Centre-Sud'        => ['Bazèga', 'Nahouri', 'Zoundwéogo'],
            'Est'               => ['Gnagna', 'Gourma', 'Komondjari', 'Kompienga', 'Tapoa'],
            'Hauts-Bassins'     => ['Houet', 'Kénédougou', 'Tuy'],
            'Nord'              => ['Loroum', 'Passoré', 'Yatenga', 'Zondoma'],
            'Plateau-Central'   => ['Ganzourgou', 'Kourwéogo', 'Oubritenga'],
            'Sahel'             => ['Oudalan', 'Seno', 'Soum', 'Yagha'],
            'Sud-Ouest'         => ['Bougouriba', 'Ioba', 'Noumbiel', 'Poni'],
        ];

        DB::table('provinces')->delete();
        DB::table('regions')->delete(); // On reset aussi les régions pour être sûr de l'ID mapping

        $regionOrder = 1;
        foreach ($regions as $regionName => $provinces) {
            $regionId = DB::table('regions')->insertGetId([
                'nom' => $regionName,
                'slug' => Str::slug($regionName),
                'ordre' => $regionOrder++,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($provinces as $provinceName) {
                DB::table('provinces')->insert([
                    'region_id' => $regionId,
                    'nom' => $provinceName,
                    'slug' => Str::slug($provinceName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
