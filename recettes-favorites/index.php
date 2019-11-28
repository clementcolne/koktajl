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
    <title>Koktajl - Cocktail Blog | Mes recettes favorites</title>

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
                                    <li class="active"><a href="../recettes-favorites/">Mes recettes <i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                    <?php
                                    if(isset($_SESSION['estConnecte'])) {
                                      if($_SESSION['estConnecte'] == "1") {
                                        echo "<li><a href='../compte/'>Mon compte</a></li>";
                                      }
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
                        <h2>Mes recettes <i class="fa fa-heart-o" aria-hidden="true"></i></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### About Area Start ##### -->
    <section class="about-area section-padding-80">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <?php
                      if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'] == "1") {
                        $id = $_SESSION['mail'];
                        $sql = $db->prepare("SELECT nomCocktail FROM cocktailsPreferes WHERE id = :id");
                        try {
                          $sql->execute(array('id' => $id));
                        }catch(Exception $e) {
                          echo $e->getMessage();
                        }
                        while($result = $sql->fetch()) {
                          $nomCocktail = $result['nomCocktail'];
                          $pathImg = remove_accent($nomCocktail);
                          if(!file_exists("../assets/images/Photos/" . $pathImg . ".jpg")) {
                            $pathImg = "no-image";
                          }
                          echo "
                            <a href='../assets/functions/supprimer-cocktail-prefere.php?nomCocktail=$nomCocktail'><i class='fa fa-times'></i></a>
                            <a href='../recette/index.php?nomCocktail=$nomCocktail&pathImg=$pathImg'><balise class='text-left'>$nomCocktail</balise></a></br>
                          ";
                        }
                      }else{
                        if(isset($_SESSION['nbRecettesPreferees'])) {
                          $nbRecettesPreferees = $_SESSION['nbRecettesPreferees'];
                          for($i = 0 ; $i < $nbRecettesPreferees ; $i++) {
                            if(isset($_SESSION["recettePreferee$i"])) {
                              if($_SESSION["recettePreferee$i"] != "") {
                                $recettePreferee = $_SESSION["recettePreferee$i"];
                                $pathImg = remove_accent($recettePreferee);
                                if(!file_exists("../assets/images/Photos/" . $pathImg . ".jpg")) {
                                  $pathImg = "no-image";
                                }
                                echo "
                                  <a href='../assets/functions/supprimer-cocktail-prefere.php?nomCocktail=$recettePreferee'><i class='fa fa-times'></i></a>
                                  <a href='../recette/index.php?nomCocktail=$recettePreferee&pathImg=$pathImg'><balise class='text-left'>$recettePreferee</balise></a></br>
                                ";
                              }
                            }
                          }
                        }
                      }
                     ?>
                </div>
            </div>

        </div>
    </section>
    <!-- ##### About Area End ##### -->

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
