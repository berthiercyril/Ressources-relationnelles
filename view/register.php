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
        <link rel="stylesheet" href="../css/registerStyle.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="topnav">
            <a href="index.html">Accueil</a>
            <a href="login.php">Connexion</a>
            <a class="active" href="#">Inscription</a>
        </div>

        <div id="container">
            <form action="../ajoutUtilisateur.php" method="POST">
                <h1>Inscription</h1>

                <div class="field-wrap">
                    <label>Nom <span class="req">*</span></label>
                    <input type="text" placeholder="Entrez votre Nom" class="case" name="nom" required>
                </div>
                <div class="field-wrap">
                    <label>Prénom <span class="req">*</span></label>
                    <input type="text" placeholder="Entrez votre Prénom" class="case" name="prenom" required>
                </div>
                <div class="field-wrap">
                    <label>Adresse mail <span class="req">*</span></label>
                    <input type="email" placeholder="Entrez votre adresse mail" class="case" name="mail" required>
                </div>
                <div class="field-wrap">
                    <label>Mot de passe <span class="req">*</span></label>
                    <input type="password" placeholder="Entrez votre mot de passe" class="case" name="password" required>
                </div>
                <input type="submit" id="submit" value="Inscription" class="button">
            </form>
        </div>
        
        <script src="" async defer></script>
    </body>
</html>