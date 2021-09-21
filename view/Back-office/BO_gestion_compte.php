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
        
        $requete = $conn->query('SELECT id_utilisateur, nom, prenom, verifie, utilisateur.id_type_compte FROM utilisateur, type_compte  WHERE utilisateur.id_type_compte=type_compte.id_type_compte ;');
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Activer</th>
                <th scope="col">Désactiver</th>
                <th scope="col">Compte activé</th>
                </tr>
            </thead>
            <tbody>
               
            <?php 
             $i=0;
             while($row = $requete->fetch(PDO::FETCH_ASSOC)) : 
             $i++;
             ?>
                <tr>
                <td><?php echo $row['id_utilisateur']?></td>
                <td><?php  echo $row['nom']?></td>
                <td><?php  echo $row['prenom']?></td>
                <td>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#activerRessource<?php echo $i?>">Activer</button>
                </td>
                <td>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#desactiverRessource<?php echo $i?>">Désactiver</button>
                </td>
                <td><?php if ($row['verifie'] == 1) {
                    echo 'Oui';
                }
                else{
                    echo 'Non';
                }
                ?></td>
                </tr>

                <!-- Modal desactiver ressource -->
            <div class="modal fade" id="desactiverRessource<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir désactiver l'utilisateur ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Non</button>
                    <form action="../../controller/BO_utilisateur.php?utilisateur=<?php echo htmlspecialchars($row['id_utilisateur']); ?>" method="post">
                        <button type="submit" class="btn btn-danger" name="desactiver" >Oui</button>
                    </form>
                </div>
                </div>
            </div>
            </div>


            <!-- Modal activer ressource -->
            <div class="modal fade" id="activerRessource<?php echo $i?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir activer l'utilisateur ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Non</button>
                    <form action="../../controller/BO_utilisateur.php?utilisateur=<?php echo htmlspecialchars($row['id_utilisateur']); ?>" method="post">
                        <button type="submit" class="btn btn-danger" name="activer" >Oui</button>
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