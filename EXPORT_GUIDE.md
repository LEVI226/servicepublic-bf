# Guide d'Exportation et de Déploiement du Projet "Service Public BF"

Ce guide vous explique comment exporter le projet pour le sauvegarder ou le transférer, et comment le réinstaller ailleurs.

## 1. Exporter le projet (Automatique)

Un script a été créé pour automatiser la tâche.

1.  Ouvrez votre terminal dans le dossier du projet.
2.  Lancez la commande suivante :
    ```powershell
    .\export_project.ps1
    ```
3.  Un fichier **ZIP** sera créé (ex: `servicepublic-bf_20240206_123000.zip`).

Ce fichier contient :
*   Le code source complet (sans les dossiers lourds `vendor` et `node_modules`).
*   Un fichier `database_dump.sql` à la racine, contenant toutes vos données.

---

## 2. Exporter manuellement (Alternative)

Si vous ne pouvez pas utiliser le script :

### Base de données
Utilisez **Laragon** ou **phpMyAdmin** :
1.  Ouvrez Laragon > Base de données (HeidiSQL/phpMyAdmin).
2.  Sélectionnez `servicepublic_bf`.
3.  Faites un clic droit > Exporter la base de données en SQL.
4.  Sauvegardez le fichier sous `database_dump.sql` dans le dossier du projet.

### Fichiers
1.  Sélectionnez tous les fichiers du projet.
2.  **Désélectionnez** les dossiers `vendor` et `node_modules` (ils sont trop lourds et seront réinstallés plus tard).
3.  Faites un clic droit > Envoyer vers > Dossier compressé.

---

## 3. Réinstaller le projet ailleurs (Import)

Pour remettre le projet en ligne sur un autre ordinateur ou serveur :

1.  **Prérequis** : Avoir PHP 8.2+, Composer et MySQL installés.
2.  **Fichiers** : Dézippez l'archive.
3.  **Dépendances** : Ouvrez un terminal dans le dossier et lancez :
    ```bash
    composer install
    npm install
    npm run build
    ```
4.  **Environnement** :
    *   Dupliquez le fichier `.env.example` et renommez-le en `.env`.
    *   Lancez `php artisan key:generate`.
    *   Configurez votre base de données dans `.env` (`DB_DATABASE`, `DB_USERNAME`, etc.).
5.  **Base de données** :
    *   Créez une base de données vide (ex: `servicepublic_bf`).
    *   Importez le fichier `database_dump.sql` inclus dans l'archive.
6.  **Lancement** :
    ```bash
    php artisan serve
    ```

Le projet est maintenant prêt !
