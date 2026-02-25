<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Documents: " . \App\Models\Document::count() . "\n";
echo "Procedures source_file: " . \App\Models\Procedure::whereNotNull('source_file')->count() . "\n";
$proc = \App\Models\Procedure::whereNotNull('source_file')->first();
if ($proc) {
    echo "Sample source_file: " . $proc->source_file . "\n";
}
$doc = \App\Models\Document::first();
if ($doc) {
    echo "Sample document path: " . $doc->file_path . "\n";
}

$cat = \App\Models\Category::first();
if ($cat) {
    echo "Sample category icon/image: " . $cat->icon . " | " . ($cat->image ?? 'N/A') . "\n";
}
