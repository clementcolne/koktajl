<?php

  /**
   * Effectue la connexion à la base de données
   * @return PDO base de données
   */
  function databaseConnect() {
    // connection à la database
    $servername = "mysql:host=localhost;dbname=myDB;charset=utf8;";
    $username = "root";
    $password = "root";
    /* POUR CLEMENTCOLNE.COM
    $servername = "mysql:host=clementcanclem.mysql.db;dbname=clementcanclem;";
    $username = "clementcanclem";
    $password = "Vuhopu6Vuhopu6";
    */
    // Connexion à la base de donnée
    try {
      $db = new PDO($servername, $username, $password);
    }catch(Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }
    return $db;
  }

  /**
   * Remplace tous les caractères spéciaux par un champ vide ou un underscore
   * et retire tous les accents de chaque lettre
   * @param  string $pathImg chaîne de caractère à traiter
   * @return string          chaine de caractère traitée
   */
  function remove_accent($pathImg) {
    // remplace les caractères spéciaux
    $pathImg = str_replace(" ", "_", $pathImg);
    $pathImg = str_replace("'", "", $pathImg);
    // remplace les accents sur les e
    $pathImg = str_replace("é", "e", $pathImg);
    $pathImg = str_replace("è", "e", $pathImg);
    $pathImg = str_replace("ë", "e", $pathImg);
    $pathImg = str_replace("ê", "e", $pathImg);
    // remplace les accents sur les a
    $pathImg = str_replace("à", "a", $pathImg);
    $pathImg = str_replace("ä", "a", $pathImg);
    // remplace les accents sur les u
    $pathImg = str_replace("û", "u", $pathImg);
    $pathImg = str_replace("ü", "u", $pathImg);
    $pathImg = str_replace("ù", "u", $pathImg);
    // remplace les accents sur les o
    $pathImg = str_replace("ô", "o", $pathImg);
    $pathImg = str_replace("ö", "o", $pathImg);
    // remplace les accents sur les a
    $pathImg = str_replace("à", "a", $pathImg);
    $pathImg = str_replace("ä", "a", $pathImg);
    // remplace les accents sur les i
    $pathImg = str_replace("ï", "i", $pathImg);
    $pathImg = str_replace("î", "i", $pathImg);
    // remplace les accents sur les c
    $pathImg = str_replace("ç", "c", $pathImg);
    // remplace les accents sur les n
    $pathImg = str_replace("ñ", "n", $pathImg);

    return $pathImg;
  }

  /**
   * Cette fonction retourne vrai si la recette est aux favoris des cookies, faux sinon
   * @return boolean
   */
  function est_favorite() {
    // get de la recette à vérifier si elle est aux favoris
    $recette_favorite = $_GET['nomCocktail'];
    $est_fav = false;
    // parcours de toutes les recettes favorites
    if(isset($_SESSION['nbRecettesPreferees'])) {
    for($i = 0 ; $i < $_SESSION['nbRecettesPreferees'] ; $i++) {
        $recettePreferee = $_SESSION["recettePreferee$i"];
        if($recettePreferee == $recette_favorite) {
          // recette déjà aux favoris
          $est_fav = true;
        }
      }
    }
    return $est_fav;
  }

 ?>
