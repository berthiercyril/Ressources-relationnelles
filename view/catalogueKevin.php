<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/catalogueStyle.css">
    </head>
    <body>
        <div class="topnav">
            <a href="index.html">Accueil</a>
            <a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>
        </div>
        <h1>Catalogue KEVIN</h1>

        <?php
            include('manipulationBDD.php');
            $mAffiche= new manipulationBDD();

            //echo "<h1>CATALOGUE KEVIN</h1></br></br>";
            $mAffiche->afficheDonnees();
        ?>
    </body>
</html>