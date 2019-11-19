<?php

  /**
   * Retourne un string contenant les requêtes SQL pour la création de la
   * base de données, chaque requête est séparée par un point-virgule
   * @param  string $databaseName nom de la base de données
   * @return string               string contenant les requêtes SQL
   */
  function createDatabase($databaseName) {
    $sql = "
      DROP DATABASE IF EXISTS $databaseName;
      CREATE DATABASE $databaseName;
      USE $databaseName;
      CREATE TABLE user (
        id varchar(100),
        mdp varchar(100),
        nom varchar(100),
        prenom varchar(100)
      );
      CREATE TABLE cocktail (
        nomCocktail varchar(100),
        descIngretient varchar(100),
        descPreparation varchar(100),
        photo varchar(100)
      );
      CREATE TABLE ingredient (
        nomIngredient varchar(100),
        nomCategorie varchar(100)
      );
      CREATE TABLE categorie (
        nomCategorie varchar(100),
        superCategorie varchar(100)
      )
    ";

    return $sql;
  }

 ?>
