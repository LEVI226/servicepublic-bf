<?php

use App\Models\Category;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$slugsPro = [
    'creation-d-entreprise', 'activites-commerciales',
    'impots-et-taxes', 'commandes-publiques',
    'comptabilite-publique', 'concurrence',
    'gouvernance-economique', 'transport', 'logistique',
    'mines', 'secteur-agricole', 'secteur-de-l-elevage',
    'peche', 'tourisme', 'tic',
    'formation-professionnelle', 'emploi',
    'administration-du-travail', 'recrutement',
    'promotion-des-energies-renouvelables'
];

$count = Category::whereIn('slug', $slugsPro)
    ->update(['is_pro' => true]);

echo "✅ {$count} categories marked as is_pro\n";
