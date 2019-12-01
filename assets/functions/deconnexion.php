<?php


  // ouverture du cookie $_SESSION
  session_start();

  /**
   * Déconnecte un utilisateur
   * en vidant le cookie $_SESSION
   */
  function deconnexion() {
    setcookie (session_id(), "", time() - 3600);
    session_destroy();
    session_write_close();
    header('Location: ' . htmlspecialchars($_GET['path']));
  }

  deconnexion();

 ?>
