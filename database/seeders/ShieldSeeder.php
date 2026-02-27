<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

/**
 * Génère toutes les permissions FilamentShield et les assigne au rôle super_admin.
 *
 * Les noms de permissions sont extraits directement des fichiers Policy
 * dans app/Policies/ et correspondent exactement au format attendu par Shield.
 *
 * Équivalent automatique de :
 *   php artisan shield:generate --all
 *   php artisan shield:super-admin
 */
class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'web';

        // Noms de permissions EXACTEMENT tels que définis dans les Policy files
        // Format : {action}_{resource_key}
        $resources = [
            'category',
            'subcategory',
            'procedure',
            'organisme',
            'life::event',   // ← Shield utilise :: pour les modèles CamelCase (LifeEvent)
            'article',
            'faq',
            'page',
            'eservice',
            'document',
            'user',
            'role',
            'region',
        ];

        $actions = [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
            'restore',
            'restore_any',
            'replicate',
            'reorder',
        ];

        // Générer la matrice complète
        $allPermissions = [];
        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                $allPermissions[] = "{$action}_{$resource}";
            }
        }

        // Permissions spéciales pages et widgets
        $allPermissions[] = 'page_Dashboard';
        $allPermissions[] = 'page_ImportData';
        $allPermissions[] = 'widget_StatsOverview';
        $allPermissions[] = 'widget_ProceduresParCategorieChart';

        // Créer toutes les permissions en base
        foreach ($allPermissions as $permName) {
            Permission::firstOrCreate([
                'name'       => $permName,
                'guard_name' => $guard,
            ]);
        }

        $this->command->info("  ✅ " . count($allPermissions) . " permissions créées.");

        // ─── Rôle super_admin → TOUTES les permissions ───
        $superAdmin = Role::firstOrCreate([
            'name'       => 'super_admin',
            'guard_name' => $guard,
        ]);
        $superAdmin->syncPermissions(Permission::where('guard_name', $guard)->get());
        $this->command->info("  ✅ Rôle super_admin → toutes les permissions.");

        // ─── Rôle editor → permissions d'édition limitées ───
        $editor = Role::firstOrCreate([
            'name'       => 'editor',
            'guard_name' => $guard,
        ]);
        $editorPerms = [];
        foreach (['procedure', 'article', 'faq', 'page', 'eservice', 'document'] as $res) {
            foreach (['view', 'view_any', 'create', 'update'] as $action) {
                $editorPerms[] = "{$action}_{$res}";
            }
        }
        $editorPerms = array_merge($editorPerms, [
            'page_Dashboard', 'widget_StatsOverview', 'widget_ProceduresParCategorieChart',
        ]);
        $editor->syncPermissions(
            Permission::whereIn('name', $editorPerms)->where('guard_name', $guard)->get()
        );
        $this->command->info("  ✅ Rôle editor → permissions d'édition.");

        // ─── Assigner les rôles aux utilisateurs ───
        $admin = User::where('email', 'admin@servicepublic.gov.bf')->first();
        if ($admin && !$admin->hasRole('super_admin')) {
            $admin->assignRole('super_admin');
            $this->command->info("  ✅ admin@servicepublic.gov.bf → super_admin");
        }

        $editeur = User::where('email', 'editeur@servicepublic.gov.bf')->first();
        if ($editeur && !$editeur->hasRole('editor')) {
            $editeur->assignRole('editor');
            $this->command->info("  ✅ editeur@servicepublic.gov.bf → editor");
        }
    }
}
