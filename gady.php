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

//Affiche l'ensemble des tuples de la table USER
$sql = $db->prepare("SELECT * FROM USER ");
$sql->execute();

$usr = "user"; //variable de test pour login
$pwd = "password"; //variable de test pour le login


$usr2 = "user2"; //variable de test pour sign up
$pwd2 = "password2"; //variable de test pour sign up
$prenom = "Emanuel"; //variable de test pour sign up
$nom = "GADY"; //variable de test pour sign up


$sql = "SELECT * FROM USER WHERE id = '$usr' "; //requete SQL qui retourne tous les elements de la table USER
$requete = $db->prepare($sql);
$requete->execute();
$reponse = $requete->fetch(); //Prend la premiere ligne du retour de la requete

if (! $reponse){ //Test si la requete retourne quelque chose
} else {
  $reponse_mdp = password_hash($reponse['mdp'],PASSWORD_DEFAULT); //permet de hacher le mot de passe de la db (a supprimer plus tard)
  $isPasswordCorrect = password_verify( $pwd,$reponse_mdp); //Compare les deux mots de passes hachés
  if (($reponse['mdp'] == $pwd) or $isPasswordCorrect){ //Compare les deux mots de passes non hachés
    echo "</br> $isPasswordCorrect";
    echo "</br>" . $reponse['id'] .  " vient de se connecter ";
  } else {
    echo "</br>mauvais mot de passe";
  }
}

//Création de compte
if(isset($usr2) and isset($pwd2)){ //verifie que l'identifiant et le mot de passe sont bien present
  $pass_hash = password_hash($pwd2,PASSWORD_DEFAULT); //hache le mot de passe
  $sql2 = $db->prepare("INSERT INTO user(id,mdp,nom,prenom) VALUES (:id,:mdp,:nom,:prenom)");
  $sql2->bindParam(':id', $usr2);
  $sql2->bindParam(':mdp', $pass_hash);
  $sql2->bindParam(':nom', $nom);
  $sql2->bindParam(':prenom', $prenom);
  try {
    $sql2->execute();
  }catch(PDOException $e) {
    echo "Erreur : $e->getMessage()";
  }
  echo "</br>" . "Compte crée avec succes ! ";
}


?>
