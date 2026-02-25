<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Eservice;
use App\Models\Category;

$categories = Category::pluck('id')->toArray();

if (empty($categories)) {
    echo "No categories found to assign.\n";
    exit;
}

$eservices = Eservice::whereNull('category_id')->get();
$count = 0;

foreach ($eservices as $idx => $eservice) {
    // Assign a semi-random category (deterministic based on ID)
    $categoryId = $categories[$eservice->id % count($categories)];
    $eservice->category_id = $categoryId;
    $eservice->save();
    $count++;
}

echo "Assigned category_id to $count Eservices.\n";
