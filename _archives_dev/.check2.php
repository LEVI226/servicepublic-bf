<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$procedures = json_decode(file_get_contents('database/data/procedures.json'), true);
$hasDocsCount = 0;
foreach($procedures as $p) {
    if (isset($p['documents']) && !empty($p['documents'])) {
        $hasDocsCount++;
        // Attempt to create document manually
        $procModel = \App\Models\Procedure::where('slug', $p['slug'])->first();
        if ($procModel) {
            foreach ($p['documents'] as $doc) {
                try {
                    $d = \App\Models\Document::updateOrCreate(
                        ['procedure_id' => $procModel->id, 'file_path' => $doc['url']],
                        [
                            'title' => $doc['title'] ?? 'Doc',
                            'file_path' => $doc['url']
                        ]
                    );
                    echo "Created doc: " . $d->id . " for procedure " . $procModel->id . "\n";
                } catch (\Exception $e) {
                    echo "Error: " . $e->getMessage() . "\n";
                }
            }
        }
    }
}
echo 'Total with documents array in database/data/procedures.json: ' . $hasDocsCount;
