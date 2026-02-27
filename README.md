# 🇧🇫 Service Public BF

> Portail officiel des démarches administratives du Burkina Faso.  
> Stack : **Laravel 11 · Filament 3 · Bootstrap 5 · MySQL**

## Démarrage rapide

```bash
git clone https://github.com/LEVI226/servicepublic-bf.git
cd servicepublic-bf
composer install
cp .env.example .env
php artisan key:generate
# → Configurer DB dans .env
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

- **Site public** → http://127.0.0.1:8000  
- **Admin** → http://127.0.0.1:8000/admin  
  - Email : `admin@servicepublic.gov.bf` / Mot de passe : `password`

## Documentation

| Guide | Pour qui | Contenu |
|---|---|---|
| 👉 **[GUIDE_DEVELOPPEUR.md](GUIDE_DEVELOPPEUR.md)** | Développeur Laravel | Architecture, Filament, modifications sûres |
| 📘 **[GUIDE_UTILISATEUR.md](GUIDE_UTILISATEUR.md)** | Administrateur / Chef de projet | UX, copywriting, workflows, mise à jour des données |

## Chiffres clés

| Contenu | Quantité |
|---|---|
| Fiches pratiques | 1 193 |
| Thématiques | 20 |
| Provinces | 45 |
| Organismes | 182 |
| Événements de vie | 12 |
| Articles | 6 |
