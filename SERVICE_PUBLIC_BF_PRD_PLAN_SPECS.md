# SERVICE PUBLIC BURKINA FASO — Document de Direction Complète

## PRD → Plan → Specs

**Version** : 1.0  
**Date** : 19 février 2026  
**Projet** : Portail national des services publics du Burkina Faso  
**Méthodologie** : PRD → Plan → Specs → Code/Build/Test → Review → Deployment

---

# PHASE 1 — PRD (Product Requirements Document)

---

## 1.1 Vision du produit

### Objectif
Créer un portail web informatif, accessible et professionnel permettant aux citoyens du Burkina Faso de trouver rapidement toutes les informations sur les démarches administratives, les services publics disponibles, les e-services en ligne et les organismes compétents.

### Ce que c'est
- Un site **purement informatif** — pas de création de compte, pas d'authentification côté citoyen
- Un **CMS administrable** via Laravel Filament pour la gestion du contenu
- Une **plateforme de référence** répertoriant 600+ procédures et 117+ e-services
- Un **annuaire** des administrations et organismes publics

### Ce que ce n'est PAS
- Pas un portail transactionnel (pas de paiement, pas de soumission de formulaires)
- Pas un espace utilisateur avec compte/profil
- Pas une plateforme de e-gouvernement (les liens vers les e-services externes sont fournis)

### Modèles de référence
- **service-public.fr** (France) — structure thématique, fiches pratiques, UX exemplaire
- **guichet.lu** (Luxembourg) — navigation par événements de vie, simplicité d'accès
- **Adaptation Burkina** — contexte local, données réelles, couleurs nationales

---

## 1.2 Utilisateurs cibles

| Profil | Description | Besoin principal |
|--------|-------------|------------------|
| **Citoyen ordinaire** | Population générale, tous niveaux numériques | Trouver une démarche simplement, comprendre les étapes |
| **Entrepreneur** | Créateurs d'entreprise, commerçants | Procédures CEFORE/RCCM, licences, agréments |
| **Fonctionnaire** | Agents publics, gestionnaires de carrière | Gestion RH, recrutement, notation |
| **Diaspora** | Burkinabè de l'extérieur | Passeport, immatriculation consulaire, investissements |
| **Administrateur CMS** | Équipe technique MTDPCE | Gestion du contenu, ajout/modification des fiches |

---

## 1.3 Inventaire de contenu (données réelles)

### Procédures administratives : 600 fiches

| Catégorie | Nb fiches | Sous-catégories |
|-----------|-----------|-----------------|
| Communication | 66 | Communication, Communication audio-visuelle, TIC |
| Médiation | 51 | Médiation dans le public |
| Économie/Finances | 44 | Commandes publiques, Comptabilité publique, Dépenses publiques, Impôts et taxes, Prêts/aides/dons |
| Autres | 38 | Divers |
| Famille/Action sociale | 36 | Femme et Genre, Services sociaux |
| Jeunesse/Emploi/Formation | 34 | Emploi, Formation professionnelle |
| Travaux publics | 34 | Construction d'ouvrages, Information géographique |
| Transport/Logistique | 29 | Logistique, Transport |
| Ressources humaines | 27 | Gestion de carrière, Recrutement |
| Justice/Droits humains | 26 | Promotion de la justice, Promotion des droits humains |
| Agriculture/Élevage | 25 | Pêche, Secteur agricole, Secteur de l'élevage |
| Gouvernance | 25 | Contentieux électoraux, Contrôle de constitutionnalité, Contrôle des partis politiques, Distinction honorifique, Gouvernance administrative/politique/économique |
| Commerce/Artisanat | 24 | Activités commerciales, Concurrence |
| Travail/Protection sociale | 21 | Administration du travail, Protection sociale |
| Culture/Tourisme | 21 | Arts et culture, Tourisme |
| Environnement (2 catégories) | 33 | Assainissement, Eau, Faune, Énergies renouvelables, Protection environnement |
| Éducation/Recherche | 14 | Bourses d'études, Enseignement, Formation, Recherche scientifique |
| Administration/Sécurité | 13 | Décentralisation, État civil, Protection civile, Sécurité |
| Sport/Loisirs | 9 | Loisirs, Promotion jeunesse, Promotion du sport |
| Urbanisme/Habitat | 6 | Aménagements urbains, Bâtiments |
| Entrepreneuriat | 5 | Création d'entreprise |
| Immigration/Émigration | 5 | Diplomatie |
| Mines/Énergie | 4 | Mines |
| Santé | 3 | Santé humaine |

### Structure d'une fiche procédure (champs existants)

```
- title          : Nom de la démarche
- category       : Catégorie principale (26 catégories)
- subcategory    : Sous-catégorie
- description    : Description détaillée
- documents      : Pièces à fournir
- cost           : Coût de la démarche (FCFA)
- conditions     : Conditions requises
- delay          : Délai de traitement
- more_info      : Informations complémentaires (contacts, adresses)
```

### E-services : 117 liens

