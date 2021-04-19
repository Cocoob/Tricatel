<?php
session_start();
require_once 'config.php';
// Création admin

try {
    $dbco = new PDO("mysql:host=localhost;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nom = 'coco';
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    $cost = ['cost' => 12];
    $password = password_hash('salut', PASSWORD_BCRYPT, $cost);
    $email = 'coco@coco.fr';



    $insert = "INSERT INTO connexion(nom,mdp,email,token) VALUES('$nom','$password','$email','$token')";
    $dbco->exec($insert);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
