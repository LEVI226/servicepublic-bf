<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@servicepublic.gov.bf'],
            [
                'nom' => 'Admin',
                'prenom' => 'Service Public',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'editeur@servicepublic.gov.bf'],
            [
                'nom' => 'Editeur',
                'prenom' => 'Contenu',
                'password' => Hash::make('password'),
                'role' => 'editor',
                'is_active' => true,
            ]
        );
    }
}