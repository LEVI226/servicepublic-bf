<?php

namespace App\Services\Importers;

use App\Models\Organisme;
use Illuminate\Support\Str;

class OrganismeImporter implements ImporterInterface
{
    public static function detect(array $data): bool
    {
        if (empty($data)) return false;
        $first = $data[0] ?? [];
        return isset($first['name']) && (isset($first['phones']) || isset($first['phone']) || isset($first['acronym']));
    }

    public static function label(): string
    {
        return 'Organismes / Annuaire';
    }

    public function analyze(array $data): array
    {
        $existingNames = Organisme::pluck('name')->map(fn($n) => strtolower($n))->toArray();
        $new = 0;
        $update = 0;

        foreach ($data as $item) {
            $name = strtolower(trim($item['name'] ?? ''));
            if (in_array($name, $existingNames)) {
                $update++;
            } else {
                $new++;
            }
        }

        return [
            'total' => count($data),
            'new' => $new,
            'update' => $update,
            'with_phone' => count(array_filter($data, fn($o) => !empty($o['phone'] ?? ($o['phones'][0] ?? '')))),
            'with_email' => count(array_filter($data, fn($o) => !empty($o['email'] ?? ($o['emails'][0] ?? '')))),
            'preview' => array_map(fn($o) => [
                'name' => Str::limit($o['name'] ?? '', 50),
                'phone' => $o['phone'] ?? ($o['phones'][0] ?? '-'),
                'email' => $o['email'] ?? ($o['emails'][0] ?? '-'),
            ], array_slice($data, 0, 10)),
            'columns' => ['name', 'phone', 'email'],
        ];
    }

    public function import(array $data): array
    {
        $created = 0;
        $updated = 0;
        $errors = [];

        foreach ($data as $i => $org) {
            try {
                $name = trim($org['name'] ?? '');
                if (empty($name)) continue;

                $phone = $org['phone'] ?? ($org['phones'][0] ?? '');
                $email = $org['email'] ?? ($org['emails'][0] ?? '');

                $slug = Str::slug($name);
                $slug = Str::limit($slug, 200, '');

                $existing = Organisme::where('slug', $slug)->first();

                if ($existing) {
                    $existing->update(array_filter([
                        'phone' => $existing->phone ?: $phone,
                        'email' => $existing->email ?: $email,
                        'address' => $existing->address ?: ($org['address'] ?? ''),
                        'website' => $existing->website ?: ($org['website'] ?? ''),
                        'acronym' => $existing->acronym ?: ($org['acronym'] ?? ''),
                    ]));
                    $updated++;
                } else {
                    Organisme::create([
                        'name' => $name,
                        'slug' => $slug,
                        'acronym' => $org['acronym'] ?? '',
                        'address' => $org['address'] ?? '',
                        'city' => $org['city'] ?? 'Ouagadougou',
                        'region' => $org['region'] ?? 'Centre',
                        'phone' => $phone,
                        'email' => $email,
                        'website' => $org['website'] ?? '',
                        'latitude' => $org['latitude'] ?? null,
                        'longitude' => $org['longitude'] ?? null,
                        'is_active' => true,
                    ]);
                    $created++;
                }
            } catch (\Exception $e) {
                $errors[] = "Ligne {$i}: " . Str::limit($e->getMessage(), 100);
            }
        }

        return compact('created', 'updated', 'errors');
    }
}
