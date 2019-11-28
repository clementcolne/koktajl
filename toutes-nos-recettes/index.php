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
    <title>Koktajl - Cocktail Blog | Tous nos cocktails</title>

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

    <!-- Search Wrapper -->
    <div class="search-wrapper">
        <!-- Close Btn -->
        <div class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#" method="post">
                        <input type="search" name="search" placeholder="Type any keywords...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
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
                                    <li class="active"><a href="./">Tous nos cocktails</a></li>
                                    <li><a href="../recettes-favorites/">Mes recettes <i class="fa fa-heart-o" aria-hidden="true"></i></a></li>
                                    <?php
                                    if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'] == "1") {
                                      echo "<li><a href='../compte/'>Mon compte</a></li>";
                                    }
                                    ?>
                                </ul>

                                <!-- Newsletter Form -->
                                <div class="search-btn">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>

                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Best Receipe Area Start ##### -->
    <section class="best-receipe-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Tous nos cocktails</h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Single Best Receipe Area -->
                <?php

                $sql = $db->query("SELECT nomCocktail FROM cocktail");
                while($result = $sql->fetch()) {
                  // récupération du nom du cocktail
                  $nomCocktail = $result['nomCocktail'];
                  // manipulation de $nomCocktail pour obtenir un nom d'image dans accents et caractères spéciaux
                  $pathImg = remove_accent($nomCocktail);
                  // si il n'existe pas d'image pour le cocktail, alors on
                  // affecte une image par défaut
                  if(!file_exists("../assets/images/Photos/" . $pathImg . ".jpg")) {
                    $pathImg = "no-image";
                  }

                  echo "

                    <div class='col-12 col-sm-6 col-lg-4'>
                        <div class='single-best-receipe-area mb-30'>
                          <a href='../recette/index.php?nomCocktail=" . $nomCocktail . "&pathImg=" . $pathImg . "'>
                            <img class='resize-img' src='../assets/images/Photos/" . $pathImg . ".jpg'>
                            <div class='receipe-content'>
                              <h5>" . $nomCocktail . "</h5>
                            </div>
                          </a>
                        </div>
                    </div>";

                }
                ?>

            </div>
        </div>
    </section>
    <!-- ##### Best Receipe Area End ##### -->

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
