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
    if(isset($_POST['ajout_ate'])){
              if($_POST['titre'] && $_POST['description']&&$_POST['etat_pad']&& $_POST['pad_id']){
                $titre = htmlspecialchars(addslashes($_POST['titre']));
                $description = htmlspecialchars(addslashes($_POST['description']));
                $etat_pad = htmlspecialchars(addslashes($_POST['etat_pad']));
                $pad_id = htmlspecialchars(addslashes($_POST['pad_id']));
                $requete="INSERT INTO t_atelier_ate VALUES(null,'$titre','$description',NOW(),'$etat_pad',$pad_id)";
                $resultat=$mysqli->query($requete);
                if ($resultat== false) {
              // la requete a echoué
              echo "Error:Probleme!\n";
              echo"Query:  " .$requete ."\n";
              echo "Errno" .$mysqli->errno."\n";
              echo "Error: ".$mysqli->errno."\n";
              exit();
            }else{
            
              }
          }else{
              echo "<p> Veuillez saisir tout les champs</p>";
            }
          } else if(isset($_POST['supp_ate'])){
              if($_POST['pad_id'] ){
                $pad_id = htmlspecialchars(addslashes($_POST['pad_id']));
                $sql="DELETE FROM t_ressources_res WHERE ate_id =$pad_id";
                $sql2="DELETE FROM t_atelier_ate WHERE ate_id =$pad_id";
                $res=$mysqli->query($sql);
                $res2=$mysqli->query($sql2);
                if ($res== false || $res2==false) {
              // la requete a echoué
              echo "Error:La requete a echoué!\n";
              echo "Errno" .$mysqli->errno."\n";
              echo "Error: ".$mysqli->errno."\n";
              exit();
            }else{
              header("Location:admin_atelier.php");
            }
          }
        }

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
                <li><a href="admin_acceuil.php" class="nav-link">ADMIN</a></li>
                <li class="active"><a href="admin_atelier.php" class="nav-link">GESTION DES ATELIERS &&PAD</a></li>
                <li><a href="deconnexion.php" class="nav-link">DECONNEXION</a></li>
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
       
        $requete = "SELECT * FROM t_pad_activite_pad
        left join t_atelier_ate using(pad_id)
        left join t_ressources_res using(ate_id)";
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
                    <th>aintitulé</th>
                    <th>res_descriptif</th>
                    <th>ressources</th>
                    <th>Ateliers</th>
                    <th>Pad_Id</th>
                    <th>Animateur</th>
                </tr>";
            //echo($result1->num_rows); //Donne le bon nombre de lignes récupérées
             while ($pad = $result1->fetch_assoc())
             {
              //echo("<table border = 1>");
              echo"
              <tr>
                <td>".$pad['pad_intitule']."</td>
                <td>".$pad['pad_description']."</td>
                <td><a href='".$pad['res_chemin_fichier']."'target ='_blank'>".$pad['res_chemin_fichier']."</a></td>
                <td>".$pad['ate_intitule']."</td>
                <td>".$pad['pad_id']."</td>
                <td>";
              $rqt="SELECT cpt_pseudo FROM t_animation_ani  WHERE pad_id =".$pad['pad_id']."";
              $rep = $mysqli->query($rqt);
              while($data = $rep->fetch_assoc()){
                echo "<li>".$data['cpt_pseudo']."</li>";
              }
              echo "</td>
              <tr/>
              ";
              
              
             
            }
          }
            echo"
            </table>
            ";
            

            //Ferme la connexion avec la base MariaDB
            $mysqli->close();
      ?>
                <form action="" method="post">
                     <fieldset>    
                                  <h2> Ajouter Votre Atelier</h2>
                                 <legend>Veuillez Entrer votre atelier :</legend>
                                 <p>Votre titre</p>
                                 <input type="text" name="titre"/>
                                 
                                 <p>Votre description :</p>
                                 <input type="text" name="description" />
                                 
                                 <p>L'Etat de votre pad:</p>
                                 <input type="text" name="etat_pad"/>
                                 
                                 <p>Id du pad:</p>
                                 <input type="number" name="pad_id"/>
                                 
                                 <p><input type="submit" name="ajout_ate" value="Valider"></p>
                      </fieldset>
                      </form>

    <div class="container">
      

      <div class="row">
        <div class="col-lg-12">
          
        </div>
      </div>
    </div>
  
       <form  action="" method="post">

         <h2> Suppression d'un atelier</h2>
         <p>Id de l'atelier:
         <input type="number" name="pad_id"/>
          </p>
          <p><input type="submit" name="supp_ate" value="Valider"></p>
       </form>
    
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