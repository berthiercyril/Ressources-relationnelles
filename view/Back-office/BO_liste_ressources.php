<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ressources Relationnelles</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Ressources relationnelles</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="BO_index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="BO_liste_ressources.php">liste des ressources</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Validation ressources</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Statistiques</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
        <h1 class="text-center">Gestion des Ressources</h1>

        <?php
            include('../../config.php');
            include('../../model/manipulationBDD.php');
            $mAffiche= new manipulationBDD();

            //echo "<h1>CATALOGUE KEVIN</h1></br></br>";
            $donnee = $mAffiche->afficheDonnees($conn);
            while($row = $donnee->fetch(PDO::FETCH_ASSOC)) :
        ?>
       <div class="card text-center container">
            <div class="card-header">
            <?php echo htmlspecialchars($row['titre_ressource']); ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text"><?php echo htmlspecialchars($row['description_ressource']); ?></p>
            </div>
            
            <div class="card-footer">
                <a href="BO_affichage_ressource.php?ressource=<?php echo htmlspecialchars($row['id_ressource']); ?>" class="btn btn-primary">Voir plus</a>
                <div class="text-end"><?php echo htmlspecialchars($row['date_creation_ressource']); ?></div>
            </div>
            
        
        </div><br><?php endwhile; ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end container">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </body>
</html>