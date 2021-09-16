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
        <?php include('navbar.php')?>
        <h1 class="text-center">Gestion des Ressources</h1><br>

        <?php
            include('../../model/config.php');
            include('../../model/manipulationBDD.php');
            $mAffiche= new manipulationBDD();

            //echo "<h1>CATALOGUE KEVIN</h1></br></br>";
            $donnee = $mAffiche->afficheDonnees($conn);
            while($row = $donnee->fetch(PDO::FETCH_ASSOC)) :
        ?>
       <div class="card text-center container">
            <div>
                <h4><?php echo htmlspecialchars($row['titre_ressource']); ?></h4>
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><?php echo htmlspecialchars($row['description_ressource']); ?></p>
                <a href="#" class="btn btn-outline-primary">Voir plus</a>
            </div>
            
            <div class="card-footer bg-light text-dark row">
                <div class="col-6 text-start">
                <a href="#" class="btn btn-primary">Suspendre</a>
                <a href="BO_modifier_ressource.php?ressource=<?php echo htmlspecialchars($row['id_ressource']); ?>" class="btn btn-warning">Modifier</a>
                <a href="#" class="btn btn-danger">Supprimer</a>
                </div>
                <div class="col-6 text-end">
                    <label class="text-start"> <?php echo htmlspecialchars($row['date_creation_ressource']); ?></label>
                </div>
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