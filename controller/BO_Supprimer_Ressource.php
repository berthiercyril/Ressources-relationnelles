<?php
    session_start();
    include('../model/manipulationBDD.php');

    if(isset($_POST['supprimer']))   // on verifie que les chanps ne soient pas vides
    {
        // instanciation de l'objet
        $ressource = new manipulationBDD();
        // modification de la ressource dan la BDD
        $ressource->supprimerRessources($_GET['ressource'], $conn);
        header('location: ../view/Back-office/BO_liste_ressources.php'); // on redirige vers la bonne ressource grâce à l'id qu'on a dans l'url
        echo'test';
    }

    else{
       echo'erreur';
    }