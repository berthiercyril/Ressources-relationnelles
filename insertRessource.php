<?php
    session_start();
    include('manipulationBDD.php');
    include('config.php');
    //echo "Ca bloque 1";
    //var_dump($_FILES['fileselect']);
    // Si tous les champs sont rentrés
    if(isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['categories']) && isset($_POST['ressources']) && isset($_POST['relations']) && isset($_FILES['fileselect']))
    {
        $insertionImg = new manipulationBDD();
        $insertionImg->Connexion($conn);
        echo "Ca bloque 2";
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $categorie = $_POST['categories'];
        $ressources = $_POST['ressources'];
        $relations = $_POST['relations'];
        $image = $_FILES['fileselect'];

        $date = date("YmdHis");

        if($titre !== "" && $description !== "" && $categorie !== "" && $ressources !== "" && $relations !== "" && $image !== "")
        {
            //echo var_dump($_FILES);
            $repertoireDestination = 'images/'.$date.basename($_FILES['fileselect']['name']);
            $_SESSION['nom_image'] = '../'.$repertoireDestination;
            
            if(move_uploaded_file($_FILES['fileselect']['tmp_name'], $repertoireDestination))
            {
                echo "Le fichier temporaire " . $_FILES['fileselect']['name'] . " a été déplacé vers " . $repertoireDestination . ".</br>";
            }
            else
            {
                echo "Le fichier n'a pas été trouvé, déplacement échoué...</br>";
            }

            echo "On va jouter la ressource avec image</br>";
            if($insertionImg->ajouterDonneesImg($titre, $date, $repertoireDestination, $description, $categorie, $ressources, $relations, $conn))//Ajouter $conn
            {
                echo "Ajout";
                                header('Location: view/mesRessources.php');
            }
            else
            {
                echo "Echec de l'ajout";
            }
        }
        /*elseif($titre !== "" && $description !== "" && $categorie !== "" && $ressources !== "" && $relations !== "")
        {
            echo "On va jouter la ressource sans image</br>";
            if($insertion->ajouterDonnees($titre, $date, $description, $categorie, $ressources, $relations))//Ajouter $conn
            {
                echo "Ajout";
                header('Location:resultatInsertion.php');
            }
            else
            {
                echo "Echec de l'ajout";
            }
        }*/
        else
        {
            echo "Ca passe pas dans les boucles...";
        }



    }
    elseif(isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['categories']) && isset($_POST['ressources']) && isset($_POST['relations']))
    {
        
        $insertion = new manipulationBDD();
        $insertion->Connexion($conn);

        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $categorie = $_POST['categories'];
        $ressources = $_POST['ressources'];
        $relations = $_POST['relations'];
        $date = date("YmdHis");
        if($titre !== "" && $description !== "" && $categorie !== "" && $ressources !== "" && $relations !== "")
        {
            echo "On va ajouter une ressource sans l'image</br>";
            if($insertion->ajouterDonnees($titre, $date, $description, $categorie, $ressources, $relations, $conn))//Ajouter $conn
            {
                echo "Ajout";
                             //header('Location:view/resultatInsertion.php');
            }
            else
            {
                echo "Echec de l'ajout";
            }

        }
    }




?>