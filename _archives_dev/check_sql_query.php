<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $result = DB::select("select `subcategories`.*, (select count(*) from `procedures` where `subcategories`.`id` = `procedures`.`subcategory_id` and `procedures`.`deleted_at` is null) as `procedures_count` from `subcategories` limit 1");
    print_r($result);
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
