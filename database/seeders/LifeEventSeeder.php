<?php

namespace Database\Seeders;

use App\Models\LifeEvent;
use App\Models\Procedure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LifeEventSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(database_path('data/life_events.json'));
        $events = json_decode($json, true);

        if (!$events) {
            $this->command->error('Impossible de lire life_events.json');
            return;
        }

        // Compléter avec les événements de vie standards si absents
        $defaults = [
            ['title' => 'Je crée mon entreprise', 'icon' => 'fas fa-store', 'order' => 1, 'keywords' => ['entreprise', 'commerce', 'société', 'boutique']],
            ['title' => 'Je déclare une naissance', 'icon' => 'fas fa-baby', 'order' => 2, 'keywords' => ['naissance', 'accouchement']],
            ['title' => 'Je me marie', 'icon' => 'fas fa-heart', 'order' => 3, 'keywords' => ['mariage', 'noces']],
            ['title' => 'Je demande un passeport', 'icon' => 'fas fa-passport', 'order' => 4, 'keywords' => ['passeport', 'voyage officiel']],
            ['title' => 'Je demande ma CNIB', 'icon' => 'fas fa-id-card', 'order' => 5, 'keywords' => ['CNIB', 'carte nationale d\'identité', 'identité burkinabè']],
            ['title' => 'Je cherche un emploi', 'icon' => 'fas fa-search', 'order' => 6, 'keywords' => ['emploi', 'chômage', 'travail', 'ANPE']],
            ['title' => 'Je construis ma maison', 'icon' => 'fas fa-home', 'order' => 7, 'keywords' => ['construction', 'logement', 'bâtiment', 'permis de construire']],
            ['title' => 'Je déclare un décès', 'icon' => 'fas fa-cross', 'order' => 8, 'keywords' => ['décès', 'mort']],
            ['title' => 'Je pars à la retraite', 'icon' => 'fas fa-sun', 'order' => 9, 'keywords' => ['retraite', 'pension']],
            ['title' => 'Je scolarise mon enfant', 'icon' => 'fas fa-book', 'order' => 10, 'keywords' => ['école', 'scolarité', 'éducation', 'élève']],
            ['title' => "J'importe ou j'exporte", 'icon' => 'fas fa-ship', 'order' => 11, 'keywords' => ['import', 'export', 'douane']],
            ['title' => 'Je demande un casier judiciaire', 'icon' => 'fas fa-file-alt', 'order' => 12, 'keywords' => ['casier judiciaire', 'justice']],
        ];

        $this->command->info("Import des événements de vie...");

        $count = 0;
        foreach ($defaults as $default) {
            // Chercher dans les données extraites
            $found = collect($events)->first(function ($e) use ($default) {
                return str_contains(strtolower($e['title'] ?? ''), strtolower(substr($default['title'], 3)));
            });

            $slug = Str::slug($default['title']);

            $lifeEvent = LifeEvent::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $default['title'],
                    'slug' => $slug,
                    'description' => $found['description'] ?? '',
                    'icon' => $default['icon'],
                    'content' => '',
                    'order' => $default['order'],
                    'is_active' => true,
                ]
            );

            // Rechercher les procédures correspondantes
            $query = Procedure::active();
            foreach ($default['keywords'] as $index => $keyword) {
                if ($index === 0) {
                    $query->where('title', 'LIKE', "%{$keyword}%");
                } else {
                    $query->orWhere('title', 'LIKE', "%{$keyword}%");
                }
            }
            
            $proceduresToAttach = $query->orderByDesc('views_count')->get();
            $lifeEvent->procedures()->syncWithoutDetaching($proceduresToAttach->pluck('id')->toArray());

            $count++;
        }

        $this->command->info("✅ {$count} événements de vie importés avec liaisons procédures.");
    }
}
