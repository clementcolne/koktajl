<?php
// page principale du site au chargement
// plus tard on utilisera le template
// pour l'instant on utilise cette page pour les test d'affichage de nos données cocktails, user et recherches



include './database/databaseQueries.php';
include './datas/Donnees.inc.php';


// informations relatives à la connexion de la base de donnée
$servername = "mysql:host=localhost;dbname=myDB;charset=utf8";
$databaseName = "myDB";
$username = "root";
$password = "";

// Connexion à la base de donnée
try {
  $db = new PDO($servername, $username, $password);
}catch(Exception $e) {
  die('Erreur : ' . $e->getMessage());
}

$usr = "user";
$pwd = "password";

$sql = 'SELECT mdp FROM user WHERE id = $usr';
$requete = $db->prepare($sql);
$requete->execute();
while($reponse = $requete->fetch()) {
  echo $reponse;
  // code...
}
//regarder d'abord sur le retour de la commande SQL n'est pas null

echo "</br>" . $reponse['mdp'] . "</br>";
echo password_hash($pwd,PASSWORD_DEFAULT);
if ($reponse == password_hash($pwd, PASSWORD_DEFAULT)){
  echo "</br>connecté";
} else {
  echo "</br>mauvais mot de passe";
}

?>
