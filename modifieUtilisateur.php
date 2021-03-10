<?php
    include('config.php');
    include('manipulationBDD.php');
    
    if(isset($_POST['mail']) && isset($_POST['nom']) && isset($_POST['prenom']))
    {
        $MODIFIER =new manipulationBDD();
        $connexion = $MODIFIER->Connexion($conn);
        
        $mail = $_POST['mail'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        if($mail !== "" && $nom !== "" && $prenom !== "")
        {      

            
            if($MODIFIER->modifierUtilisateur($conn, $mail, $nom, $prenom))
            {
                echo "Une erreur est survenue lors de la modification des données.";
            }
            else
            {
                header('Location: view/profil.php?succes=1'); // Données modifiées
            }
        }
    }