
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ressources relationnelles</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-left" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            
            <?php 
            if(isset($_SESSION['idTypeCompte'])){

            
                if ($_SESSION['idTypeCompte'] == 1) {
                    echo'
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="BO_index.php">Accueil</a>
                    </li><li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="BO_liste_ressources.php">liste des ressources</a>
                    </li>';
                }
                elseif ($_SESSION['idTypeCompte'] == 2) {
                    echo'
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="BO_index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="BO_liste_ressources.php">liste des ressources</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="#">Validation ressources</a>
                    </li><li class="nav-item">
                    <a class="nav-link active" href="#">Statistiques</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="#">Gestion compte</a>
                    </li>';
                }
                elseif ($_SESSION['idTypeCompte'] == 3) {
                    echo'
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="BO_index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="BO_liste_ressources.php">liste des ressources</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="#">Validation ressources</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="#">Statistiques</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="#">Gestion compte</a>
                    </li>';
                }
            }
            ?>
            
            
            
            
        </div>
        <?php
        if (empty($_SESSION['username'])) // Le visiteur est connecté
        {
            echo '<div class="d-flex flex-row-reverse">
            <a class="nav-link active" href="BO_login.php">Login</a>
            </div>';
        }
        else{
            echo '<div class="d-flex flex-row-reverse">
            <a class="nav-link active" href="../../CONTROLLER/BO_deconnexion.php">Deconnexion</a>
            <span>Vous êtes connecté en tant que <b>'. $_SESSION['type_utilisateur']. ' </b></span>
            </div>';

        }
        ?>

    </div>
</nav><br>