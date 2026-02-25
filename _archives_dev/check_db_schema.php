<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "DB Host connected: " . DB::connection()->getConfig('host') . "\n";
echo "DB Port connected: " . DB::connection()->getConfig('port') . "\n";
echo "DB Name connected: " . DB::connection()->getConfig('database') . "\n";

$columns = Schema::getColumnListing('procedures');
echo "Columns in procedures table:\n";
print_r($columns);
