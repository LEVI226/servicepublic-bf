<?php

namespace App\Services\Importers;

use App\Models\Eservice;
use Illuminate\Support\Str;

class EserviceImporter implements ImporterInterface
{
    public static function detect(array $data): bool
    {
        if (empty($data)) return false;
        $first = $data[0] ?? [];
        return isset($first['url']) && !isset($first['cost']) && !isset($first['phones']);
    }

    public static function label(): string
    {
        return 'E-services';
    }

    public function analyze(array $data): array
    {
        $existingUrls = Eservice::pluck('url')->map(fn($u) => rtrim($u, '/'))->toArray();
        $new = 0;
        $update = 0;
        $invalid = 0;

        foreach ($data as $item) {
            $url = rtrim($item['url'] ?? '', '/');
            if (empty($url) || str_starts_with($url, 'http://.')) {
                $invalid++;
            } elseif (in_array($url, $existingUrls)) {
                $update++;
            } else {
                $new++;
            }
        }

        return [
            'total' => count($data),
            'new' => $new,
            'update' => $update,
            'invalid_urls' => $invalid,
            'preview' => array_map(fn($e) => [
                'title' => Str::limit($e['title'] ?? '', 50),
                'url' => Str::limit($e['url'] ?? '', 60),
            ], array_slice($data, 0, 10)),
            'columns' => ['title', 'url'],
        ];
    }

    public function import(array $data): array
    {
        $created = 0;
        $updated = 0;
        $errors = [];

        foreach ($data as $i => $es) {
            try {
                $url = trim($es['url'] ?? '');
                if (empty($url) || str_starts_with($url, 'http://.')) continue;

                $title = trim($es['title'] ?? '');
                if (empty($title)) {
                    $host = parse_url($url, PHP_URL_HOST) ?? '';
                    $title = ucfirst(str_replace(['.gov.bf', '.bf', 'www.', '-'], ['', '', '', ' '], $host));
                }

                $result = Eservice::updateOrCreate(
                    ['slug' => Str::limit($es['slug'] ?? Str::slug($title), 200, '')],
                    [
                        'title' => $title,
                        'description' => $es['description'] ?? '',
                        'url' => $url,
                        'is_active' => true,
                    ]
                );

                $result->wasRecentlyCreated ? $created++ : $updated++;
            } catch (\Exception $e) {
                $errors[] = "Ligne {$i}: " . Str::limit($e->getMessage(), 100);
            }
        }

        return compact('created', 'updated', 'errors');
    }
}
