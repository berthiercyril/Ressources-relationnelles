<?php
    session_start();
    include("../config.php");
    include("../model/manipulationBDD.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/indexStyle.css">
    </head>
    <body>
        <div class="topnav">
            <a href="index.php">Accueil</a>
            <!--<a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>-->
            <a href="catalogue.php">Catalogue</a>
            
            <?php
                if (!empty($_SESSION['username'])) // Le visiteur est connecté
                {
                    echo '<a href="mesRessources.php">Mon Catalogue</a>';
                    echo '<a class="deconnexion" href="../controller/deconnexion.php"><img src="../images/deconnexion.svg" title="imageDeconnexion"></a>';
                    
                    echo '<a class="connexion" href="profil.php">Mon profil</a>';
                }
                else // Le visiteur n'est pas connecté
                {
                    //echo 'vous n\'êtes pas connecté.';
                    echo '<a class="connexion" href="login.php">Connexion</a>';
                    echo '<a class="connexion" href="register.php">Inscription</a>';
                }
                
            ?>
            <a class="active" href="#">Créer une ressource</a>
        </div>

        <div id="container">
            <form action="../controller/insertRessource.php" method="POST" enctype="multipart/form-data">
                <h1>Création</h1>
                <div>
                    <input type="text" name="titre" id="titre" placeholder="Titre" required>
                </div>
                <div>
                    <textarea id="description" name="description" placeholder="Ecrivez votre texte ici" rows="50" cols="45" required></textarea>
                </div>
                <div>
                    <input type="file" id="fileselect" name="fileselect">
                </div>
                <div>
                    <?php
                    $typeSelect = new manipulationBDD;

                    $res = $typeSelect->affichageTypeCategories($conn);
                    ?>
                    <select name="categories" id="selectCategories" class="select" required>
                        <option value="">--Choisissez une catégorie--</option>
                        <?php while($row = $res->fetch(PDO::FETCH_ASSOC)) : ?>
                        <option value="<?php echo htmlspecialchars($row['id_categories']); ?>"> <?php echo htmlspecialchars($row['lib_categories']); ?></option>
                        <?php endwhile; ?>
                    </select><br>
                    <?php

                    $res = $typeSelect->affichageTypeRessources($conn);
                    ?>
                    <select name="ressources" id="selectRessources" class="select" required>
                        <option value="">--Choisissez une ressource--</option>
                        <?php while($row = $res->fetch(PDO::FETCH_ASSOC)) : ?>
                        <option value="<?php echo htmlspecialchars($row['id_type']); ?>"> <?php echo htmlspecialchars($row['lib_type']); ?></option>
                        <?php endwhile; ?>
                    </select><br>
                    <?php

                    $res = $typeSelect->affichageTypeRelations($conn);
                    ?>
                    <select name="relations" id="selectRelations" class="select" required>
                        <option value="">--Choisissez une relation--</option>
                        <?php while($row = $res->fetch(PDO::FETCH_ASSOC)) : ?>
                        <option value="<?php echo htmlspecialchars($row['id_relation_ressource']); ?>"><?php echo htmlspecialchars($row['lib_type_relation']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <input type="submit" id="submit" value="Créer">
            </form>
        </div>
    </body>
</html>