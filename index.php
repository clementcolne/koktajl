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
    <title>Koktajl - Cocktail Blog | Accueil</title>

    <!-- Favicon -->
    <link rel="icon" href="./assets/images/img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="./assets/style.css">

    <?php
      // includes
      include './assets/functions/functions.php';
      // connexion à la base de données
      $db = databaseConnect();
    ?>

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="./assets/images/img/core-img/salad.png" alt="">
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
                                    <li><a href="#">Bienvenue !</a></li>
                                    <li><a href="./recette/index.php?nomCocktail=Bloody Mary&pathImg=Bloody_mary">La recette du mois : Le Bloody Mary</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <p>
          <?php
            if(isset($_SESSION['estConnecte'])) {
              if($_SESSION['estConnecte'] == "1") { // utilisateur connecté
                if(isset($_SESSION['nom'])) {
                  echo "Connecté en tant que " . $_SESSION['nom'];
                }
                if(isset($_SESSION['prenom'])) {
                  echo " " . $_SESSION['prenom'];
                }
              }
            }else{
              echo "Non connecté";
            }
          ?>
        </p>

        <!-- Navbar Area -->
        <div class="delicious-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="deliciousNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="./"><img src="./assets/images/img/core-img/logo_koktalj.png" alt=""></a>

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
                                    <li class="active"><a href="./">Accueil</a></li>
                                    <li><a href="./toutes-nos-recettes/index.php">Tous nos cocktails</a></li>
                                    <li><a href="#">Ingredient</a>
                                        <ul class="dropdown">
                                            <li><a href="#">Fruit</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">Agrumes</a>
                                                        <ul class="dropdown">
                                                            <li><a href="index.html">Pamplemousse</a></li>
                                                            <li><a href="about.html">Citron</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="about.html">Jus de fruit</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Liquides</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">Liquide avec alcool</a>
                                                        <ul class="dropdown">
                                                            <li><a href="index.html">Rhum</a></li>
                                                            <li><a href="about.html">Malibu</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Liquide sans alcool</a>
                                                        <ul class="dropdown">
                                                            <li><a href="index.html">Jus de tomate</a></li>
                                                            <li><a href="about.html">Coca-Cola</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Produit laitier</a>
                                                <ul class="dropdown">
                                                    <li><a href="index.html">Lait</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="receipe-post.html">Nos cocktails sans alcool</a></li>
                                    <li><a href="contact.html">Contact</a></li>
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

    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img" style="background-image: url(./assets/images/img/blog-img/accueil.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="hero-slides-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="300ms">La recette du mois</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Découvrez la recette du mois, la délicieuse recette du Bloody Mary. Un subtil mélange entre le jus de tomate, le piment et la vodka.</p>
                                <a href="./recette/index.php?nomCocktail=Bloody Mary&pathImg=Bloody_mary" class="btn delicious-btn" data-animation="fadeInUp" data-delay="1000ms">Découvrir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    <section class="top-catagory-area section-padding-80-0">
        <div class="container">
            <div class="row">
                  <div class="col-12">
                      <div class="section-heading">
                          <h3>Nos suggestions</h3>
                      </div>
                  </div>
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-catagory">
                        <img src="./assets/images/img/blog-img/mojito.jpg" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>Piña Colada</h3>
                            <h6>Simple &amp; Délicieuse</h6>
                            <a href="./recette/index.php?nomCocktail=Piña Colada&pathImg=Pina_colada" class="btn delicious-btn">Découvrez la recette</a>
                        </div>
                    </div>
                </div>
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-catagory">
                        <img src="./assets/images/img/blog-img/mojito.jpg" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>Mojito</h3>
                            <h6>Frais &amp; Intriguant</h6>
                            <a href="./recette/index.php?nomCocktail=Mojito&pathImg=Mojito" class="btn delicious-btn">See Full Receipe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <section class="cta-area bg-img bg-overlay" style="background-image: url(./assets/images/img/blog-img/accueil.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <!-- Cta Content -->
                    <div class="cta-content text-center">
                        <h2>Des dizaines de recettes</h2>
                        <p>Découvrez toutes nos recettes de cocktails, avec ou sans alcool, revisités par nos chefs pour votre plaisir.</br>L’abus d’alcool est dangereux pour la santé. À consommer avec modération.</p>
                        <a href="./toutes-nos-recettes/index.php" class="btn delicious-btn">Découvrez toutes nos recettes</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### CTA Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer-area">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100 d-flex flex-wrap align-items-center justify-content-between">
                    <!-- Footer Logo -->
                    <div class="footer-logo">
                        <a href="./"><img src="./assets/images/img/core-img/logo_koktalj.png" alt=""></a>
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
    <script src="./assets/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="./assets/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="./assets/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="./assets/js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="./assets/js/active.js"></script>
</body>

</html>
