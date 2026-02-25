<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Procedure;
use Illuminate\Support\Str;

$procedures = Procedure::pluck('title', 'id');
$output = "";
foreach($procedures as $id => $title) {
    $output .= "$id: $title\n";
}
file_put_contents('procedures_list.txt', $output);
echo "Exported " . count($procedures) . " procedures.\n";
