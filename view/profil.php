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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
        <br>
        <?php 
        $PROFIL = new manipulationBDD();
        $nbRessources = $PROFIL->affichageNombreRessources($conn);
        
        
        ?>
        <h1>Mon profil</h1>
            <div class="modification_profil">
            <h2>Prénom : <?php echo $_SESSION['Prenom']; ?></h2>
            <h2>Nom : <?php echo $_SESSION['Nom']; ?></h2>
            <h2>Mail : <?php echo $_SESSION['username']; ?></h2>
            <h2>Nombre de ressources créées : <?php echo $nbRessources; ?></h2>
        </div>
        <div class="modification_profil">
            <a href="editProfil.php" class="btn btn-primary">Modifier mes infos</a>
        </div>
        <?php 
        if(isset($_GET['succes']))
            {
                $succes = $_GET['succes'];
                if($succes == 1)
                {
                    echo "<p style='color:black'>Vos informations ont bien été mise à jour</p>";
                }
            }
        ?>
        
        

        
    </body>
</html>