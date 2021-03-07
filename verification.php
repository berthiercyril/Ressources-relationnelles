<?php
    session_start();
    
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $db_username = "root";
        $db_password = "";
        $db_name = "ressources_relationnelles";
        $db_host = "127.0.0.1";
        $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
        or die("could not connect to database");

        // On applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $prenom = mysqli_real_escape_string($db, htmlspecialchars($_POST['prenom']));
        $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['username']));
        $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));

        if($mail !== "" && $password !== "")
        {
            $requete = "SELECT count(*) FROM utilisateur WHERE mail = '" . $username . "' AND mdp = '" . $password ."' ";
            $exec_requete = mysqli_query($db, $requete);
            $reponse = mysqli_fetch_array($exec_requete);
            $count = $reponse['count(*)'];
            if($count != 0)
            {
                
                $_SESSION['username'] = $username;
                
                //
                
                //

                //PAGE SI IDENTIFICATION OK
                header('Location: view/indexLog.html');
                ?>

            <!--PAGE SI IDENTIFICATION OK-->

                <?php

            }
            else
            {
                header('Location: view/login.php?erreur=1'); // utilisateur ou mdp incorrect
            }
        }
        else
        {
            header('Location: view/login.php?erreur=2'); // utilisateur ou mdp vide
        }
    }
    else
    {
        header('Location: view/login.php');
        //header('Location: www.google.com');
    }
    mysqli_close($db)
?>