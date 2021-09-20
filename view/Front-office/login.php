<?php
    session_start();
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
        <link rel="stylesheet" href="../../css/indexStyle.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="topnav">
            <a href="index.php">Accueil</a>
            <a class="active connexion" href="#">Connexion</a>
            <a class="connexion" href="register.php">Inscription</a>
            <a href="catalogue.php">Catalogue</a>
        </div>

        <div id="container">
            <form action="../../controller/verification.php" method="POST">
                <h1>Connexion</h1>
                <div>
                    <input type="email" placeholder="Email" name="username" id="email" required>
                </div>
                <div>
                    <input type="password" placeholder="Mot de passe" name="password" id="password" required>
                </div>
                <input type="submit" id="submit" value="Connexion" class="button">
                <?php
                    if(isset($_GET['erreur']))
                    {
                        $err = $_GET['erreur'];
                        if($err == 1 || $err == 2)
                        {
                            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                        }
                    }
                    elseif(isset($_GET['succes']))
                    {
                        $succes = $_GET['succes'];
                        if($succes == 1)
                        {
                            echo "<p style='color:black'>Votre compte à été créé avec succès, vous pouvez maintenant vous identifier</p>";
                        }
                    }
                ?>
            </form>
        </div>
        
        <script src="" async defer></script>
    </body>
</html>