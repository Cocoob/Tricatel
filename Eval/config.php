<?php


$DB_NAME = 'tricatel';
$DB_USER = 'root';
$DB_PASSWORD = 'root';


// Création BDD
try
{
    $dbco = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
    $dbco->exec($sql);
}
catch(PDOException $e)
{
    echo "Erreur : " . $e->getMessage();
}

// Création table

try
{
    $dbco = new PDO("mysql:host=localhost;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS plat(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(225) NOT NULL,
        photo BLOB NULL,
        type VARCHAR(225) NOT NULL,
        description VARCHAR(225) NOT NULL,
        continent VARCHAR(225) NOT NULL,
        categorie VARCHAR(225) NOT NULL
        )";
    
    $sql2 = "CREATE TABLE IF NOT EXISTS connexion(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(225) NOT NULL,
        mdp Text NOT NULL
        )";
    
    
    $dbco->exec($sql);
    $dbco->exec($sql2);

}
catch(PDOException $e)
{
    echo "Erreur : " . $e->getMessage();
}



