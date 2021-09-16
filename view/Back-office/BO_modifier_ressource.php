<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>Ressources Relationnelles</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <!-- <link rel="stylesheet" href="../../css/indexStyle.css"> -->

    </head>
    <body>
    <?php include('navbar.php')?>
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
            $requete = $conn->prepare('SELECT ressources.id_categories, ressources.id_type, ressources.id_relation_ressource, id_ressource, titre_ressource, DATE_FORMAT(date_creation_ressource, \'%d/%m/%Y\') AS date_creation_ressource, description_ressource, lib_categories, lib_type_relation, lib_type, chemin_document, id_utilisateur 
            FROM ressources, categories_ressources, type_relation_ressource, type_ressources WHERE categories_ressources.id_categories=ressources.id_categories AND type_relation_ressource.id_relation_ressource=ressources.id_type
             AND type_ressources.id_type=ressources.id_type AND id_ressource = ?');
            $requete->execute(array($_GET['ressource']));
            $donnees = $requete->fetch();

            $size = getimagesize($donnees['chemin_document']);

            $height = $size[1] / ($size[0] / 450);
            ?>
            <form action="../../controller/BO_Modifier_Ressource.php" method="POST" enctype="multipart/form-data">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-10 align-self-center">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Titre </span>
                                <input type="text" class="form-control" placeholder="Username" value="<?php echo htmlspecialchars($donnees['titre_ressource']);?>" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                            
                            <?php
                            $typeSelect = new manipulationBDD;

                            $res = $typeSelect->affichageTypeCategories($conn);
                            ?>
                            <select name="categories" id="selectCategories" class="form-select" required>
                                <option value="">--Choisissez une catégorie--</option>
                                <?php while($row = $res->fetch(PDO::FETCH_ASSOC)) : 
                                    
                                    if($donnees['id_categories'] == $row['id_categories']){ ?>
                                        <option selected="selected" value="<?php echo htmlspecialchars($row['id_categories']); ?>"> <?php echo htmlspecialchars(utf8_encode($row['lib_categories'])); ?></option>
                                    <?php }
                                    else{?>
                                        <option value="<?php echo htmlspecialchars($row['id_categories']); ?>"> <?php echo htmlspecialchars(utf8_encode($row['lib_categories'])); ?></option>
                                    <?php } ?>
                                <?php endwhile; ?>
                            </select><br>
                            <?php

                            $res = $typeSelect->affichageTypeRessources($conn);
                            ?>
                            <select name="ressources" id="selectRessources" class="form-select" required>
                                <option value="">--Choisissez une ressource--</option>
                                <?php while($row = $res->fetch(PDO::FETCH_ASSOC)) :

                                    if($donnees['id_type'] == $row['id_type']){ ?>
                                        <option selected="selected" value="<?php echo htmlspecialchars($row['id_type']); ?>"> <?php echo htmlspecialchars(utf8_encode($row['lib_type'])); ?></option>
                                    <?php }
                                    else{?>
                                        <option value="<?php echo htmlspecialchars($row['id_type']); ?>"> <?php echo htmlspecialchars(utf8_encode($row['lib_type'])); ?></option>
                                    <?php } ?>
                                    
                                
                                <?php endwhile; ?>
                            </select><br>
                            <?php

                            $res = $typeSelect->affichageTypeRelations($conn);
                            ?>
                            <select name="relations" id="selectRelations" class="form-select" required>
                                <option value="">--Choisissez une relation--</option>
                                <?php while($row = $res->fetch(PDO::FETCH_ASSOC)) :

                                    if($donnees['id_relation_ressource'] == $row['id_relation_ressource']){ ?>
                                        <option selected="selected" value="<?php echo htmlspecialchars($row['id_relation_ressource']); ?>"><?php echo htmlspecialchars(utf8_encode($row['lib_type_relation'])); ?></option>
                                    <?php }
                                    else{?>
                                        <option value="<?php echo htmlspecialchars($row['id_relation_ressource']); ?>"><?php echo htmlspecialchars(utf8_encode($row['lib_type_relation'])); ?></option>
                                    <?php } ?>

                                
                                <?php endwhile; ?>
                            </select><br>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 300px"><?php echo nl2br(htmlspecialchars($donnees['description_ressource']));?></textarea>
                                <label for="floatingTextarea">Description :</label>
                            </div>
                            <div class="div-img"><img src="<?php echo $donnees['chemin_document']?>" class="img-fluid" width='450' height='<?php echo $height?>'></div> <!--/!\ Chemin à changer/!\-->
                            <br>
                            <div class="row">
                                <div class="col-6 text-start">
                                    <span class="" id="basic-addon1">Publiée le : <?php echo htmlspecialchars($donnees['date_creation_ressource']);?></span>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="BO_liste_ressources.php" class="btn btn-outline-secondary">Annuler</a>
                                    <!-- <a href="BO_liste_ressources.php" class="btn btn-success">Sauvegarder</a> -->
                                    <input type="submit" class="btn btn-success" value="Sauvegarder">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-10 align-self-center">
                <hr>
                    <h2 class="text-center">Commentaires</h2>
                    <form action="<?php echo' ../../controller/BO_Ajout_Commentaire.php?ressource=' . $_GET["ressource"] . ''?>" method="POST" > <!-- on passe l'id ressource en url -->
                        <!-- <input type="text" class="form-control" name="auteur" id="auteur" placeholder="Nom"><br> -->
                        <textarea class="form-control" id="commentaire" name="commentaire" placeholder="Ecrivez votre texte ici" rows="3" cols="60"></textarea><br>
                        <div class="text-end">
                            <input type="submit" id="submit" value="Envoyer" class="btn btn-primary">
                        </div>
                    </form><br>
                    <?php
                        $commentaire = new manipulationBDD();
                        $commentaire ->afficherCommentaire($conn)
                    ?>
                </div>
            </div>
        </div>
        
       

        
    </body>

</html>





