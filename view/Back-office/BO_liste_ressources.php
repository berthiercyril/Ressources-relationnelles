<?php
    session_start();
?>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ressources Relationnelles</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>


    </head>
    <body>
        <?php include('navbar.php');
            include('../../model/config.php');
            include('../../model/manipulationBDD.php');
        ?>
        <h1 class="text-center">Gestion des Ressources</h1><br>

        <?php
            $typeSelect = new manipulationBDD;

            $res = $typeSelect->affichageTypeCategories($conn);
        ?>
        <form action="" method="post">
            <select name="categories" id="selectCategories" class="form-select" required>
                <option value="">--Choisissez une catégorie--</option>
                <?php while($row = $res->fetch(PDO::FETCH_ASSOC)) : 
                    
                    if($donnees['id_categories'] == $row['id_categories']){ ?>
                        <option selected="selected" value="<?php echo htmlspecialchars($row['id_categories']); ?>"> <?php echo htmlspecialchars($row['lib_categories']); ?></option>
                    <?php }
                    else{?>
                        <option value="<?php echo htmlspecialchars($row['id_categories']); ?>"> <?php echo htmlspecialchars($row['lib_categories']); ?></option>
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
                        <option selected="selected" value="<?php echo htmlspecialchars($row['id_relation_ressource']); ?>"><?php echo htmlspecialchars($row['lib_type_relation']); ?></option>
                    <?php }
                    else{?>
                        <option value="<?php echo htmlspecialchars($row['id_relation_ressource']); ?>"><?php echo htmlspecialchars($row['lib_type_relation']); ?></option>
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
                        <option selected="selected" value="<?php echo htmlspecialchars($row['id_type']); ?>"> <?php echo htmlspecialchars($row['lib_type']); ?></option>
                    <?php }
                    else{?>
                        <option value="<?php echo htmlspecialchars($row['id_type']); ?>"> <?php echo htmlspecialchars($row['lib_type']); ?></option>
                    <?php } ?>
                    
                
                <?php endwhile; ?>
            </select><br>
        </form>            

        <?php
            $mAffiche= new manipulationBDD();

            //echo "<h1>CATALOGUE KEVIN</h1></br></br>";
            $donnee = $mAffiche->afficheDonnees($conn);
            $i=0;
            while($row = $donnee->fetch(PDO::FETCH_ASSOC)) :
            $i++;
        ?>
       <div class="card text-center container">
            <div class="card-header row">
                <h4><?php echo htmlspecialchars($row['titre_ressource']);?></h4> 
            </div>
            <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"><?php echo htmlspecialchars($row['description_ressource']); ?></p>
                <a href="<?php echo' BO_affichage_ressource.php?ressource=' . $row["id_ressource"] . ''?>" class="btn btn-outline-primary">Voir plus</a>
            </div>
            
            <div class="card-footer bg-light text-dark row">
                <div class="col-6 text-start">
                <a href="#" class="btn btn-primary">Suspendre</a>
                <a href="BO_modifier_ressource.php?ressource=<?php echo htmlspecialchars($row['id_ressource']); ?>" class="btn btn-warning">Modifier</a>
                <!-- <a href="" class="btn btn-danger" name="supprimer" data-toggle="modal" data-target="#supprimerRessource<?php echo $i?>">Supprimer</a> -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#supprimerRessource<?php echo $i?>">supprimer</button>
                </div>
                <div class="col-6 align-self-center text-end">
                    <label> <?php echo htmlspecialchars($row['date_creation_ressource']); ?></label>
                </div>
            </div>
            </div><br>


            <!-- Modal -->
            <div class="modal fade" id="supprimerRessource<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ressource</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer la ressource ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Non</button>
                    <form action="<?php echo' ../../controller/BO_Supprimer_Ressource.php?ressource=' . $row["id_ressource"] . ''?>" method="post">
                        <button type="submit" class="btn btn-danger" name="supprimer" >Oui</button>
                    </form>
                </div>
                </div>
            </div>
            </div>

            <?php endwhile; ?>

        

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