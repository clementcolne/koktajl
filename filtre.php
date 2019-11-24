<?php

$servername = "mysql:host=clementcanclem.mysql.db;dbname=clementcanclem;";
$username = "clementcanclem";
$password = "Vuhopu6Vuhopu6";

  // CETTE PARTIE AFFICHE TOUS LES COCKTAILS SELON UN FILTRE

    // connection à la database
    $servername = "mysql:host=localhost;dbname=myDB;charset=utf8";
    $username = "root";
    $password = "root";
    // Connexion à la base de donnée
    try {
      $db = new PDO($servername, $username, $password);
    }catch(Exception $e) {
      die('Erreur : ' . $e->getMessage());
    }

    $array = array();
    $filtre = 'Jus d\'ananas'; // sélectionner toutes les boissons contenant de l'ananas
    $sql = $db->prepare("SELECT cocktail.nomCocktail FROM cocktail, liaison WHERE liaison.nomIngredient = :filtre AND liaison.nomCocktail = cocktail.nomCocktail");
    $sql->execute(array(':filtre' => $filtre));
    while($result = $sql->fetch()) {
      array_push($array, $result['nomCocktail']);
    }

 ?>

 <script>

  // Access the array elements
  var passedArray =  <?php echo json_encode($array); ?>;

  // Display the array elements
  for(var i = 0; i < passedArray.length; i++){
      document.write(passedArray[i] + "</br>");
  }

</script>
