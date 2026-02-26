<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = \App\Models\User::all();
echo "Users found:\n";
foreach ($users as $u) {
    echo "  - [{$u->id}] {$u->email} (role: {$u->role})\n";
    try {
        $u->syncRoles(['super_admin']);
        echo "    => super_admin role assigned.\n";
    } catch (\Exception $e) {
        echo "    => ERROR: " . $e->getMessage() . "\n";
    }
}
echo "\nDone.\n";
