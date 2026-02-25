# 🍎 Installation du Service Public BF sur macOS avec MAMP

Ce guide détaille les étapes pour installer et lancer le projet **Service Public Burkina Faso** sur un Mac utilisant **MAMP** (ou MAMP PRO).

## 1. Prérequis

Assurez-vous d'avoir installé les outils suivants :

*   **[MAMP](https://www.mamp.info/)** : Pour le serveur Apache/Nginx et MySQL.
*   **[Composer](https://getcomposer.org/)** : Gestionnaire de dépendances PHP.
*   **[Node.js](https://nodejs.org/) & NPM** : Pour compiler les assets (CSS/JS).
*   **Git** : Pour cloner le projet.

## 2. Configuration MAMP

1.  Ouvrez MAMP.
2.  Allez dans **Preferences (Mac) > PHP** et sélectionnez la version **8.2.x** ou supérieure.
3.  Dans l'onglet **Ports**, vérifiez les ports :
    *   Apache/Nginx : `8888` (par défaut) ou `80`.
    *   MySQL : `8889` (par défaut MAMP) ou `3306`.
4.  Lancez les serveurs (Start Servers).

## 3. Installation du Projet

Ouvrez votre terminal et naviguez vers votre dossier de projets (ex: `htdocs` ou `Sites`).

```bash
# Cloner le dépôt
git clone <votre-repo-url> servicepublic-bf
cd servicepublic-bf

# Installer les dépendances PHP
composer install

# Installer les dépendances JS/CSS
npm install
npm run build
```

## 4. Configuration de l'Environnement (.env)

Copiez le fichier d'exemple :

```bash
cp .env.example .env
php artisan key:generate
```

Ouvrez le fichier `.env` et modifiez la section base de données.
**Attention :** MAMP utilise souvent le port `8889` et un socket spécifique.

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889          # Port MAMP par défaut (vérifiez vos préférences MAMP)
DB_DATABASE=servicepublic_bf
DB_USERNAME=root
DB_PASSWORD=root      # Mot de passe par défaut de MAMP
# DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock # Décommentez si erreur de connexion
```

## 5. Base de Données

1.  Ouvrez **phpMyAdmin** via MAMP (bouton "Open WebStart page" > Tools > phpMyAdmin).
2.  Créez une nouvelle base de données nommée `servicepublic_bf` (utf8mb4_unicode_ci).

Ensuite, revenez dans votre terminal pour créer les tables et insérer les données :

```bash
php artisan migrate:fresh --seed
```

> **Note :** Si vous avez une erreur "Connection refused", vérifiez le port (`8889`) ou activez la ligne `DB_SOCKET` dans le `.env`.

## 6. Lancement de l'Application

Vous avez deux options :

### Option A : Via `php artisan serve` (Recommandé pour le dev)
```bash
php artisan serve
```
Accédez à : `http://127.0.0.1:8000`

### Option B : Via MAMP Host
1.  Configurez le dossier racine (Document Root) de MAMP vers `.../servicepublic-bf/public`.
2.  Accédez à `http://localhost:8888`.

## 7. Permissions (Important sur Mac)

Si vous avez des erreurs d'écriture (logs, cache, upload d'images), fixez les permissions des dossiers `storage` et `bootstrap/cache` :

```bash
chmod -R 775 storage bootstrap/cache
```

## 8. Accès Admin

Une fois l'installation terminée :
*   **URL Admin** : `/admin`
*   **Email** : `admin@servicepublic.gov.bf`
*   **Mot de passe** : `password`

---
*Besoin d'aide ? Vérifiez les logs dans `storage/logs/laravel.log`.*
