<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$orgs = App\Models\Organisme::orderBy('name')->get();
$names = [];
$dupes = 0;
foreach($orgs as $o) {
    if(isset($names[$o->name])) {
        echo "Duplicate found: " . $o->name . " (IDs: " . $names[$o->name] . ", " . $o->id . ")\n";
        $o->delete();
        $dupes++;
    } else {
        $names[$o->name] = $o->id;
    }
}
echo "Total duplicates removed: $dupes\n";
