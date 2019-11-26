<?php

  // ouverture du cookie $_SESSION
  session_start();
  // includes
  include './functions.php';
  // connexion à la DB
  $db = databaseConnect();

  if(isset($_GET['nomCocktail'])) {
    $nomCocktail = $_GET['nomCocktail'];
    $id = $_SESSION['mail'];
    $sql = $db->prepare("DELETE FROM cocktailsPreferes WHERE id = :id AND nomCocktail = :nomCocktail");
    $sql->execute(array(
      'id' => $id,
      'nomCocktail' => $nomCocktail
    ));
  }
  header('Location: ../../recettes-favorites/');

 ?>
