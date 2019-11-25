<?php
// Ce fichier contient toutes les fonctions utilisées dans les différentes pages du site

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

  // TODO fonction faite fatigué, la façon de faire est surement dégueulasse
  // à revoir, finir si bonne façon de faire, refaire entièrement sinon
  /*function ajouterAuxFavoris($nomRecette) {
    // si l'utilisateur est connecté
    if(isset($_SESSION['estConnecte'])) {
      // alors ajout direct dans la DB de la recette
      $db = databaseConnect();
      // récupère toutes les recettes préférées d'un utilisateur
      $sql = $db->prepare("SELECT * FROM liaisonUserRecette WHERE user = $_SESSION['mail']");
      try {
        $sql->execute();
      }catch(PDOException $e) {
        echo "Erreur : $e->getMessage()";
      }
      // récupère toutes les recettes
    }else{
      // ajout dans les cookies en attendant la connexion
      $_SESSION['nbRecettesPreferees']++;
      $_SESSION["recettePreferee$_SESSION['nbRecettesPreferees']"] = $nomRecette;
    }
  }*/

 ?>
