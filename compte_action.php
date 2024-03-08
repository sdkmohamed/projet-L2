<?php 
		if ($_POST[ 'pseudosel' ])
		{
		$pseudo_choisi=$_POST ['pseudosel'];
		} elseif ($_POST['pseudochoix']) {
			$pseudo_choisi=$_POST['pseudochoix'];
		}
		$mysqli = new mysqli('localhost','zwarial00','sp5za2tu','zfl2-zwarial00_1');
		$sql="SELECT * FROM t_profil_pfl WHERE cpt_pseudo='". $pseudo_choisi ."';";
			echo ("<br>");
			echo $sql;
			echo ("<br>");
		if (!$resultat=$mysqli->query($sql)) {
			// la requete a echoué
			echo "Error:Probleme!\n";
			echo"Query:  " .$sql ."\n";
			echo "Errno" .$mysqli->errno."\n";
			echo "Error: ".$mysqli->errno."\n";
			exit();
		}else{
			$users=$resultat->fetch_assoc();
			if ($users['pfl_validite']=='A') {
				$sql2="UPDATE t_profil_pfl SET pfl_validite='D' where cpt_pseudo='".$pseudo_choisi."';";
			}else{
				$sql2="UPDATE t_profil_pfl SET pfl_validite='A' WHERE cpt_pseudo='".$pseudo_choisi."';";
			}
			echo $sql2;
		if (!$resultat2=$mysqli->query($sql2)) {
			echo "Error: Problème ! \n"; 
			echo "Query: " . $sql . "\n";
			echo "Errno: " . $mysqli->errno . "\n";
			echo "Error: " .$mysqli->error."\n";
			exit ();
				}else{
			header("Location:admin_acceuil.php");
		}
		}
		$mysqli->close();
?>
