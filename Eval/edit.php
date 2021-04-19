<?php
    session_start();
    require_once 'config.php';

    $stmt = $dbco->prepare('SELECT * from plat WHERE nom = :nom');
    $stmt->bindValue('nom', $_GET['nom']);
    $stmt->execute();
    $plat = $stmt->fetch(PDO::FETCH_OBJ);

    if(isset($_POST['save']))
    {
        $stmt = $dbco->prepare('UPDATE plat SET nom = :nom, photo = :photo, type = :type, description = :description, continent = :continent, categorie = :categorie WHERE id = :id');
        $stmt->bindValue('id', $_POST['id']);
        $stmt->bindValue('nom',$_POST['nom']);
        $stmt->bindValue('photo',$_POST['photo']);
        $stmt->bindValue('type',$_POST['type']);
        $stmt->bindValue('description',$_POST['description']);
        $stmt->bindValue('continent',$_POST['continent']);
        $stmt->bindValue('categorie',$_POST['categorie']);
        $stmt->execute();

        header('Location:landing.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/edit.css">
    <title>Modifier un plat - Tricatel</title>
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
                            <a href="deconnexion.php">Déconnexion</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="editer">
            <form method="post" autocomplete="off">
                <fieldset>
                    <legend>
                        Modifier plats
                    </legend>         
                    <label>Nom</label>
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control"  value="<?php echo $plat->id; ?>">
                    </div>  
                    <div class="form-group">
                        <input type="text" name="nom" class="form-control"  value="<?php echo $plat->nom; ?>" placeholder="Entrez le nom du plat" required="required" autocomplete="off">
                    </div>
                    <label>Photo</label>  
                    <div class="form-group">
                        <input type="text" name="photo" class="form-control" value="<?php echo $plat->photo; ?>" placeholder="Entrez le chemin de la photo" required="required" autocomplete="off">
                    </div>
                    <label>Type</label>  
                    <div class="form-group">
                        <input type="text" name="type" class="form-control" value="<?php echo $plat->type; ?>" placeholder="Entrez le type du plat" required="required" autocomplete="off">
                    </div>
                    <label>Description</label>  
                    <div class="form-group">
                        <input type="text" name="description" class="form-control" value="<?php echo $plat->description; ?>" placeholder="Entrez une description" required="required" autocomplete="off">
                    </div>
                    <label>Continent / Pays</label>  
                    <div class="form-group">
                        <input type="text" name="continent" class="form-control" value="<?php echo $plat->continent; ?>" placeholder="Entrez le continent d'origine du plat" autocomplete="off">
                    </div>
                    <label>Catégorie</label>  
                    <div class="form-group">
                        <input type="text" name="categorie" class="form-control" value="<?php echo $plat->categorie; ?>" placeholder="Entrez la catégorie du plat" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="save" value="Update" class="btn">Sauvegarder</button>
                        <a class="back" href="landing.php">Annuler</a>
                    </div>
                </fieldset>
            </form>
        </div>
    </header>
    
</body>
</html>