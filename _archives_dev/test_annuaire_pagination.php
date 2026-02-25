<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$seen = [];
$duplicates = [];
$totalItems = 0;

for ($page = 1; $page <= 10; $page++) {
    $request = Illuminate\Http\Request::create('/annuaire?page=' . $page, 'GET');
    $controller = new App\Http\Controllers\AnnuaireController();
    $view = $controller->index($request);
    $organismes = $view->getData()['organismes'];
    
    if($organismes->isEmpty()) break;
    
    foreach($organismes as $o) {
        $totalItems++;
        if(isset($seen[$o->id])) {
            $duplicates[] = $o->name . " (Page $page and Page " . $seen[$o->id] . ")";
        } else {
            $seen[$o->id] = $page;
        }
    }
}

echo "Total items retrieved across all pages: $totalItems\n";
echo "Total unique items: " . count($seen) . "\n";
echo "Duplicates found in pagination:\n";
foreach($duplicates as $d) {
    echo "- $d\n";
}
if(empty($duplicates)) echo "None.\n";
