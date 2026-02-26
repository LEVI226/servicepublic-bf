<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$p = \App\Models\Procedure::whereNotNull('steps')
    ->where('steps', '!=', '[]')
    ->where('steps', '!=', '')
    ->first();

if ($p) {
    echo "Found: " . $p->title . "\n";
    $steps = is_string($p->steps) ? json_decode($p->steps, true) : $p->steps;
    echo "Steps count: " . count((array)$steps) . "\n";
    echo "Steps preview: " . substr(json_encode($steps), 0, 300) . "\n";
    echo "Cost: " . ($p->cost ?? 'NULL') . "\n";
    echo "Delay: " . ($p->delay ?? 'NULL') . "\n";
    echo "Documents required: " . substr($p->documents_required ?? 'NULL', 0, 100) . "\n";
} else {
    echo "No procedure with steps found.\n";
    $p2 = \App\Models\Procedure::first();
    if($p2) {
        echo "First procedure (no steps): " . $p2->title . "\n";
        echo "Cost: " . ($p2->cost ?? 'NULL') . "\n";
        echo "Delay: " . ($p2->delay ?? 'NULL') . "\n";
        echo "Documents required: " . substr($p2->documents_required ?? 'NULL', 0, 100) . "\n";
        echo "Steps raw: " . substr($p2->steps ?? 'NULL', 0, 50) . "\n";
    }
}
