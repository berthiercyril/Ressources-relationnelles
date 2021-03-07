<?php
    include('manipulationBDD.php');
    include('config.php');
    if(($_POST['auteur'] !== '' && $_POST['commentaire'] !== ''))   // on verifie que les chanps ne soient pas vides
    {
        // instanciation de l'objet
        $commentaire = new manipulationBDD();
        // ajout du commentaire dans la BDD
        $commentaire->ajouterCommentaire($_POST['auteur'], $_POST['commentaire'], $_GET['ressource'], $conn);

        header('location: view/affichage_ressource.php?ressource=' . $_GET["ressource"] . ''); // on redirige vers la bonne ressource grâce à l'id qu'on a dans l'url
        echo'test';
    }

    else{
       
    }
?>