<?php
session_start();
include_once 'authentification.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($title)) {
                echo $title;
            } else {
                echo "header";
            }  ?>
    </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>

        <div>
            <h1>header</h1>
        </div>
        <div class="menu">
            <div class="child1">
                <h4 class="color"><?php if (!empty($_SESSION['connecte']) ) {
                        echo 'Salut ' . $_SESSION["connecte"]["prenom"] . ' ' . $_SESSION["connecte"]["nom"] ;
                    }
                    ?>
                </h4>
            </div>

            <div class="child2">
                <a href="index.php"><button>Accueil</button></a>
                
                <?php if (!est_connecte()) : ?>
                    <a href="connexion.php"><button>Connexion</button></a>
                    <a href="inscription.php"><button>Inscription </button></a>
                <?php else : ?>
                    <a href="profil.php"><button> Profil </button></a>
                    <a href="deconnexion.php"><button>Déconnexion</button></a>
                <?php endif; ?>

                <?php if (!empty($_SESSION) && $_SESSION['connecte']['login'] == 'admin') : ?>
                    <a href="admin.php"><button>Admin</button></a>
                <?php endif; ?>

            </div>
        </div>


    </header>
    <main>
        <aside></aside>
       