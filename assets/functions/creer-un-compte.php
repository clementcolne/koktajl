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

  if(!isset($_POST['email'])) {
    $mail = "";
  }else{
    $mail = htmlspecialchars($_POST['email']);
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

  // on vérifie qu'il n'y a pas déjà un compte existant dans la DB (car compte unique par adresse maim)
  $sql = $db->prepare('SELECT * FROM user WHERE id = :mail');
  try {
    $sql->execute(array('mail' => $mail));
  }catch(PDOException $e) {
    echo "Erreur : $e->getMessage()";
  }
  $reponse = $sql->fetch();
  if(!$reponse){
    // pas de réponse, donc mail pas encore utilisé, donc on créé un compte
    // on crée le compte dans la DB
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
    $_SESSION['prenom'] = $prenom;
    $_SESSION['nom'] = $nom;
    // retour à la page d'accueil
    header('Location: ../../index.php?');
    // TODO : message de succès (trouver une façon jolie de faire)
  }else{
    // compte déjà existant, redirect formulaire d'inscription
    header('Location: ../../creer-un-compte/index.php?erreur=compte existant');
  }

 ?>
