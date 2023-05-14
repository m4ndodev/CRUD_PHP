<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'crud';
$user = 'root';
$password = 'test404@';
$charset = 'utf8';

// Connexion à la base de données
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $password);
    // Configuration des options de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur, afficher le message d'erreur et arrêter le script
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit();
}
?>