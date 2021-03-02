<?php

    Class Ressource
    {
        private $titre;
        private $description;

        public function __construct($titre,$description)
        {
            $this->titre=$titre;
            $this->description=$description;
        }

        public function gettitre()
        {
            return $this->titre;    //lire titre
        }

        public function settitre()
        {
            $this->titre=$titre;    //ecrire le titre
        }

        public function getdescription()
        {
            return $this->description;    //lire description
        }

        public function setdescription()
        {
            $this->description=$description;    //ecrire le description
        }

        public function AjouterArticle($titre, $description,$conn)
        {
            $date= date('d/m/y H:i:s'); // Initialisation de l'heure
            $photo = $_FILES['fileselect']['name']; // on récupere le nom de l'image
            $cheminImage = "Images/".$photo; // on stock le chemin de l'image
            $res = $conn->query("INSERT INTO ressource values ('','".$this->titre."','".$this->description."','".$date."','','','','".$cheminImage."')"); // requete pour enregistrer les infos de l'article dans la bdd
            echo "L'article à bien été publié.";
        }

        public function SauvImage()
        {
            $photo = $_FILES['fileselect']['name']; // on récupere le nom de l'image
            $Chemin_image = "Images/".$photo;   // on stock le chemin de l'image
        
            move_uploaded_file($_FILES['fileselect']['tmp_name'],$Chemin_image);   // on place l'image dans le dossier $Chemin_image
    
        }
    }


?>