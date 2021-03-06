<?php
    class manipulationBDD
    {
        public function Connexion()
        {
            try{
                $base = new PDO('mysql:host=127.0.0.1; dbname=ressources_relationnelles', 'root', '');
                $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connexion ok. </br>";
            }
            catch(Exeption $e){
                die('Erreur :' . $e->getMessage());
            }
        }
        // Méthode pour ajouter une ressource dans la BDD
        public function ajouterDonnees($var_titre, $var_date_ajout, $var_chemin, $var_description, $var_categories, $var_ressources, $var_relations)
        {
            $return = "";
            $requete_insert =  "INSERT INTO ressource (titre, description, date, typeCategorie, typeRessource, typeRelation, cheminImage)
            VALUES ('" . $var_titre . "', '" . $var_description . "', '" . $var_date_ajout . "', '" . $var_categories . "', '" . $var_ressources . "', '" . $var_relations . "', '" . $var_chemin . "');";

            $return = $return . "</br> La requete ici : " . $requete_insert . "</br>";
            $return = $return . $base->exec($requete_insert);
            return $return;
        }
        // Méthode pour afficher les titres des resosurces
        public function afficheDonnees()
        {
            $base = new PDO('mysql:host=127.0.0.1; dbname=ressources_relationnelles', 'root', '');
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Affiche le titre de l'article ainsi que sa date de création
            try{
            $requete = $base->query('SELECT idRessource, titre, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS date_ajout_fr FROM ressource ORDER BY date DESC;');
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
            
            // Chaque titre est cliquable et redirige vers sa ressource
            while($donnee = $requete->fetch())
            {
                echo '<a href="affichage_ressource.php?ressource=' . $donnee['idRessource'] . '" >' . $donnee['titre'] . '</a>';
                echo "</br> le " . $donnee['date_ajout_fr'] . " </br>";
                echo "______________________________________________________________</br></br>";
            }
            $requete->closeCursor();
        }
    }
    
$mManipulationBDD = new manipulationBDD();
 ?>