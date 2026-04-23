<?php

namespace App\Services\Importers;

use App\Models\LifeEvent;
use Illuminate\Support\Str;

class LifeEventImporter implements ImporterInterface
{
    public static function detect(array $data): bool
    {
        if (empty($data)) return false;
        $first = $data[0] ?? [];
        return isset($first['title']) && isset($first['icon']) && !isset($first['url']);
    }

    public static function label(): string
    {
        return 'Événements de vie';
    }

    public function analyze(array $data): array
    {
        $existingSlugs = LifeEvent::pluck('slug')->toArray();
        $new = 0;
        $update = 0;

        foreach ($data as $item) {
            $slug = $item['slug'] ?? Str::slug($item['title'] ?? '');
            if (in_array($slug, $existingSlugs)) {
                $update++;
            } else {
                $new++;
            }
        }

        return [
            'total' => count($data),
            'new' => $new,
            'update' => $update,
            'preview' => array_map(fn($e) => [
                'title' => Str::limit($e['title'] ?? '', 50),
                'icon' => $e['icon'] ?? '-',
            ], array_slice($data, 0, 10)),
            'columns' => ['title', 'icon'],
        ];
    }

    public function import(array $data): array
    {
        $created = 0;
        $updated = 0;
        $errors = [];

        foreach ($data as $i => $event) {
            try {
                $title = trim($event['title'] ?? '');
                if (empty($title)) continue;

                $slug = $event['slug'] ?? Str::slug($title);

                $result = LifeEvent::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'title' => $title,
                        'description' => $event['description'] ?? '',
                        'icon' => $event['icon'] ?? 'fas fa-info-circle',
                        'content' => $event['content'] ?? '',
                        'order' => $event['order'] ?? ($i + 1),
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
