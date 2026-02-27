# 🚀 Guide d'installation — Service Public BF

> **Objectif :** Avoir le projet qui tourne sur votre machine en 10 minutes, avec le panneau admin complet et toutes les données.

---

## ✅ Prérequis

| Outil | Version | Comment vérifier | Comment installer |
|---|---|---|---|
| **PHP** | 8.2+ | `php -v` | [php.net](https://php.net) ou via XAMPP |
| **MySQL** | 8.0+ | `mysql --version` | [mysql.com](https://mysql.com) ou via XAMPP |
| **Composer** | 2.x | `composer --version` | [getcomposer.org](https://getcomposer.org) |
| **Git** | toute version | `git --version` | [git-scm.com](https://git-scm.com) |

> **Extensions PHP requises** (activées par défaut avec XAMPP) :
> `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `gd`

---

## 📦 Installation — Windows avec XAMPP

### Étape 1 : Installer XAMPP

1. Télécharger XAMPP depuis [apachefriends.org](https://www.apachefriends.org/) (version avec PHP 8.2+)
2. Installer dans `C:\xampp`
3. Ouvrir le panneau XAMPP → **Démarrer Apache** et **MySQL**

> ⚠️ Si MySQL ne démarre pas : vérifier qu'aucun autre service MySQL ne tourne sur le port 3306.

### Étape 2 : Installer Composer

1. Télécharger [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe)
2. Lors de l'installation, pointer vers `C:\xampp\php\php.exe`
3. Vérifier : ouvrir un nouveau PowerShell → `composer --version`

### Étape 3 : Cloner le projet

```powershell
# Ouvrir PowerShell (ou Terminal Windows)
cd C:\Users\VOTRE_NOM\Downloads
git clone https://github.com/LEVI226/servicepublic-bf.git
cd servicepublic-bf
```

### Étape 4 : Installer les dépendances PHP

```powershell
composer install
```

> **❌ Erreur « Your requirements could not be resolved » ?**
> ```powershell
> composer install --ignore-platform-reqs
> ```

### Étape 5 : Configurer l'environnement

```powershell
copy .env.example .env
C:\xampp\php\php.exe artisan key:generate
```

Puis **ouvrir `.env`** dans un éditeur de texte et vérifier ces lignes :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=servicepublic_bf
DB_USERNAME=root
DB_PASSWORD=
```

> 💡 Avec XAMPP, le mot de passe MySQL par défaut est **vide** (laisser `DB_PASSWORD=`).

### Étape 6 : Créer la base de données

**Option A — Via phpMyAdmin** (le plus simple) :
1. Ouvrir http://localhost/phpmyadmin
2. Cliquer **« Nouvelle base de données »**
3. Nom : `servicepublic_bf`
4. Interclassement : `utf8mb4_unicode_ci`
5. Cliquer **Créer**

**Option B — Via la ligne de commande** :
```powershell
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE servicepublic_bf CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Étape 7 : Créer les tables et remplir les données

```powershell
C:\xampp\php\php.exe artisan migrate:fresh --seed
```

> **Cette commande fait TOUT automatiquement :**
> - ✅ Crée les 12 tables (procedures, categories, organismes...)
> - ✅ Importe les 1193 fiches pratiques, 182 organismes, 12 événements de vie
> - ✅ Crée le compte admin (`admin@servicepublic.gov.bf` / `password`)
> - ✅ Génère les 160+ permissions FilamentShield
> - ✅ Assigne le rôle `super_admin` à l'admin

**❌ Erreur « SQLSTATE[HY000] [2002] Connection refused » ?**
→ MySQL n'est pas démarré. Ouvrir XAMPP → Démarrer MySQL.

**❌ Erreur « SQLSTATE[HY000] [1049] Unknown database » ?**
→ La base n'existe pas. Retourner à l'étape 6.

**❌ Erreur « SQLSTATE[42S01] Table already exists » ?**
→ Utiliser `migrate:fresh` (avec `fresh`) et non `migrate` seul.

### Étape 8 : Lier le stockage

```powershell
C:\xampp\php\php.exe artisan storage:link
```

### Étape 9 : Vider les caches

```powershell
C:\xampp\php\php.exe artisan optimize:clear
```

### Étape 10 : Lancer le serveur

```powershell
C:\xampp\php\php.exe artisan serve
```

🎉 **C'est terminé !**

---

## 📦 Installation — Linux / Mac

```bash
# 1. Cloner
git clone https://github.com/LEVI226/servicepublic-bf.git
cd servicepublic-bf

# 2. Dépendances
composer install

# 3. Environnement
cp .env.example .env
php artisan key:generate

# 4. Configurer .env (éditer DB_DATABASE, DB_USERNAME, DB_PASSWORD)
nano .env

# 5. Créer la base de données
mysql -u root -p -e "CREATE DATABASE servicepublic_bf CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 6. Migrer + Seeder (crée tout : tables, données, permissions, rôles)
php artisan migrate:fresh --seed

# 7. Stockage et cache
php artisan storage:link
php artisan optimize:clear

# 8. Permissions fichiers (Linux uniquement)
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache

# 9. Lancer
php artisan serve
```

---

## 🔑 Accès après installation

| | URL | Identifiants |
|---|---|---|
| **Site public** | http://127.0.0.1:8000 | Aucun |
| **Panneau admin** | http://127.0.0.1:8000/admin | `admin@servicepublic.gov.bf` / `password` |

### Vérification rapide du panneau admin

Après connexion à `/admin`, vous devez voir dans la barre latérale :

```
✅ Tableau de bord
✅ Filament Shield → Rôles (2)
✅ Contenu éditorial → Thématiques, Sous-thématiques (58), Fiches pratiques (1193), Actualités, FAQ (6), Pages statiques
✅ Événements de vie → Comment faire si ?
✅ Administration → Annuaire (Organismes)
✅ Outils & Médias → E-Services, Documents & Formulaires, Import de données
✅ Paramètres → Utilisateurs, Régions
```

> **⚠️ Si des menus manquent :** relancer `php artisan migrate:fresh --seed` puis `php artisan optimize:clear` et **redémarrer le serveur** (`Ctrl+C` puis `php artisan serve`).

---

## 🔧 Résolution des erreurs courantes

### « 500 Internal Server Error » à l'accès du site

```powershell
# 1. Vérifier que .env existe
dir .env

# 2. Générer la clé si manquante
C:\xampp\php\php.exe artisan key:generate

# 3. Vider les caches
C:\xampp\php\php.exe artisan optimize:clear
```

### « Class not found » ou « Target class does not exist »

```powershell
# Regénérer l'autoloader Composer
composer dump-autoload
C:\xampp\php\php.exe artisan optimize:clear
```

### « SQLSTATE[HY000] [2002] Connection refused »

MySQL n'est pas démarré ou pas accessible.

```powershell
# Vérifier que MySQL tourne
# Windows : ouvrir XAMPP → MySQL doit être vert
# Linux : sudo systemctl start mysql
# Mac : brew services start mysql

# Vérifier la connexion
C:\xampp\mysql\bin\mysql.exe -u root -e "SELECT 1;"
```

### « Permission denied » sur storage/ (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache
```

### Le panneau admin ne montre pas tous les menus

C'est un problème de permissions Shield. Solution :

```powershell
# Recréer tout proprement
C:\xampp\php\php.exe artisan migrate:fresh --seed
C:\xampp\php\php.exe artisan optimize:clear

# IMPORTANT : redémarrer le serveur (Ctrl+C puis relancer)
C:\xampp\php\php.exe artisan serve
```

### « Composer detected issues in your platform »

```powershell
# Si votre PHP est légèrement différent de la version requise
composer install --ignore-platform-reqs
```

### Le CSS ne s'affiche pas / le site est sans style

```powershell
# Le CSS est pré-compilé, pas besoin de Node.js
# Vérifier que le fichier existe :
dir public\css\style.min.css

# Si manquant, c'est un problème de clone incomplet :
git checkout -- public/
```

### « php n'est pas reconnu comme commande »

Sur Windows, PHP n'est pas dans le PATH. Utiliser le chemin complet :

```powershell
# Au lieu de "php artisan serve", utiliser :
C:\xampp\php\php.exe artisan serve

# OU ajouter PHP au PATH Windows :
# Paramètres → Système → Variables d'environnement
# → Path → Ajouter : C:\xampp\php
# → Redémarrer le terminal
```

---

## 📝 Commandes utiles au quotidien

```powershell
# Lancer le serveur
php artisan serve

# Vider tous les caches (après modification de code)
php artisan optimize:clear

# Recréer la base complète (⚠️ détruit les données)
php artisan migrate:fresh --seed

# Créer une migration
php artisan make:migration create_videos_table

# Créer un modèle
php artisan make:model Video

# Créer une resource Filament (interface admin)
php artisan make:filament-resource Video --generate
```

---

## 🏗️ Structure des données créées par le seeder

| Seeder | Données créées | Quantité |
|---|---|---|
| `UserSeeder` | Comptes admin et éditeur | 2 |
| `ShieldSeeder` | Permissions + rôles Spatie | 160+ |
| `CategoriesTableSeeder` | Thématiques | 20 |
| `SubcategoriesTableSeeder` | Sous-thématiques | 58 |
| `ProceduresTableSeeder` | Fiches pratiques | 1 193 |
| `OrganismesTableSeeder` | Organismes publics | 182 |
| `LifeEventsTableSeeder` | Événements de vie | 12 |
| `EservicesTableSeeder` | E-services en ligne | 26+ |
| `FaqsTableSeeder` | Questions fréquentes | 6 |
| `ArticlesTableSeeder` | Actualités | 6 |
| `ProvincesTableSeeder` | Provinces du Burkina Faso | 47 |
| `ScrapedDataSeeder` | Données enrichies (coûts réels) | ~30 |

> **Pas besoin de dump SQL.** Tout est recréé par `migrate:fresh --seed`.

---

*Guide testé le 27 février 2026 sur Windows 11 + XAMPP 8.2 + MySQL 8.0*
