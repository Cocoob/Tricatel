<?php
session_start();
require_once 'config.php';

$stmt = $dbco->prepare('SELECT * FROM plat');
$stmt->execute();

try {
    $dbco = new PDO("mysql:host=localhost;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if (isset($_POST['search'])) {

        // Afficher plat selon critère
        $stmt = $dbco->prepare('SELECT * from plat WHERE (categorie = :categorie OR categorie IS NULL ) AND (type = :type OR type IS NULL) AND (continent = :continent OR continent IS NULL)');
        $stmt->bindValue('categorie', $_POST['categorie']);
        $stmt->bindValue('continent', $_POST['continent']);
        $stmt->bindValue('type', $_POST['type']);
        $stmt->execute();

        // Afficher tout les plats si filtre vide
        if (isset($_POST['categorie']) && empty($_POST['categorie']) && isset($_POST['continent']) && empty($_POST['continent']) && isset($_POST['type']) && empty($_POST['type'])) {
            $stmt = $dbco->prepare('SELECT * FROM plat');
            $stmt->execute();
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Page d'accueil - Tricatel</title>
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
        <div class="cover-contain">
            <div class="cover-text">
                <div class="cover-title">
                    <h1>Nos meilleurs plats sur commande !</h1>
                </div>
                <div class="cover-description">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio quia velit aspernatur? Tempora id distinctio consequuntur rerum! Similique impedit assumenda, porro consequuntur est inventore eveniet. Iusto obcaecati minus beatae quod?</p>
                </div>
                <div class="cover-link">
                    <a href="#carte-banniere">Voir nos menus</a>
                </div>
            </div>
            <div class="cover-img">
                <img src="Images/restaurant.jpg" alt="restaurant table">
            </div>
        </div>
    </header>

    <!-- Menu -->
    <section class="menu-section">
        <div class="carte-banniere" id="carte-banniere">
            <div class="carte-texte">
                <div class="carte-texte-content">
                    <h2>
                        Menu
                    </h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur rem perferendis optio facere, ea a quae porro labore suscipit atque, laudantium soluta veritatis, expedita consequuntur ipsum quisquam ipsam iure nihil? Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum corporis ducimus a, veritatis aliquid maiores id deserunt quod quae modi iure voluptate pariatur voluptatum possimus minima error. Ipsa, possimus ut.
                    </p>
                    <p class="swipe">Scroll</p>
                </div>
            </div>
            <div class="carte-img">
                <img src="" alt="">
            </div>
        </div>
        <div class="plat-section">
            <div class="plat-title">
                <h2>
                    Découvrez nos neufs plats phares du moment...
                </h2>
            </div>
            <!-- Filtre -->
            <div class="filtre">
                <form method="post" name="filter">
                    <select name="categorie" id="categorie">
                        <option value="">Filtrer par catégorie...</option>
                        <option value="végétarien">Végétarien</option>
                    </select>
                    <select name="continent" id="continent">
                        <option value="">Filtrer par origine...</option>
                        <option value="espagnole">Espagnole</option>
                        <option value="français">Français</option>
                        <option value="italien">Italien</option>
                        <option value="japonais">Japonais</option>
                        <option value="vietnamien">Vietnamien</option>
                    </select>
                    <select name="type" id="type">
                        <option value="">Filtrer par type...</option>
                        <option value="entrée">Entrée</option>
                        <option value="plat">Plat</option>
                        <option value="dessert">Dessert</option>
                    </select>
                    <button type="submit" value="search" name="search">Rechercher</button>
                </form>
            </div>
            <!-- Affichage des plats -->
            <!-- Début boucle -->
            <?php while ($plat  = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                <div class="plat">
                    <div class="plat-img">
                        <img src="<?php echo $plat->photo; ?>" alt="">
                        <p>
                            <?php echo $plat->description; ?>
                        </p>
                    </div>
                    <div class="plat-text">
                        <h3>
                            <?php echo $plat->nom; ?>
                        </h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae vitae enim odit nemo explicabo atque quas, fugiat, in rem voluptas, eligendi necessitatibus accusamus suscipit cumque accusantium temporibus placeat hic porro!
                        </p>
                        <a href="">En savoir plus</a>
                    </div>
                </div>
                <span class="interligne"></span>
            <?php } ?>
            <!-- Fin boucle -->
        </div>
    </section>


</body>

</html>