# 🇧🇫 Service Public Burkina Faso

Portail des services publics du Burkina Faso - Une plateforme moderne pour accéder aux démarches administratives, e-services et informations gouvernementales.

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

---

## 📋 Fonctionnalités

- 🏛️ **Catalogue de démarches** - Services pour particuliers et entreprises
- 💻 **69 E-Services en ligne** - Démarches administratives disponibles 24h/24
- 📄 **Documents officiels** - Lois, décrets, arrêtés consultables
- 📞 **Annuaire** - Coordonnées des ministères et institutions
- 🔍 **Recherche globale** - Trouvez rapidement ce que vous cherchez
- 👤 **Espace personnel** - Dashboard adapté selon votre profil
- 🔐 **Multi-rôles** - Admin, Agent, Citoyen

---

## 🚀 Installation avec Laragon (Windows)

### Prérequis

- [Laragon Full](https://laragon.org/download/) (inclut PHP, MySQL, Composer, Node.js)

### Étapes d'installation

#### 1. Cloner le projet dans Laragon

```bash
cd C:\laragon\www
git clone https://github.com/VOTRE_USERNAME/servicepublic-bf.git
cd servicepublic-bf
```

#### 2. Installer les dépendances PHP

```bash
composer install
```

#### 3. Installer les dépendances Node.js

```bash
npm install
```

#### 4. Configurer l'environnement

```bash
copy .env.example .env
php artisan key:generate
```

#### 5. Créer la base de données

**Option A : Via Laragon (recommandé)**
1. Ouvrir Laragon
2. Clic droit → **MySQL** → **HeidiSQL**
3. Clic droit sur la connexion → **Créer** → **Base de données**
4. Nom : `servicepublic_bf`

**Option B : En ligne de commande**
```bash
mysql -u root -e "CREATE DATABASE servicepublic_bf"
```

#### 6. Configurer la base de données

Éditer le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=servicepublic_bf
DB_USERNAME=root
DB_PASSWORD=
```

#### 7. Migrer et peupler la base de données

```bash
php artisan migrate:fresh --seed
```

#### 8. Compiler les assets

```bash
npm run build
```

#### 9. Lancer l'application

**Option A : Avec Laragon (auto-hébergement)**
- Démarrer Laragon → **Start All**
- Accéder à : `http://servicepublic-bf.test`

**Option B : Avec artisan**
```bash
php artisan serve
```
- Accéder à : `http://localhost:8000`

---

## 🔑 Comptes de test

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| **Admin** | `admin@servicepublic.gov.bf` | `password` |
| **Agent** | `agent@servicepublic.gov.bf` | `password` |
| **Citoyen** | `citoyen1@example.com` | `password` |

---

## 📁 Structure du projet

```
servicepublic-bf/
├── app/
│   ├── Http/Controllers/      # Contrôleurs
│   ├── Models/                # Modèles Eloquent
│   └── Providers/             # Fournisseurs de services
├── database/
│   ├── migrations/            # Migrations de base de données
│   └── seeders/               # Données de test
├── resources/
│   ├── views/                 # Vues Blade
│   │   ├── layouts/           # Layouts principaux
│   │   └── pages/             # Pages de l'application
│   └── css/                   # Styles CSS
├── routes/
│   └── web.php                # Routes de l'application
└── public/                    # Fichiers publics
```

---

## 🎨 Design System "Sovereign OS"

Le projet utilise un système de design personnalisé aux couleurs nationales :

```css
--bf-rouge: #EF2B2D;    /* Rouge Burkina */
--bf-vert: #009E49;     /* Vert Burkina */
--bf-jaune: #FCD116;    /* Jaune Burkina */
```

---

## 🛠️ Commandes utiles

```bash
# Réinitialiser la base de données
php artisan migrate:fresh --seed

# Vider tous les caches
php artisan optimize:clear

# Importer des données CSV supplémentaires
php artisan db:seed --class=CsvDataImportSeeder

# Supprimer les doublons e-services
php artisan db:seed --class=DeduplicateEservicesSeeder

# Lancer le serveur de développement
php artisan serve

# Compiler les assets en mode watch
npm run dev
```

---

## 📦 Export du projet

Un script PowerShell est inclus pour exporter le projet :

```powershell
.\export_project.ps1
```

Cela crée un fichier ZIP contenant :
- Le code source (sans `vendor` et `node_modules`)
- Un dump SQL de la base de données

---

## 📚 Documentation

Pour une documentation technique complète, voir :
- [`DOCUMENTATION.md`](DOCUMENTATION.md) - Architecture et détails techniques
- [`EXPORT_GUIDE.md`](EXPORT_GUIDE.md) - Guide d'export/import

---

## 🤝 Contribution

1. Fork le projet
2. Créer une branche (`git checkout -b feature/nouvelle-fonctionnalite`)
3. Commit (`git commit -m 'Ajout nouvelle fonctionnalité'`)
4. Push (`git push origin feature/nouvelle-fonctionnalite`)
5. Ouvrir une Pull Request

---

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

---

## 👥 Équipe

Développé pour le **Service Public de l'Administration du Burkina Faso**.

---

<p align="center">
  <strong>🇧🇫 Unité - Progrès - Justice 🇧🇫</strong>
</p>
