# 🇧🇫 Service Public du Burkina Faso — v2.0

> **Portail officiel des droits et démarches administratives**  
> Inspiré de [service-public.fr](https://service-public.gouv.fr) et [guichet.lu](https://guichet.public.lu)

## Architecture

```
servicepublic.gov.bf/
├── /                       → Page d'accueil (recherche, événements, thèmes, actus)
├── /comment-faire-si       → Événements de vie (CNIB, passeport, mariage...)
├── /thematiques            → 10 thèmes × sous-thèmes × fiches pratiques
├── /thematiques/{t}/{f}    → Fiche pratique détaillée
├── /demarches              → Outils (formulaires, simulateurs)
├── /annuaire               → Annuaire de l'administration (A-Z, type, région)
├── /actualites             → Actualités droits & démarches
├── /entreprises/           → Portail Entreprises (structure parallèle)
├── /recherche              → Recherche globale
└── /contact                → Formulaire de contact
```

## Stack technique

| Composant | Technologie |
|-----------|-------------|
| Backend   | Laravel 11 (PHP 8.2+) |
| Frontend  | Blade + Bootstrap 5.3 |
| Base      | MySQL 8 |
| Admin CMS | Filament 3 (Phase 4) |
| Recherche | Laravel Scout + Meilisearch (Phase 3) |
| Serveur   | Nginx + PHP-FPM |
| OS        | Ubuntu 24.04 LTS |

## Installation

```bash
# 1. Cloner le dépôt
git clone <repo-url> servicepublic-bf
cd servicepublic-bf

# 2. Installer les dépendances
composer install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate
# Éditer .env avec vos paramètres DB

# 4. Créer la base et configurer le .env
# Créer une base nommée 'servicepublic_bf' dans MySQL
# Éditer ensuite le fichier .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 5. Installer la structure et les données de base
php artisan migrate --seed

# NOTE SUR LA BASE DE DONNÉES :
# La commande 'migrate --seed' installe la structure et les données de test BF.
# Si vous souhaitez une copie exacte (données saisies en admin), importez le fichier 'database.sql' (si fourni).

# 6. Lancer le serveur
php artisan serve
```

## Modèle de données

```
themes ←──── fiches ←──── avis_fiches
  │               │
  └─ formulaires  └─ evenement_etapes ──→ evenements_vie
  
structures ──→ regions ──→ provinces

actualites    users
```

### Tables principales

- **themes** — Hiérarchie thématique (10 particuliers + 6 entreprises + sous-thèmes)
- **fiches** — Fiches pratiques structurées (pièces, étapes, coût, délai, FAQ...)
- **evenements_vie** — "Comment faire si ?" avec étapes guidées
- **structures** — Annuaire (ministères, institutions, directions, services)
- **formulaires** — Documents téléchargeables
- **actualites** — Blog/news éditorial
- **regions/provinces** — Découpage administratif des 13 régions du BF

## Design System

| Élément | Valeur |
|---------|--------|
| Vert (primary) | `#009E49` / `#007A39` |
| Rouge (accent) | `#EF2B2D` |
| Jaune (highlight) | `#FCD116` |
| Police | Noto Sans (Google Fonts) |
| Approche | Institutionnel, sobre, mobile-first |

## Roadmap (10 semaines)

| Phase | Semaines | Contenu |
|-------|----------|---------|
| **1 — Fondations** ✅ | S1-S2 | Setup, design system, layout, homepage, models, migrations, seeders |
| 2 — Contenu | S3-S4 | Pages thématiques, fiches, événements, annuaire, actus |
| 3 — Outils | S5-S6 | Recherche (Scout+Meilisearch), formulaires, avis, SEO |
| **4 — Back-office** ✅ | S7-S8 | Filament 3 admin, 8 CRUD, workflow éditorial, dashboard stats |
| 5 — Auth & Deploy | S9-S10 | Auth citoyen, espace perso, portail entreprises complet, production |

## Phase 1 — Livrables

- [x] Structure projet Laravel 11
- [x] Design system CSS complet (couleurs BF, composants)
- [x] Layout principal (barre officielle, header, nav, footer)
- [x] Page d'accueil complète
- [x] 7 migrations (users, regions, themes, fiches, structures, formulaires, actualites, avis)
- [x] 11 modèles Eloquent avec relations
- [x] Routes complètes (particuliers + entreprises)
- [x] 11 contrôleurs
- [x] 19 vues Blade
- [x] 8 seeders avec données réalistes BF (13 régions, 16 thèmes, 6 fiches détaillées, 17 événements de vie, 26+ structures, 3 actus)
- [x] **Filament 3 Admin Panel complet** (`/admin`)
  - [x] 8 Resources CRUD (Thèmes, Fiches, Événements de vie, Structures, Actualités, Formulaires, Utilisateurs, Régions)
  - [x] 24 pages admin (List/Create/Edit pour chaque resource)
  - [x] Sélecteur d'icônes Bootstrap intégré (45+ icônes)
  - [x] Workflow éditorial (brouillon → révision → publié → archivé)
  - [x] Repeater JSON pour pièces, étapes, FAQ, liens utiles
  - [x] Dashboard avec statistiques (4 stats + graphique Top 10 fiches)
  - [x] Upload fichiers (formulaires PDF, images actualités)
  - [x] Filtres avancés, recherche globale, tri drag-and-drop
- [x] README & documentation

## Licence

Propriété du Gouvernement du Burkina Faso — MTDPCE
