<?php
if (!isset($_GET["id"])) {
    echo "Erreur 404";
    die;
}
$id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
if (!$id) {
    echo "Ce n'est pas un nombre";
    die;
}

require "./config/database.php";

$req = $bdd->prepare("SELECT 
    movies.*, GROUP_CONCAT(CONCAT_WS(' ', actors.first_name, actors.last_name)) AS actors  
    FROM movies
	JOIN movie_actors ON movie_actors.movie_id = movies.id 
    JOIN actors ON movie_actors.actor_id = actors.id
    WHERE movies.id = :id
    GROUP BY movies.id");
$req->bindParam(":id", $id, PDO::PARAM_INT);
$req->execute();
$movie = $req->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    echo "Ce n'est pas un film";
    die;
}

$movie["actors"] = explode(",", $movie["actors"]);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <h1>Catalogue de films</h1>
        <p>Découvrez les 20 films les plus regardés de tous les temps</p>
    </header>
    <main>
        <h1><?php echo $movie["title"]; ?></h1>
    </main>
    <footer>
        <p>
            2026 - Catalogue de films - Tous droits reservés
        </p>
    </footer>
</body>

</html>