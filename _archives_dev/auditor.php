<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

$output = "## SECTION 2 - BASE DE DONNEES\n";

$tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
foreach ($tables as $table) {
    if (in_array($table, ['migrations', 'cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs', 'sessions'])) continue;
    $output .= "### Table: $table\n";
    $columns = Schema::getColumnListing($table);
    foreach ($columns as $column) {
        $type = Schema::getColumnType($table, $column);
        $output .= "- $column ($type)\n";
    }
}

$output .= "\n## SECTION 5 - ROUTES\n";
$routes = Route::getRoutes();
foreach ($routes as $route) {
    $methods = implode('|', $route->methods());
    $uri = $route->uri();
    $name = $route->getName() ?? 'UNNAMED';
    $action = $route->getActionName();
    $output .= "- $methods $uri | $name | $action\n";
}

file_put_contents('audit_dump.txt', $output);
echo "Dumped basic DB and Routes to audit_dump.txt\n";
