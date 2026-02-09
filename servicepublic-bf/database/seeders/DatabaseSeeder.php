<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StructureSeeder::class,
            CategorieSeeder::class,
            FicheSeeder::class,
            EserviceSeeder::class,
            DocumentSeeder::class,
            FaqSeeder::class,
            ActualiteSeeder::class,
        ]);
    }
}
