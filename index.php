
<?php
require_once 'authentification.php';

$title = "page d'accueil";
require "header.php";

//var_dump(est_connecte());
?>
<div class="color1">
    <?php if (est_connecte()) : ?>
        <h1 class="bv">Salut <?= $_SESSION['connecte']['prenom'].' '.$_SESSION['connecte']['nom'];?></h1>
        <h1 class="bv">Bienvenue sur ma page</h1>

        <div class="lien">
            <a class="ellien" target="blank" href="https://github.com/fitahiantsoa-rakotoarinony/module-connexion.git">
                <h4> Acceder au projet github</h4>
            </a>
        </div>
    <?php else : ?>
        <div class="lien">
            <a class="ellien" href="connexion.php">
                <h4>Déjà inscrit ?</h4>
            </a>
            <a class="ellien" href="inscription.php">
                <h4>S'inscrire ?</h4>
            </a>
            <a class="ellien" target="blank" href="https://github.com/fitahiantsoa-rakotoarinony/module-connexion.git">
                <h4>Voir le projet github</h4>
            </a>
        </div>
    <?php endif; ?>

</div>
<?php require 'footer.php'; ?>