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
            EserviceSeeder::class, // Services de base
            CsvDataImportSeeder::class, // Compléter avec les CSV
            DeduplicateEservicesSeeder::class, // Supprimer les doublons
            DocumentSeeder::class,
            FaqSeeder::class,
            ActualiteSeeder::class,
        ]);
    }
}
