<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/annuaire', 'GET');
$controller = new App\Http\Controllers\AnnuaireController();
$view = $controller->index($request);
$organismes = $view->getData()['organismes'];

foreach($organismes as $o) {
    echo $o->id . " - " . $o->name . " (" . $o->acronym . ")\n";
}
