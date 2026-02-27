<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MissionsPageSeeder extends Seeder
{
    public function run(): void
    {
        $content = <<<'MARKDOWN'
# Missions et Valeurs de Service Public BF

**Service Public BF** est le portail officiel de l'administration du Burkina Faso, conçu pour simplifier la relation entre l'État et ses citoyens.

## Nos Missions

Notre action s'articule autour de trois piliers fondamentaux :

1. **Informer** : Délivrer une information claire, vérifiée et actualisée sur les droits et obligations des usagers. Avec plus de 1100 fiches pratiques, nous couvrons l'essentiel des démarches administratives.
2. **Orienter** : Faciliter la mise en relation avec les services compétents. Notre annuaire recense les ministères, institutions et services de proximité sur l'ensemble du territoire.
3. **Faciliter** : Accompagner l'usager dans les moments clés de sa vie (création d'entreprise, obtention de documents d'identité, etc.) grâce à des parcours guidés thématiques.

## Nos Valeurs

Pour garantir l'égalité d'accès à l'information administrative, Service Public BF s'engage sur trois valeurs clés :

- **La Simplicité** : Utiliser un langage accessible et une interface intuitive.
- **La Neutralité** : Présenter les textes officiels de manière objective et sans parti pris.
- **La Gratuité** : Garantir que l'accès à l'information et l'orientation est totalement gratuit pour tous les usagers.

## Un Portail en Évolution

Conçu dans une logique centrée sur l'utilisateur, Service Public BF évolue constamment pour intégrer de nouveaux e-services et s'adapter aux réformes administratives (comme le nouveau découpage de 17 régions et 47 provinces).

---
*Service Public BF — Pour une administration plus proche du citoyen.*
MARKDOWN;

        DB::table('pages')->updateOrInsert(
            ['slug' => 'missions-et-valeurs'],
            [
                'title' => 'Missions et Valeurs',
                'content' => $content,
                'is_published' => true,
                'meta_title' => 'Missions et Valeurs - Service Public Burkina Faso',
                'meta_description' => 'Découvrez les missions d\'information et d\'orientation et les valeurs de simplicité et neutralité du portail Service Public BF.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
