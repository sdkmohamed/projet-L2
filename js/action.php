 <?php
        $mysqli = new mysqli('localhost','zbourelgu','zgnf7nj1','zfl2-zbourelgu_1');
        //POUR RECUPERER LES VALEUR MIS DANS LES CHAMPS DU FORMULAIRE D'INSCRIPTION ET LES INSERER DANS LA BD
        //Si tous les champs sont saisis
        //Si oui , on compare les deux mots de passes saisis
        //Si les deux messages ne sont pas identiques on affiche un message d'erreur
        //Si ils correspondent on insere le compte et si l'insertion  a marché on insere le profil
        //Si non on affiche "Veuillez saisir tous les champs"
        $nom=htmlspecialchars(addslashes($_POST['nom']));
        $prenom=htmlspecialchars(addslashes($_POST['prenom']));
        $pseudo=htmlspecialchars(addslashes($_POST['pseudo']));
        $mdp=htmlspecialchars(addslashes($_POST['mdp']));
        $valmdp=htmlspecialchars(addslashes($_POST['valmdp']));
        if ($nom and $prenom and $pseudo and $mdp and $valmdp) {
              if($mdp == $valmdp){
                     $mysqli = new mysqli('localhost','zwarial00','sp5za2tu','zfl2-zwarial00_1');
                     if ($mysqli->connect_errno)
{
                             // Affichage d'un message d'erreur
                             echo "Error: Problème de connexion à la BDD \n";
                             echo "Errno: " . $mysqli->connect_errno . "\n";
                             echo "Error: " . $mysqli->connect_error . "\n";
                             // Arrêt du chargement de la page
                             exit();
                            }
                            echo ("Connexion BDD réussie !");
                            // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
                            if (!$mysqli->set_charset("utf8")) {
                             printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
                             exit();
                            }
                            //Préparation de la requête à partir des chaînes saisies =>
                            //concaténation (avec le point) des différents éléments composant la
                            //requête
                            $sql="INSERT INTO t_compte_cpt VALUES('" .$pseudo. "','" .MD5($mdp). "');";
                            // Affichage de la requête constituée pour vérification
                            echo($sql);
                            //Exécution de la requête d'ajout d'un compte dans la table des comptes
                            $result3 = $mysqli->query($sql);
                            if ($result3 == false) //Erreur lors de l’exécution de la requête
                            {
                             // La requête a echoué
                             echo "Error: La requête a échoué \n";
                             echo "Query: " . $sql . "\n";
                             echo "Errno: " . $mysqli->errno . "\n";
                             echo "Error: " . $mysqli->error . "\n";
                             exit;
                            }
                            else //Requête réussie
                            {
                             $sql2="INSERT INTO t_profil_pfl VALUES('" .$nom. "','" .$prenom. "','A','D',Now(),'".$pseudo."');";
                            // Affichage de la requête constituée pour vérification
                            echo($sql2);
                            //Exécution de la requête d'ajout d'un compte dans la table des comptes
                            $result2 = $mysqli->query($sql2);
                            if ($result2 == false) //Erreur lors de l’exécution de la requête
                            {
                             // La requête a echoué
                             echo "Error: La requête a échoué \n";
                             echo "Query: " . $sql . "\n";
                             echo "Errno: " . $mysqli->errno . "\n";
                             echo "Error: " . $mysqli->error . "\n";
                             $sup_cpt= "DELETE FROM t_compte_cpt WHERE cpt_pseudo= '".$pseudo."';";
                             $mysqli->query($sup_cpt);
                             exit;

                            }
                            echo "<br />";
                            echo "Inscription réussie !" . "\n";
                            }
                            //Ferme la connexion avec la base MariaDB
                            $mysqli->close();

              } else{
                     echo("Les mots de passe ne correspondent pas");
              }
        }
        else{
              echo("Veuillez saisir tous les champs");
        }
      

        
    ?>
      <a href="inscription.php"><button type="button"> Formulaire d'inscription</button> </a>