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

        // ⚠️ Permissions FilamentShield — DOIT tourner après UserSeeder
        // Sans ceci, le panneau admin n'affiche pas tous les menus !
        $this->call(ShieldSeeder::class);

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

        // Liaisons événements de vie ↔ procédures
        if (class_exists(LifeEventProcedureSeeder::class)) {
            $this->call(LifeEventProcedureSeeder::class);
        }

        // Données enrichies (coûts réels, documents, e-services officiels)
        $this->call(ScrapedDataSeeder::class);
    }
}
