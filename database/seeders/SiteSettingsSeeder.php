<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stats = [
            ['key' => 'stat_regions', 'label' => 'Régions', 'value' => '17', 'suffix' => null, 'order' => 1],
            ['key' => 'stat_procedures', 'label' => 'Fiches Pratiques', 'value' => '1000', 'suffix' => '+', 'order' => 2],
            ['key' => 'stat_eservices', 'label' => 'E-Services', 'value' => '100', 'suffix' => '+', 'order' => 3],
            ['key' => 'stat_provinces', 'label' => 'Provinces', 'value' => '47', 'suffix' => null, 'order' => 4],
        ];

        foreach ($stats as $stat) {
            \App\Models\SiteSetting::updateOrCreate(
                ['key' => $stat['key']],
                array_merge($stat, ['group' => 'stats'])
            );
        }
    }
}
