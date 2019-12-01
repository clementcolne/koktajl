<?php

/**
 * Ce fichier effectue la connexion d'un utilisateur à son compte
 * si les données concordent avec la base de données, alors l'utilisateur
 * est redirigé sur la page d'accueil
 * sinon, l'utilisateur est redirigé sur la page de connexion avec le message
 * informant des paramètres manquants ou faux
 */

  // ouverture du cookie $_SESSION
  session_start();
  // includes
  include './functions.php';
  // connexion à la DB
  $db = databaseConnect();

  // vérificaiton de la présence des $_POST et traitement pour sécurité
  if(!isset($_POST['mdp']) || !isset($_POST['email'])) {
    // champ vide, redirection page d'accueil sans passer par la case connexion
    header('Location: ../../index.php');
  }else{
    // champs pleins, récupération des données du compte
    $mdp = htmlspecialchars($_POST['mdp']);
    $mail = htmlspecialchars($_POST['email']);

    // récupère l'ensemble des informations sur les utilisateurs correspondantes au mail de l'utilisateur
    $sql = $db->prepare('SELECT * FROM user WHERE id = :mail');
    $sql->bindParam(':id', $mail);
    try {
      $sql->execute();
    }catch(Exception $e) {
      echo "Erreur : $e->getMessage()";
    }

    // test de réponse, si aucune réponse alors email inconnu
    $reponse = $sql->fetch(); // premiere ligne du retour de la requete
    if(!$reponse){
      // aucun utilisateur correspondant
      header('Location: ../../connexion/index.php?erreurMail=utilisateur inconnu');
    }else{
      // un utilisateur trouvé
      // récupération du mdp de l'utilisateur haché
      $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
      // vérification de la concordance mail/mdp
      if(password_verify($mdp, $reponse['mdp'])) {
        // mail et mot de passe bons, connexion de l'utilisateur
        // ajout des informations de l'utilisateur connecté dans le cookie $_SESSION
        $_SESSION['estConnecte'] = "1"; // utilisateur connecté
        $_SESSION['prenom'] = $reponse['prenom'];
        $_SESSION['nom'] = $reponse['nom'];
        $_SESSION['mail'] = $reponse['id'];
        // ajout des cocktails préférés présents dans le cookie à la DB si il y en a
        $nbRecettesPreferees = $_SESSION['nbRecettesPreferees'];
        for($i = 0 ; $i < $nbRecettesPreferees ; $i++) {
          $nomCocktail = $_SESSION["recettePreferee$i"];
          $id = $_SESSION['mail'];
          $sql = $db->prepare("SELECT * FROM cocktailsPreferes WHERE id = :id");
          $sql->bindParam('id', $id);
          $sql->execute();
          $estPresent = false;
          while($reponse = $sql->fetch()) {
            if($reponse['nomCocktail'] == $nomCocktail) {
              $estPresent = true;
            }
          }
          if($estPresent == false) {
            $sql2 = $db->prepare("INSERT INTO cocktailsPreferes(id, nomCocktail) VALUES (:id, :nomCocktail)");
            $sql2->bindParam('id', $id);
            $sql2->bindParam('nomCocktail', $nomCocktail);
            try {
              $sql2->execute();
            }catch(Exception $e) {
              echo "Erreur : $e->getMessage()";
            }
          }
        }
        // retour page d'accueil
        header('Location: ../../index.php');
      }else{
        // mail bon, mot de passe mauvais
        header('Location: ../../connexion/index.php?erreurMdp=mauvais mot de passe');
      }
    }
  }

?>
