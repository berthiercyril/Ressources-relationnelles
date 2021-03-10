<?php
    session_start();
    include('../manipulationBDD.php');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ressources Relationnelles</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/indexStyle.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="topnav">
            <a href="index.php">Accueil</a>
            <a href="catalogue.php">Catalogue</a>
            <?php
                if (!empty($_SESSION['username'])) // Le visiteur est connecté
                {
                    echo '<a href="mesRessources.php">Mon Catalogue</a>';
                    echo '<a href="creation.php">Créer une ressource</a>';
                    echo '<a class="deconnexion" href="../deconnexion.php"><img src="../images/deconnexion.svg" title="imageDeconnexion"></a>';
                    echo '<a class="active connexion" href="profil.php">Mon profil</a>';
                }
                else // Le visiteur n'est pas connecté
                {
                    echo '<a class="connexion" href="login.php">Connexion</a>';
                    echo '<a class="connexion" href="register.php">Inscription</a>';
                }
            ?>
        </div>

        <div id="container">
            <form action="../modifieUtilisateur.php" method="POST">
                <h1>Inscription</h1>

                <div>
                    Nom :<input type="text" value="<?php echo $_SESSION['Nom']?>" class="inscription" name="nom" required>
                </div>
                <div>
                    Prénom :<input type="text" value="<?php echo $_SESSION['Prenom']?>" class="inscription" name="prenom" required>
                </div>
                <div>
                    Adresse mail :<input type="email" value="<?php echo $_SESSION['username']?>" class="inscription" name="mail" required>
                </div>
                <input type="submit" id="submit" value="Modifier" class="button">
            </form>
        </div>

    </body>
</html>