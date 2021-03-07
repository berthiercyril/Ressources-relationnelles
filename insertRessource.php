<?php
    include('manipulationBDD.php');
    session_start();
    echo "Ca bloque 1";
    // Si tous les champs sont rentrés
    if(isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['categories']) && isset($_POST['ressources']) && isset($_POST['relations']) && isset($_POST['fileselect']))
    {
        $insertionImg = new manipulationBDD();
        $insertionIMG->Connexion();
        echo "Ca bloque 2";
        $titre = $_POST['titre'];
        $description = $_POST['description'];
        $categorie = $_POST['categories'];
        $ressources = $_POST['ressources'];
        $relations = $_POST['relations'];
        //$image = $_POST['fileselect'];

        $date = date("YmdHis");

        if($titre !== "" && $description !== "" && $categorie !== "" && $ressources !== "" && $relations !== "" && $_FILES !== "")
        {
            echo var_dump($_FILES);
            $repertoireDestination = 'images/'.$date.basename($_FILES['fileselect']['name']);
            $_SESSION['nom_image'] = basename($_FILES['fileselect']['name']);
            
            if(move_uploaded_file($_FILES['fileselect']['name'], $repertoireDestination))
            {
                echo "Le fichier temporaire " . $_FILES['fileselect']['name'] . " a été déplacé vers " . $repertoireDestination . ".</br>";
            }
            else
            {
                echo "Le fichier n'a pas été trouvé, déplacement échoué...</br>";
            }

            echo "On va jouter la ressource avec image</br>";
            if($insertionImg->ajouterDonneesImg($titre, $date, $repertoireDestination, $description, $categorie, $ressources, $relations))//Ajouter $conn
            {
                echo "Ajout";
                header('Location:resultatInsertion.php');
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
        $insertion->Connexion();

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
                header('Location:view/resultatInsertion.php');
            }
            else
            {
                echo "Echec de l'ajout";
            }

        }
    }




?>