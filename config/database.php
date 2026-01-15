<?php

// Configuration de la base de données
// Ce fichier centralise les paramètres de connexion à la base de données
// Modifiez ces variables selon votre configuration

$host = 'localhost:3306';
$dbname = 'movie_catalog';
$user = 'root';
$password = '';

// Création de la connexion PDO
try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
