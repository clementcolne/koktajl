<?php
  // ouverture du cookie $_SESSION
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Koktajl - Cocktail Blog | <?php echo $_GET['nomCocktail']; ?></title>

    <!-- Favicon -->
    <link rel="icon" href="../assets/images/img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/monStyle.css">

    <?php
      // includes
      include '../assets/functions/functions.php';
      // connexion à la base de données
      $db = databaseConnect();
      // nomCocktail récupéré depuis le paramètre dans l'URL reçu de la page précédente
      $nomCocktail = htmlspecialchars($_GET['nomCocktail']);
      // pathImg récupéré depuis le param de l'URL de la page précédente, représente le nom de l'image à afficher
      $pathImg = htmlspecialchars($_GET['pathImg']);
    ?>

</head>

<body>

    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="../assets/images/img/core-img/salad.png" alt="">
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-between">
                    <!-- Breaking News -->
                    <div class="col-12 col-sm-6">
                        <div class="breaking-news">
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                  <li>
                                    <?php
                                    if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
                                      echo "Bienvenue " . $_SESSION['nom'] . " " . $_SESSION['prenom'];
                                    }else{
                                      echo "Bienvenue ";
                                    }
                                    ?>
                                  </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php
                      if(isset($_SESSION['estConnecte'])) {
                        if($_SESSION['estConnecte'] == "1") {
                          // utilisateur non connecté, on propose de se connecter
                          echo "<a href='../assets/functions/deconnexion.php?path=../../toutes-nos-recettes/'><div class='text-right'>Déconnexion</div></a>";
                        }else{
                          // utilisateur non connecté, on propose de se connecter
                          echo "<a href='../connexion/'><div class='text-right'>Connexion</div></a>";
                        }
                      }else{
                        // utilisateur non connecté, on propose de se connecter
                        echo "<a href='../connexion/'><div class='text-right'>Connexion</div></a>";
                      }
                    ?>

                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="delicious-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="deliciousNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="../"><img src="../assets/images/img/core-img/logo_koktalj.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="../">Accueil</a></li>
                                    <li><a href="../toutes-nos-recettes/">Tous nos cocktails</a></li>
                                    <li><a href="../recettes-favorites/">Mes recettes <i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                    <?php
                                    if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'] == "1") {
                                      echo "<li><a href='../compte/'>Mon compte</a></li>";
                                    }
                                    ?>
                                </ul>

                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(../assets/images/img/bg-img/accueil2.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2><?php echo $nomCocktail; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <div class="receipe-post-area section-padding-80">

        <!-- Receipe Content Area -->
        <div class="receipe-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="receipe-headline my-5">
                            <div class="receipe-duration">
                                <h2>Préparation</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="receipe-ratings text-right my-5">
                          <?php
                            $sql = $db->prepare("SELECT * FROM cocktailsPreferes WHERE id = :id AND nomCocktail = :nomCocktail");
                            $sql->bindParam('id', $_SESSION['mail']);
                            $sql->bindParam('nomCocktail', $nomCocktail);
                            try {
                              $sql->execute();
                            }catch(Exception $e) {
                              echo $e->getMessage();
                            }

                            if($result = $sql->fetch()) {
                              echo "<a href='../assets/functions/supprimer-cocktail-prefere.php?nomCocktail=$nomCocktail&pathImg=$pathImg' class='btn delicious-btn'>Supprimer des recettes favorites</a> ";
                            }else{
                              echo "<a href='../assets/functions/ajouter-cocktail-prefere.php?nomCocktail=$nomCocktail&pathImg=$pathImg' class='btn delicious-btn'>Ajouter aux recettes favorites</a> ";
                            }
                          ?>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12 col-lg-8">
                        <!-- Single Preparation Step -->
                        <div class="single-preparation-step d-flex">
                            <p>
                              <?php
                                $sql = $db->prepare('SELECT descPreparation FROM cocktail WHERE nomCocktail = :nomCocktail');
                                try {
                                  $sql->execute(array('nomCocktail' => $nomCocktail));
                                }catch(Exception $e) {
                                  echo $e->getMessage();
                                }
                                $result = $sql->fetch();
                                echo $result['descPreparation'];
                              ?>
                        </div>
                    </div>

                    <!-- Ingredients -->
                    <div class='col-12 col-lg-4'>
                        <div class='ingredients'>
                            <h4>Ingrédients</h4>
                              <?php
                                // affichage dynamique des ingrédients des cocktails selon le cocktail
                                $sql = $db->prepare('SELECT descIngredient FROM cocktail WHERE nomCocktail = :nomCocktail');
                                try {
                                  $sql->execute(array('nomCocktail' => $nomCocktail));
                                }catch(Exception $e) {
                                  echo $e->getMessage();
                                }
                                $result = $sql->fetch();
                                $cpt = 1;
                                foreach(explode('|', $result['descIngredient']) as $ingredient) {
                                  echo "

                                          <!-- Custom Checkbox -->
                                          <div class='custom-control custom-checkbox'>
                                              <input type='checkbox' class='custom-control-input' id='customCheck" . $cpt . "'>
                                              <label class='custom-control-label' for='customCheck" . $cpt . "'>" . $ingredient . "</label>
                                          </div>
                                  ";
                                  $cpt++;
                                }
                                echo "<img class='resize-img' src='../assets/images/Photos/" . $pathImg . ".jpg'></img>";
                              ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100 d-flex flex-wrap align-items-center justify-content-between">
                    <!-- Footer Logo -->
                    <div class="footer-logo">
                        <a href="../"><img src="../assets/images/img/core-img/logo_koktalj.png" alt=""></a>
                    </div>
                    <!-- Copywrite -->
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="../assets/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../assets/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="../assets/js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="../assets/js/active.js"></script>
</body>

</html>
