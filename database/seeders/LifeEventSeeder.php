<?php

namespace Database\Seeders;

use App\Models\LifeEvent;
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
            ['title' => 'Je crée mon entreprise', 'icon' => 'fas fa-store', 'order' => 1],
            ['title' => 'Je déclare une naissance', 'icon' => 'fas fa-baby', 'order' => 2],
            ['title' => 'Je me marie', 'icon' => 'fas fa-heart', 'order' => 3],
            ['title' => 'Je demande un passeport', 'icon' => 'fas fa-passport', 'order' => 4],
            ['title' => 'Je demande ma CNIB', 'icon' => 'fas fa-id-card', 'order' => 5],
            ['title' => 'Je cherche un emploi', 'icon' => 'fas fa-search', 'order' => 6],
            ['title' => 'Je construis ma maison', 'icon' => 'fas fa-home', 'order' => 7],
            ['title' => 'Je déclare un décès', 'icon' => 'fas fa-cross', 'order' => 8],
            ['title' => 'Je pars à la retraite', 'icon' => 'fas fa-sun', 'order' => 9],
            ['title' => 'Je scolarise mon enfant', 'icon' => 'fas fa-book', 'order' => 10],
            ['title' => "J'importe ou j'exporte", 'icon' => 'fas fa-ship', 'order' => 11],
            ['title' => 'Je demande un casier judiciaire', 'icon' => 'fas fa-file-alt', 'order' => 12],
        ];

        $this->command->info("Import des événements de vie...");

        $count = 0;
        foreach ($defaults as $default) {
            // Chercher dans les données extraites
            $found = collect($events)->first(function ($e) use ($default) {
                return str_contains(strtolower($e['title'] ?? ''), strtolower(substr($default['title'], 3)));
            });

            $slug = Str::slug($default['title']);

            LifeEvent::updateOrCreate(
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
            $count++;
        }

        $this->command->info("✅ {$count} événements de vie importés.");
    }
}
