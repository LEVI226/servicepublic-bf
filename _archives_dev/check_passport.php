<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Procedure;
use Illuminate\Support\Facades\File;

$titleText = "Passeport";

// Check database
echo "--- BASE DE DONNEES ---\n";
$procedures = Procedure::where('title', 'LIKE', "%{$titleText}%")->get();
foreach ($procedures as $p) {
    echo "ID: {$p->id} | Title: {$p->title}\n";
    echo "Cost: {$p->cost}\n";
    echo "Delay: {$p->delay}\n";
    echo "Description: {$p->description}\n";
    echo "Documents: ". substr($p->documents_required, 0, 100) ."\n";
    echo "Conditions: ". substr($p->conditions, 0, 100) ."\n\n";
}

// Check JSON 
echo "--- FICHIER JSON ---\n";
$jsonPath = base_path('content_dump.json');
if (File::exists($jsonPath)) {
    $data = json_decode(File::get($jsonPath), true);
    if(isset($data['procedures'])) {
        foreach($data['procedures'] as $jsonP) {
            if (isset($jsonP['title']) && stripos($jsonP['title'], $titleText) !== false) {
                echo "JSON Title: " . $jsonP['title'] . "\n";
                echo "JSON Cost: " . ($jsonP['cost'] ?? 'N/A') . "\n";
                echo "JSON Documents: " . substr(json_encode($jsonP['documents'] ?? []), 0, 100) . "\n\n";
            }
        }
    }
}
