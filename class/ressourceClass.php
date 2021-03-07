<?php

    Class Ressource
    {
        private $titre;
        private $description;
        private $categories;
        private $ressources;
        private $relations;

        public function __construct($titre,$description,$categories,$ressources,$relations)
        {
            $this->titre=$titre;
            $this->description=$description;
            $this->categories=$categories;
            $this->ressources=$ressources;
            $this->relations=$relations;
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
            $this->description=$description;    //ecrire la description
        }

        public function getcategories()
        {
            return $this->categories;    //lire categorie
        }

        public function setcategories()
        {
            $this->categories=$categories;    //ecrire la categorie
        }
        public function getressources()
        {
            return $this->ressources;    //lire ressource
        }

        public function setressources()
        {
            $this->ressources=$ressources;    //ecrire la ressource
        }
        public function getrelations()
        {
            return $this->relations;    //lire relations
        }

        public function setrelations()
        {
            $this->relations=$relations;    //ecrire la relation
        }
        public function AjouterRessource($titre, $description,$conn)
        {
            $date= date('y/m/d H:i:s'); // Initialisation de l'heure
            $photo = $_FILES['fileselect']['name']; // on récupere le nom de l'image
            $cheminImage = "../images/".$photo; // on stock le chemin de l'image
        $requete = "INSERT INTO ressource values ('','".$this->titre."','".$this->description."','".$date."','".$this->categories."','".$this->ressources."','".$this->relations."','".$cheminImage."')";
           $conn -> exec($requete);
        //$res = $conn->query("INSERT INTO ressource values ('','".$this->titre."','".$this->description."','".$date."','".$this->categories."','".$this->ressources."','".$this->relations."','".$cheminImage."')"); // requete pour enregistrer les infos de l'article dans la bdd
            echo "L'article à bien été publié.";
            
        }

        public function SauvImage()
        {
            $photo = $_FILES['fileselect']['name']; // on récupere le nom de l'image
            $Chemin_image = "images/".$photo;   // on stock le chemin de l'image
        
            move_uploaded_file($_FILES['fileselect']['tmp_name'],$Chemin_image);   // on place l'image dans le dossier $Chemin_image
    
        }

        public function AffichageRessource($conn)
        {

            $sql = $conn->query("Select titre, description, date, typeCategorie, typeRessource, typeRelation, cheminImage FROM ressource order by idRessource DESC");    // Selection de tout les articles, du plus récent au plus anciens
            $_SESSION['sql']= $sql;   //Passage du tableau en variable globale

        }
    }


?>