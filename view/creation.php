<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/creationStyle.css">
    </head>
    <body>
        <div class="topnav">
            <a href="index.html">Accueil</a>
            <a href="login.php">Connexion</a>
            <a href="register.php">Inscription</a>
            <a class="active" href="#">Création</a>
        </div>

        <div id="container">
            <form action="../insertRessource.php" method="POST" enctype="multipart/form-data">
                <h1>Création</h1>
                <input type="text" name="titre" id="titre" placeholder="Titre"><br>
                <textarea id="description" name="description" placeholder="Ecrivez votre texte ici" rows="50" cols="45"></textarea><br>
                <input type="file" id="fileselect" name="fileselect"><br>
                <select name="categories" id="categories-select">
                    <option value="">--Choisissez une catégorie--</option>
                    <option value="Communication">Communication</option>
                    <option value="Cultures">Cultures</option>
                    <option value="Développement">Développement</option>
                    <option value="Intelligence émotionnelle">Intelligence émotionnelle</option>
                    <option value="Loisirs">Loisirs</option>
                    <option value="Monde professionnel">Monde professionnel</option>
                    <option value="Parentalité">Parentalité</option>
                    <option value="Qualité de vie">Qualité de vie</option>
                    <option value="Recherche de sens">Recherche de sens</option>
                    <option value="Santé physique">Santé physique</option>
                    <option value="Santé psychique">Santé psychique</option>
                    <option value="Spiritualité">Spiritualité</option>
                    <option value="Vie affective">Vie affective</option>
                </select><br>
                <select name="ressources" id="ressources-select">
                    <option value="">--Choisissez une ressource--</option>
                    <option value="Activité / Jeu à réaliser">Activité / Jeu à réaliser</option>
                    <option value="Article">Article</option>
                    <option value="Carte défi">Carte défi</option>
                    <option value="Cours au format PDF">Cours au format PDF</option>
                    <option value="Exercice / Atelier">Exercice / Atelier</option>
                    <option value="Fiche de lecture">Fiche de lecture</option>
                    <option value="Jeu en ligne">Jeu en ligne</option>
                    <option value="Vidéo">Vidéo</option>
                </select><br>
                <select name="relations" id="relations-select">
                    <option value="">--Choisissez une relation--</option>
                    <option value="Soi">Soi</option>
                    <option value="Conjoints">Conjoints</option>
                    <option value="Famille : enfants / parents / fratrie">Famille : enfants / parents / fratrie</option>
                    <option value="Professionnelle : collègues, collaborateurs et managers">Professionnelle : collègues, collaborateurs et managers</option>
                    <option value="Amis et communautés">Amis et communautés</option>
                    <option value="Inconnus">Inconnus</option>
                </select>
                <input type="submit" id="submit" value="Créer">
            </form>
        </div>
    </body>
</html>