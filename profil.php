
<?php

$title = "page de profil";
require 'header.php';

obliger_utilisateur_connecte();


//var_dump($_SESSION);



$bdd = mysqli_connect('localhost', 'root', '', 'moduleconnexion');
mysqli_set_charset($bdd, 'UTF8');

//information  dans ma session de la bdd
$id = $_SESSION['connecte']['id'];
$login = $_SESSION['connecte']['login'];
$prenom = $_SESSION['connecte']['prenom'];
$nom = $_SESSION['connecte']['nom'];
$password = $_SESSION['connecte']['password'];

//var_dump($_SESSION);

$message = null;


if (!empty($_POST)) {
    //les informations qui seront saisi par l'utilisateur pour les modifications
    $loginp =  strip_tags($_POST['login']);
    $prenomp =  strip_tags($_POST['prenom']);
    $nomp = strip_tags($_POST['nom']);
    $passwordp = strip_tags($_POST['password']);
    $confirm_password = strip_tags($_POST['confirm-password']);

    if (password_verify($confirm_password, $passwordp) || $confirm_password == $passwordp) {


        //mise a jour les informations dans la base de donnée
        $sql = "UPDATE `utilisateurs` SET `login`='$loginp',`prenom`='$prenomp',`nom`='$nomp',`password`='$passwordp' WHERE id = $id";
        $requete = mysqli_query($bdd, $sql);

        //mettre a jour les infos dans ma session
        $_SESSION['connecte']['login'] = $loginp;
        $_SESSION['connecte']['prenom'] = $prenomp;
        $_SESSION['connecte']['nom'] = $nomp;
        $_SESSION['connecte']['password'] = $passwordp;



        // var_dump($requete);
        header('Location: index.php ');
        exit();
    } else {
        $message = "Votre mot de passe  est incorrect";
    }
} 


//var_dump($_POST);

?>

<section class="sectionclass">
    <div>

        <div>
            <h1>Profil de : <?= $_SESSION['connecte']['prenom'] . ' ' . $_SESSION['connecte']['nom'] ?></h1>
            <h1> login:<?= ' ' . $_SESSION['connecte']['login'] ?></h1>
        </div>
        <div>
            <?php if ($message) {
                echo '<h4 class="messagealert">' . $message . ' </h4>';
            } ?>
        </div>

        <form class="formprofil" action="profil.php" method="post">

            <h3>
                <legend>Modifier mon profil</legend>
            </h3>

            <h6>Login</h6>
            <div class="el2">
                <label for="login"> </label>
                <input type="text" name="login" id="login" class=" inputclass" value="<?= $login  ?>">
            </div>

            <h6>Prenom</h6>
            <div class="el2">
                <label for="prenom"></label>
                <input type="text" name="prenom" id="prenom" class=" inputclass" value="<?= $prenom  ?>">
            </div>

            <h6>Nom</h6>
            <div class="el2">
                <label for="nom"></label>
                <input type="text" name="nom" id="nom" class=" inputclass" value="<?= $nom  ?>">
            </div>

            <!-- <h6>Mot de passe</h6> -->
            <div class="el2">
                <label for="password"></label>
                <input type="hidden" name="password" id="password" class=" inputclass" value="<?= $password  ?>" required>
            </div>

            <!--  <div class="el2">
                <h6>Nouveau mot de passe</h6>
                <label for="password"></label>
                <input type="password" name="password" id="password" class=" inputclass" required>
            </div>-->
            <h6>Confirmer les modifications avec votre mot de passe</h6>
            <div class="el2">
                <label for="confirm-password"></label>
                <input type="password" name="confirm-password" id="confirm-password" class=" inputclass" required>
            </div>



            <div class="el2">
                <input class="submitclass" type="submit" value="Appliquer les modifications">
            </div>
        </form>


    </div>
</section>
<?php require 'footer.php'; ?>