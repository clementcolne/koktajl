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
        descIngredient varchar(1000),
        descPreparation varchar(1000)
      );
      CREATE TABLE ingredient (
        nomIngredient varchar(100) PRIMARY KEY
      );
      CREATE TABLE liaison (
        nomCocktail varchar(100),
        nomIngredient varchar(100),
        PRIMARY KEY(nomCocktail, nomIngredient),
        FOREIGN KEY(nomCocktail) REFERENCES cocktail(nomCocktail),
        FOREIGN KEY(nomIngredient) REFERENCES ingredient(nomIngredient)
      );
      CREATE TABLE sousCategorie (
        nomCategorie varchar(100),
        nomSuperCategorie varchar(100),
        PRIMARY KEY(nomCategorie, nomSuperCategorie),
        FOREIGN KEY(nomCategorie) REFERENCES ingredient(nomIngredient),
        FOREIGN KEY(nomSuperCategorie) REFERENCES ingredient(nomIngredient)
      );
      CREATE TABLE cocktailsPreferes (
        id varchar(100),
        nomCocktail varchar(100),
        FOREIGN KEY(id) REFERENCES user(id),
        FOREIGN KEY(nomCocktail) REFERENCES cocktail(nomCocktail)
      )
    ";

    return $sql;
  }

 ?>
