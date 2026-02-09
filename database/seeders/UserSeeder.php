<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nom' => 'Admin',
            'prenom' => 'System',
            'email' => 'admin@servicepublic.gov.bf',
            'telephone' => '+226 70 00 00 00',
            'password' => Hash::make('password'),
            'type' => 'admin',
            'statut' => 'actif',
        ]);

        // Agent
        User::create([
            'nom' => 'Kaboré',
            'prenom' => 'Jean',
            'email' => 'agent@servicepublic.gov.bf',
            'telephone' => '+226 70 00 00 01',
            'password' => Hash::make('password'),
            'type' => 'agent',
            'statut' => 'actif',
        ]);

        // Citoyens de test
        $citoyens = [
            ['nom' => 'Ouédraogo', 'prenom' => 'Amadou', 'email' => 'citoyen1@example.com'],
            ['nom' => 'Sanou', 'prenom' => 'Mariam', 'email' => 'citoyen2@example.com'],
            ['nom' => 'Zongo', 'prenom' => 'Issouf', 'email' => 'citoyen3@example.com'],
        ];

        foreach ($citoyens as $citoyen) {
            User::create([
                'nom' => $citoyen['nom'],
                'prenom' => $citoyen['prenom'],
                'email' => $citoyen['email'],
                'telephone' => '+226 7' . rand(0, 9) . ' ' . rand(10, 99) . ' ' . rand(10, 99) . ' ' . rand(10, 99),
                'password' => Hash::make('password'),
                'type' => 'citoyen',
                'statut' => 'actif',
            ]);
        }
    }
}
