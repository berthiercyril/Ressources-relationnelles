<?php
    session_start();
    include('../model/manipulationBDD.php');

    if(isset($_POST['activer']))   // on verifie que les chanps ne soient pas vides
    {
        // instanciation de l'objet
        $utilisateur = new manipulationBDD();
        // modification de la ressource dan la BDD
        $utilisateur->activerUtilisateur($_GET['utilisateur'], $conn);
        header('location: ../view/Back-office/BO_gestion_compte.php?filtre=1'); // on redirige vers la bonne ressource grâce à l'id qu'on a dans l'url
    }
    elseif (isset($_POST['desactiver'])) {
        // instanciation de l'objet
        $utilisateur = new manipulationBDD();
        // modification de la ressource dan la BDD
        $utilisateur->desactiverUtilisateur($_GET['utilisateur'], $conn);
        header('location: ../view/Back-office/BO_gestion_compte.php?filtre=1'); // on redirige vers la bonne ressource grâce à l'id qu'on a dans l'url
    }
    else{
        echo'erreur';
     }
 ?>