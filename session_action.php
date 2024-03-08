<?php
//Ouverture d'une session
session_start();
/*Affectation dans des variables du pseudo/mot de passe s'ils existent,
affichage d'un message sinon*/
if ($_POST["pseudo"] && $_POST["mdp"]){
 $pseudo=htmlspecialchars(addslashes($_POST["pseudo"]));
 $motdepasse=htmlspecialchars(addslashes($_POST["mdp"]));
// A COMPLETER...
// Connexion à la base MariaDB
$mysqli = new mysqli('localhost','zwarial00','sp5za2tu','zfl2-zwarial00_1');
if ($mysqli->connect_errno) {
 // Affichage d'un message d'erreur
 echo "Error: Problème de connexion à la BDD \n";
 // Arrêt du chargement de la page
 exit();
 }
 $sql="SELECT cpt_pseudo,cpt_mot_de_passe FROM t_compte_cpt WHERE
cpt_pseudo= '$pseudo' AND cpt_mot_de_passe =MD5('$motdepasse');";
echo($sql);
$resultat = $mysqli->query($sql);
if ($resultat==false) {
 // La requête a echoué
 echo "Error: Problème d'accès à la base \n";
 exit();
 }
else {
 // A NOTER : si on a complété la requête n° 1) proposée, on peut aussi
// récupérer et tester la validité du profil, en faisant, par exemple :

 if($resultat->num_rows == 1){
   $ligne=$resultat->fetch_assoc();
  $num=$ligne["cpt_pseudo"];
  $sql2="SELECT * FROM t_profil_pfl WHERE cpt_pseudo ='$num'";

  $result2=$mysqli->query($sql2);
  $resultat2 =$result2->fetch_assoc();
    if( $resultat2["pfl_validite"]=='A'){
      session_start();
    $_SESSION['login']=$num;
    $_SESSION['role']=$resultat2["pfl_role"];
     header("Location:admin_acceuil.php");  
    }else{
      echo"le profil n'est pas encore activé";

      
    }
 }
 
 /* Dans le cas de la requête n° 1) non complétée ou n° 1bis), on teste si
 une ligne de résultat a été renvoyée, c'est à dire si le compte
 existe bien (n° 1)) et est activé (n° 1bis)) :
 */
 else{
   // echo($sql2);
 // aucune ligne retournée
 // => le compte n'existe pas ou n'est pas valide
echo "pseudo/mot de passe incorrect(s) ou profil inconnu !";
echo "<br /><a href=\"./session.php\">Cliquez ici pour réafficher
 le formulaire</a>";
}
//Fermeture de la communication avec la base MariaDB
$mysqli->close();
}
}
?>
<a href="session.php"><button type="button">formulaire de connexion</button></a>