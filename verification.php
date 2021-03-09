<?php
    include('config.php');
    include('manipulationBDD.php');
    session_start();
    
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        
        $VERIF = new manipulationBDD();
        $VERIF->Connexion($conn);
        // On applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        //$prenom = htmlspecialchars($_POST['prenom']);
                /*$mail = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);*/
        $mail = $_POST['username'];
        $password = $_POST['password'];

        if($mail !== "" && $password !== "")
        {
            //$hash = $VERIF->hashPassword($password);
            
            $VERIF->verificationLogin($conn, $mail, $password);
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
?>