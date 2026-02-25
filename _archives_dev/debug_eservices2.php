<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Active count: " . \App\Models\Eservice::active()->count() . "\n";
echo "Ordered count: " . \App\Models\Eservice::ordered()->count() . "\n";
echo "Active & Ordered sum: " . \App\Models\Eservice::active()->ordered()->count() . "\n";
