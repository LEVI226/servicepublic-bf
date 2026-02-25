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

        // ORDRE CRITIQUE : respecter les dépendances FK
        $this->call([
            // 1. Tables sans dépendances
            CategorySeeder::class,
            OrganismeSeeder::class,
            LifeEventSeeder::class,

            // 2. Tables avec FK vers categories
            ProcedureSeeder::class,
            EserviceSeeder::class,

            // 3. Tables pivot (si besoin plus tard)
            // LifeEventProcedureSeeder::class,

            // 4. Utilisateur admin par défaut
            UserSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('====================================');
        $this->command->info(' ✅ SEEDING TERMINÉ');
        $this->command->info('====================================');
    }
}
