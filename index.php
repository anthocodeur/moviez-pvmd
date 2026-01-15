<?php
// Connexion à la BDD
require "./config/database.php";
// Toute la logique PHP ICI

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue de Films</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <header>
        <h1>Catalogue de films</h1>
        <p>Découvrez les 20 films les plus regardés de tous les temps</p>
    </header>
    <main>
        <p class="count"><span>20 films</span> disponibles dans notre catalogue</p>
        <div class="movies">
            <div class="movie">
                <div class="thumbnail">
                    <img src="./assets/images/movies/gone_with_the_wind.jpg" alt="Gone with the wind">
                    <div class="rating">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="13" height="13"
                            fill="rgba(255,223,23,1)">
                            <path
                                d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z">
                            </path>
                        </svg><span>8.2</span>
                    </div>
                </div>
                <div class="content">
                    <h2>Gone with the Wind</h2>
                    <div class="text">
                        <div class="infos">
                            <div class="year">1939</div>
                            <div class="duration">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM13 12H17V14H11V7H13V12Z">
                                    </path>
                                </svg>
                                <span>238 min</span>
                            </div>
                        </div>
                        <div class="categories">
                            <span>Drame</span>
                            <span>Romance</span>
                            <span>Guerre</span>
                        </div>
                    </div>
                    <a href="detail.html?id=">Voir plus</a>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>
            2026 - Catalogue de films - Tous droits reservés
        </p>
    </footer>
</body>

</html>