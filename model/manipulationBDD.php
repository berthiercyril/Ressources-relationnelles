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
        public function ajouterDonneesImg($var_titre_ressource, $var_date_ajout, $var_chemin, $var_description, $var_categories, $var_ressources, $var_relations, $conn)
        {
            $return = "";
            //gitvar_dump($_SESSION['idUser']);
            $requete_insert =  "INSERT INTO ressources (titre_ressource, description_ressource, date_creation_ressource, chemin_document, id_utilisateur, id_categories, id_type, id_relation_ressource, id_statut)
            VALUES ('" . $var_titre_ressource . "', '" . $var_description . "', '" . $var_date_ajout . "', '" . $var_chemin . "', '".$_SESSION['idUser']."', '" . $var_categories . "', '" . $var_ressources . "', '" . $var_relations . "', 3);";

            $return = $return . "</br> La requete ici : " . $requete_insert . "</br>";
            $return = $return . $conn->exec($requete_insert);
            return $return;
        }
        public function ajouterDonnees($var_titre_ressource, $var_date_ajout, $var_description, $var_categories, $var_ressources, $var_relations, $conn)
        {
            $return = "";

            
            $requete_insert =  "INSERT INTO ressources (titre_ressource, description_ressource, date_creation_ressource, id_categories, id_type, id_relation_ressource, id_utilisateur)
            VALUES ('" . $var_titre_ressource . "', '" . $var_description . "', '" . $var_date_ajout . "', '" . $var_categories . "', '" . $var_ressources . "', '" . $var_relations . "', '".$_SESSION['idUser']."');";

            $return = $return . "</br> La requete ici : " . $requete_insert . "</br>";
            $return = $return . $conn->exec($requete_insert);
            return $return;
        }
        // Méthode pour afficher les titre_ressources des resosurces
        public function afficheDonnees($conn)
        {
            // Affiche le titre_ressource de l'article ainsi que sa date de création
            try{
            $requete = $conn->query('SELECT id_ressource, description_ressource, titre_ressource, DATE_FORMAT(date_creation_ressource, \'%d/%m/%Y\') AS date_creation_ressource FROM ressources ORDER BY date_creation_ressource DESC;');
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
            
            return $requete;
            $requete->closeCursor();
        }

        public function afficheMesRessources($conn)
        {

            // Affiche le titre_ressource de l'article ainsi que sa date de création
            try{
                $requete = $conn->query('SELECT id_ressource, titre_ressource, DATE_FORMAT(date_creation_ressource, \'%d/%m/%Y\') AS date_creation_ressource FROM ressources WHERE id_utilisateur= '.$_SESSION['idUser'].' ORDER BY date_creation_ressource DESC;');
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }

                return $requete;
                $requete->closeCursor();

        }

        public function modifierRessources($var_id_ressource, $var_titre, $var_description, $var_id_type, $var_id_categories, $var_id_relation_ressource, $conn){
            $requete = ("UPDATE ressources SET titre_ressource='".$var_titre."', description_ressource='".$var_description."', id_type='".$var_id_type."', id_categories='".$var_id_categories."', id_relation_ressource='".$var_id_relation_ressource."' WHERE id_ressource='".$var_id_ressource."'");
            $conn->exec($requete);
        }

        public function supprimerRessources($var_id_ressource, $conn){
            $requete = ("DELETE FROM ressources WHERE id_ressource = '".$var_id_ressource."'");
            $conn->exec($requete);
        }

        public function ajouterCommentaire($auteur, $commentaire, $id_ressource, $conn)
        {
            $dateCommentaire = date('Y-m-d H:i:s');
            $res = $conn->query("INSERT INTO commentaires (id_ressource, id_utilisateur, commentaire, date_creation_commentaire) VALUES ('$id_ressource', '".$auteur."', '".$commentaire."', '".$dateCommentaire."')");
        }

        public function afficherCommentaire($conn)
        {
            // Récupération des commentaires
            $req = $conn->prepare('SELECT nom, prenom, commentaire, DATE_FORMAT(date_creation_commentaire, \'%d/%m/%Y à %H:%i\') AS date_creation_commentaire FROM commentaires, utilisateur WHERE utilisateur.id_utilisateur=commentaires.id_utilisateur AND id_ressource = ? ORDER BY date_creation_commentaire DESC');
            $req->execute(array($_GET['ressource']));

            while ($donnees = $req->fetch())
            {
            ?>
            <!-- <div class="container"> -->
            <p><strong><?php echo htmlspecialchars($donnees['prenom']. ' ' .$donnees['nom']); ?></strong> le <?php echo $donnees['date_creation_commentaire']; ?></p>
            <p><?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?></p>
            <hr class="solid">
            <!-- </div> -->
            <?php 
            } // Fin de la boucle des commentaires
            $req->closeCursor();
        }

        
        public function verificationLogin($conn, $mail, $password)
        {
            $req = $conn->query("SELECT id_utilisateur, mdp, nom, prenom FROM utilisateur WHERE mail = '$mail'");
                //$req = $conn->query("SELECT COUNT(id_user) AS countIdUser, id_user FROM utilisateur WHERE mail = '" . $username . "' AND mdp = '" . $password ."' ");
            $res = $req->fetch();
            //print_r($res);
            $hashed_password = $res['mdp'];
            echo "Password = ". $password . " | hashed_password = ". $hashed_password;
            if(password_verify($password, $hashed_password))
            {
                $_SESSION['username'] = $mail;
                $_SESSION['idUser'] = $res['id_utilisateur'];
                $_SESSION['Nom'] = $res['nom'];
                $_SESSION['Prenom'] = $res['prenom'];
                header('Location: ../view/Front-office/index.php');
                
            }else
            {
                header('Location: ../view/login.php?erreur=1'); // utilisateur ou mdp incorrect
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
            $req = $conn->query("INSERT INTO utilisateur (mail, mdp, nom, prenom, id_type_compte, verifie) VALUES ('" . $mail . "', '" . $hash . "', '" . $nom . "', '" . $prenom . "', 4, 0);");
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

            $sql = $conn->query("SELECT lib_type, id_type FROM  type_ressources ");   
            return $sql;
        }

        public function affichageTypeCategories($conn)
        {

            $sql = $conn->query("SELECT lib_categories, id_categories FROM  categories_ressources ");   
            return $sql;
        }

        public function affichageTypeRelations($conn)
        {

            $sql = $conn->query("SELECT lib_type_relation, id_relation_ressource FROM  type_relation_ressource ");   
            return $sql;
        }

        public function affichageNombreRessources($conn)
        {
            //$sql = $conn->query('SELECT count(id_ressource) FROM ressource WHERE idUser= '.$_SESSION['idUser'].'');
            try{
                $sql = $conn->query('SELECT count(id_ressource) FROM ressources WHERE id_utilisateur= '.$_SESSION['idUser'].'');
                }
                catch(PDOException $e){
                    die($e->getMessage());
                }
                $count = $sql->fetchColumn();
                return $count;
        }
        public function modifierUtilisateur($conn, $mail, $nom, $prenom)
        {
            try{
                $req = $conn->query("UPDATE utilisateur SET mail ='" . $mail . "', nom = '" . $nom . "', prenom = '" . $prenom . "' WHERE id_utilisateur= '" . $_SESSION['idUser'] . "'  ");
            }
            catch(PDOException $e){
                die($e->getMessage());
            }
        }


    }
 ?>