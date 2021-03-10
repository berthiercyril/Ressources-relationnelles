<?php
    include('config.php');
    include('../model/manipulationBDD.php');
    
    if(isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['nom']) && isset($_POST['prenom']))
    {
        $AJOUT =new manipulationBDD();
        $connexion = $AJOUT->Connexion($conn);
        // On applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
        // pour éliminer toute attaque de type injection SQL et XSS
        /*$mail = $connexion->real_escape_string(htmlspecialchars($_POST['mail']));
        $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
        $nom = mysqli_real_escape_string($conn, htmlspecialchars($_POST['nom']));
        $prenom = mysqli_real_escape_string($conn, htmlspecialchars($_POST['prenom']));*/
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        if($mail !== "" && $password !== "" && $nom !== "" && $prenom !== "")
        {

            
            $hash = $AJOUT->hashPassword($password);
            

            
            if($AJOUT->ajouterUtilisateur($conn, $mail, $hash, $nom, $prenom))
            {
                echo "Une erreur est survenue lors de l'insertion des données.";
            }
            else
            {
                header('Location: ../view/login.php?succes=1'); // utilisateur ajouté
            }
        }
    }