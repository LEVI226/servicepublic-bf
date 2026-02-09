# Portail des Services Publics du Burkina Faso

Une application web complète développée avec Laravel, Bootstrap et MySQL pour moderniser l'accès aux services publics au Burkina Faso.

## Fonctionnalités

### Pour les citoyens
- **Navigation intuitive** par catégories (Particuliers, Entreprises)
- **Fiches pratiques** détaillées pour chaque démarche administrative
- **E-Services** pour effectuer des demandes en ligne
- **Suivi des demandes** en temps réel
- **Annuaire numérique** des ministères et institutions
- **Documents officiels** téléchargeables (lois, décrets, arrêtés)
- **FAQ** complète

### Pour les agents
- **Tableau de bord** avec statistiques
- **Gestion des demandes** (traitement, mise à jour du statut)
- **Notifications** en temps réel

### Pour les administrateurs
- **Administration complète** via Filament
- **Gestion des utilisateurs**, structures, catégories
- **Gestion des contenus** (fiches, e-services, documents, actualités)
- **Statistiques détaillées**

## Stack technique

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Bootstrap 5, Bootstrap Icons
- **Base de données**: MySQL
- **Admin**: Filament 3
- **Authentification**: Laravel Sanctum

## Installation

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- MySQL
- Node.js (optionnel, pour les assets)

### Étapes d'installation

1. **Cloner le projet**
```bash
cd /mnt/okcomputer/output/servicepublic-bf
```

2. **Installer les dépendances**
```bash
composer install
```

3. **Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurer la base de données**
Modifiez le fichier `.env` avec vos informations de connexion MySQL :
```
DB_DATABASE=servicepublic_bf
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

5. **Créer la base de données et exécuter les migrations**
```bash
mysql -u root -p -e "CREATE DATABASE servicepublic_bf CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan migrate
```

6. **Remplir la base de données**
```bash
php artisan db:seed
```

7. **Créer le lien symbolique pour le stockage**
```bash
php artisan storage:link
```

8. **Lancer le serveur**
```bash
php artisan serve
```

## Accès par défaut

### Administrateur
- Email: `admin@servicepublic.gov.bf`
- Mot de passe: `password`

### Agent
- Email: `agent@servicepublic.gov.bf`
- Mot de passe: `password`

### Citoyens de test
- Email: `citoyen1@example.com`, `citoyen2@example.com`, `citoyen3@example.com`
- Mot de passe: `password`

## Structure du projet

```
servicepublic-bf/
├── app/
│   ├── Http/Controllers/    # Contrôleurs
│   ├── Models/              # Modèles Eloquent
│   └── Filament/            # Ressources Filament
├── database/
│   ├── migrations/          # Migrations
│   └── seeders/             # Seeders avec données BF
├── resources/
│   └── views/               # Vues Blade
│       ├── layouts/         # Layouts
│       └── pages/           # Pages
├── public/
│   ├── css/                 # Styles CSS
│   └── images/              # Images
└── routes/
    └── web.php              # Routes
```

## Design System

Le projet utilise les couleurs nationales du Burkina Faso :
- **Vert** (#009E49) : Couleur principale
- **Rouge** (#EF2B2D) : Couleur secondaire
- **Jaune** (#FCD116) : Accent

## Licence

Ce projet est développé pour le Gouvernement du Burkina Faso.

## Contact

- Email: contact@servicepublic.gov.bf
- Téléphone: (+226) 25 30 66 30
