<?php
    if(isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['nom']) && isset($_POST['prenom']))
    {
        $db_username = "root";
        $db_password = "root";
        $db_name = "ressources_relationnelles";
        $db_host = "127.0.0.1";
        $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
        or die("could not connect to database");

        // On applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        $mail = mysqli_real_escape_string($db, htmlspecialchars($_POST['mail']));
        $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['password']));
        $nom = mysqli_real_escape_string($db, htmlspecialchars($_POST['nom']));
        $prenom = mysqli_real_escape_string($db, htmlspecialchars($_POST['prenom']));

        if($mail !== "" && $password !== "" && $nom !== "" && $prenom !== "")
        {
            $requete = "INSERT INTO utilisateur (mail, mdp, nom, prenom) VALUES ('" . $mail . "', '" . $password . "', '" . $nom . "', '" . $prenom . "');";
            $exec_requete = mysqli_query($db, $requete);
            if(!$exec_requete)
            {
                echo "Une erreur est survenue lors de l'insertion des données.";
            }
            else
            {
                header('Location: login.php?succes=1'); // utilisateur ou mdp incorrect
            }
        }
    }