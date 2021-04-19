<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location:landing.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/admin.css">
    <title>Connexion espace administrateur - Tricatel</title>
</head>

<body>
    <header>
        <nav>
            <div class="navbar">
                <span class="space"></span>
                <div class="navbar-logo">
                    <img src="Images/logo.jpg" alt="logo tricatel">
                </div>
                <h3>Tricatel</h3>
                <div class="navbar-link">
                    <ul>
                        <li>
                            <a href="index.php">Accueil</a>
                        </li>
                        <span>|</span>
                        <li>
                            <a href="admin.php">Espace admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="cover"></div>
        <div class="login-form">
            <?php
            if (isset($_GET['login_err'])) {
                $err = htmlspecialchars($_GET['login_err']);

                switch ($err) {
                    case 'password':
            ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> mot de passe incorrect
                        </div>
                    <?php
                        break;
                    case 'already':
                    ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> compte non existant
                        </div>
            <?php
                        break;
                }
            }
            ?>
            <form action="connexion.php" method="post">
                <h2 class="text-center">Espace administrateur</h2>
                <div class="form-group">
                    <label for="email">Nom</label>
                    <input type="text" name="nom" class="form-control" placeholder="Entrez votre nom" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Se connecter</button>
                </div>
                <a href="forgot.php">Mot de passe oublié ?</a>
            </form>
        </div>
    </header>

</body>

</html>