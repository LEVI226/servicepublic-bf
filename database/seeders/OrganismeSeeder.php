<?php

namespace Database\Seeders;

use App\Models\Organisme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class OrganismeSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(database_path('data/organismes.json'));
        $organismes = json_decode($json, true);

        if (!$organismes) {
            $this->command->error('Impossible de lire organismes.json');
            return;
        }

        $this->command->info("Import de " . count($organismes) . " organismes...");

        $count = 0;
        $dupes = 0;

        foreach ($organismes as $org) {
            $name = trim($org['name'] ?? '');
            if (empty($name)) continue;

            $slug = Str::slug($name);
            // Some migrations limit slug to 100 or 255. Let's limit
            $slug = Str::limit($slug, 200, '');

            // Vérifier le doublon par slug
            $existing = Organisme::where('slug', $slug)->first();
            if ($existing) {
                $dupes++;
                // Mettre à jour les champs manquants
                $existing->update(array_filter([
                    'phone' => $existing->phone ?: ($org['phone'] ?? ''),
                    'email' => $existing->email ?: ($org['email'] ?? ''),
                    'address' => $existing->address ?: ($org['address'] ?? ''),
                    'website' => $existing->website ?: ($org['website'] ?? ''),
                ]));
                continue;
            }

            Organisme::create([
                'name' => $name,
                'slug' => $slug,
                'acronym' => $org['acronym'] ?? '',
                'address' => $org['address'] ?? '',
                'city' => $org['city'] ?? 'Ouagadougou',
                'region' => $org['region'] ?? 'Centre',
                'phone' => $org['phone'] ?? '',
                'email' => $org['email'] ?? '',
                'website' => $org['website'] ?? '',
                'latitude' => $org['latitude'] ?? null,
                'longitude' => $org['longitude'] ?? null,
                'is_active' => true,
            ]);
            $count++;
        }

        $this->command->info("✅ {$count} organismes importés.");
        if ($dupes > 0) $this->command->info("ℹ️ {$dupes} doublons détectés → mis à jour.");
    }
}
