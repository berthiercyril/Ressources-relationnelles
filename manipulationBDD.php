<?php
    include("config.php");
    class manipulationBDD
    {
        public function Connexion($conn)
        {
            try{
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connexion ok. </br>";
            }
            catch(Exeption $e){
                die('Erreur :' . $e->getMessage());
            }
        }
        // Méthode pour ajouter une ressource avec image dans la BDD
        public function ajouterDonneesImg($var_titre, $var_date_ajout, $var_chemin, $var_description, $var_categories, $var_ressources, $var_relations, $conn)
        {
            $return = "";
            $var_chemin = '../'.$var_chemin;
            $requete_insert =  "INSERT INTO ressource (titre, description, date, cheminImage, idUser, id_typeCategorie, id_typeRessource, id_typeRelation)
            VALUES ('" . $var_titre . "', '" . $var_description . "', '" . $var_date_ajout . "', '" . $var_chemin . "', '".$_SESSION['idUser']."', '" . $var_categories . "', '" . $var_ressources . "', '" . $var_relations . "');";

            $return = $return . "</br> La requete ici : " . $requete_insert . "</br>";
            $return = $return . $conn->exec($requete_insert);
            return $return;
        }
        public function ajouterDonnees($var_titre, $var_date_ajout, $var_description, $var_categories, $var_ressources, $var_relations, $conn)
        {
            $return = "";

            
            $requete_insert =  "INSERT INTO ressource (titre, description, date, id_typeCategorie, id_typeRessource, id_typeRelation, idUser)
            VALUES ('" . $var_titre . "', '" . $var_description . "', '" . $var_date_ajout . "', '" . $var_categories . "', '" . $var_ressources . "', '" . $var_relations . "', '".$_SESSION['idUser']."');";

            $return = $return . "</br> La requete ici : " . $requete_insert . "</br>";
            $return = $return . $conn->exec($requete_insert);
            return $return;
        }
        // Méthode pour afficher les titres des resosurces
        public function afficheDonnees($conn)
        {
            // Affiche le titre de l'article ainsi que sa date de création
            try{
            $requete = $conn->query('SELECT idRessource, titre, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS date_ajout_fr FROM ressource ORDER BY date DESC;');
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
            
            // Chaque titre est cliquable et redirige vers sa ressource
            echo '<div class="list-group">';
            while($donnee = $requete->fetch())
            {
                echo '<div class="list-group-item list-group-item-action">';
                    echo '<a href="affichage_ressource.php?ressource=' . $donnee['idRessource'] . '" >' . $donnee['titre'] . '</a></br>';
                    echo "</br> le " . $donnee['date_ajout_fr'] . " </br>";
                    //echo "______________________________________________________________</br></br>";
                echo '</div>';
            }
            echo '</div>';

            $requete->closeCursor();
        }

        public function afficheMesRessources($conn)
        {

            // Affiche le titre de l'article ainsi que sa date de création
            try{
                $requete = $conn->query('SELECT idRessource, titre, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS date_ajout_fr FROM ressource WHERE idUser= '.$_SESSION['idUser'].' ORDER BY date DESC;');
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
                
                // Chaque titre est cliquable et redirige vers sa ressource
                echo '<div class="list-group">';
                while($donnee = $requete->fetch())
                {
                    echo '<div class="list-group-item list-group-item-action">';
                        echo '<a href="affichage_ressource.php?ressource=' . $donnee['idRessource'] . '" >' . $donnee['titre'] . '</a></br>';
                        echo "</br> le " . $donnee['date_ajout_fr'] . " </br>";
                        //echo "______________________________________________________________</br></br>";
                    echo '</div>';
                }
                echo '</div>';
                $requete->closeCursor();

        }

        public function ajouterCommentaire($auteur, $commentaire, $idRessource, $conn)
        {
            $dateCommentaire = date('Y-m-d H:i:s');
            $res = $conn->query("INSERT INTO commentaires (idRessource, auteur, commentaire, dateCommentaire) VALUES ('$idRessource', '".$auteur."', '".$commentaire."', '".$dateCommentaire."')");
        }

        public function afficherCommentaire($conn)
        {
            // Récupération des commentaires
            $req = $conn->prepare('SELECT auteur, commentaire, DATE_FORMAT(datecommentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE idRessource = ? ORDER BY datecommentaire DESC');
            $req->execute(array($_GET['ressource']));

            while ($donnees = $req->fetch())
            {
            ?>
            <div class="commentaires">
            <p><strong><?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?></p>
            <p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
            </div><hr class="solid">
            <?php 
            } // Fin de la boucle des commentaires
            $req->closeCursor();
        }

        
        public function verificationLogin($conn, $mail, $password)
        {
            $req = $conn->query("SELECT id_user, mdp FROM utilisateur WHERE mail = '$mail'");
                //$req = $conn->query("SELECT COUNT(id_user) AS countIdUser, id_user FROM utilisateur WHERE mail = '" . $username . "' AND mdp = '" . $password ."' ");
            $res = $req->fetch();
            //print_r($res);
            $hashed_password = $res['mdp'];
            echo "Password = ". $password . " | hashed_password = ". $hashed_password;
            if(password_verify($password, $hashed_password))
            {
                $_SESSION['username'] = $mail;
                $_SESSION['idUser'] = $res['id_user'];
                header('Location: view/index.php');
            }else
            {
                header('Location: view/login.php?erreur=1'); // utilisateur ou mdp incorrect
            }
            /*if($res['countIdUser'] > 0)
            {
                $_SESSION['mail'] = $mail;
                $_SESSION['idUser'] = $res['id_user'];
                header('Location: view/index.php');
            }
            else
            {
                header('Location: view/login.php?erreur=1'); // utilisateur ou mdp incorrect
            }*/
        }
        public function verifyPassword($password, $hashed_password)
        {
            if(password_verify($password, $hashed_password))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function ajouterUtilisateur($conn, $mail, $hash, $nom, $prenom)
        {
            $req = $conn->query("INSERT INTO utilisateur (mail, mdp, nom, prenom) VALUES ('" . $mail . "', '" . $hash . "', '" . $nom . "', '" . $prenom . "');");
        }
        public function hashPassword($password) 
        {
            $options = [
                'memory_cost' => 1<<17, // 128 Mb
                'time_cost'   => 4,
                'threads'     => 3,
            ];
            $hash = password_hash($password, PASSWORD_ARGON2I, $options);
            return $hash;
        }

        public function affichageTypeRessources($conn)
        {

            $sql = $conn->query("SELECT lib_ressource, id_typeRessource FROM  type_ressources ");   
            return $sql;
        }

        public function affichageTypeCategories($conn)
        {

            $sql = $conn->query("SELECT lib_categorie, id_typeCategorie FROM  type_categories ");   
            return $sql;
        }

        public function affichageTypeRelations($conn)
        {

            $sql = $conn->query("SELECT lib_relation, id_typeRelation FROM  type_relations ");   
            return $sql;
        }


    }
 ?>