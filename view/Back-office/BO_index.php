<?php
    session_start();
    if(empty($_SESSION['idTypeCompte'])){
        header('Location: BO_login.php');
    }
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

    </head>
    <body>
        <?php include('navbar.php')?>
        <h1 class="text-center">Ressources Relationnelles</h1>
        
        <div id="logo" >
            <img class="mx-auto d-block" src="../../images/Logo-removebg.png">
        </div>
        <script src="" async defer></script>

        
    </body>
</html>