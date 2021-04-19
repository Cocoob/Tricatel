<?php 
    session_start();
	require_once 'config.php';
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }

    // Bouton delete
    if (isset($_GET['action']) && $_GET['action'] == 'delete')
    {
        $stmt = $dbco->prepare('DELETE from plat WHERE nom = :nom');
        $stmt->bindValue('nom',$_GET['nom']); 
        $stmt->execute();
        header('Location:landing.php');
        die();
    }

    // Afficher data table
    $stmt = $dbco->prepare('SELECT * FROM plat');
    $stmt->execute();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/crud.css">
    <title>Espace administrateur - Tricatel</title>
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
        <!-- Crud -->
        <div class="crud">
            <div class="add">
                <a href="add_plat.php">Ajouter un plat</a>
            </div>
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Continent</th>
                    <th>Catégorie</th>
                    <th>Action</th>
                </tr>
                <?php while($plat  = $stmt->fetch(PDO::FETCH_OBJ )) {?>
                <tr>
                    <td> <?php echo $plat->nom; ?> </td>
                    <td class="image"> <img src="<?php echo $plat->photo; ?>" alt=""> </td>
                    <td class="type"><?php echo $plat->type; ?> </td>
                    <td><?php echo $plat->description; ?> </td>
                    <td><?php echo $plat->continent; ?> </td>
                    <td><?php echo $plat->categorie; ?> </td>
                    <td class="act">
                        <div class="act-link">
                            <a class="delete" href="landing.php?nom=<?php echo $plat->nom ?>&action=delete">Supprimer</a>
                            <a class="edit" href="edit.php?nom=<?php echo $plat->nom ?>">Modifier</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </header>
</body>