<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Verifying Seeding Results:\n";
echo "Catégories : " . \App\Models\Category::count() . "\n";
echo "Procédures : " . \App\Models\Procedure::count() . "\n";
echo "E-services : " . \App\Models\Eservice::count() . "\n";
echo "Organismes : " . \App\Models\Organisme::count() . "\n";
echo "Événements : " . \App\Models\LifeEvent::count() . "\n";

echo "Procédures avec catégorie : " . \App\Models\Procedure::whereNotNull('category_id')->count() . "\n";
echo "Procédures sans catégorie : " . \App\Models\Procedure::whereNull('category_id')->count() . "\n";

\App\Models\Category::withCount('procedures')->get()->each(function ($cat) {
    if ($cat->procedures_count > 0) {
        echo "{$cat->name}: {$cat->procedures_count} fiches\n";
    }
});

echo "Doublons procédures (slug) : " . \App\Models\Procedure::selectRaw('slug, count(*) as c')->groupBy('slug')->having('c', '>', 1)->count() . "\n";
echo "Doublons organismes (name) : " . \App\Models\Organisme::selectRaw('LOWER(name) as n, count(*) as c')->groupBy('n')->having('c', '>', 1)->count() . "\n";
echo "============================\n";
