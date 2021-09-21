<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="stylesheet" href="../../css/indexStyle.css">
    </head>
    <body>
        <div class="topnav">
            <a href="index.php">Accueil</a>
            <a href="catalogue.php">Catalogue</a>
            <!--<a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>-->
            <?php
                if (!empty($_SESSION['username'])) // Le visiteur est connecté
                {
                    echo '<a href="mesRessources.php">Mon Catalogue</a>';
                    echo '<a href="creation.php">Créer une ressource</a>';
                    //echo '<a class="connexion" href="../../deconnexion.php">Déconnexion</a>';
                    echo '<a class="deconnexion" href="../../controller/deconnexion.php"><img src="../../images/deconnexion.svg" title="imageDeconnexion"></a>';
                    if ($_SESSION['idTypeCompte'] != 4) {
                        echo '<a class="connexion" href="../Back-office/BO_index.php">Admin</a>';
                    }
                }
                else // Le visiteur n'est pas connecté
                {
                    //echo 'vous n\'êtes pas connecté.';
                    echo '<a class="connexion" href="login.php">Connexion</a>';
                    echo '<a class="connexion" href="register.php">Inscription</a>';
                }
                
            ?>
        </div>
        <br><br>
        <?php
        include('../../model/manipulationBDD.php');
            try{
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connexion ok. </br>";
            }
            catch(Exeption $e){
                die('Erreur :' . $e->getMessage());
            }

            // Execution de la requete pour afficher la ressource sélectionnée
            $requete = $conn->prepare('SELECT id_ressource, titre_ressource, DATE_FORMAT(date_creation_ressource, \'%d/%m/%Y à %Hh %imin %ss\') AS date_creation_ressource, description_ressource, lib_categories, lib_type_relation, lib_type, chemin_document, id_utilisateur 
            FROM ressources, categories_ressources, type_relation_ressource, type_ressources WHERE categories_ressources.id_categories=ressources.id_categories AND type_relation_ressource.id_relation_ressource=ressources.id_type
             AND type_ressources.id_type=ressources.id_type AND id_ressource = ?');
            $requete->execute(array($_GET['ressource']));
            $donnees = $requete->fetch();

            $size = getimagesize($donnees['chemin_document']);

            $height = $size[1] / ($size[0] / 450);
            ?>
            <div class="contenu_ressource">
                <h2 class="titre">Titre : <?php echo htmlspecialchars($donnees['titre_ressource']);?> </h2></br>
                <h3>Type catégorie : <?php echo htmlspecialchars($donnees['lib_categories']);?></h3></br>
                <h3>Type ressource : <?php echo htmlspecialchars($donnees['lib_type']);?></h3></br>
                <h3>Type relation : <?php echo htmlspecialchars_decode($donnees['lib_type_relation']);?></h3></br><hr class="solid">
                <h3> Contenu : <br><br></h3> <p><?php echo nl2br(htmlspecialchars($donnees['description_ressource']));?></p></br>
                <div class="div-img"><img src="<?php echo $donnees['chemin_document']?>" class="img-fluid" width='450' height='<?php echo $height?>'></div> <!--/!\ Chemin à changer/!\-->
                <br><h3 id="date">Publiée le : <?php echo htmlspecialchars($donnees['date_creation_ressource']);?></h3>
                <a href="catalogue.php" class="btn btn-primary">Retour au catalogue</a>
            </div>
<?php
                // Affiche le résultat de la requete
            //echo "<h1>" . htmlspecialchars($donnees['titre']) . "</h1></br>";
            //echo "<h2>Type catégorie : " . $donnees['typeCategorie'] . "</h2></br>";
            //echo "<h2>Type ressource : " . $donnees['typeRessource'] . "</h2></br>";
            //echo "<h2>Type relation : " . htmlspecialchars($donnees['typeRelation']) . "</h2></br>";
            //echo "<h2>Description : " . $donnees['description'] . "</h2></br>";
            //echo "<img src='" . $donnees['cheminImage'] . "'></br>";
            //echo "<h2>Publiée le : " . $donnees['date_ajout_fr'] . "</h2></br>";
            $requete->closeCursor(); //on libère le curseur pour la prochaine requête            
        ?>
        
        <div class="commentaires">
            <h2 class="titre">Commentaires</h2>
            <form action="<?php echo' ../../controller/ajoutCommentaire.php?ressource=' . $_GET["ressource"] . ''?>" method="POST" > <!-- on passe l'id ressource en url -->
                <input type="hidden" class="form-control" name="auteur" id="auteur" placeholder="<?php $donnees['id_utilisateur']?>" value="<?php $donnees['id_utilisateur']?>"><br>
                <textarea class="form-control" id="commentaire" name="commentaire" placeholder="Ecrivez votre texte ici" rows="3" cols="60"></textarea><br>
                <input type="submit" id="submit" value="Envoyer">
            </form><br>
        </div>
        
        <?php
            $commentaire = new manipulationBDD();
            $commentaire ->afficherCommentaire($conn)
        ?>
    </body>

</html>





