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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/indexStyle.css">
    </head>
    <body>
        <div class="topnav">
            <a href="index.php">Accueil</a>
            <!--<a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>-->
            <a class="active" href="#">Catalogue</a>
            <?php
                if (!empty($_SESSION['username'])) // Le visiteur est connecté
                {
                    echo '<a href="mesRessources.php">Mon Catalogue</a>';
                    echo '<a href="creation.php">Créer une ressource</a>';
                    //echo '<a class="connexion" href="../deconnexion.php">Déconnexion</a>';
                    echo '<a class="deconnexion" href="../controller/deconnexion.php"><img src="../images/deconnexion.svg" title="imageDeconnexion"></a>';
                }
                else // Le visiteur n'est pas connecté
                {
                    //echo 'vous n\'êtes pas connecté.';
                    echo '<a class="connexion" href="login.php">Connexion</a>';
                    echo '<a class="connexion" href="register.php">Inscription</a>';
                }
                
            ?>
        </div>
            </br><h1>Catalogue</h1></br></br>
        

        <?php
            include('../model/manipulationBDD.php');
            $mAffiche= new manipulationBDD();

            //echo "<h1>CATALOGUE KEVIN</h1></br></br>";
            $donnee = $mAffiche->afficheDonnees($conn);
            while($row = $donnee->fetch(PDO::FETCH_ASSOC)) :
        ?>
            <div class="list-group">
                <div class="list-group-item list-group-item-action">
                    <a href="affichage_ressource.php?ressource=<?php echo htmlspecialchars($row['idRessource']); ?>"> <?php echo htmlspecialchars($row['titre']); ?></a></br>
                    </br> le <?php echo htmlspecialchars($row['date_ajout_fr']);  ?> </br>
                </div>
            </div>
            <?php endwhile; ?>
    </body>

</html>