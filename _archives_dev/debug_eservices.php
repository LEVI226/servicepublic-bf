<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;

$categories = Category::has('eservices')->get(['id', 'name']);
$output = [];
foreach($categories as $c) {
    $output[] = $c->name;
}

file_put_contents('debug_out.json', json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Done.\n";
