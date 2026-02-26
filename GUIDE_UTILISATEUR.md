# 📘 Guide Utilisateur — Service Public BF

> Ce document explique **pourquoi** la plateforme a été conçue ainsi :  
> les choix de nommage, l'UX, le copywriting, les workflows, et comment mettre à jour les données.

---

## Table des matières

1. [Philosophie générale](#1-philosophie-générale)
2. [Pourquoi ces termes ? (Glossaire raisonné)](#2-pourquoi-ces-termes--glossaire-raisonné)
3. [Catégories vs Procédures — la distinction fondamentale](#3-catégories-vs-procédures--la-distinction-fondamentale)
4. [La navbar : logique de navigation](#4-la-navbar--logique-de-navigation)
5. [Choix UX/UI et présentation](#5-choix-uxui-et-présentation)
6. [Choix de copywriting](#6-choix-de-copywriting)
7. [Workflows utilisateur](#7-workflows-utilisateur)
8. [Mettre à jour les données (scraping)](#8-mettre-à-jour-les-données-scraping)

---

## 1. Philosophie générale

La plateforme repose sur **une règle simple** :

> Un citoyen ne connaît pas les termes administratifs. Il sait en revanche où il en est dans sa vie.

Tout le site est donc organisé autour de **deux portes d'entrée** :

| Entrée | Pour quel profil ? | Exemple |
|---|---|---|
| **Thématiques** | Citoyen qui sait dans quel domaine chercher | "Je cherche quelque chose lié au Commerce" |
| **Événements de vie** | Citoyen qui part de sa situation | "Je vais me marier, qu'est-ce que je dois faire ?" |

Les deux mènent exactement aux **mêmes fiches pratiques** — c'est juste le chemin qui diffère.

---

## 2. Pourquoi ces termes ? (Glossaire raisonné)

### « Fiche pratique » et non « Procédure »

**Le problème :** Le terme juridique exact est « procédure administrative ». Mais ce mot est :
- 🚫 Technique → intimidant pour le citoyen
- 🚫 Vague → on ne sait pas ce qu'on va trouver

**La solution :** « Fiche pratique » — ce terme dit exactement ce que c'est :
- ✅ Un document **pratique** (utile, actionnable)
- ✅ Une **fiche** (courte, lisible, structurée)

> *En interne (code, base de données, admin)*, on garde `Procedure` car c'est le terme métier précis. Sur le site **public**, on dit « Fiche pratique ».

---

### « Thématique » et non « Catégorie »

**Le problème :** Le mot « catégorie » est générique (n'importe quelle app en a). Il ne dit rien sur le **contenu**.

**La solution :** « Thématique » évoque un **domaine de la vie publique** (Commerce, Justice, Santé…). C'est le vocabulaire utilisé sur [service-public.fr](https://service-public.fr) et sur les portails gouvernementaux africains (Sénégal, Côte d'Ivoire).

> En base de données, le modèle s'appelle `Category` (terme technique standard Laravel). Sur le site, on dit **Thématique**.

---

### « Événement de vie » et non « Situation » ou « Parcours »

Ce terme vient directement de la **norme SGMAP française** (Standard général du management public). Il est utilisé par tous les portails gouvernementaux depuis 2010. Il désigne une étape notable dans la vie d'une personne qui génère plusieurs démarches en cascade.

Exemples : naissance, mariage, décès, création d'entreprise.

---

### « Annuaire » et non « Répertoire » ou « Organismes »

- « Annuaire » est le terme institutionnel universel (annuaire téléphonique → annuaire des services publics)
- Plus court, plus intuitif, connu de tous

---

### « E-Service » et non « Service dématérialisé »

- Court, international, compréhensible même sans traduction
- Utilisé par l'UEMOA et les organisations régionales
- Différent d'une « fiche pratique » : l'e-service est un **lien vers une plateforme externe** (paiement en ligne, formulaire numérique…), pas une démarche à faire en présentiel

---

### « Espace Entreprises » et non « Guichet Entreprises »

- « Guichet » = image physique, présentiel → pas cohérent avec un portail numérique
- « Espace » = environnement dédié, inclusif, numérique

---

## 3. Catégories vs Procédures — la distinction fondamentale

```
CATÉGORIE (Thématique)
│
│  Exemple : "Commerce & Investissement"
│  → Un domaine administratif large
│  → A plusieurs sous-catégories
│
├── SOUS-CATÉGORIE
│   │  Exemple : "Import / Export"
│   │  → Subdivise la thématique
│   │
│   └── FICHE PRATIQUE (Procédure)
│          Exemple : "Obtention de la DPI"
│          → La démarche concrète avec
│            ses pièces, son coût, son délai
```

**La hiérarchie :**

| Niveau | Nom public | Nom technique | Rôle |
|---|---|---|---|
| 1 | Thématique | `Category` | Domaine administratif (Commerce, Justice…) |
| 2 | Sous-catégorie | `Subcategory` | Subdivision (Import/Export, Impôts…) |
| 3 | Fiche pratique | `Procedure` | La démarche concrète |

> **Pas de redondance.** Une fiche appartient à **une** catégorie et éventuellement **une** sous-catégorie. Elle peut aussi être référencée dans plusieurs événements de vie via la table `life_event_procedure`.

---

## 4. La navbar : logique de navigation

La barre de navigation suit l'ordre de **fréquence d'utilisation** :

```
Accueil | Thématiques ▼ | Événements de vie ▼ | E-services | Annuaire | Espace Entreprises | Actualités
```

| Position | Choix | Justification |
|---|---|---|
| **1er** : Accueil | Toujours présent | Ancre, retour au point de départ |
| **2e** : Thématiques | Accès principal | La majorité des visites cherchent par domaine |
| **3e** : Événements de vie | Accès alternatif | Pour ceux qui partent de leur situation |
| **4e** : E-services | Très demandé | Les démarches en ligne sont prioritaires |
| **5e** : Annuaire | Utile, secondaire | Accès aux coordonnées, pas de démarche |
| **6e** : Espace Entreprises | Audience ciblée | Profil différent du citoyen lambda |
| **Dernier** : Actualités | Information, pas démarche | Ne devrait pas primer sur l'action |

**Les deux menus déroulants** (Thématiques, Événements de vie) affichent les **8 premiers** pour ne pas surcharger visuellement.

---

## 5. Choix UX/UI et présentation

### Bande tricolore en haut

La bande rouge-blanc-vert en haut de page est une convention des portails gouvernementaux (France, Sénégal, Maroc…). Elle signale immédiatement : **site officiel de l'État**.

### Barre officielle (bandeau noir)

```
Drapeau BF | BURKINA FASO — Unité – Progrès – Justice | Téléphone | Email
```

Présente sur **toutes les pages**, car c'est la signature d'autorité de l'État.

### Armoiries comme logo

Le choix de l'armoirie (et non un logo graphique) renforce la **légitimité institutionnelle**. Les armoiries sont un symbole d'État reconnu internationalement.

### Cartes pour les thématiques (page d'accueil)

Chaque thématique est une card avec icône, couleur et compteur de fiches. Pourquoi ?
- L'icône = reconnaissance immédiate sans lire le texte
- La couleur = différenciation rapide entre domaines
- Le compteur = montre que la plateforme est **riche en contenu**

### Page de fiche pratique : les "info boxes" coût/délai/public

Ces trois blocs en haut de fiche (avant même la description) répondent aux **3 questions que tout citoyen se pose en premier** :
1. Combien ça coûte ?
2. Combien de temps ça prend ?
3. Est-ce que c'est pour moi ?

Répondre immédiatement à ces questions évite de lire un texte long pour rien.

### « Voir aussi » sur les fiches

Le bloc de fiches connexes encourage à explorer des démarches complémentaires — augmente l'engagement et aide le citoyen à ne rien oublier.

---

## 6. Choix de copywriting

### Ton général

| ❌ À éviter | ✅ Utilisé | Pourquoi |
|---|---|---|
| "L'usager doit fournir…" | "Vous devez fournir…" | Plus direct, moins administratif |
| "Procédure n°2847" | "Demander son passeport" | Centré sur l'action du citoyen |
| "Service dématérialisé" | "E-service" | Court, moderne |
| "Effectuer une requête" | "Faire une demande" | Accessible à tous |

### Titres des fiches pratiques

Les titres commencent par un **verbe d'action** ou un **nom d'objet** :
- "Demande de passeport ordinaire" ✅
- "Obtention du RCCM" ✅
- "Comment obtenir le casier judiciaire ?" ❌ (trop long)

### Événements de vie — formulation à la 1ère personne

Toutes les cartes événements utilisent le « Je » :
- "Je crée mon entreprise" → Empathie, identification immédiate
- "Je déclare une naissance" → Le citoyen se retrouve dans le titre

---

## 7. Workflows utilisateur

### Workflow 1 : Trouver une démarche par thématique

```
Page d'accueil
→ Clic sur "Thématiques" dans la navbar
→ Clic sur "Commerce & Investissement"
→ Page de la thématique avec liste de fiches
→ Clic sur "Obtention de la DPI"
→ Fiche complète avec pièces + coût + délai
```

### Workflow 2 : Trouver une démarche par situation de vie

```
Page d'accueil
→ Clic sur "Événements de vie"
→ Clic sur "Je me marie"
→ Page de l'événement avec toutes les démarches liées
→ Sélection d'une fiche (ex: "Déclaration de mariage à l'état civil")
→ Fiche complète
```

### Workflow 3 : Recherche directe

```
Barre de recherche sur la page d'accueil
→ Saisie : "casier judiciaire"
→ Résultats filtrés par pertinence
→ Clic sur la fiche correspondante
```

### Workflow 4 : Trouver un organisme

```
Navbar → "Annuaire"
→ Recherche par nom ou ville
→ Fiche de l'organisme : adresse, téléphone, horaires
```

### Workflow 5 : Administrateur — Ajouter une fiche

```
/admin → Connexion
→ "Fiches pratiques" → "Créer"
→ Remplir : titre, catégorie, description, pièces, coût, délai
→ Activer "Visible en ligne"
→ Enregistrer
→ La fiche est immédiatement visible sur le site
```

---

## 8. Mettre à jour les données (scraping)

### Sources de données officielles

| Source | URL | Contenu disponible |
|---|---|---|
| **Site original SP BF** | https://www.servicepublic.gov.bf | Procédures, organismes, catégories |
| **Portail OHADA** | https://www.ohada.com | Procédures commerciales et juridiques |
| **Guichet Unique CEFORE** | https://www.cefore.bf | Création d'entreprise |

### Méthode recommandée : Python + BeautifulSoup

```python
# Exemple de scraper basique pour les procédures
import requests
from bs4 import BeautifulSoup
import json

BASE_URL = "https://www.servicepublic.gov.bf"

def scrape_procedures(category_url):
    response = requests.get(category_url, timeout=10)
    soup = BeautifulSoup(response.text, 'html.parser')

    procedures = []
    for card in soup.select('.procedure-card'):  # adapter le sélecteur CSS
        procedures.append({
            'title':              card.select_one('h2, h3').text.strip()   if card.select_one('h2, h3') else '',
            'description':        card.select_one('.description').text.strip() if card.select_one('.description') else '',
            'documents_required': card.select_one('.pieces').text.strip()  if card.select_one('.pieces') else '',
            'cost':               card.select_one('.cout').text.strip()    if card.select_one('.cout') else '',
            'delay':              card.select_one('.delai').text.strip()   if card.select_one('.delai') else '',
        })

    return procedures

# Sauvegarder en JSON
data = scrape_procedures(BASE_URL + "/categorie/commerce")
with open('procedures_scraped.json', 'w', encoding='utf-8') as f:
    json.dump(data, f, ensure_ascii=False, indent=2)
```

### Méthode d'import dans la plateforme

Une fois les données scraped en JSON, deux options pour les importer :

**Option A — Via l'outil d'import intégré (recommandé)**

```
Admin → Outils & Médias → Import de données
→ Upload du fichier CSV/JSON
→ Mapping des colonnes
→ Import
```

**Option B — Via un seeder Laravel (pour gros volumes)**

```php
// database/seeders/ProceduresImportSeeder.php
$data = json_decode(file_get_contents('procedures_scraped.json'), true);

foreach ($data as $item) {
    Procedure::updateOrCreate(
        ['slug' => Str::slug($item['title'])],  // ← cherche par slug
        [
            'title'               => $item['title'],
            'description'         => $item['description'],
            'documents_required'  => $item['documents_required'],
            'cost'                => $item['cost'],
            'delay'               => $item['delay'],
            'category_id'         => 1,  // ← catégorie à définir
            'is_active'           => true,
        ]
    );
}
```

```bash
php artisan db:seed --class=ProceduresImportSeeder
```

### Règles d'or pour le scraping

> [!IMPORTANT]
> 1. **Respecter le `robots.txt`** du site cible
> 2. **Mettre un délai** entre les requêtes (`time.sleep(2)` en Python) pour ne pas surcharger le serveur
> 3. **Toujours tester** avec `is_active = false` pour vérifier les données avant publication
> 4. Utiliser `updateOrCreate()` (pas `create()`) pour éviter les doublons
> 5. Vérifier manuellement un échantillon des fiches importées

### Automatiser les mises à jour mensuelles

```bash
# Cron job (Linux/Mac) — tous les 1er du mois à 3h du matin
0 3 1 * * /usr/bin/php /var/www/servicepublic-bf/artisan schedule:run

# Dans app/Console/Kernel.php
$schedule->command('import:procedures')->monthly();
```

---

## Résumé des choix clés

| Décision | Choix fait | Alternative rejetée | Raison |
|---|---|---|---|
| Nom du contenu | Fiche pratique | Procédure | Plus accessible au citoyen |
| Classement principal | Thématiques | Alphabétique | Le citoyen pense par domaine |
| Classement secondaire | Événements de vie | Types de démarches | Centré sur l'humain |
| Ton rédactionnel | "Vous" / verbes d'action | Passif administratif | Proximité et clarté |
| Logo | Armoiries officielles | Logo graphique | Légitimité institutionnelle |
| Architecture DB | 1 table `procedures` | Tables séparées par type | Simplicité + flexibilité |
