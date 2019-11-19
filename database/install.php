<?php

  include './databaseQueries.php';

  /**
   * Effectue la conneixon à la DB
   * et crée les différentes tables de celle-ci
   * @return mysqli objet correspondant à la DB
   */
  function connectDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $databaseName = "myDB";

    // Connexion à MySql
    $db = new mysqli($servername, $username, $password);
    // Vérifie si la connexion est ok
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    foreach(explode(';', createDatabase($databaseName)) as $sql) {
      echo "</br>$sql </br>";
      $bool = $db->query($sql);
      if ($bool) {
          echo "Success";
      } else {
          echo "Error creating database: " . $db->error;
      }
    }

    return $db;
  }

  /**
   * Ferme la connexion à la DB
   * @param  mysqli $db objet correspondant à la DB
   */
  function quitDatabase($db) {
    $db->close();
  }

  $conn = connectDatabase();


?>
