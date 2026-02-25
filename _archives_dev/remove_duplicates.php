<?php

use Illuminate\Support\Facades\DB;
use App\Models\Organisme;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$duplicates = DB::table('organismes')
    ->select('name', DB::raw('COUNT(*) as count'))
    ->groupBy('name')
    ->having('count', '>', 1)
    ->get();

$deletedCount = 0;

foreach ($duplicates as $duplicate) {
    // Keep the first one, delete the rest
    $organismes = Organisme::where('name', $duplicate->name)->orderBy('id')->get();
    
    // Skip the first, delete others
    $toDelete = $organismes->slice(1);
    
    foreach ($toDelete as $org) {
        $org->delete(); // Soft delete or hard delete depending on model
        $deletedCount++;
    }
    
    echo "Resolved duplicate for: " . $duplicate->name . "\n";
}

echo "Total duplicate organisms deleted: $deletedCount\n";
