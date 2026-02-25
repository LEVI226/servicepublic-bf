<?php

namespace App\Services\Importers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryImporter implements ImporterInterface
{
    public static function detect(array $data): bool
    {
        if (empty($data)) return false;
        $first = $data[0] ?? [];
        // Détecte un JSON de catégories si les clés contiennent 'procedures_count' ou si c'est petit et a 'name' + 'slug'
        return isset($first['name']) && (isset($first['procedures_count']) || isset($first['order'])) && !isset($first['cost']);
    }

    public static function label(): string
    {
        return 'Catégories';
    }

    public function analyze(array $data): array
    {
        $existingSlugs = Category::pluck('slug')->toArray();

        $new = 0;
        $update = 0;
        $empty = 0;

        foreach ($data as $item) {
            $slug = $item['slug'] ?? Str::slug($item['name'] ?? '');
            if (empty($item['name'] ?? '')) {
                $empty++;
            } elseif (in_array($slug, $existingSlugs)) {
                $update++;
            } else {
                $new++;
            }
        }

        return [
            'total' => count($data),
            'new' => $new,
            'update' => $update,
            'empty_fields' => $empty,
            'preview' => array_slice($data, 0, 10),
            'columns' => array_keys($data[0] ?? []),
        ];
    }

    public function import(array $data): array
    {
        $created = 0;
        $updated = 0;
        $errors = [];

        foreach ($data as $i => $item) {
            try {
                $name = trim($item['name'] ?? '');
                if (empty($name)) continue;

                $slug = $item['slug'] ?? Str::slug($name);

                $result = Category::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => $name,
                        'slug' => $slug,
                        'icon' => $item['icon'] ?? 'fas fa-folder',
                        'color' => $item['color'] ?? '#009E49',
                        'description' => $item['description'] ?? '',
                        'order' => $item['order'] ?? ($i + 1),
                        'is_active' => ($item['procedures_count'] ?? 1) > 0,
                    ]
                );

                $result->wasRecentlyCreated ? $created++ : $updated++;
            } catch (\Exception $e) {
                $errors[] = "Ligne {$i}: {$e->getMessage()}";
            }
        }

        return [
            'created' => $created,
            'updated' => $updated,
            'errors' => $errors,
        ];
    }
}
