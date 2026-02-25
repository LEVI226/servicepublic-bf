<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use BezhanSalleh\FilamentShield\Support\Utils;

try {
    $roleName = Utils::getSuperAdminName();
    $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

    $user = User::firstOrCreate(
        ['email' => 'admin@servicepublic.gov.bf'],
        [
            'name' => 'Super Administrateur',
            'password' => Hash::make('password'),
        ]
    );

    $user->assignRole($roleName);

    echo "Super Admin 'admin@servicepublic.gov.bf' (mot de passe: 'password') a été créé avec le rôle {$roleName} !\n";
} catch (\Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
