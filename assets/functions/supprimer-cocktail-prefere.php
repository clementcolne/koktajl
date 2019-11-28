<?php

  // ouverture du cookie $_SESSION
  session_start();
  // includes
  include './functions.php';
  // connexion à la DB
  $db = databaseConnect();

  if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'] == 1) {
    // utilisateur connecté, suppression de la DB
    if(isset($_GET['nomCocktail'])) {
      // nom du cocktail à supprimer des favoris
      $nomCocktail = $_GET['nomCocktail'];
      $id = $_SESSION['mail'];
      $sql = $db->prepare("DELETE FROM cocktailsPreferes WHERE id = :id AND nomCocktail = :nomCocktail");
      try {
        $sql->execute(array(
          'id' => $id,
          'nomCocktail' => $nomCocktail
        ));
      }catch(Exception $e) {
        echo $e->getMessage();
      }
    }
  }else{
    // utilisateur pas connecté, suppression des cookies
    if(isset($_GET['nomCocktail'])) {
      // nom du cocktail à supprimer des favoris
      $nomCocktail = $_GET['nomCocktail'];
      $nbRecettesPreferees = $_SESSION['nbRecettesPreferees'];
      for($i = 0 ; $i < $nbRecettesPreferees ; $i++) {
        $recettePreferee = $_SESSION["recettePreferee$i"];
        if($recettePreferee == $nomCocktail) {
          $_SESSION["recettePreferee$i"] = "";
        }
      }
    }
  }
  header('Location: ../../recettes-favorites/');

 ?>
