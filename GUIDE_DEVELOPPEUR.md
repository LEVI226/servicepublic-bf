# 🇧🇫 Service Public BF — Guide Développeur

> **Portail officiel des démarches administratives du Burkina Faso**
>
> **Stack :** Laravel 11 · Filament 3 (admin) · Bootstrap 5 (frontend) · MySQL 8
>
> **Repo :** https://github.com/LEVI226/servicepublic-bf
>
> **Auteur initial :** Ulric Levi (architecte réseau & product owner)

---

## 📋 Table des matières

1. [Installation locale](#1-installation-locale)
2. [Architecture du projet](#2-architecture-du-projet)
3. [Base de données — Modèles & Relations](#3-base-de-données--modèles--relations)
4. [Fonctionnalités implémentées](#4-fonctionnalités-implémentées)
5. [Panneau Admin — Filament](#5-panneau-admin--filament)
6. [Frontend — Structure des vues](#6-frontend--structure-des-vues)
7. [Routes — Cartographie](#7-routes--cartographie)
8. [Modifier sans casser](#8-modifier-sans-casser)
9. [Import de données](#9-import-de-données)
10. [Comptes & Rôles](#10-comptes--rôles)
11. [Carte des fichiers importants](#11-carte-des-fichiers-importants)
12. [FAQ Développeur](#12-faq-développeur)

---

## 1. Installation locale

### Prérequis

| Outil | Version minimum | Vérification |
|---|---|---|
| PHP | 8.1+ | `php -v` |
| MySQL | 8.0+ | `mysql --version` |
| Composer | 2.x | `composer --version` |
| Node.js | 18+ (optionnel) | `node -v` |
| Git | toute version | `git --version` |

> **Note :** Les assets CSS/JS sont pré-compilés dans `public/css/` et `public/js/`. Node.js n'est nécessaire que si vous souhaitez recompiler les assets.

### Installation pas-à-pas

```bash
# 1. Cloner le dépôt
git clone https://github.com/LEVI226/servicepublic-bf.git
cd servicepublic-bf

# 2. Installer les dépendances PHP
composer install

# 3. Copier et configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Éditer .env — configurer la base de données
# DB_DATABASE=servicepublic_bf
# DB_USERNAME=root
# DB_PASSWORD=votre_mot_de_passe

# 5. Créer la base de données (dans MySQL)
mysql -u root -p -e "CREATE DATABASE servicepublic_bf CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 6. Exécuter les migrations et les seeders (données + permissions)
# ⚠️ Cette commande crée TOUT : tables, données, permissions Shield, rôles admin
php artisan migrate:fresh --seed

# 7. Lier le stockage public (pour les uploads de fichiers)
php artisan storage:link

# 8. Vider tous les caches
php artisan optimize:clear

# 9. Lancer le serveur de développement
php artisan serve
```

### Accès après installation

| Accès | URL | Identifiants |
|---|---|---|
| Site public | http://127.0.0.1:8000 | — |
| Panel Admin | http://127.0.0.1:8000/admin | admin@servicepublic.gov.bf / password |

### Commandes XAMPP (Windows)

Si vous utilisez XAMPP (sans PHP dans le PATH) :
```bash
# Remplacer "php" par le chemin complet
C:\xampp\php\php.exe artisan serve
C:\xampp\php\php.exe artisan migrate:fresh --seed
```

---

## 2. Architecture du projet

```
servicepublic-bf/
│
├── app/
│   ├── Filament/                          ← PANNEAU ADMIN
│   │   ├── Resources/                     ← Un fichier = un type de contenu CRUD
│   │   │   ├── ProcedureResource.php      ← Fiches pratiques (le plus important)
│   │   │   ├── CategoryResource.php       ← Thématiques
│   │   │   ├── SubcategoryResource.php    ← Sous-thématiques
│   │   │   ├── OrganismeResource.php      ← Annuaire des organismes
│   │   │   ├── LifeEventResource.php      ← Événements de vie
│   │   │   ├── ArticleResource.php        ← Actualités / Blog
│   │   │   ├── FaqResource.php            ← FAQ
│   │   │   ├── PageResource.php           ← Pages statiques (Mentions légales...)
│   │   │   ├── EserviceResource.php       ← E-Services en ligne
│   │   │   └── DocumentResource.php       ← Documents & Formulaires PDF
│   │   ├── Widgets/                       ← Widgets tableau de bord
│   │   │   ├── StatsOverview.php          ← Compteurs (procs, organismes...)
│   │   │   └── ProceduresParCategorieChart.php ← Graphique camembert
│   │   └── Pages/
│   │       └── Dashboard.php              ← Page d'accueil admin
│   │
│   ├── Http/
│   │   └── Controllers/                   ← CONTRÔLEURS SITE PUBLIC
│   │       ├── HomeController.php
│   │       ├── ProcedureController.php    ← Affiche fiches + recherche
│   │       ├── CategoryController.php
│   │       ├── LifeEventController.php
│   │       ├── OrganismeController.php
│   │       ├── EServiceController.php
│   │       ├── ArticleController.php
│   │       └── PageController.php         ← Pages statiques dynamiques
│   │
│   ├── Models/                            ← MODÈLES ELOQUENT (= tables BDD)
│   │   ├── Procedure.php
│   │   ├── Category.php
│   │   ├── Subcategory.php
│   │   ├── Organisme.php
│   │   ├── LifeEvent.php
│   │   ├── Article.php
│   │   ├── Faq.php
│   │   ├── Page.php
│   │   ├── EService.php
│   │   ├── Province.php                   ← 45 provinces
│   │   └── Document.php
│   │
│   └── Providers/
│       ├── AppServiceProvider.php         ← Gate::before super_admin + cache
│       └── ViewComposerServiceProvider.php ← Injecte thématiques/events dans navbar
│
│── Policies/                              ← 13 POLICY FILES (permissions Shield)
│   ├── ProcedurePolicy.php
│   ├── CategoryPolicy.php
│   └── ... (un par Resource)
│
├── database/
│   ├── migrations/                        ← Schéma de chaque table
│   └── seeders/
│       ├── DatabaseSeeder.php             ← ⭐ Point d'entrée (appelle tous les autres)
│       ├── UserSeeder.php                 ← Comptes admin + éditeur
│       ├── ShieldSeeder.php               ← ⭐ Permissions FilamentShield + rôles Spatie
│       ├── CategoriesTableSeeder.php      ← 20 thématiques
│       ├── SubcategoriesTableSeeder.php   ← 58 sous-thématiques
│       ├── ProceduresTableSeeder.php      ← 1193 fiches pratiques
│       ├── OrganismesTableSeeder.php      ← 182 organismes
│       ├── LifeEventsTableSeeder.php      ← 12 événements de vie
│       ├── EservicesTableSeeder.php       ← 26+ e-services
│       ├── FaqsTableSeeder.php            ← FAQ
│       ├── ArticlesTableSeeder.php        ← Actualités
│       ├── ProvincesTableSeeder.php       ← 45 provinces
│       └── ScrapedDataSeeder.php          ← Données enrichies (coûts réels, docs...)
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php              ← ⭐ LAYOUT MAÎTRE (navbar, header, footer)
│       ├── pages/                         ← UNE PAGE = UN DOSSIER
│       │   ├── home/index.blade.php       ← Accueil
│       │   ├── fiches/
│       │   │   ├── index.blade.php        ← Liste des fiches
│       │   │   └── show.blade.php         ← Détail d'une fiche
│       │   ├── thematiques/
│       │   ├── evenements/
│       │   ├── annuaire/
│       │   ├── eservices/
│       │   ├── entreprises/
│       │   ├── articles/
│       │   └── static/                    ← Pages statiques (mentions légales...)
│       └── components/                    ← COMPOSANTS RÉUTILISABLES
│           ├── ui/hero-banner.blade.php
│           ├── cards/procedure.blade.php
│           ├── quick-info-row.blade.php   ← Ligne Coût/Délai en haut des fiches
│           └── breadcrumb-jsonld.blade.php
│
├── routes/
│   └── web.php                            ← ⭐ TOUTES LES ROUTES
│
└── public/
    ├── css/style.min.css                  ← CSS compilé (NE PAS MODIFIER)
    ├── js/
    │   └── admin-tooltips.js              ← Tooltips de la sidebar admin
    └── img/                               ← Logo, armoiries, drapeau
```

---

## 3. Base de données — Modèles & Relations

### Schéma relationnel

```
Category (thématique)
├── Subcategory (sous-catégorie) [1..N]
└── Procedure (fiche pratique) [1..N]
     ├── Document (PDF téléchargeable) [0..N]
     └── LifeEvent (événement de vie) [N..N via life_event_procedure]

Organisme (annuaire)         ← indépendant
Article (actualité)          ← indépendant
Faq                          ← lié à Category (optionnel)
EService                     ← lié à Category
Page (page statique)         ← indépendant
```

### Table `procedures` (détail)

| Colonne | Type | Description |
|---|---|---|
| `id` | bigint PK | Identifiant unique |
| `category_id` | FK | Thématique parente |
| `subcategory_id` | FK nullable | Sous-catégorie |
| `title` | string(500) | Nom de la démarche |
| `slug` | string(500) unique | URL (ex: `demande-passeport`) |
| `description` | text | Description HTML |
| `documents_required` | text nullable | Liste HTML des pièces à fournir |
| `cost` | text nullable | Coût (ex: "1 500 FCFA" ou "Gratuit") |
| `delay` | string nullable | Délai de traitement |
| `conditions` | text nullable | Conditions d'éligibilité HTML |
| `more_info` | text nullable | Informations supplémentaires |
| `icon` | string nullable | Classe CSS icône Bootstrap |
| `is_free` | boolean | Gratuit ou non |
| `is_active` | boolean | Visible sur le site public |
| `is_featured` | boolean | Mis en avant sur la page d'accueil |
| `views_count` | integer | Compteur de vues |
| `deleted_at` | timestamp | SoftDelete (archivage) |

### Table `categories`

| Colonne | Type | Description |
|---|---|---|
| `name` | string | Nom (ex: "Commerce & Investissement") |
| `slug` | string unique | URL |
| `description` | text | Description HTML |
| `icon` | string | Classe CSS icône Bootstrap |
| `color` | string | Couleur Bootstrap (ex: "success") |
| `order` | integer | Ordre d'affichage |
| `is_active` | boolean | Visible sur le site |

### Table `organismes`

| Colonne | Type | Description |
|---|---|---|
| `name` | string | Nom de l'organisme |
| `type` | string | Type (Ministère, Direction, Agence...) |
| `phone` | string | Numéro de téléphone |
| `email` | string | Email de contact |
| `address` | text | Adresse physique |
| `website` | string | Site web officiel |
| `acronym` | string | Sigle (ex: "DGPN") |

---

## 4. Fonctionnalités implémentées

### Site public

| Fonctionnalité | URL | Description |
|---|---|---|
| **Accueil** | `/` | Barre de recherche, thématiques en cards, stats, procédures populaires |
| **Thématiques** | `/thematiques` | 20 thématiques principales avec icônes et compteurs de fiches |
| **Fiches pratiques** | `/fiches` | Liste + recherche full-text |
| **Détail fiche** | `/fiches/{slug}` | Description, pièces, coût, délai, conditions |
| **Événements de vie** | `/evenements-de-vie` | 12 situations de vie (Je me marie, Je crée une entreprise...) |
| **Annuaire** | `/annuaire` | 182 organismes avec recherche |
| **E-Services** | `/eservices` | Services dématérialisés par catégorie |
| **Espace Entreprises** | `/entreprises` | Procédures dédiées aux entreprises |
| **Actualités** | `/actualites` | Blog institutionnel |
| **FAQ** | `/faq` | Questions/Réponses |
| **Recherche** | `/recherche?q=...` | Recherche full-text MySQL |
| **Pages statiques** | `/{slug}` | Mentions légales, accessibilité... |

### Panneau Admin (`/admin`)

| Section | Description | Raccourci |
|---|---|---|
| **Tableau de bord** | 4 compteurs + graphique procédures/catégorie | `/admin` |
| **Fiches pratiques** | CRUD complet + documents liés | `/admin/procedures` |
| **Thématiques** | Les 16 grands domaines (était « Catégories ») | `/admin/categories` |
| **Sous-thématiques** | Subdivisions des thématiques (était « Sous-catégories ») | `/admin/subcategories` |
| **Organismes** | Annuaire complet | `/admin/organismes` |
| **Événements de vie** | Avec liaison multi-procédures | `/admin/life-events` |
| **Actualités** | Blog avec éditeur rich text | `/admin/articles` |
| **FAQ** | Questions ordonnées par drag & drop | `/admin/faqs` |
| **Pages statiques** | Contenu HTML libre | `/admin/pages` |
| **E-Services** | Liens vers services externes | `/admin/eservices` |
| **Documents & Formulaires** | Upload PDF (10 Mo max) | `/admin/documents` |
| **Import de données** | CSV/JSON | `/admin/import` |
| **Utilisateurs** | Gestion des comptes admin | `/admin/users` |
| **Rôles & Permissions** | FilamentShield | `/admin/roles` |

### Fonctionnalités techniques

- ✅ **SEO complet** : balises Open Graph, JSON-LD (breadcrumb, article), canonical URLs, sitemap
- ✅ **Recherche full-text MySQL** : index FULLTEXT sur `title`, `description`, `documents_required`
- ✅ **SoftDelete** : les procédures et articles supprimés sont archivés (récupérables)
- ✅ **Upload de fichiers** : PDF jusqu'à 10 Mo, images avec redimensionnement auto
- ✅ **Permissions granulaires** : FilamentShield gère les droits CRUD par type de contenu
- ✅ **Cache** : configuration pour optimiser les performances en production
- ✅ **Accessibilité** : skip-to-content, aria-labels sur les formulaires

---

## 5. Panneau Admin — Filament

### Comprendre la structure d'une Resource

Chaque type de contenu est géré par une `Resource` Filament dans `app/Filament/Resources/`. Une Resource comporte **3 parties** :

```php
class ProcedureResource extends Resource
{
    // ① CONFIGURATION : quel modèle, quel menu, quel libellé
    protected static ?string $model = Procedure::class;
    protected static ?string $navigationGroup = 'Contenu éditorial';
    protected static ?string $navigationLabel = 'Fiches pratiques';

    // ② FORM : les champs du formulaire de création/édition
    public static function form(Form $form): Form { ... }

    // ③ TABLE : les colonnes de la liste
    public static function table(Table $table): Table { ... }

    // ④ PAGES : quelles pages existent (liste, créer, éditer)
    public static function getPages(): array { ... }
}
```

### Ajouter un nouveau type de contenu (exemple : Vidéo)

```bash
# 1. Créer la migration
php artisan make:migration create_videos_table

# 2. Créer le modèle
php artisan make:model Video

# 3. Créer la resource Filament
php artisan make:filament-resource Video --generate

# 4. Générer les permissions
php artisan shield:generate --all
# Répond "yes" ou appuyer Entrée pour chaque question

# 5. Vider les caches
php artisan optimize:clear
```

### Ajouter un champ dans une fiche pratique

Éditer `app/Filament/Resources/ProcedureResource.php`, dans la méthode `form()` :

```php
// Exemple : ajouter un champ "Organisme responsable"
Forms\Components\TextInput::make('responsible_organisme')
    ->label('Organisme responsable')
    ->maxLength(255)
    ->hint('Nom de l\'administration qui traite cette démarche.'),
```

> ⚠️ Si le champ n'existe pas en base, créer d'abord une migration :
> ```bash
> php artisan make:migration add_responsible_organisme_to_procedures_table
> ```

### Structure d'une Resource complète (patron)

```php
<?php
namespace App\Filament\Resources;

use App\Models\Video;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Illuminate\Support\Str;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
    protected static ?string $navigationIcon = 'heroicon-o-film';
    protected static ?string $navigationGroup = 'Outils & Médias';
    protected static ?string $navigationLabel = 'Vidéos';
    protected static ?string $modelLabel = 'Vidéo';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Titre')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state)))
                ->hint('Titre de la vidéo tel qu\'affiché sur la plateforme.'),
            Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->hint('URL générée automatiquement.'),
            Forms\Components\FileUpload::make('path')
                ->label('Fichier vidéo')
                ->disk('public')
                ->directory('videos')
                ->hint('Format MP4 recommandé. Taille max : 50 Mo.'),
            Forms\Components\Toggle::make('is_active')
                ->label('Actif')
                ->default(true)
                ->hint('Désactiver pour masquer du site public.'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')
                ->searchable()->sortable()->weight('bold'),
            Tables\Columns\IconColumn::make('is_active')
                ->label('Actif')->boolean(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit'   => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
```

### Relation Manager (onglet dans un formulaire)

Pour gérer les documents liés depuis le formulaire d'une fiche :

```php
// Dans ProcedureResource
public static function getRelations(): array
{
    return [
        DocumentsRelationManager::class, // Onglet "Documents" dans l'édition
    ];
}
```

---

## 6. Frontend — Structure des vues

### Modifier le contenu d'une page

| Page / Élément | Fichier à modifier |
|---|---|
| **Navbar + Header + Footer** | `resources/views/layouts/app.blade.php` |
| **Page d'accueil** | `resources/views/pages/home/index.blade.php` |
| **Liste des fiches** | `resources/views/pages/fiches/index.blade.php` |
| **Détail d'une fiche** | `resources/views/pages/fiches/show.blade.php` |
| **Page d'une thématique** | `resources/views/pages/thematiques/show.blade.php` |
| **Événements de vie** | `resources/views/pages/evenements/` |
| **Annuaire** | `resources/views/pages/annuaire/` |
| **E-Services** | `resources/views/pages/eservices/` |
| **Actualités** | `resources/views/pages/articles/` |
| **Ligne Coût/Délai (fiches)** | `resources/views/components/quick-info-row.blade.php` |
| **Carte de fiche (mini)** | `resources/views/components/cards/procedure.blade.php` |

### Ajouter un lien dans la navbar

Éditer `resources/views/layouts/app.blade.php`, dans la section `<ul class="navbar-nav">` :

```html
<li class="nav-item">
    <a href="{{ route('ma-nouvelle-page') }}"
       class="nav-link {{ request()->routeIs('ma-nouvelle-page') ? 'active' : '' }}">
        Mon menu
    </a>
</li>
```

### Ajouter une nouvelle page publique

**Étape 1** — Créer le contrôleur :
```bash
php artisan make:controller MaPageController
```

**Étape 2** — Dans `app/Http/Controllers/MaPageController.php` :
```php
public function index()
{
    $procedures = Procedure::active()->latest()->take(10)->get();
    return view('pages.ma-page.index', compact('procedures'));
}
```

**Étape 3** — Créer la vue : `resources/views/pages/ma-page/index.blade.php`
```blade
@extends('layouts.app')
@section('title', 'Ma Page')
@section('content')
    {{-- votre HTML ici --}}
@endsection
```

**Étape 4** — Ajouter la route dans `routes/web.php` :
```php
Route::get('/ma-page', [MaPageController::class, 'index'])->name('ma-page');
```

---

## 7. Routes — Cartographie

```php
// routes/web.php — toutes les routes du site public

// Pages principales
GET /                           → HomeController@index        (Accueil)
GET /thematiques                → CategoryController@index    (Liste thématiques)
GET /thematiques/{slug}         → CategoryController@show     (Détail thématique)
GET /fiches                     → ProcedureController@index   (Liste fiches)
GET /fiches/{slug}              → ProcedureController@show    (Détail fiche)
GET /evenements-de-vie          → LifeEventController@index   (Liste événements)
GET /evenements-de-vie/{slug}   → LifeEventController@show    (Détail événement)
GET /annuaire                   → OrganismeController@index   (Annuaire)
GET /annuaire/{slug}            → OrganismeController@show    (Détail organisme)
GET /eservices                  → EServiceController@index    (E-Services)
GET /entreprises                → (vue directe)              (Espace Entreprises)
GET /actualites                 → ArticleController@index     (Blog)
GET /actualites/{slug}          → ArticleController@show      (Article)
GET /faq                        → (vue directe)              (FAQ)
GET /recherche                  → ProcedureController@search  (Recherche)

// Pages statiques (dynamiques depuis la BDD)
GET /{slug}                     → PageController@show         (Pages statiques)

// Admin (géré par Filament)
GET /admin                      → Dashboard admin
GET /admin/*                    → Resources Filament
```

---

## 8. Modifier sans casser

### Règle d'or

```bash
# Toujours vider les caches après chaque modification
php artisan optimize:clear
```

### ✅ Modifications sûres (aucun risque)

| Action | Fichier / Commande |
|---|---|
| Modifier du texte dans une vue | Éditer le `.blade.php` directement |
| Ajouter/modifier un champ de formulaire admin | Modifier `form()` dans la Resource |
| Ajouter une colonne dans un tableau admin | Modifier `table()` dans la Resource |
| Changer l'ordre des menus admin | Modifier `$navigationSort` |
| Changer le groupe d'un menu admin | Modifier `$navigationGroup` |
| Mettre à jour les données via l'admin | Panneau d'administration |

### ⚠️ Modifications avec précautions

| Action | Précaution |
|---|---|
| Modifier un modèle Eloquent | Vérifier que `$fillable` contient les nouveaux champs |
| Ajouter une colonne en BDD | Créer une migration (`make:migration`) — ne jamais toucher les migrations existantes |
| Modifier les routes | Vérifier que les noms de routes utilisés dans les vues (partout où `route('...')` est appelé) restent identiques |
| Modifier `layouts/app.blade.php` | Impacte TOUTES les pages — tester sur mobile |

### 🚫 Ne jamais toucher

- `vendor/` — dépendances Composer (géré par `composer install`)
- `bootstrap/cache/` — cache auto-généré
- `public/css/style.min.css` — CSS compilé (reconstruire via `npm run build` si nécessaire)
- Migrations existantes déjà exécutées en production

### Workflow Git recommandé

```bash
# 1. Créer une branche dédiée
git checkout -b feature/nom-de-la-modification

# 2. Faire les modifications

# 3. Vider les caches et tester
php artisan optimize:clear
php artisan serve

# 4. Commiter avec un message clair
git add .
git commit -m "feat: description de ce qui a changé"

# 5. Pousser sur GitHub
git push origin feature/nom-de-la-modification

# 6. Sur GitHub : créer une Pull Request vers main
```

---

## 9. Import de données

### Via l'interface admin

```
Admin → Outils & Médias → Import de données
→ Choisir : CSV ou JSON
→ Faire correspondre les colonnes
→ Importer
```

### Via un Seeder Laravel (gros volumes)

```php
// database/seeders/MonImportSeeder.php
<?php
namespace Database\Seeders;
use App\Models\Procedure;
use Illuminate\Support\Str;

class MonImportSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('data/procedures.json')), true);

        foreach ($data as $item) {
            Procedure::updateOrCreate(
                ['slug' => Str::slug($item['title'])],   // cherche par slug
                [
                    'title'              => $item['title'],
                    'description'        => $item['description'] ?? null,
                    'documents_required' => $item['documents_required'] ?? null,
                    'cost'               => $item['cost'] ?? null,
                    'delay'              => $item['delay'] ?? null,
                    'category_id'        => $item['category_id'] ?? 1,
                    'is_active'          => true,
                ]
            );
        }

        $this->command->info('Import terminé : ' . count($data) . ' procédures traitées.');
    }
}
```

```bash
php artisan db:seed --class=MonImportSeeder
```

### Seeder données enrichies (déjà disponible)

```bash
# Enrichit 5 procédures populaires + importe 26 e-services officiels
php artisan db:seed --class=ScrapedDataSeeder
```

---

## 10. Comptes & Rôles

### Comptes existants

| Rôle | Email | Mot de passe |
|---|---|---|
| **Super Admin** | admin@servicepublic.gov.bf | password |

### Créer un nouvel administrateur

```bash
php artisan make:filament-user
# Suivre les invites (email, nom, mot de passe)
```

### Assigner le rôle super_admin manuellement

```bash
# Depuis la racine du projet
php assign_role.php
# ou via le panneau Admin → Filament Shield → Utilisateurs
```

### Rôles disponibles

| Rôle | Droits |
|---|---|
| `super_admin` | Accès complet à tout |
| `admin` | Accès standard (peut être limité par Shield) |
| Rôles personnalisés | Configurables via Admin → Rôles |

### Créer un rôle personnalisé

```
Admin → Filament Shield → Rôles → Créer
→ Nommer le rôle
→ Cocher les permissions CRUD souhaitées par resource
→ Enregistrer
→ Assigner à un utilisateur dans Admin → Utilisateurs
```

---

## 11. Carte des fichiers importants

```
⭐ FICHIERS QUE VOUS MODIFIEREZ SOUVENT
├── routes/web.php                                      ← Routes du site public
├── resources/views/layouts/app.blade.php               ← Navbar, header, footer
├── resources/views/pages/home/index.blade.php          ← Page d'accueil
├── resources/views/pages/fiches/show.blade.php         ← Fiche pratique (détail)
├── app/Filament/Resources/ProcedureResource.php        ← Admin : fiches pratiques
├── app/Filament/Resources/CategoryResource.php         ← Admin : thématiques
└── database/seeders/ScrapedDataSeeder.php              ← Import données enrichies

⚙️ CONFIGURATION & PERMISSIONS
├── .env                                                 ← Variables d'environnement
├── config/app.php                                       ← Config Laravel (nom, locale)
├── app/Providers/AppServiceProvider.php                ← ⚠️ Gate::before super_admin bypass
├── database/seeders/ShieldSeeder.php                   ← ⚠️ Permissions + rôles Spatie
└── app/Policies/                                       ← 13 fichiers Policy (1 par Resource)

🔒 NE PAS TOUCHER
├── vendor/                                             ← Dépendances Composer
├── bootstrap/cache/                                    ← Cache auto-généré
├── storage/framework/                                  ← Sessions et cache disque
└── public/css/style.min.css                           ← CSS compilé
```

---

## 12. FAQ Développeur

**Q : Le site affiche une erreur « storage/logs ne peut pas être créé »**
```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache   # Linux/Mac seulement
```

**Q : Les modifications admin n'apparaissent pas**
```bash
php artisan optimize:clear
# Puis rafraîchir avec Ctrl+Shift+R (cache navigateur forcé)
```

**Q : J'ai cloné le projet et le panneau admin ne montre pas tous les menus**

C'est un problème de permissions. La commande `migrate:fresh --seed` devrait tout générer automatiquement grâce à `ShieldSeeder`. Si ça ne marche pas :
```bash
# 1. Vérifier que le seed a bien tourné
php artisan migrate:fresh --seed

# 2. Vider les caches
php artisan optimize:clear

# 3. Redémarrer le serveur
php artisan serve
```

Si le problème persiste, vérifier que :
- `app/Providers/AppServiceProvider.php` contient le `Gate::before` pour `super_admin`
- `database/seeders/ShieldSeeder.php` est bien appelé dans `DatabaseSeeder.php`

**Q : J'ai créé une Resource mais elle n'apparaît pas dans le menu admin**

1. Ajouter les permissions dans `database/seeders/ShieldSeeder.php` (ajouter le nom du modèle dans le tableau `$resources`)
2. Créer le Policy correspondant dans `app/Policies/`
3. Puis :
```bash
php artisan migrate:fresh --seed
php artisan optimize:clear
```

**Q : Comment modifier le thème couleur de l'admin ?**

Éditer `app/Providers/Filament/AdminPanelProvider.php` :
```php
->colors([
    'primary' => Color::Green, // Changer la couleur principale
])
```

**Q : Comment ajouter un widget sur le tableau de bord ?**
```bash
php artisan make:filament-widget MonWidget --stats-overview
# Puis l'enregistrer dans app/Providers/Filament/AdminPanelProvider.php
```

**Q : Comment réinitialiser complètement la base de données ?**
```bash
php artisan migrate:fresh --seed
# ⚠️ DÉTRUIT toutes les données ! Uniquement en développement.
# Recrée tout : tables, données, permissions, rôles.
```

**Q : La recherche ne trouve pas mes nouvelles procédures**
```bash
# Reconstruire l'index full-text (MySQL)
php artisan migrate:fresh --seed
# ou ajouter manuellement via Admin → Fiches pratiques
```

**Q : Comment fonctionne le système de permissions ?**

Le projet utilise **FilamentShield** (basé sur **Spatie Permission**) :
- Chaque Resource Filament a un **Policy** qui vérifie les droits (ex: `CategoryPolicy.php`)
- Les noms de permissions suivent le format `{action}_{model}` (ex: `view_any_category`, `create_procedure`)
- Le rôle `super_admin` bypass toutes les vérifications via `Gate::before()` dans `AppServiceProvider`
- Le `ShieldSeeder` crée automatiquement 160+ permissions et les assigne au rôle

**Q : Comment fonctionnent les tooltips de la sidebar admin ?**

Le fichier `public/js/admin-tooltips.js` est injecté via `AdminPanelProvider.php` (`renderHook`). Il ajoute un attribut `title` (bulle d'aide au survol) à chaque élément de navigation. Pour modifier une description, éditer le dictionnaire `tooltips` dans le fichier JS.

**Q : Pourquoi le bouton « Contact » a été remplacé par « Administration » ?**

Dans `resources/views/layouts/app.blade.php`, le bouton header pointe vers `/admin` (panneau Filament). C'est plus utile pour un accès rapide au back-office depuis le site public.

**Q : Pourquoi la page Thématiques n'affiche que 20 éléments alors qu'il y a 82 catégories en BDD ?**

Les IDs 1-20 sont les 20 thématiques principales (créées manuellement). Les IDs 21-82 sont des sous-catégories importées par scraping. Le `ThematiqueController` filtre avec `where('id', '<=', 20)` pour n'afficher que les thématiques curatées. Les 62 autres restent en BDD pour la recherche et les détails.

---

*Dernière mise à jour : Février 2026 — Version 2.0*
