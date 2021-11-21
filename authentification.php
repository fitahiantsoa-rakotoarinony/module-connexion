<?php 

 function est_connecte(){
     if(session_status() === PHP_SESSION_NONE){
         session_start();
     }
    return !empty($_SESSION['connecte']);
 }




 
 function obliger_utilisateur_connecte(){
    if(!est_connecte()){
        header('Location: connexion.php');
        exit();
    }
 }

?>