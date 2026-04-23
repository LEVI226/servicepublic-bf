<?php

namespace App\Services\Importers;

use App\Models\Category;
use App\Models\Procedure;
use Illuminate\Support\Str;

class ProcedureImporter implements ImporterInterface
{
    public static function detect(array $data): bool
    {
        if (empty($data)) return false;
        $first = $data[0] ?? [];
        return isset($first['description']) && (isset($first['cost']) || isset($first['documents_required']));
    }

    public static function label(): string
    {
        return 'Procédures / Fiches pratiques';
    }

    public function analyze(array $data): array
    {
        $existingSlugs = Procedure::pluck('slug')->toArray();
        $categoryNames = Category::pluck('id', 'name')->toArray();

        $new = 0;
        $update = 0;
        $noCat = 0;
        $noCost = 0;

        foreach ($data as $item) {
            $slug = $item['slug'] ?? '';
            if (in_array($slug, $existingSlugs)) {
                $update++;
            } else {
                $new++;
            }
            if (empty($item['category'] ?? '')) $noCat++;
            if (empty($item['cost'] ?? '')) $noCost++;
        }

        return [
            'total' => count($data),
            'new' => $new,
            'update' => $update,
            'no_category' => $noCat,
            'no_cost' => $noCost,
            'categories_found' => count(array_unique(array_filter(array_column($data, 'category')))),
            'preview' => array_map(function ($p) {
                return [
                    'title' => Str::limit($p['title'] ?? $p['slug'] ?? '', 60),
                    'category' => $p['category'] ?? '-',
                    'cost' => $p['cost'] ?? '-',
                    'delay' => $p['delay'] ?? '-',
                ];
            }, array_slice($data, 0, 10)),
            'columns' => ['title', 'category', 'cost', 'delay'],
        ];
    }

    public function import(array $data): array
    {
        $categoryMap = Category::pluck('id', 'name')->toArray();
        $categorySlugMap = Category::pluck('id', 'slug')->toArray();
        $defaultCatId = Category::where('name', 'Autres')->first()?->id ?? Category::first()?->id;

        $created = 0;
        $updated = 0;
        $errors = [];

        foreach ($data as $i => $proc) {
            try {
                $title = trim($proc['title'] ?? '');
                $slug = trim($proc['slug'] ?? '');

                if (empty($title) && empty($slug)) continue;
                if (empty($title)) {
                    $title = ucfirst(str_replace('-', ' ', $slug));
                }

                // Résoudre la catégorie
                $catName = trim($proc['category'] ?? '');
                $categoryId = $categoryMap[$catName]
                    ?? $categorySlugMap[Str::slug($catName)]
                    ?? $defaultCatId;

                $cost = trim($proc['cost'] ?? '');
                $isFree = empty($cost) || strtolower($cost) === 'gratuit' || $cost === '0';

                $result = Procedure::updateOrCreate(
                    ['slug' => $slug ?: Str::slug($title)],
                    [
                        'category_id' => $categoryId,
                        'title' => $title,
                        'slug' => $slug ?: Str::slug($title),
                        'description' => $proc['description'] ?? '',
                        'documents_required' => $proc['documents_required'] ?? '',
                        'cost' => $isFree ? 'Gratuit' : $cost,
                        'conditions' => $proc['conditions'] ?? '',
                        'delay' => $proc['delay'] ?? '',
                        'more_info' => $proc['more_info'] ?? '',
                        'is_free' => $isFree,
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
