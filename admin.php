
    <?php

$title = "page d'admin";
require 'header.php';

require_once 'authentification.php';
obliger_utilisateur_connecte();

$bdd = mysqli_connect('localhost', 'root', '', 'moduleconnexion');

mysqli_set_charset($bdd, 'UTF8');

$sql = 'SELECT * FROM utilisateurs';

$requete = mysqli_query($bdd, $sql);

$utilisateurs = mysqli_fetch_all($requete, MYSQLI_ASSOC);

if($_SESSION['connecte']['login'] == 'admin' ){
// var_dump($utilisateurs);

echo "<section class='sectionclass'><table>
<caption><h1>Liste des membres inscrits</h1></caption>
<thead>
<th>id</th>
<th>login</th>
<th>prenom</th>
<th>non</th>
<th>password</th>
</thead>
<tbody>";
foreach ($utilisateurs as $utilisateur) {
    echo " <tr>
        <td>" . $utilisateur['id'] . "</td>
        <td>" . $utilisateur['login'] . "</td>
        <td>" . $utilisateur['prenom'] . "</td>
        <td>" . $utilisateur['nom'] . "</td>
        <td>" . $utilisateur['password'] . "</td>
    </tr>";
}

echo "</tbody>

</table></section>";
}else{
header('Location: index.php ');
exit();
}



?>
<?php require 'footer.php'; ?>