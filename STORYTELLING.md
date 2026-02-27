# 🇧🇫 Service Public BF — Le storytelling complet

> Ce document explique la vision, les choix, et la pertinence de la plateforme. Il sert aussi de guide pour une **présentation/démo** et anticipe les questions des utilisateurs.

---

## 📖 L'histoire — Pourquoi ce portail ?

### Le problème

Au Burkina Faso, un citoyen qui veut accomplir une démarche administrative (passeport, création d'entreprise, casier judiciaire…) fait face à un **parcours du combattant** :

- **Aucune source unique** → Les informations sont dispersées entre des dizaines de sites ministériels, souvent obsolètes ou hors ligne
- **Pas de clarté sur les coûts** → « Combien ça coûte ? » est la question n°1 — et la réponse est rarement écrite noir sur blanc
- **Délais flous** → « Revenez dans 2 semaines » peut vouloir dire 2 jours ou 2 mois
- **Documents requis inconnus** → Le citoyen se déplace, fait la queue, et découvre qu'il manque un papier

### La solution

**Service Public BF** est un **portail unique** qui centralise **1 193 démarches administratives** avec, pour chacune : le coût, le délai, les documents requis, et l'organisme responsable.

C'est le « Google des démarches » pour le Burkinabè.

---

## 🌍 Comparaison avec les portails existants

### Les modèles de référence

| Pays | Portail | Forces | Faiblesses | Notre inspiration |
|---|---|---|---|---|
| 🇫🇷 **France** | [service-public.fr](https://service-public.fr) | 10 000+ fiches, démarches en ligne, téléservices | Trop dense, bureaucratique, parfois complexe | ✅ Structure par thématiques + événements de vie |
| 🇸🇳 **Sénégal** | [servicepublic.gouv.sn](https://www.servicepublic.gouv.sn) | Portail clair, navigation par thématique | Peu de fiches (~200), pas d'e-services intégrés | ✅ Volume de données + e-services |
| 🇨🇮 **Côte d'Ivoire** | [servicepublic.gouv.ci](https://www.servicepublic.gouv.ci) | Bon design, démarches bien structurées | Navigation peu intuitive | ✅ Double navigation (thématique + situation) |
| 🇧🇫 **BF officiel** | [servicepublic.gov.bf](https://www.servicepublic.gov.bf) | Données réelles | Design daté, UX difficile, pas responsive | ✅ Toutes les données + design moderne |

### Ce que Service Public BF fait mieux

| Point | Site officiel actuel | Notre portail |
|---|---|---|
| **Design** | Années 2010, non responsive | Modern, responsive, Bootstrap 5 |
| **Navigation** | Menu classique | Double entrée : thématiques + événements de vie |
| **Recherche** | Basique ou absente | Recherche full-text sur 1 193 fiches |
| **Informations** | Texte brut, parfois incomplet | Coût · Délai · Documents en tête de chaque fiche |
| **Admin** | Accès technique | Panneau admin Filament avec CRUD complet |
| **E-services** | Pas centralisés | 26+ services dématérialisés répertoriés |
| **Annuaire** | Partiel | 182 organismes avec coordonnées |

---

## 🇧🇫 Pourquoi cette approche sied au Burkina Faso

### 1. Un pays en numérisation active

Le Burkina Faso a lancé sa stratégie de transformation numérique. Des services comme l'e-CNIB, la déclaration d'entreprise en ligne (CEFORE), et le paiement des impôts via e-SITAX montrent la volonté de dématérialiser. **Mais il manquait un portail qui les centralise.**

### 2. Un public francophone avec des besoins clairs

Les utilisateurs sont des citoyens burkinabè, souvent sur mobile, qui veulent une réponse simple : 
- **Combien ?** 💰
- **Quel délai ?** ⏱️
- **Quels documents ?** 📋

Notre portail met ces 3 informations **en tête de chaque fiche**, avant tout texte descriptif.

### 3. Le français administratif simplifié

Les sites ministériels utilisent un jargon juridique. Nous utilisons :
- « **Fiche pratique** » au lieu de « Procédure administrative » → moins intimidant
- « **Thématique** » au lieu de « Catégorie » → plus institutionnel, plus clair
- « **Comment faire si ?** » → formulation humaine, empathique
- Le « **Je** » : « Je crée mon entreprise » → le citoyen se reconnaît

### 4. L'approche événements de vie

Dans un pays où beaucoup de citoyens n'ont pas l'habitude de chercher par « nom de démarche », l'approche **situation de vie** est plus intuitive :

> *« Je ne sais pas que ça s'appelle un « extrait d'acte de naissance », mais je sais que je suis en train de préparer mon mariage. »*

Les 12 événements de vie couvrent les moments clés : naissance, mariage, entreprise, passeport, retraite, décès, scolarisation…

---

## 🎨 Les choix de design expliqués

### La bande tricolore rouge-blanc-vert

Signal visuel universel dans l'espace francophone africain → « Ceci est un site officiel du gouvernement ». Les citoyens la reconnaissent immédiatement — comme le `.gouv` dans l'URL.

### Les armoiries nationales comme logo

Pas de logo graphique moderne ou abstrait. Les armoiries projettent une **autorité institutionnelle immédiate**. Le citoyen fait confiance au contenu car il reconnaît le symbole de l'État.

### Le fond blanc et le vert dominant

Le vert (couleur nationale) est utilisé comme couleur primaire. Le fond blanc garantit la **lisibilité sur tous les écrans**, y compris les smartphones bas de gamme courants au Burkina.

### La barre supérieure sombre

Numéro de téléphone + email du service → **réassurance immédiate**. Le citoyen sait qu'il peut appeler s'il ne trouve pas l'information en ligne.

---

## 🏗️ Les choix techniques expliqués

### Pourquoi Laravel + Filament ?

| Technologie | Raison |
|---|---|
| **Laravel** | Framework PHP le plus populaire en Afrique francophone, grande communauté, documentation en français |
| **Filament** | Panneau admin complet en quelques clics, pas besoin de coder l'interface CRUD |
| **Bootstrap** | CSS responsive sans configuration, fonctionne sur tous les navigateurs |
| **MySQL** | Base de données la plus déployée chez les hébergeurs africains |

### Pourquoi pas React/Vue/Next.js ?

Un site gouvernemental doit être :
- **Simple à maintenir** par des développeurs juniors
- **Rapide à charger** même avec une connexion lente (Bootstrap CSS = pas de build JS)
- **Facile à héberger** sur n'importe quel serveur LAMP classique

### Pourquoi les seeders plutôt qu'un dump SQL ?

Les seeders sont **versionnés dans Git** → un nouveau développeur fait `git clone` + `migrate:fresh --seed` et tout fonctionne. Un dump SQL de 50 Mo serait difficile à maintenir et à versionner.

---

## 📋 Glossaire — Explication de chaque section admin

### Le panneau admin — Qu'est-ce que c'est ?

C'est l'espace où les administrateurs gèrent le contenu du site **sans toucher au code**. Accessible à `/admin`.

| Menu admin | Correspond à | Explication simple |
|---|---|---|
| **Thématiques** | Les grandes familles | Les 20 grands domaines : Commerce, Justice, Santé, Travail… Sur le site public → menu « Thématiques » |
| **Sous-thématiques** | Subdivisions | Chaque thématique a des sous-sections. Ex : « Commerce » → « Import/Export », « Création d'entreprise » |
| **Fiches pratiques** | Le contenu principal | Les 1 193 démarches. Chaque fiche = 1 démarche administrative (passeport, acte de naissance…) |
| **Actualités** | Blog institutionnel | Articles d'information publiés sur le site |
| **FAQ** | Questions fréquentes | Questions/réponses à afficher sur la page FAQ |
| **Pages statiques** | Pages libres | Mentions légales, accessibilité, À propos… Pages HTML libres |
| **Comment faire si ?** | Événements de vie | Les 12 parcours situationnels (« Je me marie », « Je crée une entreprise »…) avec les fiches rattachées |
| **Annuaire (Organismes)** | Annuaire des services | Les 182 organismes publics avec adresse, téléphone, email |
| **E-Services** | Services en ligne | Liens vers les 26 plateformes dématérialisées (e-CNIB, e-SITAX…) |
| **Documents & Formulaires** | Fichiers PDF | Formulaires téléchargeables rattachés à une fiche pratique (ex: formulaire de demande de passeport) |
| **Import de données** | Outil technique | Import CSV/JSON en masse pour ajouter beaucoup de fiches d'un coup |
| **Rôles** | Permissions | Gestion des droits : qui peut voir/modifier/supprimer quoi |
| **Utilisateurs** | Comptes admin | Gestion des comptes administrateurs et éditeurs |
| **Régions** | Découpage géographique | Les 13 régions du Burkina Faso |

### C'est quoi « Documents & Formulaires » exactement ?

C'est un espace pour **uploader des fichiers PDF** (formulaires officiels pré-remplis, guides papier) et les **rattacher à une fiche pratique**.

**Exemple :**
- La fiche « Demande de passeport ordinaire » peut avoir un document attaché : `Formulaire_Passeport.pdf`
- Ce PDF apparaîtra en bas de la fiche sur le site public, avec un bouton **Télécharger**

---

## 🎤 Questions de démo — FAQ pour la présentation

### Questions sur le contenu

**Q : D'où viennent les 1 193 fiches pratiques ?**
> Elles ont été extraites du site officiel servicepublic.gov.bf et enrichies avec des informations de coût, délai et documents requis provenant des sites ministériels.

**Q : Les données sont-elles à jour ?**
> Les données actuelles sont un instantané de février 2026. Le panneau admin permet de les mettre à jour en temps réel. Pour une mise à jour massive, on peut utiliser un script de scraping ou l'outil d'import CSV intégré.

**Q : Pourquoi certaines fiches n'ont pas de coût ou de délai ?**
> Ces informations ne sont pas toujours publiées par les administrations. L'objectif est de les compléter progressivement, soit par saisie manuelle (admin), soit par partenariat avec les ministères.

**Q : Quelle est la différence entre « Thématiques » et « Événements de vie » ?**
> Les **thématiques** classent les fiches par domaine administratif (Commerce, Justice…). Les **événements de vie** les classent par situation humaine (« Je me marie », « Je crée une entreprise »). Une même fiche peut apparaître dans les deux. C'est deux portes d'entrée vers le même contenu.

### Questions techniques

**Q : Le site est-il hébergé ?**
> La version actuelle tourne en local. Le déploiement se fait sur n'importe quel serveur LAMP (Linux, Apache, MySQL, PHP) — des hébergeurs locaux comme Faso Net ou OVH Afrique suffisent.

**Q : Est-ce sécurisé ?**
> Oui : Laravel gère automatiquement la protection CSRF, le hashing des mots de passe, et l'échappement des entrées. Le panneau admin est protégé par authentification + permissions granulaires (FilamentShield).

**Q : Un développeur peut-il maintenir le code ?**
> Oui. Le code suit l'architecture standard Laravel (MVC). On a un guide développeur complet (`GUIDE_DEVELOPPEUR.md`) et un guide d'installation (`INSTALL.md`). Tout développeur Laravel peut rapidement comprendre et modifier le projet.

**Q : Comment ajouter un nouveau type de contenu ?**
> 3 commandes : `make:migration`, `make:model`, `make:filament-resource`. Puis ajouter le modèle dans `ShieldSeeder.php` pour les permissions. C'est 15 minutes de travail.

### Questions sur l'utilité

**Q : Pourquoi ne pas simplement améliorer le site officiel existant ?**
> Le site officiel a des contraintes techniques lourdes (CMS ancien, hébergement gouvernemental). Cette plateforme est une **preuve de concept** qui montre ce qui est possible avec des technologies modernes. Elle peut servir de base pour un futur portail officiel ou compléter l'existant.

**Q : Qui va alimenter le contenu ?**
> Les 1 193 fiches sont déjà prêtes. Ensuite, un ou deux éditeurs suffisent pour maintenir le contenu à jour via le panneau admin. Pas besoin de compétences techniques.

**Q : Et sur mobile ?**
> Le site est **responsive** (Bootstrap 5). Il s'adapte automatiquement aux smartphones, tablettes et ordinateurs. Aucune application mobile n'est nécessaire.

**Q : Peut-on l'utiliser sans Internet ?**
> Non, c'est une application web. Mais le site est optimisé pour les connexions lentes (CSS léger, pas de JavaScript lourd, pas de framework frontend).

### Questions sur les choix de noms

**Q : Pourquoi « Fiche pratique » et pas « Procédure » ?**
> « Procédure » est un terme administratif froid. « Fiche pratique » est plus accessible — le citoyen comprend immédiatement qu'il va trouver des informations pratiques et actionnables.

**Q : Pourquoi « Thématique » dans le menu public et « Catégorie » dans le code ?**
> Dans le code (base de données, modèles), on utilise le terme technique `Category`. Sur le site et dans l'admin, on affiche « Thématique » car c'est plus institutionnel et compréhensible pour un gestionnaire de contenu francophone.

**Q : C'est quoi la différence entre « Sous-catégorie » et « Thématique » ?**
> Une **thématique** = un grand domaine (ex : « Commerce & Investissement »). Une **sous-thématique** = une subdivision (ex : « Import/Export », « Création d'entreprise »). C'est un système parent → enfant.

---

## 📊 Arguments clés pour la présentation

### Le volume
> 1 193 fiches pratiques, 182 organismes, 12 parcours de vie, 26 e-services → c'est le portail le plus complet d'Afrique de l'Ouest francophone.

### L'accessibilité
> Double navigation (thématique + situation), recherche full-text, design responsive, français simplifié → tout citoyen peut trouver sa démarche en 3 clics.

### L'autonomie
> Le panneau admin permet à un non-développeur de gérer 100% du contenu : ajouter des fiches, modifier des coûts, publier des actualités, uploader des formulaires.

### La maintenabilité
> Code standard Laravel, documentation complète (4 guides), installation en 10 minutes → n'importe quel développeur PHP peut reprendre le projet.

### Le coût
> Technologies 100% open-source (Laravel, Filament, Bootstrap, MySQL). Hébergement : un serveur à 10 000 FCFA/mois suffit.

---

*Document préparé pour la démonstration — Service Public BF v2 — Février 2026*
