# 🇧🇫 Service Public BF — Guide Développeur

> **Projet** : Portail officiel des démarches administratives du Burkina Faso
> **Stack** : Laravel 11 · Filament 3 · Bootstrap 5 · MySQL
> **Repo GitHub** : https://github.com/LEVI226/servicepublic-bf

---

## 📋 Table des matières

1. [Installation locale](#1-installation-locale)
2. [Architecture du projet](#2-architecture-du-projet)
3. [Modèles de données (base de données)](#3-modèles-de-données)
4. [Fonctionnalités implémentées](#4-fonctionnalités-implémentées)
5. [Panneau Admin (Filament)](#5-panneau-admin-filament)
6. [Structure des vues (Frontend)](#6-structure-des-vues-frontend)
7. [Comment modifier sans casser](#7-comment-modifier-sans-casser)
8. [Comptes de test](#8-comptes-de-test)

---

## 1. Installation locale

### Prérequis
- PHP 8.1+
- MySQL 8.0+
- Composer
- Node.js (optionnel, les assets CSS/JS sont déjà compilés)

### Étapes

```bash
# 1. Cloner le dépôt
git clone https://github.com/LEVI226/servicepublic-bf.git
cd servicepublic-bf

# 2. Installer les dépendances PHP
composer install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Configurer la base de données dans .env
# DB_DATABASE=servicepublic_bf
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Créer la base & seeder les données
php artisan migrate:fresh --seed

# 6. Lier le stockage (pour les uploads)
php artisan storage:link

# 7. Vider les caches
php artisan optimize:clear

# 8. Lancer le serveur
php artisan serve
```

Accès : http://127.0.0.1:8000
Admin : http://127.0.0.1:8000/admin

---

## 2. Architecture du projet

```
servicepublic-bf/
├── app/
│   ├── Filament/                  ← Panneau d'administration
│   │   ├── Resources/             ← Un fichier par type de contenu
│   │   │   ├── ProcedureResource.php
│   │   │   ├── CategoryResource.php
│   │   │   ├── OrganismeResource.php
│   │   │   └── ...
│   │   └── Widgets/               ← Widgets du tableau de bord
│   │       ├── StatsOverview.php
│   │       └── ProceduresParCategorieChart.php
│   ├── Http/
│   │   └── Controllers/           ← Contrôleurs du site public
│   │       ├── HomeController.php
│   │       ├── ProcedureController.php
│   │       └── ...
│   ├── Models/                    ← Modèles Eloquent (= tables DB)
│   │   ├── Procedure.php
│   │   ├── Category.php
│   │   ├── Organisme.php
│   │   └── ...
│   └── Providers/
│       └── ViewComposerServiceProvider.php  ← Données injectées dans la navbar
├── database/
│   ├── migrations/                ← Structure des tables
│   └── seeders/                   ← Données initiales (1193 procédures, 182 organismes...)
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php      ← LAYOUT PRINCIPAL (header, navbar, footer)
│       ├── pages/                 ← Une page = un dossier
│       │   ├── home/
│       │   ├── fiches/            ← Page de détail d'une fiche pratique
│       │   ├── thematiques/
│       │   ├── evenements/
│       │   ├── annuaire/
│       │   └── ...
│       └── components/            ← Composants réutilisables (cartes, hero...)
├── routes/
│   └── web.php                    ← Toutes les routes du site
└── public/
    ├── css/                       ← Bootstrap + style.min.css compilé
    └── img/                       ← Logo, armoiries, drapeau
```

---

## 3. Modèles de données

### Table principale : `procedures`

| Colonne | Type | Description |
|---|---|---|
| `title` | string | Nom de la démarche |
| `slug` | string | URL (ex: `demande-passeport`) |
| `description` | text | Description HTML |
| `documents_required` | text | Liste HTML des pièces à fournir |
| `cost` | string | Coût (ex: "1 500 FCFA" ou "Gratuit") |
| `delay` | string | Délai de traitement |
| `conditions` | text | Conditions d'éligibilité HTML |
| `steps` | json | Étapes sous forme de tableau JSON |
| `more_info` | text | Informations supplémentaires |
| `is_active` | boolean | Visible sur le site public |
| `category_id` | FK | Thématique parente |
| `subcategory_id` | FK | Sous-catégorie |

### Relations clés

```
Category (thématique)
  └── Subcategory (sous-catégorie)
  └── Procedure (fiche pratique)
       └── Document (fichier PDF téléchargeable)

LifeEvent (événement de vie)
  └── Procedure (many-to-many via life_event_procedure)

Procedure ──────── Category
         ──────── Subcategory
         ──────── LifeEvent (pivot)
         ──────── Document
```

---

## 4. Fonctionnalités implémentées

### Site public
- ✅ **Accueil** : moteur de recherche, thématiques en card, stats
- ✅ **Thématiques** : 16 catégories, filtrage par sous-catégorie
- ✅ **Fiches pratiques** : avec description, pièces, coût, délai, conditions
- ✅ **Événements de vie** : 12 parcours, chacun lié à des procédures
- ✅ **Annuaire** : 182 organismes avec coordonnées
- ✅ **E-Services** : services dématérialisés par catégorie
- ✅ **Espace Entreprises** : démarches liées aux entreprises
- ✅ **Actualités** : blog institutionnel
- ✅ **FAQ** : questions/réponses
- ✅ **Recherche** : full-text sur les procédures
- ✅ **SEO** : OpenGraph, JSON-LD, sitemaps
- ✅ **Accessibilité** : skip-to-content, aria-labels

### Admin
- ✅ **Tableau de bord** : 4 compteurs + graphique procédures/catégorie
- ✅ **Gestion catégories** + sous-catégories (relation directe)
- ✅ **Gestion fiches pratiques** + documents liés
- ✅ **Gestion organismes** (annuaire)
- ✅ **Gestion événements de vie**
- ✅ **Gestion articles** (actualités)
- ✅ **Gestion FAQ**
- ✅ **Gestion pages statiques**
- ✅ **Gestion documents/formulaires** (upload PDF)
- ✅ **Import de données CSV**
- ✅ **Gestion utilisateurs + rôles** (FilamentShield)

---

## 5. Panneau Admin (Filament)

### Ajouter un nouveau type de contenu

**Exemple : ajouter un modèle `Video`**

```bash
# 1. Créer la migration
php artisan make:migration create_videos_table

# 2. Créer le modèle
php artisan make:model Video

# 3. Créer la ressource Filament
php artisan make:filament-resource Video

# 4. Générer les permissions Shield
php artisan shield:generate --all
# Choisir "admin" quand demandé

# 5. Assigner les permissions au super_admin
# (déjà fait si le rôle super_admin existe)
```

### Structure d'une Resource Filament (exemple simplifié)

```php
// app/Filament/Resources/VideoResource.php
class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
    protected static ?string $navigationGroup = 'Outils & Médias'; // ← groupe dans sidebar
    protected static ?string $navigationLabel = 'Vidéos';

    public static function form(Form $form): Form {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->hint('Titre de la vidéo'),           // ← texte d'aide sous le champ
            Forms\Components\FileUpload::make('path')
                ->disk('public'),
        ]);
    }

    public static function table(Table $table): Table {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable(),
        ]);
    }

    public static function getPages(): array {
        return [
            'index'  => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit'   => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
```

---

## 6. Structure des vues (Frontend)

### Modifier le contenu d'une page

| Quoi modifier | Où modifier |
|---|---|
| Header + Navbar | `resources/views/layouts/app.blade.php` (lignes 37–119) |
| Footer | `resources/views/layouts/app.blade.php` (lignes 130–175) |
| Page d'accueil | `resources/views/pages/home/index.blade.php` |
| Page thématique | `resources/views/pages/thematiques/` |
| Fiche pratique (détail) | `resources/views/pages/fiches/show.blade.php` |
| Événement de vie | `resources/views/pages/evenements/` |
| Annuaire | `resources/views/pages/annuaire/` |
| CSS global | `public/css/style.min.css` ← **NE PAS MODIFIER** le .min directement |
| Variables CSS | Dans le fichier source SCSS/CSS avant compilation |

### Composants Blade réutilisables

```
resources/views/components/
├── ui/
│   ├── hero-banner.blade.php      ← Bannière titre en haut des pages
│   └── ...
├── cards/
│   └── procedure.blade.php        ← Carte de fiche pratique
├── quick-info-row.blade.php       ← Ligne Coût/Délai/Public d'une fiche
└── breadcrumb-jsonld.blade.php    ← SEO breadcrumb
```

### Ajouter un lien dans la navbar

Éditer `resources/views/layouts/app.blade.php`, entre les `<li class="nav-item">` existants :

```html
<li class="nav-item">
    <a href="{{ route('ma-nouvelle-page') }}"
       class="nav-link {{ request()->routeIs('ma-nouvelle-page') ? 'active' : '' }}">
        Mon menu
    </a>
</li>
```

---

## 7. Comment modifier sans casser

### ✅ Règle d'or : toujours vider les caches après modification

```bash
php artisan optimize:clear
```

### Modifications sûres (risque faible)

| Action | Commande / Fichier |
|---|---|
| Modifier du texte dans une vue | Éditer directement le `.blade.php` |
| Ajouter un champ dans un formulaire admin | Modifier `form()` dans la Resource Filament |
| Ajouter une colonne dans un tableau admin | Modifier `table()` dans la Resource Filament |
| Changer l'ordre des menus admin | Modifier `$navigationSort` dans la Resource |
| Changer le groupe d'un menu admin | Modifier `$navigationGroup` dans la Resource |

### Modifications à faire prudemment

| Action | Précaution |
|---|---|
| Modifier un modèle Eloquent | Vérifier que les `$fillable` contiennent les nouveaux champs |
| Ajouter une colonne en base | Créer une migration (`php artisan make:migration`) et ne PAS toucher les migrations existantes |
| Modifier les routes | `routes/web.php` — vérifier que les noms de routes utilisés dans les vues restent identiques |
| Modifier le layout app.blade.php | Impact sur TOUTES les pages — tester sur mobile |

### ⚠️ Ne JAMAIS modifier directement

- Les fichiers dans `vendor/` (dépendances Composer)
- Les fichiers `database/migrations/` déjà exécutés
- Le fichier `public/css/style.min.css` directement

### Workflow de modification recommandé

```bash
# 1. Créer une branche Git
git checkout -b feature/ma-modification

# 2. Faire les modifications

# 3. Vider les caches
php artisan optimize:clear

# 4. Tester localement
php artisan serve

# 5. Commiter
git add . && git commit -m "feat: description de la modification"

# 6. Pousser sur GitHub
git push origin feature/ma-modification
```

---

## 8. Comptes de test

| Rôle | Email | Mot de passe |
|---|---|---|
| Super Admin | admin@servicepublic.gov.bf | password |

> Pour créer un nouvel administrateur :
> ```bash
> php artisan make:filament-user
> ```

---

## 🗺️ Carte des fichiers importants

```
MODIFICATIONS FRÉQUENTES :
├── routes/web.php                              ← Routes du site
├── resources/views/layouts/app.blade.php      ← Navbar & footer
├── resources/views/pages/home/index.blade.php ← Page d'accueil
├── app/Filament/Resources/                    ← Admin : tous les CRUD
└── database/seeders/                          ← Données initiales

CONFIGURATION :
├── .env                                        ← Variables d'environnement
├── config/filament-shield.php                 ← Permissions admin
└── config/app.php                             ← Config Laravel

NE PAS TOUCHER :
├── vendor/                                    ← Dépendances
├── bootstrap/cache/                           ← Cache auto-généré
└── storage/framework/                         ← Sessions/cache
```
