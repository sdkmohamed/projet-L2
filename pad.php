<!DOCTYPE html>
<html lang="en">

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

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="index.html">
              <img src="images/logo.png" alt="Logo">
            </a>
          </div>
          <div class="ml-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li class="active"><a href="pad.php" class="nav-link">Pad</a></li>
                <li><a href="players.php" class="nav-link">Activite</a></li>
                <li><a href="inscription.php" class="nav-link">Inscription</a></li>
                <li><a href="session.php" class="nav-link">CONNEXION</a></li>
                <li><a href="admin_acceuil.php" class="nav-link">ADMIN</a></li>
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
          <div class="col-lg-5 mx-auto text-center">
            <h1 class="text-white">Matches</h1>
        </div>
      </div>
    </div>

    <?php
       $mysqli = new mysqli('localhost','zwarial00','sp5za2tu','zfl2-zwarial00_1');
       // echo ("Connexion BDD réussie !");
        echo "<br />";
        //echo"<h1> DETAIL D'UNE PAD:</h1>";
        if(isset($_GET['code'])){
         // echo("Valeur de id:");
          //echo($_GET['id']);
        
        echo "<br/>";
        //reccuperez dans une variable la valeur passer en parametres dans l'URL
        $pad_code = ($_GET['code']);
        }
        else{
          echo("Vous avez oublié le parametres !");
          exit();
        }
        $requete = "SELECT * FROM t_pad_activite_pad
        left join t_atelier_ate using(pad_id)
        left join t_ressources_res using(ate_id)
         WHERE pad_code ='".$_GET['code']."';";
        echo"<br/>";
        //echo ($requete);
        $result1 = $mysqli->query($requete);
        if($result1==false){
          echo "Error : LA requete a echoué \n";
          echo "Errno" . $mysqli->errno ."\n";
          echo "Error" . $mysqli->error ."\n";
          exit();
        }
        else //La requête s’est bien exécutée (<=> couleur verte dans phpmyadmin)
            {

            //echo "<br />";
            //echo("<table class=\"table table_bordered\">");
            echo "
            <table border = 1 class='mt-5'>
                <tr>
                    <th>ate_intitule</th>
                    <th>res_descriptif</th>
                    <th>res_chemin_fichier</th>
                </tr>";
            //echo($result1->num_rows); //Donne le bon nombre de lignes récupérées
             while ($pad = $result1->fetch_assoc())
             {
              //echo("<table border = 1>");
              echo"
              <tr>
                <td>".$pad['ate_intitule']."</td>
                <td>".$pad['res_descriptif']."</td>
                <td><a href=".$pad['res_chemin_fichier'].">".$pad['res_chemin_fichier']."</a></td>
              <tr/>
              ";
              // echo("<table ");
              echo "";
             
            }
          }
            echo"
            </table>
            ";
            //Ferme la connexion avec la base MariaDB
            $mysqli->close();
      ?>
    
    <div class="container">
      

      <div class="row">
        <div class="col-lg-12">
          
        </div>
      </div>
    </div>
  

    
    <div class="site-section bg-dark">
      <div class="container">
        
        <div class="row mb-5">
          <div class="col-lg-12">
          </div>
        </div>

       
      </div>
    </div> <!-- .site-section -->

    



    <footer class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>News</h3>
              <ul class="list-unstyled links">
                <li><a href="#">All</a></li>
                <li><a href="#">Club News</a></li>
                <li><a href="#">Media Center</a></li>
                <li><a href="#">Video</a></li>
                <li><a href="#">RSS</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Tickets</h3>
              <ul class="list-unstyled links">
                <li><a href="#">Online Ticket</a></li>
                <li><a href="#">Payment and Prices</a></li>
                <li><a href="#">Contact &amp; Booking</a></li>
                <li><a href="#">Tickets</a></li>
                <li><a href="#">Coupon</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Matches</h3>
              <ul class="list-unstyled links">
                <li><a href="#">Standings</a></li>
                <li><a href="#">World Cup</a></li>
                <li><a href="#">La Lega</a></li>
                <li><a href="#">Hyper Cup</a></li>
                <li><a href="#">World League</a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Social</h3>
              <ul class="list-unstyled links">
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">Youtube</a></li>
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