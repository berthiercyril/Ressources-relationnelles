<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
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
        <?php
            include("../config.php");
            include("../class/ressourceClass.php");
            $ressource = new Ressource("","","","","");

            $ressource->AffichageRessource($conn);
            $sql = $_SESSION['sql'];
        ?>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="topnav">
            <a href="index.html">Accueil</a>
            <a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>
        </div>

        <h1>Catalogue</h1>
        <a href="index.html?deconnexion=true"><span>Déconnexion</span></a>
        <h2>Liste des Ressources</h2>
        <table>
            <tbody>
            <?php while($row = $sql->fetch(PDO::FETCH_ASSOC)) : ?>    <!-- Boucle qui parcours le tableau et les affiches 1 par 1  -->
            <tr>
                <td> <h2> Titre : <?php echo htmlspecialchars($row['titre']); ?> </h2></td>   <!-- Affiche le titre  -->
            </tr>
            <tr>
                <td> <h3> Type catégorie : <?php echo htmlspecialchars($row['typeCategorie']); ?> </h3></td>   <!-- Affiche la categorie  -->
            </tr>
            <tr>
                <td> <h3> Type ressource : <?php echo htmlspecialchars($row['typeRessource']); ?> </h3></td>   <!-- Affiche la categorie  -->
            </tr>
            <tr>
                <td> <h3> Type relation : <?php echo htmlspecialchars($row['typeRelation']); ?> </h3></td>   <!-- Affiche la categorie  -->
            </tr>
            <tr>
                <td> <h3> Publiée le  <?php echo htmlspecialchars($row['date']); ?> </h3> </td>   <!-- Affiche la date de publication  -->
            </tr>
            <tr>
                <td> <p> <?php echo htmlspecialchars($row['description']); ?> </p> </td>    <!-- Affiche le commentaire -->
            </tr>
            <tr>
                <td> <img src="<?php echo htmlspecialchars($row['cheminImage']);?>" height="450" width="450"/></td>    <!-- Affiche l'image -->
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        <!--<?php
            /*session_start();
            if(isset($_GET['deconnexion']))
            {
                if($_GET['deconnexion'] == true)
                {
                    session_destroy();
                    header('Location: login.php');
                }
            }

            if($_SESSION['username'] !== "")
            {
                $user = $_SESSION['username'];
                echo "Bonjour " . $user . " vous êtes connecté !";
            }
            
*/
        ?>-->
        <script src="" async defer></script>
    </body>
</html>