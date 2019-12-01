<?php

  // ouverture du cookie $_SESSION
  session_start();
  // includes
  include './functions.php';
  // connexion à la DB
  $db = databaseConnect();

  if(isset($_SESSION['estConnecte'])) {
    if($_SESSION['estConnecte'] == 1) {
      // utilisateur connecté, suppression de la DB
      if(isset($_GET['nomCocktail'])) {
        // nom du cocktail à supprimer des favoris
        $nomCocktail = $_GET['nomCocktail'];
        $pathImg = $_GET['pathImg'];
        $id = $_SESSION['mail'];
        $sql = $db->prepare("DELETE FROM cocktailsPreferes WHERE id = :id AND nomCocktail = :nomCocktail");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':nomCocktail', $nomCocktail);
        try {
          $sql->execute();
        }catch(Exception $e) {
          echo $e->getMessage();
        }
        header("Location: ../../recette/index.php?nomCocktail=$nomCocktail&pathImg=$pathImg");
      }
    }
  }else if(!isset($_SESSION['estConnecte'])){
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
    header('Location: ../../recettes-favorites/');
  }else{
    header('Location: ../../recettes-favorites/');
  }

 ?>
