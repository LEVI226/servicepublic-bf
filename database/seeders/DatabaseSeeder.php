<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('');
        $this->command->info('====================================');
        $this->command->info(' SERVICE PUBLIC BF — SEEDING');
        $this->command->info('====================================');
        $this->command->info('');

        // Utilisateur admin par défaut
        $this->call(UserSeeder::class);

        // Données réelles extraites de la base locale
        $this->call([
            CategoriesTableSeeder::class,
            SubcategoriesTableSeeder::class,
            OrganismesTableSeeder::class,
            LifeEventsTableSeeder::class,
            ProceduresTableSeeder::class,
            EservicesTableSeeder::class,
            FaqsTableSeeder::class,
            ArticlesTableSeeder::class,
        ]);
    }
}
