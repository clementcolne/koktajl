<?php

/* Ce fichier crée une base de données appelée myDB, crée
ses tables correspondantes et remplis les tables selon
les données récupérées dans le tableau contenu dans le fichier
Donnees.inc.php */

include './databaseQueries.php';
include './Donnees.inc.php';

// informations relatives à la connexion de la base de donnée
$servername = "mysql:host=localhost;dbname=myDB;charset=utf8";
$databaseName = "autreDB";
$username = "root";
$password = "root";

// Connexion à la base de donnée
try {
  $db = new PDO($servername, $username, $password);
}catch(Exception $e) {
  die('Erreur : ' . $e->getMessage());
}
// création des tables de la DB
foreach(explode(';', createDatabase($databaseName)) as $sql) {
  echo "</br>COMMANDE SQL EFFECTUEE AVEC SUCCES : $sql</br>";
  $bool = $db->exec($sql);
  $db->exec($sql);
}

foreach($Recettes as $array) {
  // récupération du nom, de la description des ingrédients et de la description de la préparation de chaque cocktail
  $nomCocktail = $array['titre'];
  $descIngredient = $array['ingredients'];
  $descPreparation = $array['preparation'];

  // préparation de la requête pour éviter l'injection SQL
  $sql = $db->prepare("INSERT INTO cocktail(nomCocktail, descIngredient, descPreparation) VALUES(:nomCocktail, :descIngredient, :descPreparation)");
  $sql->bindParam(':nomCocktail', $nomCocktail);
  $sql->bindParam(':descIngredient', $descIngredient);
  $sql->bindParam(':descPreparation', $descPreparation);

  // exécution de la requête SQL
  try {
    $sql->execute();
  }catch(PDOException $e) {
    echo "Erreur : $e->getMessage()";
  }

}

?>
