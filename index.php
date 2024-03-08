<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Football Amateur &mdash;Acceuil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">



</head>

<body class="bg-white text-black">
          <?php
              $mysqli = new mysqli('localhost','zwarial00','sp5za2tu','zfl2-zwarial00_1');
              if ($mysqli -> connect_errno) {
                //
                echo "Error: Problème de connexion à la BDD \n";
                echo "Errno: " . $mysqli->connect_errno ."\n";
                echo "Error: " . $mysqli->connect_error . "\n";
                // Arrêt du chargement de la page
                exit();

              }
              // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
              if (!$mysqli->set_charset("utf8")) {
               printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
               exit();
              }
              $rqt = "SELECT * FROM t_configuration_cfg";
              $re_cfg = $mysqli->query($rqt);
              $cfg = $re_cfg->fetch_assoc();
          ?>

  <div class="site-wrap">
    <h1 class="text-black"></h1>

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4 bg-black" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="index.html" class="">
              <?php echo $cfg["cfg_nom"] ?>
            </a>
          </div>
          <div class="ml-auto">
            <nav class="site-navigation position-relative text-right text-black" role="navigation">
              <ul class="bg-black site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active"><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="pad.php" class="nav-link">PAD</a></li>
                <li ><a href="players.php" class="nav-link">Activite</a></li>
                <li><a href="inscription.php" class="nav-link">Inscription</a></li>
                <li><a href="session.php" class="nav-link">CONNEXION</a></li>
                <li ><a href="admin_acceuil.php" class="nav-link">ADMIN</a></li>
              </ul>
            </nav>

            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white"><span
                class="icon-menu h3 text-white"></span></a>
          </div>
        </div>
      </div>

    </header>

    <div class="hero overlay" style="background-image: url('images/bg_3.jpg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 ml-auto">
            <h3 class="text-black"> <?php echo $cfg["cfg_description"]?> </h3>
            <p> <?php echo $cfg["cfg_texte"]?></p>
          </div>
        </div>
      </div>
    </div>
    
     <div class="container bg-white">   
       <?php
              //echo ("Connexion BDD réussie !");
              $requete="SELECT * FROM t_news_new WHERE new_etat = 'P'";
              //echo ($requete);

              $result1 = $mysqli->query($requete);
            if ($result1 == false) //Erreur lors de l’exécution de la requête
            { // La requête a echoué
             echo "Error: La requête a echoué \n";
             echo "Errno: " . $mysqli->errno . "\n";
             echo "Error: " . $mysqli->error . "\n";
             exit();
            }
            else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
            {

            //echo "<br />";
            //echo("<table class=\"table table_bordered\">");
            echo "
            <table border = 1 class='mt-5'>
                <tr>
                    <th>Titre</th>
                    <th>Texte</th>
                    <th>Auteur</th>
                    <th>Date</th>
                </tr>";
            //echo($result1->num_rows); //Donne le bon nombre de lignes récupérées
             while ($actu = $result1->fetch_assoc())
             {
              //echo("<table border = 1>");
              echo"
              <tr>
                <td>".$actu['new_titre']."</td>
                <td>".$actu['new_texte']."</td>
                <td>".$actu['cpt_pseudo']."</td>
                <td>".$actu['new_date']."</td>
              <tr/>
              ";
              // echo("<table ");
             
            }
          }
            echo"
            </table>
            ";
            //Ferme la connexion avec la base MariaDB
            $mysqli->close();
      ?>
   </div>

    <footer class="footer-section bg-white text-black">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>News</h3>
              <ul class="list-unstyled  ">
                <li><a class="link-dark" href="#"> <?php echo $cfg["cfg_nom"]?></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Tickets</h3>
              <ul class="list-unstyled ">
                <li><a href="#"><?php echo $cfg["cfg_adresse_email"]?></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Matches</h3>
              <ul class="list-unstyled">
                <li><a href="#"><?php echo $cfg["cfg_adresse_postale"]?></a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Social</h3>
              <ul class="list-unstyled ">
                <li><a href="#"><?php echo $cfg["cfg_numero_telephone"]?></a></li>
              </ul>
            </div>
          </div>

        </div>

        <div class="row text-center">
          <div class="col-md-12">
            <div class=" pt-5">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="icon-heart"
                  aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>

        </div>
      </div>
    </footer>



  </div>
  <!-- .site-wrap -->

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>


  <script src="js/main.js"></script>

</body>

</html>