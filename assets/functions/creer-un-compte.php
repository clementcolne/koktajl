<?php

  // ouverture du cookie $_SESSION
  session_start();
  // includes
  include './functions.php';
  // connexion à la DB
  $db = databaseConnect();

  // vérificaiton de la présence des $_POST et traitement pour sécurité
  if(!isset($_POST['mdp'])) {
    $mdp = "";
  }else{
    $mdp = htmlspecialchars($_POST['mdp']);
  }
  if(!isset($_POST['mdpConfirme'])) {
    $mdpConfirme = "";
  }else{
    $mdpConfirme = htmlspecialchars($_POST['mdpConfirme']);
  }
  if(!isset($_POST['email'])) {
    $mail = "";
  }else{
    $mail = htmlspecialchars($_POST['email']);
  }
  if(!isset($_POST['emailConfirme'])) {
    $mailConfirme = "";
  }else{
    $mailConfirme = htmlspecialchars($_POST['emailConfirme']);
  }
  if(!isset($_POST['nom'])) {
    $nom = "";
  }else{
    $nom = htmlspecialchars($_POST['nom']);
  }
  if(!isset($_POST['prenom'])) {
    $prenom = "";
  }else{
    $prenom = htmlspecialchars($_POST['prenom']);
  }

  if($mdp == $mdpConfirme && $mail == $mailConfirme) {
    // concordance entre les 2 mdp et les 2 mails
    $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
    // ajout du mdp haché dans la DB selon son mail
    $sql = $db->prepare("INSERT INTO user(id, mdp, nom, prenom) VALUES (:id, :mdp, :nom, :prenom)");
    $sql->bindParam(':id', $mail);
    $sql->bindParam(':mdp', $mdp_hash);
    $sql->bindParam(':nom', $nom);
    $sql->bindParam(':prenom', $prenom);
    try {
      $sql->execute();
    }catch(PDOException $e) {
      echo "Erreur : $e->getMessage()";
    }
    // compte créé et ajouté dans la DB
    // ajout des informations de l'utilisateur connecté dans le cookie $_SESSION
    $_SESSION['estConnecte'] = "1"; // utilisateur connecté
    $_SESSION['prenom'] = $reponse['prenom'];
    $_SESSION['nom'] = $reponse['nom'];
    // retour à la page d'accueil
    header('Location: ../../index.php?');
    // TODO : ajout aux cookies création réussie + connexion + message de succès (trouver une façon jolie de faire)
  }else{
    // non concordance
    header('Location: ../../creer-un-compte/index.php?erreur=non concordance');
    // TODO : trouver une façon de faire ça dynamiquement dans la page creer-un-compte.php
  }

 ?>