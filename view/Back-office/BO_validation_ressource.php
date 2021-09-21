<?php
    session_start();
    include("../../model/config.php");
    include('../../model/manipulationBDD.php');
?>
<!DOCTYPE html>

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
        
        $requete = $conn->query('SELECT ressources.id_ressource, description_ressource, titre_ressource, DATE_FORMAT(date_creation_ressource, \'%d/%m/%Y\') AS date_creation_ressource FROM ressources WHERE id_statut = 4 ORDER BY date_creation_ressource DESC;');
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Titre ressource</th>
                <th scope="col">Validation</th>
                </tr>
            </thead>
            <tbody>
               
            <?php 
             $i=0;
             while($row = $requete->fetch(PDO::FETCH_ASSOC)) : 
             $i++;
             ?>
                <tr>
                <td><?php echo $row['id_ressource']?></td>
                <td><?php  echo $row['titre_ressource']?></td>
                <td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#validerRessource<?php echo $i?>">valider</button>
                    
                </td>
                </tr>

                <!-- Modal valider ressource -->
            <div class="modal fade" id="validerRessource<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ressource</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir valider la ressource ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Non</button>
                    <form action="../../controller/BO_Supprimer_Ressource.php?ressource=<?php echo htmlspecialchars($row['id_ressource']); ?>&suspendu=ok" method="post">
                        <button type="submit" class="btn btn-danger" name="valider" >Oui</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
            <?php endwhile; ?>
            </tbody>
        </table>

        
    </body>
</html>