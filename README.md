# Application de Catalogue de Films

Cette application permet de gérer un catalogue de films avec leurs catégories et acteurs.

## Structure du Projet

```
AP/
├── config/
│   └── database.php         - Configuration de la base de données
├── database/
│   ├── setup_database.php    - Script pour créer la base de données
│   └── populate_database.php - Script pour peupler la base de données
└── README.md
```

## Configuration de la Base de Données

### Prérequis

- Serveur MySQL installé
- PHP installé avec l'extension PDO_MYSQL
- Droit d'accès à MySQL

### Étapes pour configurer la base de données

#### 1. **Modifier les paramètres de connexion**

Dans le fichier `config/database.php`, modifiez les variables suivantes selon votre configuration :

```php
$host = 'localhost:3306';      // Adresse du serveur MySQL
$dbname = 'movie_catalog'; // Nom de la base de données
$user = 'root';           // Nom d'utilisateur MySQL
$password = '';           // Mot de passe MySQL
```

_Pensez à mettre votre mot de passe_

#### 2. **Créer la base de données**

Exécutez le script de configuration :

```bash
php database/setup_database.php
```

Ce script va :

- Créer la base de données `movie_catalog`
- Créer les tables nécessaires : `movies`, `categories`, `actors`, `movie_categories`, `movie_actors`
- Créer les indexes pour optimiser les requêtes

#### 3. **Peupler la base de données**

Exécutez le script de population :

```bash
php database/populate_database.php
```

Ce script va :

- Insérer 20 films
- Insérer 43 acteurs
- Insérer 10 catégories
- Créer les associations entre films et catégories
- Créer les associations entre films et acteurs

### Structure de la Base de Données

La base de données contient les tables suivantes :

- **movies** : Table principale des films
- **categories** : Table des catégories de films
- **actors** : Table des acteurs
- **movie_categories** : Table de jointure pour les relations Many-to-Many entre films et catégories
- **movie_actors** : Table de jointure pour les relations Many-to-Many entre films et acteurs

### Configuration centralisée

Les paramètres de connexion à la base de données sont centralisés dans le fichier [`config/database.php`](config/database.php). Ce fichier contient :

- Les variables de configuration pour la connexion MySQL
- La création de l'objet PDO `$bdd` prêt à l'emploi

Ce fichier peut être inclus dans vos scripts pour accéder à la base de données.

### Exécution des Scripts

Vous pouvez exécuter les scripts via un navigateur web :

#### 1. **Lancer un serveur PHP intégré**

Dans le terminal, à la racine du projet, exécutez :

```bash
php -S localhost:8000
```

#### 2. **Accéder aux scripts**

Ouvrez votre navigateur et accédez aux URLs suivantes :

```
http://localhost:8000/database/setup_database.php
http://localhost:8000/database/populate_database.php
```

Exécutez d'abord le script de configuration, puis le script de population.

### Vérification avec l'extension Database

Avec l'extension **Database** dans VS Code, vous pouvez vérifier que tout a bien été créé :

#### 1. **Ouvrir l'extension Database**

- Cliquez sur l'icône Database dans la barre latérale de VS Code
- Connectez-vous à votre serveur MySQL (utilisez les mêmes identifiants que dans `config/database.php`)

#### 2. **Exécuter des requêtes de vérification**

Exécutez ces requêtes pour vérifier la structure et les données :

```sql
-- Vérifier que la base de données existe
SHOW DATABASES;

-- Sélectionner la base de données
USE movie_catalog;

-- Vérifier que toutes les tables ont été créées
SHOW TABLES;

-- Compter le nombre de films insérés
SELECT COUNT(*) AS nombre_films FROM movies;

-- Compter le nombre de catégories insérées
SELECT COUNT(*) AS nombre_categories FROM categories;

-- Compter le nombre d'acteurs insérés
SELECT COUNT(*) AS nombre_acteurs FROM actors;

-- Vérifier une relation Many-to-Many (exemple avec Titanic)
SELECT m.title, c.name AS category_name
FROM movies m
JOIN movie_categories mc ON m.id = mc.movie_id
JOIN categories c ON mc.category_id = c.id
WHERE m.title = 'Titanic';

-- Vérifier une relation film-acteur (exemple avec Titanic)
SELECT m.title, a.first_name, a.last_name, ma.role
FROM movies m
JOIN movie_actors ma ON m.id = ma.movie_id
JOIN actors a ON ma.actor_id = a.id
WHERE m.title = 'Titanic';
```

#### 3. **Résultats attendus**

- Vous devriez voir 5 tables : `movies`, `categories`, `actors`, `movie_categories`, `movie_actors`
- Le compteur de films doit afficher **20**
- Le compteur de catégories doit afficher **10**
- Le compteur d'acteurs doit afficher **43**
- La requête sur Titanic doit retourner 2 catégories (Drama et Romance)
- La requête sur les acteurs de Titanic doit retourner 3 acteurs avec leurs rôles

Si tous ces tests passent, votre base de données est correctement configurée et peuplée !

## Exercice

### Consignes

#### 1. **Afficher la liste des films**

- Modifier le fichier [`index.php`](index.php) pour afficher tous les films de la base de données
- Pour chaque film, afficher :
  - Le titre
  - L'année de sortie
  - La durée
  - Les catégories associées
  - Un bouton "Voir plus" pour accéder à la page de détails

#### 2. **Créer une page de détails**

- Créer un fichier [`detail.php`](detail.php) pour afficher les détails d'un film spécifique
- Soyez créatifs sur la gestion des visuels
- Récupérer l'ID du film depuis l'URL (paramètre GET)
- Afficher les informations suivantes :
  - Titre
  - Année de sortie
  - Durée
  - Synopsis
  - Liste des acteurs avec leurs rôles
  - Liste des catégories
  - Note (si disponible)

#### 3. **Styliser l'interface**

- Modifier le fichier [`assets/css/style.css`](assets/css/style.css) pour recréé le design
- Utiliser un design responsive
- Appliquer des styles cohérents pour les cartes de films
- Styliser la page de détails avec une mise en page claire

## Utilisation

Une fois la base de données configurée, vous pouvez développer votre application pour :

- Afficher la liste des films
- Filtrer les films par catégorie
- Rechercher des films par titre ou acteur
- Afficher les détails d'un film (synopsis, acteurs, catégories)
- Et bien plus encore...
