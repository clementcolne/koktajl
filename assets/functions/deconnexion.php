<?php

  // ouverture du cookie $_SESSION
  session_start();

  /**
   * déconnecte un utilisateur
   */
  function deconnexion() {
    setcookie (session_id(), "", time() - 3600);
    session_destroy();
    session_write_close();
    header('Location: ' . htmlspecialchars($_GET['path']));
  }

  deconnexion();

 ?>
