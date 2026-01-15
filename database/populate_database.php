<?php

// Inclusion de la configuration de la base de données
require_once __DIR__ . '/../config/database.php';

try {
    // Connexion à la base de données
    $pdo = $bdd;

    // Désactivation des contraintes foreign key temporairement
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

    // Suppression des données existantes
    $tables = ['movie_actors', 'movie_categories', 'actors', 'categories', 'movies'];
    foreach ($tables as $table) {
        $pdo->exec("TRUNCATE TABLE $table");
    }

    // Réactivation des contraintes
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    echo "Données existantes supprimées.\n";

    // Insertion des catégories
    $categories = [
        ['Action', 'Films avec des scènes d"action et d"aventure'],
        ['Science-Fiction', 'Films se déroulant dans un futur imaginaire'],
        ['Drama', 'Films avec des histoires émotionnelles'],
        ['Romance', 'Films centrés sur des relations amoureuses'],
        ['Animation', 'Films d"animation'],
        ['Fantasy', 'Films avec des éléments fantastiques'],
        ['Famille', 'Films adaptés à toute la famille'],
        ['Aventure', 'Films avec des quêtes et des explorations'],
        ['Guerre', 'Films sur des conflits militaires'],
        ['Comédie', 'Films drôles et légers']
    ];

    $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
    foreach ($categories as $category) {
        $stmt->execute([
            ':name' => $category[0],
            ':description' => $category[1]
        ]);
    }
    echo "Catégories insérées (" . count($categories) . ").\n";

    // Insertion des acteurs
    $actors = [
        ['Gable', 'Clark', '1901-02-01', 'Acteur américain légendaire', 'clark_gable.jpg'],
        ['Leigh', 'Vivien', '1913-11-05', 'Actrice britannique célèbre', 'vivien_leigh.jpg'],
        ['Howard', 'Leslie', '1893-04-13', 'Acteur britannique', 'leslie_howard.jpg'],
        ['Worthington', 'Sam', '1976-08-02', 'Acteur australien', 'sam_worthington.jpg'],
        ['Saldana', 'Zoe', '1978-06-19', 'Actrice américaine', 'zoe_saldana.jpg'],
        ['Weaver', 'Sigourney', '1949-10-08', 'Actrice américaine', 'sigourney_weaver.jpg'],
        ['DiCaprio', 'Leonardo', '1974-11-11', 'Acteur américain célèbre', 'leonardo_dicaprio.jpg'],
        ['Winslet', 'Kate', '1975-10-05', 'Actrice britannique', 'kate_winslet.jpg'],
        ['Zane', 'Billy', '1966-02-24', 'Acteur américain', 'billy_zane.jpg'],
        ['Ridley', 'Daisy', '1992-04-10', 'Actrice britannique', 'daisy_ridley.jpg'],
        ['Boyega', 'John', '1987-03-17', 'Acteur britannique', 'john_boyega.jpg'],
        ['Isaac', 'Oscar', '1979-03-01', 'Acteur chilien', 'oscar_isaac.jpg'],
        ['Downey', 'Robert', '1965-04-04', 'Acteur américain', 'robert_downey.jpg'],
        ['Evans', 'Chris', '1981-06-13', 'Acteur américain', 'chris_evans.jpg'],
        ['Ruffalo', 'Mark', '1967-11-22', 'Acteur américain', 'mark_ruffalo.jpg'],
        ['Hemsworth', 'Chris', '1983-08-11', 'Acteur australien', 'chris_hemsworth.jpg'],
        ['Broderick', 'Matthew', '1962-03-02', 'Acteur américain', 'matthew_broderick.jpg'],
        ['Jones', 'James Earl', '1931-01-17', 'Acteur américain', 'james_earl_jones.jpg'],
        ['Irons', 'Jeremy', '1948-08-19', 'Acteur britannique', 'jeremy_irons.jpg'],
        ['Bell', 'Kristen', '1980-07-14', 'Actrice américaine', 'kristen_bell.jpg'],
        ['Menzel', 'Idina', '1971-05-30', 'Actrice et chanteuse américaine', 'idina_menzel.jpg'],
        ['Gad', 'Josh', '1981-02-23', 'Acteur et comédien américain', 'josh_gad.jpg'],
        ['Cruise', 'Tom', '1962-07-03', 'Acteur et producteur américain', 'tom_cruise.jpg'],
        ['Teller', 'Miles', '1987-02-20', 'Acteur américain', 'miles_teller.jpg'],
        ['Connelly', 'Jennifer', '1970-12-12', 'Actrice américaine', 'jennifer_connelly.jpg'],
        ['Pratt', 'Chris', '1979-06-21', 'Acteur américain', 'chris_pratt.jpg'],
        ['Howard', 'Bryce Dallas', '1981-03-02', 'Actrice américaine', 'bryce_dallas_howard.jpg'],
        ['D\'Onofrio', 'Vincent', '1959-04-30', 'Acteur américain', 'vincent_donofrio.jpg'],
        ['Hamill', 'Mark', '1951-09-25', 'Acteur américain', 'mark_hamill.jpg'],
        ['Ford', 'Harrison', '1942-07-13', 'Acteur américain', 'harrison_ford.jpg'],
        ['Fisher', 'Carrie', '1956-10-21', 'Actrice américaine', 'carrie_fisher.jpg'],
        ['Thomas', 'Henry', '1971-09-09', 'Acteur américain', 'henry_thomas.jpg'],
        ['Barrymore', 'Drew', '1975-02-22', 'Actrice américaine', 'drew_barrymore.jpg'],
        ['Coyote', 'Peter', '1949-10-10', 'Acteur américain', 'peter_coyote.jpg'],
        ['Neeson', 'Liam', '1952-06-07', 'Acteur irlandais', 'liam_neeson.jpg'],
        ['McGregor', 'Ewan', '1971-03-31', 'Acteur écossais', 'ewan_mcgregor.jpg'],
        ['Portman', 'Natalie', '1981-06-09', 'Actrice américaine', 'natalie_portman.jpg'],
        ['Wood', 'Elijah', '1981-01-28', 'Acteur américain', 'elijah_wood.jpg'],
        ['Mortensen', 'Viggo', '1958-10-20', 'Acteur dano-islandais', 'viggo_mortensen.jpg'],
        ['McKellen', 'Ian', '1939-05-25', 'Acteur britannique', 'ian_mckellen.jpg'],
        ['Radcliffe', 'Daniel', '1989-07-23', 'Acteur britannique connu pour Harry Potter', 'daniel_radcliffe.jpg'],
        ['Grint', 'Rupert', '1988-08-24', 'Acteur britannique', 'rupert_grint.jpg'],
        ['Watson', 'Emma', '1990-04-15', 'Actrice britannique', 'emma_watson.jpg']
    ];

    $stmt = $pdo->prepare("INSERT INTO actors (last_name, first_name, birth_date, biography, photo) VALUES (:last_name, :first_name, :birth_date, :biography, :photo)");
    foreach ($actors as $actor) {
        $stmt->execute([
            ':last_name' => $actor[0],
            ':first_name' => $actor[1],
            ':birth_date' => $actor[2],
            ':biography' => $actor[3],
            ':photo' => $actor[4]
        ]);
    }
    echo "Acteurs insérés (" . count($actors) . ").\n";

    // Insertion des films
    $movies = [
        ['Gone with the Wind', 1939, 'Une épopée historique sur la guerre de Sécession', 238, 8.2, 'gone_with_the_wind.jpg'],
        ['Avatar', 2009, 'Un marine devient un avatar sur la lune de Pandora', 162, 7.9, 'avatar.jpg'],
        ['Titanic', 1997, 'Une histoire d"amour tragique à bord du paquebot Titanic', 194, 8.5, 'titanic.jpg'],
        ['Star Wars: Episode VII - The Force Awakens', 2015, 'La nouvelle génération de la saga Star Wars', 138, 7.8, 'star_wars_7.jpg'],
        ['Avengers: Endgame', 2019, 'Les Avengers tentent de reversing la destruction de l"univers', 181, 8.4, 'avengers_endgame.jpg'],
        ['Avengers: Infinity War', 2018, 'Thanos cherche les Pierres d"Infini', 149, 8.4, 'avengers_infinity_war.jpg'],
        ['The Lion King', 1994, 'L"histoire de Simba, le futur roi des lions', 88, 8.5, 'lion_king.jpg'],
        ['Frozen II', 2019, 'Elsa et Anna partent à la découverte des secrets de leur royaume', 103, 6.8, 'frozen_2.jpg'],
        ['Top Gun: Maverick', 2022, 'Un pilote de chasse légendaire forme une nouvelle génération', 130, 8.3, 'topgun.jpg'],
        ['Jurassic World', 2015, 'Un parc à thème avec des dinosaures', 124, 7.0, 'jurassic_world.jpg'],
        ['The Avengers', 2012, 'Les super-héros se réunissent pour sauver le monde', 143, 8.0, 'avengers.jpg'],
        ['Frozen', 2013, 'Une princesse peut geler tout ce qu"elle touche', 102, 7.4, 'frozen.jpg'],
        ['Star Wars: Episode IV - A New Hope', 1977, 'Luke Skywalker découvre la Force', 121, 8.6, 'star_wars_4.jpg'],
        ['E.T. the Extra-Terrestrial', 1982, 'Un enfant se lie d"amitié avec un extraterrestre', 115, 7.9, 'et.jpg'],
        ['Star Wars: Episode I - The Phantom Menace', 1999, 'Les débuts de Anakin Skywalker', 136, 6.5, 'star_wars_1.jpg'],
        ['The Lord of the Rings: The Return of the King', 2003, 'La bataille finale contre Sauron', 201, 8.9, 'lotr_return.jpg'],
        ['Harry Potter and the Sorcerer\'s Stone', 2001, 'Un jeune sorcier découvre le monde de la magie', 152, 7.6, 'harry_potter.jpg'],
        ['Harry Potter and the Chamber of Secrets', 2002, 'Harry affronte un monstre dans la Chambre des Secrets', 161, 7.4, 'harry_potter_2.jpg'],
        ['Harry Potter and the Prisoner of Azkaban', 2004, 'Sirius Black s\'échappe de Azkaban', 142, 7.9, 'harry_potter_3.jpg'],
        ['Harry Potter and the Goblet of Fire', 2005, 'Harry participe au Tournoi des Trois Sorciers', 157, 7.7, 'harry_potter_4.jpg']
    ];

    $stmt = $pdo->prepare("INSERT INTO movies (title, year, synopsis, duration, rating, poster) VALUES (:title, :year, :synopsis, :duration, :rating, :poster)");
    foreach ($movies as $movie) {
        $stmt->execute([
            ':title' => $movie[0],
            ':year' => $movie[1],
            ':synopsis' => $movie[2],
            ':duration' => $movie[3],
            ':rating' => $movie[4],
            ':poster' => $movie[5]
        ]);
    }
    echo "Films insérés (" . count($movies) . ").\n";

    // Association des films avec les catégories
    $movieCategories = [
        [1, [3, 4, 9]],  // Gone with the Wind -> Drama, Romance, Guerre
        [2, [2, 8]],     // Avatar -> Science-Fiction, Aventure
        [3, [3, 4]],     // Titanic -> Drama, Romance
        [4, [2, 8]],     // Star Wars 7 -> Science-Fiction, Aventure
        [5, [1, 2]],     // Avengers Endgame -> Action, Science-Fiction
        [6, [1, 2]],     // Avengers Infinity War -> Action, Science-Fiction
        [7, [5, 8, 3]],  // Lion King -> Animation, Aventure, Drama
        [8, [5, 8, 10]], // Frozen II -> Animation, Aventure, Comédie
        [9, [1, 3]],     // Top Gun -> Action, Drama
        [10, [8, 2]],    // Jurassic World -> Aventure, Science-Fiction
        [11, [1, 2]],    // Avengers -> Action, Science-Fiction
        [12, [5, 8, 10]], // Frozen -> Animation, Aventure, Comédie
        [13, [2, 8]],    // Star Wars 4 -> Science-Fiction, Aventure
        [14, [7, 2]],    // ET -> Famille, Science-Fiction
        [15, [2, 8]],    // Star Wars 1 -> Science-Fiction, Aventure
        [16, [8, 3, 6]], // LOTR Return -> Aventure, Drama, Fantasy
        [17, [7, 6]],    // Harry Potter 1 -> Famille, Fantasy
        [18, [7, 6]],    // Harry Potter 2 -> Famille, Fantasy
        [19, [7, 6]],    // Harry Potter 3 -> Famille, Fantasy
        [20, [7, 6]]     // Harry Potter 4 -> Famille, Fantasy
    ];

    $stmt = $pdo->prepare("INSERT INTO movie_categories (movie_id, category_id) VALUES (:movie_id, :category_id)");
    foreach ($movieCategories as $relation) {
        $movie_id = $relation[0];
        foreach ($relation[1] as $category_id) {
            $stmt->execute([
                ':movie_id' => $movie_id,
                ':category_id' => $category_id
            ]);
        }
    }
    echo "Associations films-catégories créées.\n";

    // Association des films avec les acteurs
    $movieActors = [
        [1, [1, 'Rhett Butler'], [2, 'Scarlett O\'Hara'], [3, 'Ashley Wilkes']],
        [2, [4, 'Jake Sully'], [5, 'Neytiri'], [6, 'Dr. Grace Augustine']],
        [3, [7, 'Jack Dawson'], [8, 'Rose DeWitt Bukater'], [9, 'Caledon Hockley']],
        [4, [10, 'Rey'], [11, 'Finn'], [12, 'Poe Dameron']],
        [5, [13, 'Iron Man'], [14, 'Captain America'], [15, 'Hulk']],
        [6, [13, 'Iron Man'], [16, 'Thor'], [15, 'Hulk']],
        [7, [17, 'Simba'], [18, 'Mufasa'], [19, 'Scar']],
        [8, [20, 'Anna'], [21, 'Elsa'], [22, 'Olaf']],
        [9, [23, 'Maverick'], [24, 'Rooster'], [25, 'Penny']],
        [10, [26, 'Owen Grady'], [27, 'Claire Dearing'], [28, 'Vic Hoskins']],
        [11, [13, 'Iron Man'], [14, 'Captain America'], [15, 'Hulk']],
        [12, [20, 'Anna'], [21, 'Elsa'], [22, 'Olaf']],
        [13, [29, 'Luke Skywalker'], [30, 'Han Solo'], [31, 'Princesse Leia']],
        [14, [32, 'Elliot'], [33, 'Gertie'], [34, 'Keys']],
        [15, [35, 'Qui-Gon Jinn'], [36, 'Obie-Wan Kenobi'], [37, 'Padmé Amidala']],
        [16, [38, 'Frodon Sacquet'], [39, 'Aragorn'], [40, 'Gandalf']],
        [17, [41, 'Harry Potter'], [42, 'Ron Weasley'], [43, 'Hermione Granger']],
        [18, [41, 'Harry Potter'], [42, 'Ron Weasley'], [43, 'Hermione Granger']],
        [19, [41, 'Harry Potter'], [42, 'Ron Weasley'], [43, 'Hermione Granger']],
        [20, [41, 'Harry Potter'], [42, 'Ron Weasley'], [43, 'Hermione Granger']]
    ];

    $stmt = $pdo->prepare("INSERT INTO movie_actors (movie_id, actor_id, role) VALUES (:movie_id, :actor_id, :role)");
    foreach ($movieActors as $relation) {
        $movie_id = $relation[0];
        for ($i = 1; $i < count($relation); $i++) {
            $actor_data = $relation[$i];
            $stmt->execute([
                ':movie_id' => $movie_id,
                ':actor_id' => $actor_data[0],
                ':role' => $actor_data[1]
            ]);
        }
    }
    echo "Associations films-acteurs créées.\n";

    echo "Base de données peuplée avec succès!\n";
} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}

$pdo = null;
