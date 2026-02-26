# 🇧🇫 Présentation — Portail Service Public Burkina Faso

> **Portail officiel des démarches administratives du Burkina Faso**
> Version 2.0 — Février 2026

---

## 🎯 Vue d'ensemble

**Service Public BF** est un portail numérique gouvernemental qui centralise toutes les démarches administratives du Burkina Faso en un seul endroit. Il s'adresse à deux profils :

- **Le citoyen** — qui cherche comment accomplir une démarche (passeport, casier judiciaire, création d'entreprise...)
- **L'administrateur** — qui gère, publie et met à jour le contenu via un panneau d'administration dédié

---

## 📊 Ce qui a été réalisé

### Contenu de la plateforme

| Élément | Volume | Source |
|---|---|---|
| **Fiches pratiques** | 1 193 | Importées depuis le site officiel |
| **Thématiques** | 16 | Organisées par domaine administratif |
| **Sous-catégories** | 58 | Subdivisions des thématiques |
| **Organismes** | 182 | Annuaire des services de l'État |
| **Événements de vie** | 12 | Parcours guidés situationnels |
| **E-Services** | 26+ | Services dématérialisés officiels |
| **Régions couvertes** | 13 | Tout le territoire burkinabè |

### Site public — Fonctionnalités

| Fonctionnalité | Description |
|---|---|
| 🔍 **Moteur de recherche** | Recherche full-text sur toutes les fiches pratiques |
| 🗂️ **Navigation par thématique** | 16 domaines administratifs (Commerce, Justice, Santé...) |
| 🧭 **Événements de vie** | 12 parcours guidés (Je me marie, Je crée une entreprise...) |
| 📋 **Fiches pratiques** | Coût, délai, documents requis, conditions pour chaque démarche |
| 🏢 **Annuaire** | Coordonnées de 182 organismes publics |
| 💻 **E-Services** | Liens vers les 26 plateformes de services en ligne |
| 🏭 **Espace Entreprises** | Section dédiée aux démarches entreprises |
| 📰 **Actualités** | Blog institutionnel |
| ❓ **FAQ** | Questions fréquentes |
| 📄 **Pages statiques** | Mentions légales, accessibilité... |

### Panneau d'administration

| Module | Description |
|---|---|
| 📊 **Tableau de bord** | Statistiques en temps réel + graphique |
| 📝 **Fiches pratiques** | Création/édition avec éditeur rich text |
| 🗂️ **Catégories** | Gestion des thématiques et sous-catégories |
| 🏢 **Annuaire** | Gestion des organismes |
| 🧭 **Événements de vie** | Avec liaison multi-procédures |
| 📰 **Actualités** | Blog avec planification de publication |
| ❓ **FAQ** | Avec tri par drag & drop |
| 📄 **Pages statiques** | Édition HTML libre |
| 💻 **E-Services** | Gestion des liens vers services en ligne |
| 📎 **Documents** | Upload de formulaires PDF |
| 📤 **Import de données** | CSV / JSON pour les gros volumes |
| 👥 **Utilisateurs & Rôles** | Gestion des accès avec permissions fines |

---

## 🏗️ Architecture technique

### Stack technologique

| Couche | Technologie | Version | Rôle |
|---|---|---|---|
| **Backend** | Laravel | 11.x | Framework PHP principal |
| **Admin** | Filament | 3.x | Panneau d'administration |
| **Frontend** | Bootstrap | 5.3 | Framework CSS responsive |
| **Base de données** | MySQL | 8.0+ | Stockage des données |
| **Permissions** | FilamentShield | 3.x | Gestion des rôles |
| **Serveur test** | Artisan serve / XAMPP | — | Serveur de développement |

### Architecture logicielle

```
MVC Laravel
│
├── Models/           → Eloquent ORM (Procedure, Category, Organisme...)
├── Controllers/      → Logique de rendu des pages publiques
├── Filament Resources/ → Interface admin (CRUD automatisé)
├── Views/            → Templates Blade (Bootstrap 5)
└── Database/
    ├── Migrations/   → Schéma de la BDD (versionné)
    └── Seeders/      → Données initiales (1193 procédures, 182 organismes...)
```

### Relations de données

```
Category (thématique)
  └── Subcategory (sous-catégorie)
        └── Procedure (fiche pratique)
              ├── Document (fichier PDF)
              └── LifeEvent (événement de vie) [many-to-many]

Organisme, Article, Faq, Page, EService (entités indépendantes)
```

---

## 🎨 Choix UX/UI

### Design institutionnel

La plateforme adopte les **codes visuels des portails gouvernementaux francophones** :

| Élément | Choix | Justification |
|---|---|---|
| **Bande tricolore** | Rouge-blanc-vert | Signal universel "site officiel gouvernemental" |
| **Barre officielle** | Fond sombre, devise, téléphone | Signature d'autorité de l'État |
| **Logo** | Armoiries nationales | Légitimité institutionnelle immédiate |
| **Couleurs** | Vert/blanc (couleurs nationales) | Cohérence identitaire |
| **Typographie** | Clean, lisible | Accessibilité à tous les niveaux d'éducation |

### Navigation centrée sur l'utilisateur

```
Accueil → Thématiques → Événements de vie → E-services → Annuaire → Espace Entreprises → Actualités
```

Deux portes d'entrée complémentaires pour les mêmes contenus :
- **Par domaine** → "Je cherche dans le Commerce"
- **Par situation** → "Je vais me marier"

### Information prioritaire sur les fiches

En tête de chaque fiche pratique, avant tout texte :
```
💰 COÛT          ⏱️ DÉLAI          👤 PUBLIC VISÉ
  300 FCFA         Le jour même       Tout citoyen burkinabè
```

Les 3 questions que tout citoyen se pose en premier → réponse immédiate.

---

## 📁 Structure des fichiers

```
servicepublic-bf/
├── 📂 app/
│   ├── Filament/Resources/    ← 10 modules d'administration
│   ├── Http/Controllers/      ← 8 contrôleurs site public
│   ├── Models/                ← 10 modèles Eloquent
│   └── Providers/             ← Services (ViewComposer pour navbar)
│
├── 📂 database/
│   ├── migrations/            ← 12 migrations (schéma versionné)
│   └── seeders/               ← 9 seeders (1193 procédures, 182 org...)
│
├── 📂 resources/views/
│   ├── layouts/app.blade.php  ← Layout maître (navbar, header, footer)
│   ├── pages/                 ← 10 sections de pages publiques
│   └── components/            ← Composants Blade réutilisables
│
├── 📂 routes/
│   └── web.php                ← 20+ routes publiques
│
├── 📂 public/
│   ├── css/style.min.css      ← CSS compilé Bootstrap + custom
│   └── img/                   ← Armoiries, drapeau, logos
│
├── 📄 GUIDE_DEVELOPPEUR.md    ← Guide technique complet
├── 📄 GUIDE_UTILISATEUR.md    ← Guide UX et workflows
└── 📄 PRESENTATION.md         ← Ce document
```

---

## 🔐 Accès et sécurité

### Comptes

| Rôle | Email | Mot de passe | Droits |
|---|---|---|---|
| **Super Admin** | admin@servicepublic.gov.bf | password | Accès complet |

> ⚠️ Changer le mot de passe en production via : Admin → Utilisateurs → Modifier

### Système de permissions (FilamentShield)

Chaque resource admin a des permissions individuelles configurables :
- **Voir** la liste
- **Créer** un enregistrement
- **Modifier** un enregistrement
- **Supprimer** un enregistrement

Les rôles (super_admin, admin, éditeur...) regroupent ces permissions.

---

## 🚀 Installation en 5 minutes

```bash
# Cloner
git clone https://github.com/LEVI226/servicepublic-bf.git
cd servicepublic-bf

# Installer
composer install
cp .env.example .env
php artisan key:generate

# Base de données (configurer .env d'abord)
php artisan migrate:fresh --seed
php artisan storage:link

# Lancer
php artisan serve
```

**Accès :**
- 🌐 Site : http://127.0.0.1:8000
- 🔧 Admin : http://127.0.0.1:8000/admin

---

## 📈 Ce qui peut être amélioré (prochaines étapes)

| Fonctionnalité | Priorité | Description |
|---|---|---|
| **Enrichissement des fiches** | 🔴 Haute | Compléter les 1193 fiches avec coût/délai/documents réels |
| **Scraping automatique** | 🟡 Moyenne | Script de synchronisation mensuelle avec le site officiel |
| **Carte des organismes** | 🟡 Moyenne | Afficher les organismes sur Google Maps |
| **Multilingue** | 🟢 Basse | Français + langues locales (mooré, dioula) |
| **Application mobile** | 🟢 Basse | PWA ou app native Android |
| **Notifications** | 🟢 Basse | Alertes email/SMS pour nouvelles démarches |
| **Authentification citoyens** | 🟢 Basse | Suivi de ses démarches personnelles |

---

## 🧑‍💻 Contexte du projet

Ce portail a été conçu et développé par **Ulric Levi**, architecte réseau, en utilisant une approche de **prompt engineering** avec Antigravity (Google DeepMind). L'ensemble du développement — de l'idée aux seeders de données — a été réalisé par itération via des prompts detaillés, sans écrire directement le code.

Le code produit suit les bonnes pratiques Laravel :
- Architecture MVC propre
- Modèles Eloquent avec relations et scopes
- Migrations versionnées
- SoftDelete pour préserver les données
- Cache optimisé pour la production

---

*Projet : Service Public BF — Portail des démarches administratives*
*Stack : Laravel 11 · Filament 3 · Bootstrap 5 · MySQL 8*
*Repo : https://github.com/LEVI226/servicepublic-bf*
*Février 2026*
