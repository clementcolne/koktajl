<?php

  /**
   * Retourne un string contenant les requêtes SQL pour la création de la
   * base de données, chaque requête est séparée par un point-virgule
   * @param  string $databaseName nom de la base de données
   * @return string               string contenant les requêtes SQL
   */
  function createDatabase($databaseName) {
    $sql = "
      CREATE DATABASE IF NOT EXISTS $databaseName;
      ALTER DATABASE `cocktail` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
      USE $databaseName;
      CREATE TABLE user (
        id varchar(100) PRIMARY KEY,
        mdp varchar(100),
        nom varchar(100),
        prenom varchar(100)
      );
      CREATE TABLE cocktail (
        nomCocktail varchar(100) PRIMARY KEY,
        descIngredient varchar(10000),
        descPreparation varchar(10000)
      )
    ";

    return $sql;
  }

 ?>
