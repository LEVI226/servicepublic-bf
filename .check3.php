<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$eservices = \App\Models\Eservice::with('category')->take(10)->get();
foreach($eservices as $e) {
    echo "ID: {$e->id}, Title: {$e->title}, Category: " . ($e->category ? $e->category->name : 'NONE') . "\n";
}

$sportCat = \App\Models\Category::where('name', 'Sport & Loisirs')->first();
if ($sportCat) {
    echo "Sport ID: " . $sportCat->id . "\n";
}
