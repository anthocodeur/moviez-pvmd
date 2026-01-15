<?php

// Configuration de la base de données
// Modifiez ces variables selon votre configuration
$host = 'localhost:3306';
$dbname = 'movie_catalog';
$user = 'root';
$password = '';

try {
    // Connexion à MySQL
    $pdo = new PDO("mysql:host=$host", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Suppression de la base de données si elle existe
    $pdo->exec("DROP DATABASE IF EXISTS $dbname");

    // Création de la base de données
    $pdo->exec("CREATE DATABASE $dbname");
    echo "Base de données '$dbname' créée avec succès.\n";

    // Connexion à la base de données
    $pdo->exec("USE $dbname");

    // Création des tables
    $queries = [
        // Table movies
        "CREATE TABLE IF NOT EXISTS movies (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            year INT,
            synopsis TEXT,
            duration INT,
            rating DECIMAL(3,1),
            poster VARCHAR(255)
        )",

        // Table categories
        "CREATE TABLE IF NOT EXISTS categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            description TEXT
        )",

        // Table actors
        "CREATE TABLE IF NOT EXISTS actors (
            id INT AUTO_INCREMENT PRIMARY KEY,
            last_name VARCHAR(100) NOT NULL,
            first_name VARCHAR(100) NOT NULL,
            birth_date DATE,
            biography TEXT,
            photo VARCHAR(255)
        )",

        // Table de jointure movie_categories
        "CREATE TABLE IF NOT EXISTS movie_categories (
            movie_id INT,
            category_id INT,
            PRIMARY KEY (movie_id, category_id),
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
        )",

        // Table de jointure movie_actors
        "CREATE TABLE IF NOT EXISTS movie_actors (
            movie_id INT,
            actor_id INT,
            role VARCHAR(100),
            PRIMARY KEY (movie_id, actor_id),
            FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
            FOREIGN KEY (actor_id) REFERENCES actors(id) ON DELETE CASCADE
        )"
    ];

    // Exécution des requêtes
    foreach ($queries as $query) {
        $pdo->exec($query);
    }

    echo "Tables créées avec succès.\n";

    // Création des indexes
    $indexQueries = [
        "CREATE INDEX IF NOT EXISTS idx_movies_year ON movies(year)",
        "CREATE INDEX IF NOT EXISTS idx_movies_rating ON movies(rating)",
        "CREATE INDEX IF NOT EXISTS idx_categories_name ON categories(name)",
        "CREATE INDEX IF NOT EXISTS idx_actors_last_name ON actors(last_name)",
        "CREATE INDEX IF NOT EXISTS idx_actors_first_name ON actors(first_name)"
    ];

    foreach ($indexQueries as $query) {
        $pdo->exec($query);
    }

    echo "Index créés avec succès.\n";

    echo "Configuration de la base de données terminée avec succès! Vous pouvez ajouter vos données.\n";
} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}

$pdo = null;
