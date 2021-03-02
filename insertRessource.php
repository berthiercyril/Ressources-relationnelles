<?php
    //session_start();
    include('class/ressourceClass.php');
    //include('verification.php');
    include('config.php');


    if(isset($_POST['submit']))
    {
    // instanciation de l'objet
    $ressource = new ressource($_POST['titre'], $_POST['description']);
    // Ajout de la ressource dans la BDD
    $ressource->AjouterArticle($_POST['titre'], $_POST['description'],$conn);
    // On place l'image dans le dossier Images
    $ressource->SauvImage();

    }

    else
    {
        echo "Erreur !";
        var_dump(isset($_POST['submit']));   
    }

 ?>