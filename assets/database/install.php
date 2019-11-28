<?php

// POUR LES ERREURS OUVRIR : php_error.log

/* Ce fichier crée une base de données appelée myDB, crée
ses tables correspondantes et remplis les tables selon
les données récupérées dans les tableaux contenus dans le fichier
Donnees.inc.php */

include './databaseQueries.php';
include '../datas/Donnees.inc.php';
include '../functions/functions.php';

$databaseName = "myDB";

$db = databaseConnect();

// création des tables de la DB
foreach(explode(';', createDatabase($databaseName)) as $sql) {
  echo "</br>COMMANDE SQL EFFECTUEE AVEC SUCCES : $sql</br>";
  $bool = $db->exec($sql);
  $db->exec($sql);
}

// récupération de tous les ingrédients existants même on utilisés dans un cocktail
// insert dans la table ingredient
foreach($Hierarchie as $key => $nomIngredient) {
  $sql = $db->prepare("INSERT INTO ingredient(nomIngredient) VALUES(:nomIngredient)");
  $sql->bindParam(':nomIngredient', $key);
  try {
    $sql->execute();
  }catch(PDOException $e) {
    echo "Erreur : $e->getMessage()";
  }
}

// parcours du premier tableau $Recettes
foreach($Recettes as $array) {
  // récupération du nom et de la description des ingrédients et de la préparation
  // insert dans table cocktail
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

  // récupération des ingrédients du cocktail
  // insert dans la table liaison selon le nom du cocktail
  $arrayIndex = $array['index'];
  foreach($arrayIndex as $nomIngredient) {
    // pour chaque ingrédient d'un cocktail
    // insert dans la table liaison l'ingrédient associé à sa recette
    $sql = $db->prepare("INSERT INTO liaison(nomCocktail, nomIngredient) VALUES(:nomCocktail, :nomIngredient)");
    $sql->bindParam(':nomCocktail', $nomCocktail);
    $sql->bindParam(':nomIngredient', $nomIngredient);
    try {
      $sql->execute();
    }catch(PDOException $e) {
      echo "Erreur : $e->getMessage()";
    }
  }
}

// parcours du deuxième tableau $Hierarchie
foreach($Hierarchie as $nomSuperCategorie => $array) {
  // récupération du nom et de la description des ingrédients et de la préparation
  // insert dans table Cocktail
  foreach($array as $caracteristique => $valeur) {
    if($caracteristique == 'sous-categorie') {
      foreach($valeur as $nomAliment) {
        // pour chaque sous-catégorie d'une super-catégorie
        // insert dans la table sousCategorie la super-catégorie associée à la catégorie regardée
        $sql = $db->prepare("INSERT INTO sousCategorie(nomCategorie, nomSuperCategorie) VALUES(:nomCategorie, :nomSuperCategorie)");
        $sql->bindParam(':nomCategorie', $nomCategorie);
        $sql->bindParam(':nomSuperCategorie', $nomSuperCategorie);
        try {
          $sql->execute();
        }catch(PDOException $e) {
          echo "Erreur : $e->getMessage()";
        }
      }
    }
  }
}

?>
