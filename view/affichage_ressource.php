<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/catalogueStyle.css">
    </head>
    <body>
        <div class="topnav">
            <a href="index.html">Accueil</a>
            <a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>
        </div>
        <h1>Catalogue</h1>
        <?php
        include('../manipulationBDD.php');
            try{
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connexion ok. </br>";
            }
            catch(Exeption $e){
                die('Erreur :' . $e->getMessage());
            }

            // Execution de la requete pour afficher la ressource sélectionnée
            $requete = $conn->prepare('SELECT idRessource, titre, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS date_ajout_fr, description, typeCategorie, typeRessource, typeRelation, cheminImage
                                    FROM ressource WHERE idRessource = ?');
            $requete->execute(array($_GET['ressource']));
            $donnees = $requete->fetch();

            $size = getimagesize($donnees['cheminImage']);
            $height = $size[1] / ($size[0] / 450);
            ?>

            <h2>Titre : <?php echo htmlspecialchars($donnees['titre']);?> </h2></br>
            <h3>Type catégorie : <?php echo htmlspecialchars($donnees['typeCategorie']);?></h3></br>
            <h3>Type ressource : <?php echo htmlspecialchars($donnees['typeRessource']);?></h3></br>
            <h3>Type relation : <?php echo htmlspecialchars_decode($donnees['typeRelation']);?></h3></br>
            <h3>Description : </h3> <p><?php echo nl2br(htmlspecialchars($donnees['description']));?></p></br>
            <img src="<?php echo $donnees['cheminImage']?>" width='450' height='<?php echo $height?>'> <!--/!\ Chemin à changer/!\-->
            <h3>Publiée le : <?php echo htmlspecialchars($donnees['date_ajout_fr']);?></h3></br>

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
            echo "</br><a href='catalogueKevin.php'>Retour au catalogue</a>";
        ?>
        <h2>Commentaires</h2>
        
        <form action="<?php echo' ../ajoutCommentaire.php?ressource=' . $_GET["ressource"] . ''?>" method="POST"> <!-- on passe l'id ressource en url -->
            <input type="text" name="auteur" id="auteur" placeholder="Nom"><br>
            <textarea id="commentaire" name="commentaire" placeholder="Ecrivez votre texte ici" rows="3" cols="60"></textarea><br>
            <input type="submit" id="submit" value="Envoyer">
        </form>
        
        <?php
            $commentaire = new manipulationBDD();
            $commentaire ->afficherCommentaire($conn)
        ?>
    </body>