Services en ligne existants avec URL et description. Exemples clés :
- CEFORE (création d'entreprise)
- eSINTAX (impôts)
- e-casierjudiciaire
- eVisa
- CAMPUSFASO
- legiBurkina
- JOBF (journal officiel)
- Faso arzeka (app citoyenne)
- PRISCA (retraites)
- et 108 autres...

---

## 1.4 Fonctionnalités requises

### Front Office (Public — aucune authentification)

| ID | Fonctionnalité | Priorité | Description |
|----|----------------|----------|-------------|
| F-01 | Page d'accueil | P0 | Hero, recherche, thématiques, événements de vie, actualités |
| F-02 | Navigation par thématique | P0 | 12 thèmes principaux avec sous-catégories |
| F-03 | Navigation par événement de vie | P0 | 8-10 parcours de vie (naissance, mariage, entreprise...) |
| F-04 | Fiches procédures | P0 | Page détaillée avec description, coût, documents, délai, contacts |
| F-05 | Recherche globale | P0 | Full-text search sur toutes les fiches et organismes |
| F-06 | Annuaire des administrations | P1 | Organismes publics avec coordonnées et localisation |
| F-07 | Page e-services | P1 | Catalogue des services en ligne avec liens externes |
| F-08 | Actualités | P1 | Articles d'information, classés par date et catégorie |
| F-09 | FAQ | P2 | Questions fréquentes par thématique |
| F-10 | Plan du site | P2 | Arborescence complète du portail |
| F-11 | Page de contact | P2 | Formulaire de contact (non authentifié), numéros utiles |
| F-12 | Formulaires à télécharger | P2 | PDFs des formulaires officiels liés aux procédures |

### Back Office (CMS — Laravel Filament avec authentification admin)

| ID | Fonctionnalité | Priorité | Description |
|----|----------------|----------|-------------|
| B-01 | Gestion des procédures | P0 | CRUD complet, import CSV/JSON, classement catégoriel |
| B-02 | Gestion des catégories/sous-catégories | P0 | Arborescence thématique modifiable |
| B-03 | Gestion des e-services | P0 | CRUD avec URL, statut (actif/inactif) |
| B-04 | Gestion des organismes | P1 | CRUD, coordonnées, horaires, localisation |
| B-05 | Gestion des actualités | P1 | Éditeur riche, images, publication programmée |
| B-06 | Gestion des événements de vie | P1 | Parcours éditoriaux avec procédures liées |
| B-07 | Gestion des pages statiques | P1 | À propos, mentions légales, accessibilité |
| B-08 | Gestion des FAQ | P2 | Questions/réponses par thématique |
| B-09 | Gestion des formulaires téléchargeables | P2 | Upload PDF, liaison avec procédures |
| B-10 | Gestion des utilisateurs admin | P0 | Rôles (super-admin, éditeur, contributeur) |
| B-11 | Tableau de bord | P1 | Statistiques de contenu, dernières modifications |
| B-12 | Import de données en masse | P0 | Import JSON/CSV initial des 600 procédures et 117 e-services |
| B-13 | Gestion des médias | P1 | Bibliothèque d'images et documents |
| B-14 | SEO / Métadonnées | P2 | Meta title, description, OpenGraph par fiche |

---

## 1.5 Exigences non fonctionnelles

| Exigence | Cible | Justification |
|----------|-------|---------------|
| Performance | TTFB < 500ms, LCP < 2.5s | Connexions limitées au Burkina |
| Accessibilité | WCAG 2.1 AA | Portail gouvernemental, obligation d'accessibilité |
| Responsive | Mobile-first | 70%+ du trafic sera mobile |
| Offline | Pages cachées via Service Worker | Infrastructure internet instable |
| SEO | Score Lighthouse > 90 | Référencement Google essentiel |
| Langue | Français (principal) | Extensible multilangue ultérieurement |
| Sécurité | Voir matrice de sécurité § Specs | Protection complète dès la conception |
| Navigateurs | Chrome 90+, Firefox 88+, Safari 14+, Edge 90+ | Parc navigateurs BF |

---

# PHASE 2 — PLAN (Architecture & Planning)

---

## 2.1 Stack technique

```
┌─────────────────────────────────────────────────────┐
│                    FRONT OFFICE                      │
│  Laravel 11 Blade + Bootstrap 5.3 + Vanilla JS      │
│  (Server-Side Rendering — pas de SPA)               │
└────────────────────────┬────────────────────────────┘
                         │
┌────────────────────────┴────────────────────────────┐
│                    BACK END                          │
│  Laravel 11 (PHP 8.3+)                              │
│  ├─ Routing, Controllers, Form Requests             │
│  ├─ Eloquent ORM + Query Scopes                     │
│  ├─ Laravel Scout (search)                           │
│  └─ Cache (file/redis selon infra)                   │
└────────────────────────┬────────────────────────────┘
                         │
┌────────────────────────┴────────────────────────────┐
│                    ADMIN (CMS)                       │
│  Filament 3.x                                       │
│  ├─ Resources (CRUD)                                │
│  ├─ Widgets (Dashboard)                             │
│  ├─ Shield (Rôles & Permissions)                    │
│  └─ Import/Export (CSV/JSON)                        │
└────────────────────────┬────────────────────────────┘
                         │
┌────────────────────────┴────────────────────────────┐
│                    DATABASE                          │
│  MySQL 8.0+                                         │
│  ├─ Full-text indexes (search)                      │
│  └─ Migrations versionnées                          │
└─────────────────────────────────────────────────────┘
```

### Justification du stack

| Choix | Raison |
|-------|--------|
| **Laravel 11** | Framework PHP mature, excellent écosystème, familiarité locale, hosting abordable |
| **Blade (SSR)** | SEO natif, performances sur réseau lent, pas de build JS complexe |
| **Bootstrap 5.3** | Stable, documenté, grid responsive solide, pas de dépendance JS lourde |
| **Vanilla JS** | Aucune dépendance framework front, léger, maintenable |
| **Filament 3** | Admin panel Laravel natif, puissant, extensible, excellente DX |
| **MySQL 8** | Standard, full-text search natif, largement supporté par les hébergeurs locaux |
| **Pas de SPA/React/Vue** | Simplicité, SSR pour le SEO, performance sur bande passante limitée |

---

## 2.2 Architecture des fichiers Laravel

```
service-public-bf/
├── app/
│   ├── Filament/
│   │   ├── Resources/
│   │   │   ├── ProcedureResource.php
│   │   │   ├── CategoryResource.php
│   │   │   ├── SubcategoryResource.php
│   │   │   ├── EserviceResource.php
│   │   │   ├── OrganismeResource.php
│   │   │   ├── ArticleResource.php
│   │   │   ├── LifeEventResource.php
│   │   │   ├── FaqResource.php
│   │   │   ├── PageResource.php
│   │   │   └── DocumentResource.php
│   │   ├── Widgets/
│   │   │   ├── StatsOverview.php
│   │   │   ├── LatestProcedures.php
│   │   │   └── ContentChart.php
│   │   └── Pages/
│   │       ├── Dashboard.php
│   │       └── ImportData.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── ProcedureController.php
│   │   │   ├── CategoryController.php
│   │   │   ├── EserviceController.php
│   │   │   ├── OrganismeController.php
│   │   │   ├── ArticleController.php
│   │   │   ├── LifeEventController.php
│   │   │   ├── SearchController.php
│   │   │   ├── FaqController.php
│   │   │   ├── ContactController.php
│   │   │   └── PageController.php
│   │   └── Middleware/
│   │       ├── SecurityHeaders.php
│   │       ├── TrustHosts.php
│   │       └── BlockDangerousHeaders.php
│   ├── Models/
│   │   ├── Procedure.php
│   │   ├── Category.php
│   │   ├── Subcategory.php
│   │   ├── Eservice.php
│   │   ├── Organisme.php
│   │   ├── Article.php
│   │   ├── LifeEvent.php
│   │   ├── Faq.php
│   │   ├── Page.php
│   │   ├── Document.php
│   │   └── User.php
│   └── Services/
│       ├── SearchService.php
│       └── ImportService.php
├── database/
│   ├── migrations/
│   │   ├── 001_create_categories_table.php
│   │   ├── 002_create_subcategories_table.php
│   │   ├── 003_create_procedures_table.php
│   │   ├── 004_create_eservices_table.php
│   │   ├── 005_create_organismes_table.php
│   │   ├── 006_create_articles_table.php
│   │   ├── 007_create_life_events_table.php
│   │   ├── 008_create_faqs_table.php
│   │   ├── 009_create_pages_table.php
│   │   ├── 010_create_documents_table.php
│   │   └── 011_create_life_event_procedure_pivot.php
│   └── seeders/
│       ├── CategorySeeder.php
│       ├── ProcedureSeeder.php
│       ├── EserviceSeeder.php
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php           (layout principal)
│       │   └── partials/
│       │       ├── header.blade.php
│       │       ├── nav.blade.php
│       │       ├── footer.blade.php
│       │       ├── search-bar.blade.php
│       │       └── breadcrumb.blade.php
│       ├── home.blade.php
│       ├── procedures/
│       │   ├── index.blade.php         (liste par catégorie)
│       │   └── show.blade.php          (fiche détaillée)
│       ├── categories/
│       │   ├── index.blade.php         (toutes les thématiques)
│       │   └── show.blade.php          (une thématique)
│       ├── eservices/
│       │   └── index.blade.php
│       ├── organismes/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── articles/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── life-events/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── search/
│       │   └── results.blade.php
│       ├── faq/
│       │   └── index.blade.php
│       ├── contact.blade.php
│       ├── sitemap.blade.php
│       ├── pages/
│       │   └── show.blade.php
│       ├── errors/
│       │   ├── 404.blade.php
│       │   ├── 500.blade.php
│       │   └── 503.blade.php
│       └── components/
│           ├── theme-card.blade.php
│           ├── procedure-card.blade.php
│           ├── life-event-card.blade.php
│           ├── news-card.blade.php
│           ├── stats-bar.blade.php
│           └── search-suggestions.blade.php
├── public/
│   ├── css/
│   │   ├── app.css                     (styles custom)
│   │   └── bootstrap.min.css           (Bootstrap 5.3)
│   ├── js/
│   │   ├── app.js                      (vanilla JS)
│   │   ├── search.js                   (logique de recherche)
│   │   └── bootstrap.bundle.min.js
│   ├── images/
│   │   ├── logo-bf.svg
│   │   ├── armoiries.svg
│   │   └── og-image.jpg
│   └── fonts/
│       ├── SourceSans3/
│       └── PlayfairDisplay/
├── routes/
│   └── web.php
├── config/
│   └── session.php                     (secure cookies)
└── storage/
```

---

## 2.3 Schéma de base de données

```sql
-- =====================================================
-- CATÉGORIES & SOUS-CATÉGORIES
-- =====================================================
categories
├── id                  BIGINT UNSIGNED PK AUTO
├── name                VARCHAR(255)        -- "Commerce/Artisanat"
├── slug                VARCHAR(255) UNIQUE
├── description         TEXT NULL
├── icon                VARCHAR(100) NULL   -- "fas fa-store"
├── color               VARCHAR(20) NULL    -- "green", "red", "blue"...
├── order               INT DEFAULT 0
├── is_active           BOOLEAN DEFAULT TRUE
├── meta_title          VARCHAR(255) NULL
├── meta_description    TEXT NULL
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP

subcategories
├── id                  BIGINT UNSIGNED PK AUTO
├── category_id         BIGINT UNSIGNED FK → categories.id
├── name                VARCHAR(255)        -- "Activités commerciales"
├── slug                VARCHAR(255) UNIQUE
├── description         TEXT NULL
├── order               INT DEFAULT 0
├── is_active           BOOLEAN DEFAULT TRUE
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP

-- =====================================================
-- PROCÉDURES (Cœur du portail — 600+ fiches)
-- =====================================================
procedures
├── id                  BIGINT UNSIGNED PK AUTO
├── category_id         BIGINT UNSIGNED FK → categories.id
├── subcategory_id      BIGINT UNSIGNED FK → subcategories.id NULL
├── title               VARCHAR(500)
├── slug                VARCHAR(500) UNIQUE
├── description         TEXT                -- Description complète
├── documents_required  TEXT NULL            -- Pièces à fournir
├── cost                TEXT NULL            -- Coût en FCFA
├── conditions          TEXT NULL            -- Conditions requises
├── delay               VARCHAR(255) NULL   -- Délai de traitement
├── more_info           TEXT NULL            -- Infos complémentaires
├── source_file         VARCHAR(255) NULL   -- Référence fichier source
├── is_free             BOOLEAN DEFAULT FALSE
├── is_active           BOOLEAN DEFAULT TRUE
├── is_featured         BOOLEAN DEFAULT FALSE
├── views_count         INT UNSIGNED DEFAULT 0
├── meta_title          VARCHAR(255) NULL
├── meta_description    TEXT NULL
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP
    FULLTEXT INDEX (title, description, documents_required, more_info)

-- =====================================================
-- E-SERVICES (Liens vers services en ligne externes)
-- =====================================================
eservices
├── id                  BIGINT UNSIGNED PK AUTO
├── category_id         BIGINT UNSIGNED FK → categories.id NULL
├── title               VARCHAR(500)
├── slug                VARCHAR(500) UNIQUE
├── description         TEXT NULL
├── url                 VARCHAR(1000)       -- Lien externe
├── source_file         VARCHAR(255) NULL
├── is_active           BOOLEAN DEFAULT TRUE
├── is_featured         BOOLEAN DEFAULT FALSE
├── order               INT DEFAULT 0
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP

-- =====================================================
-- ORGANISMES PUBLICS
-- =====================================================
organismes
├── id                  BIGINT UNSIGNED PK AUTO
├── name                VARCHAR(500)
├── slug                VARCHAR(500) UNIQUE
├── acronym             VARCHAR(50) NULL    -- "CEFORE", "CNSS"
├── description         TEXT NULL
├── address             TEXT NULL
├── city                VARCHAR(255) NULL
├── region              VARCHAR(255) NULL
├── phone               VARCHAR(100) NULL
├── email               VARCHAR(255) NULL
├── website             VARCHAR(500) NULL
├── hours               TEXT NULL            -- Horaires d'ouverture
├── latitude            DECIMAL(10,8) NULL
├── longitude           DECIMAL(11,8) NULL
├── is_active           BOOLEAN DEFAULT TRUE
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP

-- =====================================================
-- ÉVÉNEMENTS DE VIE (Parcours utilisateur)
-- =====================================================
life_events
├── id                  BIGINT UNSIGNED PK AUTO
├── title               VARCHAR(255)        -- "Naissance & Petite enfance"
├── slug                VARCHAR(255) UNIQUE
├── description         TEXT NULL
├── icon                VARCHAR(50) NULL     -- Emoji ou icône
├── content             LONGTEXT NULL        -- Contenu éditorial Markdown/HTML
├── order               INT DEFAULT 0
├── is_active           BOOLEAN DEFAULT TRUE
├── meta_title          VARCHAR(255) NULL
├── meta_description    TEXT NULL
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP

life_event_procedure (pivot)
├── life_event_id       BIGINT UNSIGNED FK
├── procedure_id        BIGINT UNSIGNED FK
└── order               INT DEFAULT 0

-- =====================================================
-- ACTUALITÉS
-- =====================================================
articles
├── id                  BIGINT UNSIGNED PK AUTO
├── category_id         BIGINT UNSIGNED FK → categories.id NULL
├── title               VARCHAR(500)
├── slug                VARCHAR(500) UNIQUE
├── excerpt             TEXT NULL            -- Résumé court
├── content             LONGTEXT             -- Contenu complet (HTML)
├── image               VARCHAR(500) NULL    -- Chemin image
├── is_published        BOOLEAN DEFAULT FALSE
├── published_at        TIMESTAMP NULL
├── is_featured         BOOLEAN DEFAULT FALSE
├── views_count         INT UNSIGNED DEFAULT 0
├── meta_title          VARCHAR(255) NULL
├── meta_description    TEXT NULL
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP

-- =====================================================
-- FAQ
-- =====================================================
faqs
├── id                  BIGINT UNSIGNED PK AUTO
├── category_id         BIGINT UNSIGNED FK → categories.id NULL
├── question            TEXT
├── answer              TEXT
├── order               INT DEFAULT 0
├── is_active           BOOLEAN DEFAULT TRUE
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP

-- =====================================================
-- PAGES STATIQUES
-- =====================================================
pages
├── id                  BIGINT UNSIGNED PK AUTO
├── title               VARCHAR(255)
├── slug                VARCHAR(255) UNIQUE
├── content             LONGTEXT
├── is_published        BOOLEAN DEFAULT TRUE
├── meta_title          VARCHAR(255) NULL
├── meta_description    TEXT NULL
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP

-- =====================================================
-- DOCUMENTS (Formulaires téléchargeables)
-- =====================================================
documents
├── id                  BIGINT UNSIGNED PK AUTO
├── procedure_id        BIGINT UNSIGNED FK → procedures.id NULL
├── title               VARCHAR(500)
├── file_path           VARCHAR(500)
├── file_size           INT UNSIGNED NULL
├── file_type           VARCHAR(50) NULL     -- "pdf", "doc"
├── downloads_count     INT UNSIGNED DEFAULT 0
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP

-- =====================================================
-- UTILISATEURS ADMIN (Filament)
-- =====================================================
users
├── id                  BIGINT UNSIGNED PK AUTO
├── name                VARCHAR(255)
├── email               VARCHAR(255) UNIQUE
├── password            VARCHAR(255)
├── role                ENUM('super_admin','editor','contributor')
├── is_active           BOOLEAN DEFAULT TRUE
├── email_verified_at   TIMESTAMP NULL
├── remember_token      VARCHAR(100) NULL
├── created_at          TIMESTAMP
└── updated_at          TIMESTAMP
```

### Relations clés

```
Category       1 ──── N  Subcategory
Category       1 ──── N  Procedure
Subcategory    1 ──── N  Procedure
Category       1 ──── N  Eservice
Category       1 ──── N  Article
Category       1 ──── N  Faq
Procedure      N ──── N  LifeEvent       (pivot: life_event_procedure)
Procedure      1 ──── N  Document
```

---

## 2.4 Routes (web.php)

```
GET  /                                  → HomeController@index
GET  /thematiques                       → CategoryController@index
GET  /thematiques/{slug}                → CategoryController@show
GET  /thematiques/{cat}/{sub}           → CategoryController@subcategory
GET  /demarches/{slug}                  → ProcedureController@show
GET  /evenements-de-vie                 → LifeEventController@index
GET  /evenements-de-vie/{slug}          → LifeEventController@show
GET  /e-services                        → EserviceController@index
GET  /annuaire                          → OrganismeController@index
GET  /annuaire/{slug}                   → OrganismeController@show
GET  /actualites                        → ArticleController@index
GET  /actualites/{slug}                 → ArticleController@show
GET  /recherche                         → SearchController@index
GET  /faq                               → FaqController@index
GET  /contact                           → ContactController@index
POST /contact                           → ContactController@send
GET  /plan-du-site                      → PageController@sitemap
GET  /{slug}                            → PageController@show      (pages statiques)

-- Admin (Filament auto-registered)
GET  /admin                             → Filament Dashboard
```

---

## 2.5 Planning de réalisation

### Sprint 0 — Fondations (Semaine 1)

- Initialisation projet Laravel 11
- Configuration MySQL, .env, config/session.php
- Installation Bootstrap 5.3.3 (fichiers locaux, pas CDN)
- Installation Filament 3.x + Shield
- Création de toutes les migrations
- Création de tous les modèles Eloquent avec relations
- Configuration des middlewares de sécurité
- Seeders d'import JSON initial (600 procédures + 117 e-services)

### Sprint 1 — Layout & Navigation (Semaine 2)

- Layout principal Blade (header, nav, footer, breadcrumb)
- Design System CSS (variables, composants, typographie)
- Page d'accueil complète
- Navigation responsive
- Composants Blade réutilisables

### Sprint 2 — Contenu Principal (Semaines 3-4)

- Pages thématiques (liste catégories, sous-catégories)
- Fiches procédures détaillées
- Pages événements de vie
- Catalogue e-services
- Recherche full-text

### Sprint 3 — Admin Filament (Semaines 4-5)

- Toutes les Resources Filament (CRUD)
- Dashboard avec widgets stats
- Import/Export CSV/JSON
- Gestion des médias
- Rôles et permissions

### Sprint 4 — Contenu Secondaire (Semaine 6)

- Annuaire des organismes
- Actualités
- FAQ
- Pages statiques (à propos, mentions légales, accessibilité)
- Formulaires téléchargeables

### Sprint 5 — Optimisation & Sécurité (Semaine 7)

- SEO (sitemap.xml, meta, OpenGraph, robots.txt)
- Performance (cache, lazy loading, compression images)
- Sécurité complète (voir matrice § Specs)
- Accessibilité WCAG 2.1 AA
- Pages d'erreur personnalisées (404, 500, 503)
- Tests fonctionnels

### Sprint 6 — Déploiement (Semaine 8)

- Configuration serveur de production
- Déploiement
- Tests de charge
- Formation équipe CMS
- Documentation technique

---

# PHASE 3 — SPECS (Spécifications Techniques)

---

## 3.1 Design System — Direction Artistique

### Philosophie visuelle

L'identité visuelle s'inspire de service-public.fr et guichet.lu : **sobre, institutionnelle, lisible, fonctionnelle**. Pas de fantaisie décorative. Chaque élément sert la compréhension. Le design inspire confiance et autorité sans être austère.

Mots-clés : **Clarté — Confiance — Efficacité — Accessibilité — Identité nationale**

### Typographie

| Usage | Police | Poids | Taille |
|-------|--------|-------|--------|
| **Titres principaux (h1)** | Playfair Display | 700 (Bold) | 32-36px |
| **Titres de section (h2)** | Playfair Display | 700 | 26-30px |
| **Titres de carte (h3)** | Source Sans 3 | 700 (Bold) | 18-20px |
| **Sous-titres (h4)** | Source Sans 3 | 600 (SemiBold) | 16-17px |
| **Corps de texte** | Source Sans 3 | 400 (Regular) | 15-16px |
| **Texte secondaire** | Source Sans 3 | 400 | 14px |
| **Labels, badges** | Source Sans 3 | 600 (SemiBold) | 12-13px |
| **Navigation** | Source Sans 3 | 500 (Medium) | 14.5px |

**Pourquoi ces polices :**
- **Playfair Display** : Serif élégant, institutionnel, donne de l'autorité aux titres. Utilisé avec parcimonie (titres seulement).
- **Source Sans 3** : Sans-serif humaniste par Adobe/Google. Excellente lisibilité corps de texte, vaste gamme de poids, support complet des caractères français (accents, ligatures). Professionnelle sans être générique.

**Chargement** : Les deux polices sont hébergées localement (pas Google Fonts CDN) en format WOFF2 pour performance optimale. Subset Latin + Latin Extended uniquement.

```css
/* Fichier : public/css/fonts.css */
@font-face {
  font-family: 'Source Sans 3';
  src: url('/fonts/SourceSans3/SourceSans3-Regular.woff2') format('woff2');
  font-weight: 400;
  font-display: swap;
}
/* ... autres poids : 300, 500, 600, 700 */
```

### Palette de couleurs

```
COULEURS NATIONALES (usage structurel, dosé)
┌──────────────────────────────────────────────────┐
│  Vert    #009E49  │  Couleur d'action primaire   │
│  Vert foncé #007A38  │  Hover, accents          │
│  Vert clair #E6F5ED  │  Fonds légers            │
│  Rouge   #EF2B2D  │  Alertes, accents           │
│  Rouge foncé #C41E20  │  Hover rouge             │
│  Jaune   #FCD116  │  Highlights, badges          │
│  Jaune foncé #D4A800  │  Texte sur jaune         │
└──────────────────────────────────────────────────┘

COULEURS FONCTIONNELLES (usage principal quotidien)
┌──────────────────────────────────────────────────┐
│  neutral-900  #1A1A2E  │  Texte principal, nav   │
│  neutral-800  #2D2D3F  │  Titres                 │
│  neutral-700  #3D3D50  │  Texte secondaire fort  │
│  neutral-600  #5A5A6E  │  Texte secondaire       │
│  neutral-500  #7E7E8F  │  Texte désactivé        │
│  neutral-400  #A0A0AE  │  Placeholders           │
│  neutral-300  #C5C5D0  │  Bordures hover         │
│  neutral-200  #E2E2EA  │  Bordures, séparateurs  │
│  neutral-100  #F2F2F6  │  Fonds de section       │
│  neutral-50   #F8F8FB  │  Fond de page           │
│  white        #FFFFFF  │  Cartes, conteneurs     │
└──────────────────────────────────────────────────┘

COULEURS SÉMANTIQUES (catégories de fiches)
┌──────────────────────────────────────────────────┐
│  Bleu     #2563EB  │  Santé, Éducation          │
│  Violet   #7C3AED  │  Logement, Urbanisme       │
│  Orange   #EA580C  │  Transport, Environnement  │
│  Teal     #0D9488  │  Justice                   │
│  Slate    var(--neutral-700)  │  Fiscalité       │
└──────────────────────────────────────────────────┘
```

### Règles d'utilisation des couleurs nationales

Les couleurs vert/rouge/jaune sont **les couleurs du drapeau**. Elles sont utilisées avec retenue :
- **Vert** : Boutons principaux (CTA), liens, accents positifs, barre de navigation. C'est la couleur d'action primaire.
- **Jaune** : Badges, highlights, accents décoratifs (barre sous nav active, accent-line). Jamais comme fond plein.
- **Rouge** : Alertes, urgences, accents dramatiques. Très rare dans l'interface courante.
- **Bandeau tricolore** : Bande fine (4px) en haut de chaque page. Identité immédiate.

### Iconographie

- **Bibliothèque** : Font Awesome 6.x (free), chargé localement
- **Style** : Icônes solides (`fas`) pour la navigation et les catégories, icônes régulières (`far`) pour les actions secondaires
- **Taille cohérente** : 20-24px dans les cartes, 16-18px dans la navigation
- **Émojis** : Utilisés uniquement pour les événements de vie (convivialité)

### Composants UI (Bootstrap + Custom)

#### Cartes thématiques
```
┌─────────────────────────────────┐
│ ┌──────┐                        │
│ │ ICON │  Titre thématique      │
│ └──────┘                        │
│                                 │
│  Description courte de la       │
│  thématique sur 2-3 lignes      │
│  maximum.                       │
│                                 │
│  Consulter →                    │
└─────────────────────────────────┘
- Fond blanc, bordure neutral-200
- Barre d'accent colorée en haut (4px, visible au hover)
- Hover : translateY(-4px) + shadow-lg
- Icône dans un carré arrondi (52x52px) avec fond teinté
- Lien "Consulter →" en vert, gap augmente au hover
```

#### Fiche procédure (page détail)
```
┌─────────────────────────────────────────────────────┐
│  Breadcrumb : Accueil > Thématique > Sous-cat > ... │
├─────────────────────────────────────────────────────┤
│                                                     │
│  [Badge catégorie]                                  │
│  Titre de la procédure                              │
│  Description complète                               │
│                                                     │
│  ┌─────────────────────────────────────────────┐   │
│  │  📋 Pièces à fournir                         │   │
│  │  ─────────────────────────                   │   │
│  │  Liste des documents requis                  │   │
│  └─────────────────────────────────────────────┘   │
│                                                     │
│  ┌──────────┐ ┌──────────┐ ┌──────────┐           │
│  │ 💰 Coût  │ │ ⏱ Délai  │ │ ✅ Cond. │           │
│  │ 25 000F  │ │ 72h      │ │ Voir...  │           │
│  └──────────┘ └──────────┘ └──────────┘           │
│                                                     │
│  ┌─────────────────────────────────────────────┐   │
│  │  ℹ️ Informations complémentaires             │   │
│  │  Adresse, contacts, site web                 │   │
│  └─────────────────────────────────────────────┘   │
│                                                     │
│  ┌─────────────────────────────────────────────┐   │
│  │  🔗 Services en ligne liés                   │   │
│  │  [Lien vers e-service externe]               │   │
│  └─────────────────────────────────────────────┘   │
│                                                     │
│  ← Retour à la thématique                          │
└─────────────────────────────────────────────────────┘
```

#### Grilles responsive

```
Desktop (≥1200px) : 4 colonnes (thématiques), 3 colonnes (actualités)
Tablette (768-1199px) : 2 colonnes
Mobile (<768px) : 1 colonne

Gouttière : 20px (gap)
Marge conteneur : 24px latéral
Largeur max conteneur : 1200px
```

### Animations et interactions

```css
/* Transition standard pour toutes les interactions */
--transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);

/* Hover cartes : élévation douce */
transform: translateY(-4px);
box-shadow: 0 8px 30px rgba(0,0,0,0.12);

/* Apparition au scroll (Intersection Observer) */
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(24px); }
  to { opacity: 1; transform: translateY(0); }
}
/* Stagger : +50ms par élément enfant */

/* Focus visible : outline vert pour accessibilité */
:focus-visible {
  outline: 3px solid var(--green);
  outline-offset: 2px;
}
```

**Règles d'animation :**
- Pas d'animation qui bloque la lecture du contenu
- `prefers-reduced-motion: reduce` → désactiver toutes les animations
- Durée max : 400ms. Au-delà, ça ralentit l'expérience
- Uniquement des propriétés GPU-composites : `transform`, `opacity`

---

## 3.2 Structure des pages (Wireframes textuels)

### Page d'accueil

```
[Bandeau tricolore 4px]
[Header : Logo BF | BURKINA FASO | Unité — Progrès — Justice || Aide | Contact | Plan du site]
[Nav sticky : Accueil | Thématiques | Événements de vie | Services | Actualités | Annuaire | 🔍]

[HERO]
  Badge: "Portail officiel"
  H1: "Votre guide des services publics au Burkina Faso"
  P: Description
  [Barre de recherche globale]
  [Suggestions : Acte de naissance, CNIB, Passeport, Permis...]

[STATS BAR]
  13 Régions | 600+ Fiches | 117+ E-services | 45 Provinces

[THÉMATIQUES] — Grille 4 colonnes
  12 cartes thématiques avec icône, titre, description, lien

[ÉVÉNEMENTS DE VIE] — Grille 4 colonnes
  8 cartes avec emoji, titre, description courte

[SERVICES RAPIDES] — Fond sombre, grille 3 colonnes
  Guides pratiques | Formulaires | Annuaire | Localisation | FAQ | Contact

[ACTUALITÉS] — Grille 3 colonnes
  3 derniers articles avec image, tag, date, titre, extrait

[ANNUAIRE BANNER]
  Titre + description + CTA "Consulter l'annuaire"

[FOOTER]
  Logo + description | Thématiques | Services | Informations
  Copyright | Mentions légales | Accessibilité | Cookies
```

### Page thématique (ex: Commerce/Artisanat)

```
[Breadcrumb : Accueil > Thématiques > Commerce/Artisanat]

[En-tête thématique]
  Icône + Titre "Commerce & Artisanat"
  Description de la thématique
  Nombre de fiches : 24

[Sous-catégories] — Onglets ou liens
  Activités commerciales (20) | Concurrence (4)

[Liste des procédures] — Cartes compactes
  Pour chaque procédure :
  ├── Titre (lien)
  ├── Description (tronquée 2 lignes)
  ├── Badges : Coût (gratuit/payant) | Délai
  └── →

[Pagination si nécessaire]
[Sidebar optionnel : E-services liés, Organismes liés]
```

---

## 3.3 Matrice de sécurité (Intégrée dès la conception)

| ID | Vulnérabilité | Solution | Fichier |
|----|--------------|----------|---------|
| VUL-001 | Version Bootstrap non supportée | Bootstrap 5.3.3 (dernière stable), fichiers locaux, pas CDN | `public/css/bootstrap.min.css` |
| VUL-002 | HSTS manquant | Header `Strict-Transport-Security: max-age=31536000; includeSubDomains` | `SecurityHeaders.php` |
| VUL-003 | Injection d'en-tête Host | Middleware TrustHosts avec domaine whitelist | `TrustHosts.php` |
| VUL-004 | Cookie sans flag Secure | `'secure' => true` en production | `config/session.php` |
| VUL-005 | Cookie sans flag HttpOnly | `'http_only' => true` | `config/session.php` |
| VUL-006 | CSP non défini | Content-Security-Policy restrictive | `SecurityHeaders.php` |
| VUL-007 | X-Content-Type-Options manquant | `X-Content-Type-Options: nosniff` | `SecurityHeaders.php` |
| VUL-008 | Divulgation d'informations | Suppression `X-Powered-By`, `Server` | `SecurityHeaders.php` |
| VUL-009 | Divulgation d'erreur | `APP_DEBUG=false` en prod, pages 404/500/503 custom | `errors/*.blade.php` |
| VUL-010 | X-Frame-Options manquant | `X-Frame-Options: SAMEORIGIN` | `SecurityHeaders.php` |
| VUL-011 | Contournement URL | Blocage `X-Original-URL`, `X-Rewrite-URL` | `BlockDangerousHeaders.php` |
| VUL-012 | CSRF formulaire contact | `@csrf` dans tous les formulaires Blade | Tous les formulaires |
| VUL-013 | X-XSS-Protection | `X-XSS-Protection: 1; mode=block` | `SecurityHeaders.php` |

### Middleware SecurityHeaders.php (spécification)

```
Headers à ajouter sur CHAQUE réponse :
- Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
- X-Content-Type-Options: nosniff
- X-Frame-Options: SAMEORIGIN
- X-XSS-Protection: 1; mode=block
- Referrer-Policy: strict-origin-when-cross-origin
- Permissions-Policy: camera=(), microphone=(), geolocation=()
- Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self';

Headers à SUPPRIMER :
- X-Powered-By
- Server (via config Apache/Nginx)
```

### config/session.php (spécification)

```php
'secure'    => env('SESSION_SECURE_COOKIE', true),  // HTTPS only
'http_only' => true,                                 // Pas d'accès JS
'same_site' => 'lax',                               // Protection CSRF
```

---

## 3.4 Spécifications Filament (Admin CMS)

### Dashboard

```
┌─────────────────────────────────────────────────────────────┐
│  Service Public BF — Administration                         │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  ┌──────────┐ ┌──────────┐ ┌──────────┐ ┌──────────┐     │
│  │ 600      │ │ 117      │ │ 26       │ │ 12       │     │
│  │ Procéd.  │ │ E-serv.  │ │ Catégor. │ │ Articles │     │
│  └──────────┘ └──────────┘ └──────────┘ └──────────┘     │
│                                                             │
│  ┌──────────────────────────┐ ┌────────────────────────┐   │
│  │ Procédures par catégorie │ │ Dernières modif.       │   │
│  │ [Bar Chart]              │ │ - Fiche X modifiée...  │   │
│  │                          │ │ - Article Y publié...  │   │
│  └──────────────────────────┘ └────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
```

### Resources Filament

**ProcedureResource** (le plus complexe) :

```
Liste :
- Colonnes : Titre, Catégorie, Sous-catégorie, Coût, Statut (actif/inactif)
- Filtres : par catégorie, par sous-catégorie, gratuit/payant, actif/inactif
- Recherche : titre, description
- Actions : Edit, Delete, Toggle actif
- Bulk actions : Activer/Désactiver, Changer catégorie, Exporter

Formulaire (Create/Edit) :
- Section "Informations principales" :
  ├── Titre (TextInput, required, maxLength:500)
  ├── Slug (auto-généré depuis titre, editable)
  ├── Catégorie (Select, required, relationship)
  ├── Sous-catégorie (Select, dependsOn:catégorie, relationship)
  └── Description (RichEditor ou Textarea)
  
- Section "Détails de la démarche" :
  ├── Documents requis (Textarea, nullable)
  ├── Coût (Textarea, nullable)
  ├── Conditions (Textarea, nullable)
  ├── Délai (TextInput, nullable)
  └── Informations complémentaires (Textarea, nullable)

- Section "Paramètres" :
  ├── Gratuit (Toggle)
  ├── Actif (Toggle, default:true)
  ├── Mis en avant (Toggle)
  └── Source file (TextInput, disabled, info)

- Section "SEO" :
  ├── Meta title (TextInput, nullable)
  └── Meta description (Textarea, nullable)
```

### Rôles et permissions (Filament Shield)

| Rôle | Permissions |
|------|------------|
| **super_admin** | Tout : CRUD complet, import/export, gestion utilisateurs, configuration |
| **editor** | CRUD procédures, e-services, articles, organismes, FAQ. Pas de gestion utilisateurs ni import en masse |
| **contributor** | Création et modification propres contenus, pas de suppression ni publication |

### Import de données initial

**Page Filament custom `ImportData`** :
1. Upload du fichier `content_dump.json`
2. Parsing des 600 procédures : création automatique des catégories → sous-catégories → procédures
3. Parsing des 117 e-services
4. Rapport d'import : créés, ignorés (doublons), erreurs
5. Mapping automatique catégorie existante → nouvelle catégorie nettoyée

**Mapping catégories JSON → catégories portail :**

| Catégorie source (JSON) | Catégorie portail | Icône |
|------------------------|-------------------|-------|
| Commerce/Artisanat | Entreprises & Commerce | `fa-store` |
| Communication | Communication & Numérique | `fa-satellite-dish` |
| Économie/Finances | Fiscalité & Finances | `fa-coins` |
| Famille/Action sociale | Famille & Action sociale | `fa-users` |
| Jeunesse/Emploi/Formation | Travail & Emploi | `fa-briefcase` |
| Justice/Droits humains/Civisme | Justice & Droits | `fa-gavel` |
| Éducation/Recherche scientifique | Éducation & Recherche | `fa-graduation-cap` |
| Santé | Santé & Protection sociale | `fa-heartbeat` |
| Transport/Logistique | Transport & Mobilité | `fa-car` |
| Agriculture/Élevage | Agriculture & Élevage | `fa-seedling` |
| Environnement/* (2 catégories) | Environnement & Ressources | `fa-leaf` |
| Travaux publics | Travaux publics & Urbanisme | `fa-hard-hat` |
| Urbanisme/Habitat | Travaux publics & Urbanisme | `fa-hard-hat` |
| Travail/Protection sociale | Travail & Emploi | `fa-briefcase` |
| Gouvernance | Gouvernance & Institutions | `fa-landmark` |
| Administration/Sécurité | Papiers & Citoyenneté | `fa-id-card` |
| Sport/Loisirs | Sport & Loisirs | `fa-running` |
| Mines/Énergie | Environnement & Ressources | `fa-leaf` |
| Culture/Tourisme | Culture & Tourisme | `fa-palette` |
| Immigration/Émigration | Diaspora & Coopération | `fa-globe-africa` |
| Médiation | Médiation | `fa-handshake` |
| Ressources humaines | Fonction publique | `fa-user-tie` |
| Entrepreneuriat | Entreprises & Commerce | `fa-store` |
| Autres / Uncategorized | Autres démarches | `fa-folder` |

---

## 3.5 Spécifications SEO

### Structure URL

```
/                                    → Page d'accueil
/thematiques/entreprises-commerce    → Catégorie
/thematiques/entreprises-commerce/activites-commerciales → Sous-catégorie
/demarches/demande-dagrement-pour-la-commercialisation   → Fiche procédure
/e-services                          → Catalogue e-services
/evenements-de-vie/naissance         → Événement de vie
/annuaire/cefore                     → Fiche organisme
/actualites/campagne-vaccination-2026 → Article
```

### Règles SEO

- Slugs auto-générés depuis les titres, en minuscules, accents conservés en base mais URL-encodés
- Balise `<title>` : `{titre fiche} — Service Public Burkina Faso`
- Meta description : champ dédié ou auto-tronqué depuis description (160 chars)
- OpenGraph (og:title, og:description, og:image, og:url) sur chaque page
- Sitemap XML auto-généré (`/sitemap.xml`)
- robots.txt : autoriser tout sauf `/admin`
- Canonical URLs sur chaque page
- Breadcrumb structuré (JSON-LD Schema.org)

---

## 3.6 Performance et cache

### Stratégie de cache Laravel

```
- Route cache    : php artisan route:cache (production)
- Config cache   : php artisan config:cache
- View cache     : php artisan view:cache
- Query cache    : Cache::remember() sur les requêtes fréquentes
  ├── Page d'accueil : 1 heure
  ├── Liste catégories : 6 heures
  ├── Fiche procédure : 24 heures (invalidée à l'édition Filament)
  └── Recherche : pas de cache (dynamique)
- Driver cache   : file (par défaut) ou redis si disponible
```

### Optimisation front-end

```
- Bootstrap : fichier CSS unique minifié, pas de JS Bootstrap sauf collapse/dropdown
- Fonts : WOFF2 uniquement, font-display: swap, préchargement <link rel="preload">
- Images : WebP si supporté, lazy loading natif (loading="lazy")
- CSS : un seul fichier custom (app.css), minifié en production
- JS : un seul fichier (app.js), < 15KB, defer
- Pas de jQuery, pas de framework JS lourd
```

### Objectifs Lighthouse

```
Performance   : > 90
Accessibility : > 90
Best Practices: > 90
SEO           : > 95
```

---

## 3.7 Accessibilité (WCAG 2.1 AA)

| Critère | Implémentation |
|---------|---------------|
| Contraste couleurs | Ratio minimum 4.5:1 (texte), 3:1 (grands textes) — validé avec les couleurs nationales |
| Navigation clavier | Tous les éléments interactifs accessibles via Tab, outline visible (`:focus-visible`) |
| ARIA landmarks | `<header>`, `<nav>`, `<main>`, `<footer>`, `<aside>` correctement utilisés |
| Textes alternatifs | Toutes les images avec `alt` descriptif |
| Hiérarchie titres | H1 unique par page, hiérarchie H1→H2→H3 respectée |
| Formulaires | Labels associés, messages d'erreur liés par `aria-describedby` |
| Skip to content | Lien "Aller au contenu" en premier élément |
| Langue | `<html lang="fr">` |
| Responsive text | Tailles en rem, zoom 200% sans perte de contenu |

---

## 3.8 Spécifications de déploiement

### Environnement cible

```
- Serveur : VPS Linux (Ubuntu 22.04 LTS ou 24.04)
- Web server : Nginx
- PHP : 8.3+
- MySQL : 8.0+
- SSL : Let's Encrypt (certificat automatique)
- Backup : quotidien (base de données + uploads)
```

### Configuration Nginx (spécification)

```
- GZIP activé pour CSS, JS, HTML, JSON, SVG
- Cache statique : 1 an pour fonts/images, 1 mois pour CSS/JS (avec hash)
- Rate limiting sur /contact (5 req/min)
- Blocage des fichiers .env, .git, composer.*
- ServerTokens off
```

### Variables d'environnement (.env production)

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://servicepublic.gov.bf
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
```

---

## 3.9 Récapitulatif des livrables par phase

### Phase Code/Build/Test (prochaine étape)

| Sprint | Livrable | Critère de validation |
|--------|----------|----------------------|
| Sprint 0 | Projet Laravel initialisé + migrations + seeders + import JSON | `php artisan migrate:fresh --seed` sans erreur, 600 procédures en base |
| Sprint 1 | Layout Blade + Design System CSS + page d'accueil | Rendu visuel conforme au design system, responsive OK |
| Sprint 2 | Pages contenu (thématiques, fiches, e-services, événements) + recherche | Navigation complète, recherche fonctionnelle |
| Sprint 3 | Admin Filament complet | CRUD sur toutes les entités, import fonctionnel |
| Sprint 4 | Annuaire, actualités, FAQ, pages statiques | Contenu secondaire navigable |
| Sprint 5 | Sécurité + SEO + accessibilité + performance | Lighthouse > 90, 0 faille matrice sécurité |
| Sprint 6 | Déploiement + documentation + formation | Site en ligne, équipe formée |

---

*Ce document constitue la base de référence pour toute la phase de développement. Aucun code ne doit être écrit sans validation de ces spécifications.*
