<?php
    session_start();
    include('../model/manipulationBDD.php');

    if(isset($_POST['filtrer']))   // on verifie que les chanps ne soient pas vides
    {
        // instanciation de l'objet
        $ressource = new manipulationBDD();
        // modification de la ressource dan la BDD
        $ressource->filtrerRessources($_POST['categories'], $_POST['relations'], $_POST['ressources'], $conn);
        header('location: ../view/Back-office/BO_liste_ressources.php?filtre=1'); // on redirige vers la bonne ressource grâce à l'id qu'on a dans l'url
        echo'test';
    }
    else{
        echo'erreur';
     }
 ?>