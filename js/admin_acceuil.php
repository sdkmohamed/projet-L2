<!DOCTYPE html>
<html lang="en">
<?php
    /* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
    autorisé à un utilisateur connecté. */
    session_start();
    if(!isset($_SESSION['login'])) //A COMPLETER pour tester aussi le rôle...
    {
     //Si la session n'est pas ouverte, redirection vers la page du formulaire
    header("Location:session.php");
    }
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
        $requete_cfg = "SELECT * FROM t_configuration_cfg";
        $reponse_cfg = $mysqli->query($requete_cfg);
        $cfg = $reponse_cfg->fetch_assoc();
?>

<head>
  <title>Soccer &mdash; Website by Colorlib</title>
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

<body>
  <?php
  $pseudo = $_SESSION["login"];
  $role = $_SESSION["role"];
        $sql = "SELECT * FROM t_profil_pfl WHERE cpt_pseudo = '$pseudo'";
        $resultat = $mysqli->query($sql);
        $user=$resultat->fetch_assoc();
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
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="pad.php" class="nav-link">PAD</a></li>
                <li ><a href="players.php" class="nav-link">Activite</a></li>
                <li><a href="inscription.php" class="nav-link">Inscription</a></li>
                <li><a href="session.php" class="nav-link">CONNEXION</a></li>
                <li class="active"><a href="admin_acceuil.php" class="nav-link">ADMIN</a></li>
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
          <div style="font-size:4em" class="col-lg-12 mx-auto text-center text-white">
             ESPACE ADMINISTRATEUR
          </div>
        </section>
        </div>
      </div>
    </div>
    <div class="latest-news">
      <div class="container">
        <div class="row d-flex">
             <h2> Bienvenue <?php echo " ".$user["pfl_nom"]." ".$user["pfl_prenom"]?></h2>
             <?php
             if($role=='R'){
              echo "<table border = 1 class='mt-5'>
                <tr>
                    <th>NOM</th>
                    <th>PRENOM</th>
                    <th>VALLIDITE</th>
                    <th>ROLE</th>
                </tr>";
              $sql2= "SELECT * FROM t_profil_pfl";
              $exe_sql2 =$mysqli->query($sql2);
              while($users = $exe_sql2->fetch_assoc()){
                echo "
                <tr>
                  <td>".$users["pfl_nom"]."</td>
                  <td>".$users["pfl_prenom"]."</td>
                  <td>".$users["pfl_validite"]."</td>
                  <td>".$users["pfl_role"]."</td>
                </tr>";
              }
              
             } 
             echo "</table>";
             ?>
            </div>
          </div>
          
      </div>
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
                <li><a href="#"><?php echo $cfg["cfg_numero_telephone"] ?></a></li>
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