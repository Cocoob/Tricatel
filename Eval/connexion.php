<?php
session_start();
require_once 'config.php';

if (!empty($_POST['nom']) && !empty($_POST['password'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $password = htmlspecialchars($_POST['password']);

    $check = $dbco->prepare('SELECT nom, mdp, email FROM connexion WHERE nom = ?');
    $check->execute(array($nom));
    $data = $check->fetch();
    $row = $check->rowCount();

    if ($row == 1) {
        if ($nom = $data['nom']) {

            if (password_verify($password, $data['mdp'])) {
                $_SESSION['user'] = $data['nom'];
                header('Location: landing.php');
                die();
            } else {
                header('Location: admin.php?login_err=password');
                die();
            }
        } else {
            header('Location: admin.php?login_err=email');
            die();
        }
    } else {
        header('Location: admin.php?login_err=already');
        die();
    }
}
