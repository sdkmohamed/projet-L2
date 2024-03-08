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
      /* Vérification ci-dessous à faire sur toutes les pages dont l'accès est
      autorisé à un utilisateur connecté. */
      session_start();
      if(!isset($_SESSION['login'])) //A COMPLETER pour tester aussi le rôle...
      {
       //Si la session n'est pas ouverte, redirection vers la page du formulaire
      header("Location:session.php");
    }

      $pseudo = $_SESSION["login"];
      $role = $_SESSION["role"];
      $mysqli = new mysqli('localhost','zwarial00','sp5za2tu','zfl2-zwarial00_1');
              if ($mysqli -> connect_errno) {
                //
                echo "Error: Problème de connexion à la BDD \n";
                echo "Errno: " . $mysqli->connect_errno ."\n";
                echo "Error: " . $mysqli->connect_error . "\n";
                // Arrêt du chargement de la page
                exit();

              }
              $requete = "SELECT * FROm t_profil_pfl WHERE cpt_pseudo = '$pseudo'";
              $resultat1=$mysqli->query($requete);
              $res=$resultat1->fetch_assoc(); 
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
            </a>
          </div>
          <div class="ml-auto">
            <nav class="site-navigation position-relative text-right text-black" role="navigation">
              <ul class="bg-black site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li class="active"><a href="admin_acceuil.php" class="nav-link">ADMIN</a></li>
                <li><a href="admin_atelier.php" class="nav-link">GESTION DES ATELIERS &&PAD</a></li>
                 <li><a href="deconnexion.php" class="nav-link">Deconnexion</a></li>
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
            <h3 class="text-white"> ADMIN </h3>
          </div>
        </div>
      </div>
    </div>
    
     <div class="container bg-white">   
      <h2 class="text-black">Bienvenu <?php echo $_SESSION['login']?></h2>
      <h2 class="text-black"> Votre Profil :</h2>
      <h3 class="text-black"> <?php echo"--".$res["pfl_nom"]."--".$res["pfl_prenom"]."--".$res["cpt_pseudo"]."--".$res["pfl_role"]?></h3>
      <h3> Vous etes <?php if($_SESSION['role']=="R"){
        echo "responsable";
      }else{
        echo "Animateur";
      }
    ?></h3>

      <?php
      if ($_SESSION["role"] =='R') {
        echo "
            <table border = 1 class='mt-5'>
                <tr>
                    <th>Pseudo</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Role</th>
                    <th>Validite</th>
                    <th>Action</th>
                </tr>";
        $sql2 = "SELECT * FROM t_profil_pfl ";
        $resultat= $mysqli->query($sql2);
        echo "Nombre de comptes:".$resultat->num_rows."";
        while ($users = $resultat->fetch_assoc()) {
            echo "
            <tr>
              <td>".$users['cpt_pseudo']."</td>
              <td>".$users['pfl_nom']."</td>
              <td>".$users['pfl_prenom']."</td>              
              <td>".$users['pfl_role']."</td>
              <td>".$users['pfl_validite']."</td>
               <td>";
            echo "<form action='compte_action.php' method='POST'>";
            echo "<input type='hidden' name='pseudosel' value='" .$users['cpt_pseudo']."'/>";
              echo"<button type='submit' class='btn btn-default' name='desactive'>Activer/Désactiver</button>";
              echo "</form>";
              echo ("</td>"); 
           echo" <tr/>";
      }
    }
      echo"</table>";
      ?>
   </div>

    <footer class="footer-section bg-white text-black">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>News</h3>
              <ul class="list-unstyled  ">
                <li><a class="link-dark" href="#"> </a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Tickets</h3>
              <ul class="list-unstyled ">
                <li><a href="#"></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Matches</h3>
              <ul class="list-unstyled">
                <li><a href="#"></a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="widget mb-3">
              <h3>Social</h3>
              <ul class="list-unstyled ">
                <li><a href="#"></a></li>
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