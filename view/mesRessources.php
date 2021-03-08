<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/indexStyle.css">
    </head>
    <body>
        <div class="topnav">
            <a href="index.php">Accueil</a>
        <!--<a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>  -->
            <a href="catalogue.php">Catalogue</a>
            <a class="active" href="#">Mon Catalogue</a>
            <?php
                if (!empty($_SESSION['username'])) // Le visiteur est connecté
                {
                    echo '<a href="creation.php">Créer une ressource</a>';
                    echo '<a class="deconnexion" href="../deconnexion.php"><img src="../images/deconnexion.svg" title="imageDeconnexion"></a>';
                }
                else // Le visiteur n'est pas connecté
                {
                    //echo 'vous n\'êtes pas connecté.';
                    echo '<a class="connexion" href="login.php">Connexion</a>';
                    echo '<a class="connexion" href="register.php">Inscription</a>';
                }
            ?>
        </div>
        <h1>Catalogue</h1>

        <?php
            include('../manipulationBDD.php');
            $AfficheMesRessources= new manipulationBDD();

            //echo "<h1>CATALOGUE KEVIN</h1></br></br>";
            $AfficheMesRessources->afficheMesRessources($conn);
        ?>
    </body>
</html>