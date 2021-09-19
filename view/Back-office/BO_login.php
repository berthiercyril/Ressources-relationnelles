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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="../../css/indexStyle.css"> -->
    </head>
    <body>
    <?php include('navbar.php'); ?>

        <div id="container text-center">
            <form action="../../controller/BO_verification.php" method="POST">
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
                        if($err == 3){
                            echo "<p style='color:red'>Vous n'avez pas les droits requis pour vous connecter !</p>";
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