<?php

/**
 * Ce fichier met à jour les informations personnelles d'un utilisateur
 */

  // ouverture du cookie $_SESSION
  session_start();
  // includes
  include './functions.php';
  // connexion à la DB
  $db = databaseConnect();

  if(!isset($_SESSION['mail'])) {
    header('Location: ../../index.php');
    exit();
  }
  $ancienMail = $_SESSION['mail'];

  // vérificaiton de la présence des $_POST et traitement pour sécurité
  if(isset($_POST['mdp'])) {
    $mdp = htmlspecialchars($_POST['mdp']);
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
    $sql = $db->prepare('UPDATE user SET mdp = :mdp WHERE id = :ancienMail');
    $sql->bindParam(':mdp', $mdp_hash);
    $sql->bindParam(':ancienMail', $ancienMail);
    try {
      $sql->execute();
    }catch(Exception $e) {
      echo "Erreur : $e->getMessage()";
    }
  }

  if(isset($_POST['nom'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $sql = $db->prepare('UPDATE user SET nom = :nom WHERE id = :ancienMail');
    $sql->bindParam(':nom', $nom);
    $sql->bindParam(':ancienMail', $ancienMail);
    try {
      $sql->execute();
    }catch(Exception $e) {
      echo "Erreur : $e->getMessage()";
    }
  }

  if(isset($_POST['prenom'])) {
    $prenom = htmlspecialchars($_POST['prenom']);
    $sql = $db->prepare('UPDATE user SET prenom = :prenom WHERE id = :ancienMail');
    $sql->bindParam(':prenom', $prenom);
    $sql->bindParam(':ancienMail', $ancienMail);
    try {
      $sql->execute();
    }catch(Exception $e) {
      echo "Erreur : $e->getMessage()";
    }
  }

  if(isset($_POST['email'])) {
    $id = htmlspecialchars($_POST['email']);
    // si l'utilisateur change d'adresse pour une adresse existante
    $sql = $db->prepare('SELECT * FROM user');
    try {
      $sql->execute();
    }catch(Exception $e) {
      echo "Erreur : $e->getMessage()";
    }
    while($reponse = $sql->fetch()) {
      if($reponse['id'] == $id && $reponse['id'] != $ancienMail) {
        header('Location: ../../compte/index.php?erreurMail=cet email est déjà lié à un compte');
        exit();
      }
    }
    // si l'utilisateur change d'adresse pour une nouvelle adresse
    $sql = $db->prepare('UPDATE user SET id = :id WHERE id = :ancienMail');
    $sql->bindParam(':id', $id);
    $sql->bindParam(':ancienMail', $ancienMail);
    try {
      $sql->execute();
    }catch(Exception $e) {
      echo "Erreur : $e->getMessage()";
    }
  }

  // mise à jour des informations cookie $_SESSION utilisateur
  $_SESSION['prenom'] = $prenom;
  $_SESSION['nom'] = $nom;
  $_SESSION['mail'] = $id;

  // retour à la page du compte
  header('Location: ../../compte/index.php?success=changements effectués avec succès');

 ?>
