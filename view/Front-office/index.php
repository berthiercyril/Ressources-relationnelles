<?php
    session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ressources Relationnelles</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../css/indexStyle.css">
    </head>
    <body>

        
        <div class="topnav">
            <a class="active" href="index.php">Accueil</a>
            <a href="catalogue.php">Catalogue</a>
            <?php
                if (!empty($_SESSION['username'])) // Le visiteur est connecté
                {
                    echo '<a href="mesRessources.php">Mon Catalogue</a>';
                    echo '<a href="creation.php">Créer une ressource</a>';
                    
                    echo '<a class="deconnexion" href="../../controller/deconnexion.php"><img src="../../images/deconnexion.svg" title="imageDeconnexion"></a>';
                    echo '<a class="connexion" href="profil.php">Mon profil</a>';
                    if ($_SESSION['idTypeCompte'] != 4) {
                        echo '<a class="connexion" href="../Back-office/BO_index.php">Admin</a>';
                    }
                }
                else // Le visiteur n'est pas connecté
                {
                   // echo 'vous n\'êtes pas connecté.';
                    echo '<a class="connexion" href="login.php">Connexion</a>';
                    echo '<a class="connexion" href="register.php">Inscription</a>';
                }
            ?>
            
        </div>
        <br>
        <h1>Ressources Relationnelles</h1>
        
        <div id="logo" >
            <img src="../../images/Logo-removebg.png">
        </div>
        
        <script src="" async defer></script>

        
    </body>
</html>