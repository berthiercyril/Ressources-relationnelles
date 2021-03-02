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
        <link rel="stylesheet" href="../css/loginStyle.css">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="topnav">
            <a href="index.html">Accueil</a>
            <a class="active" href="#">Connexion</a>
            <a href="register.php">Inscription</a>
        </div>

        <div id="container">
            <form action="../verification.php" method="POST">
                <h1>Connexion</h1>

                <div class="field-wrap">
                    <label>Adresse mail <span class="req">*</span></label>
                    <input type="email" placeholder="Entrez votre adresse mail" class="case" name="username" required>
                </div>
                <div class="field-wrap">
                    <label>Mot de passe <span class="req">*</span></label>
                    <input type="password" placeholder="Entrez votre mot de passe" class="case" name="password" required>
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
                            echo "<p style='color:white'>Votre compte à été créé avec succès, vous pouvez maintenant vous identifier</p>";
                        }
                    }
                ?>
            </form>
        </div>
        
        <script src="" async defer></script>
    </body>
</html>