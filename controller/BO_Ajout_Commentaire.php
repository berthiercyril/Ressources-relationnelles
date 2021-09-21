<?php
    session_start();
    include('../model/manipulationBDD.php');

    if(($_POST['commentaire'] !== ''))   // on verifie que les chanps ne soient pas vides
    {
        // instanciation de l'objet
        $commentaire = new manipulationBDD();
        // ajout du commentaire dans la BDD
        // var_dump($_POST['auteur']);
        $commentaire->ajouterCommentaire($_SESSION['idUser'], $_POST['commentaire'], $_GET['ressource'], $conn);

        header('location: ../view/Back-office/BO_affichage_ressource.php?ressource=' . $_GET["ressource"] . ''); // on redirige vers la bonne ressource grâce à l'id qu'on a dans l'url
        echo'test';
    }
    elseif(isset($_POST['supprimer'])) 
    {
        // instanciation de l'objet
        $commentaire = new manipulationBDD();
        // ajout du commentaire dans la BDD
        // var_dump($_POST['auteur']);
        $commentaire->supprimerCommentaire($_GET['ressource'], $conn);

        header('location: ../view/Back-office/BO_affichage_ressource.php?ressource=' . $_GET["ressource"] . ''); // on redirige vers la bonne ressource grâce à l'id qu'on a dans l'url
        echo'test';
    }

    else{
       echo'erreur';
    }
?>