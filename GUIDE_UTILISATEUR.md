# 📘 Guide Utilisateur & Administrateur — Service Public BF

> Document expliquant **pourquoi** la plateforme a été conçue ainsi :
> choix de nommage, UX/UI, copywriting, workflows, et administration du contenu.

---

## Table des matières

1. [Philosophie de la plateforme](#1-philosophie-de-la-plateforme)
2. [Glossaire raisonné — Pourquoi ces termes ?](#2-glossaire-raisonné--pourquoi-ces-termes-)
3. [La distinction Catégories / Procédures / Événements de vie](#3-la-distinction-catégories--procédures--événements-de-vie)
4. [La navbar — logique de navigation](#4-la-navbar--logique-de-navigation)
5. [Choix UX/UI et design](#5-choix-uxui-et-design)
6. [Choix de copywriting](#6-choix-de-copywriting)
7. [Workflows des utilisateurs](#7-workflows-des-utilisateurs)
8. [Workflows de l'administrateur](#8-workflows-de-ladministrateur)
9. [Comment scraper et mettre à jour les données](#9-comment-scraper-et-mettre-à-jour-les-données)
10. [Résumé des décisions clés](#10-résumé-des-décisions-clés)

---

## 1. Philosophie de la plateforme

### Le problème de départ

Les portails administratifs africains souffrent historiquement de deux défauts majeurs :

1. **Organisés pour l'administration, pas pour le citoyen** — les menus suivent l'organigramme des ministères, pas la logique de la personne qui cherche une information.
2. **Vocabulaire technique et intimidant** — termes juridiques, numéros de procédures, sigles sans explication.

### La règle de conception

> Un citoyen ne connaît pas les termes administratifs. Il sait en revanche **où il en est dans sa vie**.

Toute la plateforme est donc organisée autour de **deux portes d'entrée complémentaires** :

| Porte | Pour quel profil | Exemple |
|---|---|---|
| **Thématiques** | Citoyen qui sait dans quel domaine chercher | "Je cherche quelque chose lié au Commerce" |
| **Événements de vie** | Citoyen qui part de sa situation personnelle | "Je vais me marier, que dois-je faire ?" |

Ces deux chemins mènent aux **mêmes fiches pratiques** — seul le parcours diffère, selon le modèle mental de l'utilisateur.

### Les 3 principes de conception

| Principe | Application concrète |
|---|---|
| **Citoyen d'abord** | Le menu suit la vie du citoyen, pas l'organigramme de l'État |
| **Clarté avant tout** | Les 3 infos clés (Coût, Délai, Public visé) en tête de chaque fiche |
| **Légitimité officielle** | Armoiries, drapeau, devise — signaux d'autorité institutionnelle |

---

## 2. Glossaire raisonné — Pourquoi ces termes ?

### « Fiche pratique » — et non « Procédure »

**Problème du terme « procédure » :**
- 🚫 Technique → intimidant pour le citoyen ordinaire
- 🚫 Ambigu → ne dit pas ce qu'on va trouver concrètement

**Pourquoi « fiche pratique » :**
- ✅ **Fiche** = courte, lisible, structurée (format connu de tous)
- ✅ **Pratique** = utile, actionnable, orienté résultat

> **En coulisses :** dans la base de données, le modèle technique s'appelle `Procedure` (terme métier standard). Sur le site **public**, on dit toujours « Fiche pratique ». Les deux coexistent sans contradiction.

---

### « Thématique » — et non « Catégorie »

**Problème du terme « catégorie » :**
- 🚫 Trop générique — n'importe quelle boutique en ligne a des « catégories »
- 🚫 Ne communique rien sur le contenu

**Pourquoi « thématique » :**
- ✅ Évoque un **domaine de la vie publique** (Commerce, Justice, Santé…)
- ✅ Vocabulaire utilisé par service-public.fr et par les portails gouvernementaux de toute la région (Sénégal, Côte d'Ivoire, Maroc)

> **En coulisses :** le modèle en base s'appelle `Category`. Sur le site public, on dit « Thématique ».

---

### « Événement de vie » — et non « Situation » ou « Parcours »

Ce terme vient de la **norme SGMAP** (Standard général du management public, France 2010), reprise par l'ensemble des portails gouvernementaux modernes depuis. Il désigne une étape notable dans la vie d'une personne qui génère plusieurs démarches administratives en cascade.

**Exemples :** naissance, mariage, décès, création d'entreprise, départ à la retraite.

La formulation à la **1ère personne** (« Je me marie », « Je crée mon entreprise ») crée une identification immédiate et une empathie avec la situation du citoyen.

---

### « Annuaire » — et non « Répertoire » ou « Organismes »

- « Annuaire » est le terme institutionnel universel (annuaire téléphonique → annuaire des services de l'État)
- Plus court, plus intuitif, connu de tous sans explication
- Utilisé par tous les portails gouvernementaux de référence

---

### « E-Service » — et non « Service dématérialisé »

- Court, international, compréhensible sans traduction
- Utilisé par l'UEMOA et les organisations panafricaines
- **Distinction clé** avec les fiches pratiques : un e-service est un **lien vers une plateforme externe** (formulaire en ligne, paiement électronique) — pas une démarche à faire en présentiel dont on décrit les étapes.

---

### « Espace Entreprises » — et non « Guichet Entreprises »

- « Guichet » = image physique, présentiel → incohérent avec un portail numérique
- « Espace » = environnement dédié, inclusif, numérique → cohérent avec la mission du portail

---

### « Fiche pratique » vs « Fiche pratique en ligne »

Dans le tableau de bord admin, on lit :
- **Procédures actives : 1193** — toutes les fiches, actives ou non
- **Fiches pratiques en ligne** — uniquement celles avec `is_active = true` (visibles au public)

C'est le même contenu, mais avec un filtre de publication.

---

## 3. La distinction Catégories / Procédures / Événements de vie

### La hiérarchie du contenu

```
THÉMATIQUE (Category)
│  Exemple : « Commerce & Investissement »
│  → Un domaine administratif large
│
├── SOUS-CATÉGORIE (Subcategory)
│   │  Exemple : « Import / Export »
│   │  → Subdivise la thématique pour naviguer plus vite
│   │
│   └── FICHE PRATIQUE (Procedure)
│          Exemple : « Obtention de la Déclaration Préalable d'Importation »
│          → La démarche concrète avec pièces, coût, délai

ÉVÉNEMENT DE VIE (LifeEvent)                   [chemin alternatif]
│  Exemple : « J'importe ou j'exporte »
│  → Regroupe les mêmes fiches pratiques
│    selon un angle différent : la situation du citoyen
```

### Tableau comparatif

| Concept | Nom public | Nom technique | Rôle | Nombre |
|---|---|---|---|---|
| Niveau 1 | Thématique | `Category` | Domaine administratif | 16 |
| Niveau 2 | Sous-catégorie | `Subcategory` | Subdivision | 58 |
| Niveau 3 | Fiche pratique | `Procedure` | La démarche concrète | 1193 |
| Chemin B | Événement de vie | `LifeEvent` | Regroupement situationnel | 12 |

### Y a-t-il une redondance ?

**Non.** Voici la logique :
- Une **fiche pratique appartient à une thématique** (ex: "Demande de passeport" → Thématique "État Civil")
- La même fiche peut **apparaître dans plusieurs événements de vie** (ex: "Demande de passeport" → "Je pars à l'étranger" ET "Je demande ma CNIB")
- Ce n'est pas de la duplication : c'est du **cross-référencement** — la fiche existe une seule fois en base, elle est juste référencée depuis plusieurs entrées.

---

## 4. La navbar — logique de navigation

### Structure complète

```
[Accueil] [Thématiques ▼] [Événements de vie ▼] [E-services] [Annuaire] [Espace Entreprises] [Actualités]
```

### Justification de chaque position

| Position | Entrée | Justification |
|---|---|---|
| 1ère | **Accueil** | Ancre universelle, retour au point de départ |
| 2e | **Thématiques** | Accès principal — la majorité des visites vient d'une recherche par domaine |
| 3e | **Événements de vie** | Accès alternatif — pour ceux qui partent de leur situation de vie |
| 4e | **E-services** | Très demandé — les démarches en ligne sont prioritaires |
| 5e | **Annuaire** | Utile mais secondaire — accès aux coordonnées, pas à des démarches |
| 6e | **Espace Entreprises** | Audience ciblée (entrepreneurs) — différente du citoyen famille |
| Dernier | **Actualités** | Information → ne doit pas primer sur l'action |

### Les menus déroulants

Les deux menus déroulants (Thématiques, Événements de vie) affichent les **8 premiers** éléments pour ne pas surcharger visuellement la navigation. L'utilisateur peut voir tout le contenu en cliquant directement sur le titre.

---

## 5. Choix UX/UI et design

### La bande tricolore (rouge-blanc-vert)

C'est une convention des portails gouvernementaux francophones (France, Sénégal, Maroc, Côte d'Ivoire). Elle signale immédiatement : **site officiel du gouvernement**. Elle positionne le site avant même que l'utilisateur lise le titre.

### La barre officielle

```
🇧🇫 BURKINA FASO — Unité – Progrès – Justice  |  (+226) 25 30 66 30  |  contact@servicepublic.gov.bf
```

Présente sur **toutes les pages**, car c'est la signature d'autorité de l'État. Son fond sombre (presque noir) tranche visuellement avec le reste — elle ne se confond pas avec le contenu.

### Les armoiries comme logo (et non un logo graphique)

Le choix de l'armoirie nationale (et non un logo graphique moderne) renforce la **légitimité institutionnelle**. Les armoiries sont un symbole d'État reconnu internationalement, immédiatement associé à l'autorité officielle.

### Les cartes thématiques (page d'accueil)

Chaque thématique est une carte avec :
- **Icône** → reconnaissance immédiate sans lire le texte
- **Couleur distinctive** → différenciation rapide entre domaines
- **Compteur de fiches** → montre que la plateforme est riche en contenu

### Les « info boxes » Coût / Délai / Public visé

En haut de chaque fiche pratique, avant même la description, apparaissent 3 blocs colorés. Cette décision répond aux **3 questions que tout citoyen se pose en premier** :

1. 💰 Combien ça coûte ?
2. ⏱️ Combien de temps ça prend ?
3. 👤 Est-ce que c'est pour moi ?

Répondre immédiatement à ces questions évite de lire un long texte pour rien. C'est le principe du **progressive disclosure** : les informations les plus importantes d'abord.

### Le bloc « Voir aussi »

En bas de chaque fiche : des suggestions de fiches connexes. Cela :
- Aide le citoyen à ne rien oublier dans ses démarches
- Augmente l'engagement et le temps passé sur le site
- Crée des liens sémantiques entre les démarches liées

### Responsive mobile

Plus de **60% des utilisateurs** africains naviguent sur smartphone. Toutes les pages s'adaptent automatiquement (Bootstrap 5 breakpoints). Les cartes passent de la grille 4 colonnes (desktop) à 1 colonne (mobile).

---

## 6. Choix de copywriting

### Ton général

| ❌ À éviter | ✅ Utilisé sur la plateforme | Pourquoi |
|---|---|---|
| « L'usager doit fournir… » | « Vous devez fournir… » | Plus direct, moins administratif |
| « Procédure n°2847 » | « Demande de passeport ordinaire » | Centré sur l'action du citoyen |
| « Service dématérialisé » | « E-service » | Court, moderne, accessible |
| « Effectuer une requête » | « Faire une demande » | Accessible à tous les niveaux |
| « Suite aux dispositions de l'article… » | « En tant que citoyen burkinabè… » | Empathique, pas juridique |

### Titres des fiches pratiques

Tous les titres commencent par un **nom d'action** ou un **verbe d'action** :
- ✅ « Demande d'un passeport ordinaire »
- ✅ « Obtention du certificat de nationalité »
- ✅ « Inscription aux concours de la Fonction Publique »
- ❌ « Comment faire pour obtenir le casier judiciaire ? » (trop long, trop imprécis)

### Événements de vie — formulation à la 1ère personne

Toutes les cartes d'événements utilisent le « Je » :
- « Je crée mon entreprise » → Le citoyen s'identifie immédiatement à la situation
- « Je déclare une naissance » → Empathie, personnalisation, sentiment d'être compris

### Les sections des fiches

| Section | Voix | Exemple |
|---|---|---|
| Description | Neutre, informatif | « Ce document atteste de... » |
| Documents requis | Direct, liste | « Voici les pièces à fournir : » |
| Coût | Factuel | « 300 FCFA » ou « Gratuit » |
| Conditions | Inclusif | « Est concerné par cette démarche... » |
| Plus d'information | Orienté action | « Adressez-vous à... Pour plus d'infos... » |

---

## 7. Workflows des utilisateurs

### Workflow 1 — Trouver une démarche par thématique

```
Page d'accueil
  → Clic sur « Thématiques » dans la navbar  (ou sur une carte en page d'accueil)
  → Sélection d'une thématique (ex: « Commerce & Investissement »)
  → Affichage des fiches de cette thématique (filtrable par sous-catégorie)
  → Clic sur une fiche (ex: « Déclaration Préalable d'Importation »)
  → Page détail : coût, délai, documents à fournir, conditions, procédure
```

### Workflow 2 — Trouver une démarche par situation de vie

```
Page d'accueil
  → Section « Comment faire si ? »  (ou Navbar → Événements de vie)
  → Clic sur une situation (ex: « Je crée mon entreprise »)
  → Page de l'événement : liste de toutes les démarches associées
  → Clic sur une fiche (ex: « Immatriculation au RCCM via CEFORE »)
  → Page détail de la fiche
```

### Workflow 3 — Recherche directe

```
Barre de recherche (page d'accueil ou navbar)
  → Saisie : « casier judiciaire »
  → Résultats classés par pertinence (full-text MySQL)
  → Clic sur la fiche correspondante
  → Page détail
```

### Workflow 4 — Trouver un organisme

```
Navbar → « Annuaire »
  → Barre de recherche par nom ou type d'organisme
  → Fiche de l'organisme : adresse, téléphone, email, site web, horaires
```

### Workflow 5 — Accéder à un e-service

```
Navbar → « E-services »
  → Filtrage par catégorie (Commerce, Éducation, Emploi...)
  → Clic sur le service (ex: « CAMPUSFASO »)
  → Redirection vers la plateforme officielle externe
```

### Workflow 6 — Entreprises

```
Navbar → « Espace Entreprises »
  → Fiches démarches spécifiques aux entreprises
    (RCCM, IFU, Importation, Marchés publics...)
```

---

## 8. Workflows de l'administrateur

### Accéder au panneau admin

```
http://127.0.0.1:8000/admin
  → Email : admin@servicepublic.gov.bf
  → Mot de passe : password
```

### Système de rôles et permissions

Le panneau admin utilise **FilamentShield** (basé sur Spatie Permission) :

| Rôle | Accès | Qui |
|---|---|---|
| **super_admin** | Tout voir, créer, modifier, supprimer | Administrateur principal |
| **editor** | Voir & modifier le contenu (fiches, articles, FAQ) | Rédacteur |

> ✅ Après un clone, lancer `php artisan migrate:fresh --seed` — les permissions et rôles sont créés automatiquement par `ShieldSeeder`.
> Le rôle `super_admin` a un **bypass total** : il peut tout faire sans restriction.

### Ajouter une nouvelle fiche pratique

```
Admin → Contenu éditorial → Fiches pratiques → [+ Créer]

Remplir :
  ① Titre          → « Demande d'un extrait d'acte de naissance »
  ② Catégorie      → « État Civil & Nationalité »
  ③ Sous-catégorie → « Actes d'état civil » (optionnel)
  ④ Description    → Texte explicatif HTML
  ⑤ Documents requis → Liste HTML des pièces
  ⑥ Coût           → « Gratuit » ou « 500 FCFA »
  ⑦ Délai          → « Immédiat » ou « 48 heures »
  ⑧ Conditions     → Qui peut en bénéficier
  ⑨ Plus d'infos   → Adresse du service compétent
  ⑩ Statut         → Activer « Visible en ligne »

→ [Créer]  ←  La fiche est IMMÉDIATEMENT visible sur le site
```

### Modifier une fiche existante

```
Admin → Fiches pratiques → Rechercher par titre → Clic sur [Modifier]
→ Mettre à jour les champs souhaités
→ [Enregistrer]
```

### Attacher un document PDF à une fiche

```
Admin → Outils & Médias → Documents & Formulaires → [+ Créer]
  → Titre du document : « Formulaire demande de passeport »
  → Procédure liée  : [Sélectionner la fiche correspondante]
  → Fichier         : [Uploader le PDF — max 10 Mo]
→ [Créer]
```

### Lier des procédures à un événement de vie

```
Admin → Événements de vie → [Modifier un événement]
  → Section « Fiches pratiques liées »
  → Rechercher et sélectionner les fiches à associer
→ [Enregistrer]
```

### Créer une page statique (ex: Mentions légales)

```
Admin → Contenu éditorial → Pages statiques → [+ Créer]
  → Titre   : « Mentions légales »
  → Slug    : « mentions-legales »  (URL sera /mentions-legales)
  → Contenu : Texte HTML complet
  → Publiée : Oui
→ [Créer]
```

### Publier une actualité

```
Admin → Contenu éditorial → Actualités → [+ Créer]
  → Titre             → Titre de l'actualité
  → Chapeau           → Résumé (1-2 phrases pour la vignette)
  → Image             → Photo illustrative
  → Contenu           → Article complet (éditeur rich text)
  → Date publication  → Aujourd'hui ou planifier
  → Publié            → Activer pour publier
→ [Créer]
```

### Ajouter une question FAQ

```
Admin → Contenu éditorial → FAQ → [+ Créer]
  → Question   → Formuler comme un citoyen la poserait
  → Réponse    → Réponse claire avec listes si étapes multiples
  → Catégorie  → Thématique parent (optionnel)
  → Ordre      → Position dans la liste (0 = premier)
  → Active     → Oui
→ [Créer]
```

---

## 9. Comment scraper et mettre à jour les données

### Sources de données officielles

| Source | URL | Contenu |
|---|---|---|
| **Site officiel SP BF** | https://www.servicepublic.gov.bf | Procédures, catégories, organismes |
| **CEFORE** | https://www.cefore.bf | Création d'entreprise, RCCM |
| **DGI Burkina** | https://www.dgi.gov.bf | Fiscalité, IFU, IUTS |
| **Police Nationale** | https://www.police.bf | Passeport, CNIB |
| **Justice** | http://www.infos-pratiques.justice.gov.bf | Casier judiciaire, nationalité |

### Méthode 1 — Saisie manuelle (recommandée pour quelques fiches)

```
Admin → Fiches pratiques → Créer
→ Compléter les champs manuellement depuis la source officielle
```

### Méthode 2 — Import CSV/JSON via l'interface admin

```
Admin → Outils & Médias → Import de données
→ Préparer un fichier CSV avec les colonnes :
  title, description, cost, delay, documents_required, conditions, category_id
→ Uploader et mapper les colonnes
→ Importer
```

### Méthode 3 — Script Python (grandes quantités)

```python
# Scraper basique adapté au site servicepublic.gov.bf
# Le site utilise JavaScript → nécessite Playwright ou Selenium

from playwright.sync_api import sync_playwright
import json

def scrape_procedures():
    procedures = []
    
    with sync_playwright() as p:
        browser = p.chromium.launch()
        page = browser.new_page()
        
        # Naviguer vers une catégorie
        page.goto("https://servicepublic.gov.bf/particuliers/commerce-investissement")
        page.wait_for_load_state("networkidle")
        
        # Récupérer la liste des fiches
        links = page.query_selector_all("a.procedure-link")
        urls = [link.get_attribute("href") for link in links]
        
        for url in urls:
            page.goto(url)
            page.wait_for_load_state("networkidle")
            
            procedures.append({
                "title":              page.query_selector("h1").inner_text() if page.query_selector("h1") else "",
                "description":        page.query_selector(".description").inner_text() if page.query_selector(".description") else "",
                "cost":               page.query_selector(".cout").inner_text() if page.query_selector(".cout") else "",
                "delay":              page.query_selector(".delai").inner_text() if page.query_selector(".delai") else "",
                "documents_required": page.query_selector(".pieces").inner_text() if page.query_selector(".pieces") else "",
            })
        
        browser.close()
    
    # Sauvegarder
    with open("procedures_scraped.json", "w", encoding="utf-8") as f:
        json.dump(procedures, f, ensure_ascii=False, indent=2)
    
    print(f"{len(procedures)} procédures récupérées.")

scrape_procedures()
```

```bash
# Installation
pip install playwright
playwright install chromium

# Exécution
python scraper.py
```

### Méthode 4 — Seeder Laravel (après scraping)

```bash
# Importer le JSON scraped en base de données
php artisan db:seed --class=ScrapedDataSeeder

# Ou créer son propre seeder
php artisan db:seed --class=MonImportSeeder
```

### Règles impératives pour le scraping

> [!IMPORTANT]
> 1. **Vérifier le `robots.txt`** avant de commencer : https://servicepublic.gov.bf/robots.txt
> 2. **Mettre un délai** entre les requêtes (2-3 secondes) pour ne pas surcharger le serveur
> 3. **Toujours importer d'abord avec `is_active = false`** — vérifier les données avant publication
> 4. Utiliser **`updateOrCreate()`** (jamais `create()` seul) pour éviter les doublons
> 5. **Vérifier manuellement** un échantillon de 10% des fiches importées

---

## 10. Résumé des décisions clés

| Décision | Choix retenu | Alternative rejetée | Raison |
|---|---|---|---|
| Nom du contenu principal | **Fiche pratique** | Procédure | Plus accessible, moins intimidant |
| Organisation principale | **Thématiques** | Alphabétique / Ministères | Le citoyen pense par domaine de vie |
| Organisation secondaire | **Événements de vie** | Types de démarches | Centré sur la situation humaine |
| Vocabulaire officiel | **Thématique** | Catégorie | Institutionnel, différenciant |
| Lien vers services externes | **E-service** | Service dématérialisé | Court, international, clair |
| Logo | **Armoiries nationales** | Logo graphique moderne | Légitimité d'État immédiate |
| Architecture BDD | **1 table `procedures`** | Tables séparées par type | Simplicité + recherche unifiée |
| Ton rédactionnel | **« Vous » / verbes d'action** | Passif administratif | Proximité, clarté, accessibilité |
| Priorité page fiche | **Coût + Délai + Public en tête** | Description en premier | Les 3 questions prioritaires du citoyen |
| Admin | **Filament 3 (Laravel)** | Nova / Backpack | Open-source, complet, moderne |
| Permissions | **ShieldSeeder + Gate::before** | Permissions manuelles | Clone fonctionnel automatiquement |

---

*Dernière mise à jour : Février 2026 — Service Public BF v2*
