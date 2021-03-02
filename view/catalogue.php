<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h1>Catalogue</h1>
        <a href="index.html?deconnexion=true"><span>Déconnexion</span></a>
        <?php
            session_start();
            if(isset($_GET['deconnexion']))
            {
                if($_GET['deconnexion'] == true)
                {
                    session_destroy();
                    header('Location: login.php');
                }
            }

            if($_SESSION['username'] !== "")
            {
                $user = $_SESSION['username'];
                echo "Bonjour " . $user . " vous êtes connecté !";
            }
            

        ?>
        <script src="" async defer></script>
    </body>
</html>