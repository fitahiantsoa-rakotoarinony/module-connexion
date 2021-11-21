<?php
$title = "page d'inscription";
require 'header.php';

//CONNEXION / INSERTION DANS LA BASE DE DONNEE  


$bdd = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

mysqli_set_charset($bdd, 'UTF8');
$message = null;
//traitement du formulaire d'inscription
//la fonction strip_tags suprime les balise html et php d'une chaine de carractère 

if (!empty($_POST)) {

    $login = strip_tags($_POST['login']);
    $prenom = strip_tags($_POST['prenom']);
    $nom = strip_tags($_POST['nom']);


    //pour verifier la validité d'un mail sans passer par les expression regulière
    //if(!filter_var($_post["email"], FILTER_VALIDATE_EMAIL)){ die("L'adresse email est incorrecte")};


    //password_hash est une fonction pour hasher le motde passe
    $password = password_hash($_POST['password'], PASSWORD_ARGON2ID);
    $confirm_password = $_POST['confirm-password'];

    $sql = "INSERT INTO `utilisateurs` ( `login`, `prenom`, `nom`, `password`) VALUES ('$login', '$prenom', '$nom', '$password')";

    if (isset($login, $prenom, $nom, $password) && !empty($login) && !empty($prenom) && !empty($nom) && !empty($password)) {

        //on verifie si le login existe
        $sqlVerif = "SELECT * FROM utilisateurs WHERE login = '$login'";
        $select = mysqli_query($bdd, $sqlVerif);

        if (mysqli_num_rows($select)) {
            $message = "Ce login existe déjà . choisissez un autre";

            //si le login n'existe pas
        } elseif (password_verify($confirm_password, $password)) {
            $requete = mysqli_query($bdd, $sql);

            //  var_dump(password_verify($password, $confirm_password));

            header('Location: connexion.php');
            exit();
        } else {
            $message = "Les mots de passe ne sont pas identique";
        }
    } else {
        $message =  "vous avez des champs vide ";
    }
}


require_once 'authentification.php';

if (est_connecte()) {
    header('Location: index.php');
    exit();
}

//var_dump(est_connecte());

mysqli_close($bdd);

?>
<section class="sectionclass">
    <div>
        <div>
            <?php if ($message) {
                echo '<h4 class="messagealert">' . $message . ' </h4>';
            } ?>
        </div>
        <form class="forminscrip" action="inscription.php" method="post">

            <legend>
                <h2>Inscription</h2>
            </legend>

            <div class="el1">
                <label for="login"> </label>
                <input type="text" name="login" id="login" placeholder="login" class=" inputclass" required>
            </div>

            <div class="el1">
                <label for="prenom"></label>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom" class=" inputclass" required>
            </div>

            <div class="el1">
                <label for="nom"></label>
                <input type="text" name="nom" id="nom" placeholder="Nom" class=" inputclass" required>
            </div>


            <div class="el1">
                <label for="password"></label>
                <input type="password" name="password" id="password " placeholder="Mot de passe" class=" inputclass" required>
            </div>


            <div class="el1">
                <label for="confirm-password"></label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirmer le mot de passe" class=" inputclass" required>
            </div>


            <div class="el1">
                <input type="submit" value="Envoyer" class="submitclass">
            </div>


        </form>
    </div>
</section>

<?php require 'footer.php'; ?>