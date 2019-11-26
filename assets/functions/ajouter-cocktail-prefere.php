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
    $sql = $db->query("SELECT * FROM cocktailsPreferes");
    while($reponse = $sql->fetch()) {
      if($reponse['nomCocktail'] == $nomCocktail) {
        echo 'coucou';
        header("Location: ../../recette/index.php?nomCocktail=$nomCocktail&pathImg=$pathImg");
        exit();
      }
    }
    $sql = $db->prepare("INSERT INTO cocktailsPreferes(id, nomCocktail) VALUES (:id, :nomCocktail)");
    $sql->bindParam(':id', $id);
    $sql->bindParam(':nomCocktail', $nomCocktail);
    $sql->execute(array(
      'id' => $id,
      'nomCocktail' => $nomCocktail
    ));
  }
  header("Location: ../../recette/index.php?nomCocktail=$nomCocktail&pathImg=$pathImg");

 ?>
