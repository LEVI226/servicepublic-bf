<?php

namespace Database\Seeders;

use App\Models\Eservice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EserviceSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(database_path('data/eservices.json'));
        $eservices = json_decode($json, true);

        if (!$eservices) {
            $this->command->error('Impossible de lire eservices.json');
            return;
        }

        $this->command->info("Import de " . count($eservices) . " e-services...");

        $count = 0;
        $invalid = 0;

        foreach ($eservices as $es) {
            $url = trim($es['url'] ?? '');
            $title = trim($es['title'] ?? '');

            // Ignorer les URLs invalides
            if (empty($url) || str_starts_with($url, 'http://.')) {
                $invalid++;
                continue;
            }

            // Si pas de titre, générer depuis l'URL
            if (empty($title)) {
                $title = $this->titleFromUrl($url);
            }

            // Nettoyer le titre (retirer suffixes parasites)
            $title = preg_replace('/(Services? aux Usagers|Services? en ligne|send)$/i', '', $title);
            $title = trim($title);

            if (empty($title)) {
                $title = $this->titleFromUrl($url);
            }

            $slug = $es['slug'] ?? Str::slug($title);

            Eservice::updateOrCreate(
                ['slug' => Str::limit($slug, 200, '')],
                [
                    'title' => $title,
                    'description' => $es['description'] ?? '',
                    'url' => $url,
                    'is_active' => true,
                    'is_featured' => false,
                ]
            );
            $count++;
        }

        $this->command->info("✅ {$count} e-services importés.");
        if ($invalid > 0) $this->command->warn("⚠️ {$invalid} URLs invalides ignorées.");
    }

    private function titleFromUrl(string $url): string
    {
        $host = parse_url($url, PHP_URL_HOST) ?? $url;
        $host = str_replace(['www.', '.gov.bf', '.bf'], '', $host);
        return ucfirst(str_replace(['-', '.'], ' ', $host));
    }
}
