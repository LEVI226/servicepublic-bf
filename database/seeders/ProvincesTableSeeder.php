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
            'Bankui (Dédougou)'       => ['Balé', 'Banwa', 'Mouhoun'],
            'Sourou (Tougan)'         => ['Kossin (ex-Kossi)', 'Nayala', 'Sourou'],
            'Guiriko (Bobo-Dioulasso)' => ['Houet', 'Kénédougou', 'Tuy'],
            'Tannounyan (Banfora)'    => ['Comoé', 'Léraba'],
            'Djôrô (Gaoua)'           => ['Bougouriba', 'Ioba', 'Noumbiel', 'Poni'],
            'Nando (Koudougou)'       => ['Boulkiemdé', 'Sanguié', 'Sissili', 'Ziro'],
            'Nazinon (Manga)'         => ['Bazèga', 'Nahouri', 'Zoundwéogo'],
            'Kadiogo (Ouagadougou)'   => ['Kadiogo'],
            'Oubri (Ziniaré)'         => ['Bassitenga (ex-Oubritenga)', 'Ganzourgou', 'Kourwéogo'],
            'Kuilsé (Kaya)'           => ['Bam', 'Namentenga', 'Sandbondtenga (ex-Sanmatenga)'],
            'Yaadga (Ouahigouya)'     => ['Loroum', 'Passoré', 'Yatenga', 'Zondoma'],
            'Nakambé (Tenkodogo)'     => ['Boulgou', 'Koulpélogo', 'Kouritenga'],
            'Goulmou (Fada N\'Gourma)' => ['Gourma', 'Koom-piënga (ex-Kompienga)'],
            'Sirba (Bogandé)'         => ['Gnagna', 'Komondjari'],
            'Tapoa (Diapaga)'         => ['Tapoa', 'Dyamongou'],
            'Liptako (Dori)'          => ['Oudalan', 'Seno', 'Yagha'],
            'Soum (Djibo)'            => ['Djelgodji (ex-Soum)', 'Karo-Peli'],
        ];

        DB::table('provinces')->delete();
        DB::table('regions')->delete();

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
