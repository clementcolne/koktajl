<?php

  // TODO : ajouter cocktail préféré quand on est pas connecté

  // ouverture du cookie $_SESSION
  session_start();
  // includes
  include './functions.php';
  // connexion à la DB
  $db = databaseConnect();

  if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'] == "1") {
    // l'utilisateur est connecté, alors ajout dans la base de données
    if(isset($_GET['nomCocktail']) && isset($_GET['pathImg'])) {
      $nomCocktail = $_GET['nomCocktail'];
      $pathImg = $_GET['pathImg'];
      $id = $_SESSION['mail'];
      $sql = $db->query("SELECT * FROM cocktailsPreferes");
      while($reponse = $sql->fetch()) {
        if($reponse['nomCocktail'] == $nomCocktail) {
          header("Location: ../../recette/index.php?nomCocktail=$nomCocktail&pathImg=$pathImg");
          exit();
        }
      }
      $sql = $db->prepare("INSERT INTO cocktailsPreferes(id, nomCocktail) VALUES (:id, :nomCocktail)");
      $sql->bindParam(':id', $id);
      $sql->bindParam(':nomCocktail', $nomCocktail);
      try {
        $sql->execute(array(
          'id' => $id,
          'nomCocktail' => $nomCocktail
        ));
      }catch(Exception $e) {
        echo "Erreur : $e->getMessage()";
      }
    }
  }else{
    if(isset($_GET['nomCocktail']) && isset($_GET['pathImg'])) {
      // l'utilisateur n'est pas connecté alors ajout dans les cookies
      $nomCocktail = $_GET['nomCocktail'];
      $pathImg = $_GET['pathImg'];
      if(!isset($_SESSION['nbRecettesPreferees'])) {
        // cookie session inexistant donc jamais initialisé
        $_SESSION['nbRecettesPreferees'] = 0;
      }

      // ajout uniquement si pas déjà ajoutée
      $nbRecettesPreferees = $_SESSION['nbRecettesPreferees'];
      $existant = false;
      for($i = 0 ; $i < $nbRecettesPreferees ; $i++) {
        $recettePreferee = $_SESSION["recettePreferee$i"];
        if($recettePreferee == $nomCocktail) {
          $existant = true;
        }
      }
      // nom unique, on l'ajoute
      if($existant == false) {
        $_SESSION["recettePreferee$nbRecettesPreferees"] = $nomCocktail; // ajout de la recette préférée
        $_SESSION['nbRecettesPreferees']++; // incrémentation du nombre de recettes préférées
      }
    }
  }

  header("Location: ../../recette/index.php?nomCocktail=$nomCocktail&pathImg=$pathImg");

 ?>
