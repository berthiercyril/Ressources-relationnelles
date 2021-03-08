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
            <a class="connexion" href="login.php">Connexion</a>
            <a class="active connexion" href="#">Inscription</a>
            <a href="catalogue.php">Catalogue</a>
        </div>

        <div id="container">
            <form action="../ajoutUtilisateur.php" method="POST">
                <h1>Inscription</h1>

                <div>
                    <input type="text" placeholder="Nom"  class="inscription" name="nom" required>
                </div>
                <div>
                    <input type="text" placeholder="Prénom"  class="inscription" name="prenom" required>
                </div>
                <div>
                    <input type="email" placeholder="Email"  class="inscription" name="mail" required>
                </div>
                <div>
                    <input type="password" placeholder="Mot de passe"  class="inscription" name="password" required>
                </div>
                <input type="submit" id="submit" value="Inscription" class="button">
            </form>
        </div>
        
        <script src="" async defer></script>
    </body>
</html>