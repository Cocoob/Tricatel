<?php 
    require_once 'config.php';

    if(!empty($_POST['email'])){
        $email = htmlspecialchars($_POST['email']);

        $check = $dbco->prepare('SELECT token FROM connexion WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        if($row){
            $token = bin2hex(openssl_random_pseudo_bytes(24));
            $token_user = $data['token'];

            $insert = $dbco->prepare('INSERT INTO mdp_oublie(token_user, token) VALUES(?,?)');
            $insert->execute(array($token_user, $token));

            $link = 'recover.php?u='.base64_encode($token_user).'&token='.base64_encode($token);

            echo "<a href='$link'>Lien</a>";
        }else{
            echo "Compte non existant";
            #header('Location: index.php');
            #die();
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
          <div class="col-11">
              <div class="card text-center m-4 shadow p-3 mb-5 bg-white rounded">
                <div class="card-body">
                  <h4 class="card-title p-3">J'ai oublié mon mot de passe</h4>
                    <div class="form-group">
                        <form action="forgot.php" method="POST">
                            <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required />
                            <button type="submit" class="btn btn-primary btn-lg m-3">Envoyer</button>
                        </form>
                    </div>
                </div>
              </div>
          </div>
      </div>
</body>
</html>

