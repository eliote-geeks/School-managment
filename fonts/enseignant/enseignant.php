<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>admin</title>
	<meta name="description" content="...">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Icons -->
	<link rel="apple-touch-icon" href="apple-touch-icon.png">

	<!-- CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="material-design-iconic-font/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/fontello.css">
	<link rel="stylesheet" href="css/chartist.min.css">
	<link rel="stylesheet" href="css/app.min.css">
	
	<!-- Modernizr -->
	<script src="js/modernizr-2.8.3.min.js"></script>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>espace enseignant</title>
	<style type="text/css">
 	*{
		font-family: 'poppins';
	}
 </style>
</head>

<?php  
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])){
	echo $_SESSION['filiere'];


	if(isset($_GET['absence']) AND !empty($_GET['absence'])){
		$absence = (int) $_GET['absence'];
		$req = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
		$req->execute(array($absence));
		$n = $req->fetch();
		echo "<p align=\"center\" class=\"container btn-warning\">matricule de l'etudiant: ".$n['matricule']."<p>";
		echo "absence";
			if (isset($_POST['vali'])) {
			if (isset($_POST['abs']) AND !empty($_POST['abs'])) {
				$abs = htmlspecialchars($_POST['abs']);
				$edi = $bdd->prepare("UPDATE menbre SET absence = ? WHERE id = ?");
				$abi = $abs + $n['absence'];
				$edi->execute(array($abi,$absence));

				echo "<script>alert('absence ajoutee');</script>";
			}
			else{
				echo "<script>alert('tous les champs doivent etre rempli');</script>";
			}
		}

?>
	<form style="width: 30%;" method="post" action="" class="container alert-info form-group">
	<p align="center">--ABSENCE--<input type="number"  name="abs" class="form-control"></p>
	<button type="submit" name="vali" class="form-control btn-sm btn-success">ajouter</button>
</form>

<?php
	}


	if(isset($_GET['sanction']) AND !empty($_GET['sanction'])){
		$sanction = (int) $_GET['sanction'];
		$req = $bdd->prepare("SELECT matricule FROM menbre WHERE id = ?");
		$req->execute(array($sanction));
		$n = $req->fetch();
		echo "<p align=\"center\" class=\"container btn-warning\">matricule de l'etudiant: ".$n['matricule']."<p>";
		echo "sanction";
		if (isset($_POST['val'])) {
			if (isset($_POST['san'])) {
				if (empty($_POST['san'])) {
					echo "<script>alert('sanction retiree');</script>";
					header('Location:enseignant.php?id='.$_SESSION['id']);
				}
				$san = htmlspecialchars($_POST['san']);
				$edi = $bdd->prepare("UPDATE menbre SET sanction = ? WHERE id = ?");
				$edi->execute(array($san,$sanction));

				echo "<script>alert('sanction ajoutee');</script>";
			}
		}
?>

	<form method="post" style="width: 30%;" action="" class="container alert-info form-group">
	<p align="center">--SANCTION--<select  name="san" class="form-control">
		<option></option>
		<option>exclusion 2 heures</option>
		<option>exclusion 4 heures</option>
		<option>exclusion 24 jours</option>
		<option>exclusion 3 jours</option>
		<option>exclusion 7 jours</option>
		<option>exclusion 28 jours</option>
		<option>retractaire</option>
		<option>conseil de discipline</option>
		<option>exclusion definitive</option>
	</select></p>
	<button type="submit" name="val" class="form-control btn-sm btn-success">ajouter</button>
</form>

<?php		
	}
$etudiants = $bdd->prepare("SELECT * FROM menbre WHERE session = ? AND specialite = ?");
$etudiants->execute(array($_SESSION['session'], $_SESSION['filiere']));

if (isset($_GET['info']) AND !empty($_GET['info'])) {
	$info = (int) $_GET['info'];
	$req = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
	$req->execute(array($info));
	$i = $req->fetch();
	echo "<center><p class = \"container alert-sm alert-info\">profil de <font color=\"green\"><b>".$i['pseudo']."</b></font></p></center>";
	echo "<p class = \"container alert-sm alert-info\">matricule: <font color=\"green\"><b>".$i['matricule']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">filiere: <font color=\"green\"><b>".$i['specialite']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">nom: <font color=\"green\"><b>".$i['first']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">prenom: <font color=\"green\"><b>".$i['last']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">age: <font color=\"green\"><b>".$i['age']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">date de naissance: <font color=\"green\"><b>".$i['naissance']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">addresse mail: <font color=\"green\"><b>".$i['email']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">lieu: <font color=\"green\"><b>".$i['lieu']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">diplome: <font color=\"green\"><b>".$i['niveau']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">session: <font color=\"green\"><b>".$i['session']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">date d'entree: <font color=\"green\"><b>".$i['date_enreg']."</b></font></p>";
	echo "<p class = \"container alert-sm alert-info\">paiement: <font color=\"green\"><b>".$i['paiement']."</b></font></p>";
}

?>
<body class="home"><br>
	
	<div class="container-table">
	<table class="table">
		<tr>
		<td><a class="btn-sm btn-info" href="enseignant.php?id=<?$_SESSION['id']?>">actualiser</a></td>
		<td><a href="module.php?id=<?=$_SESSION['id']?>" class="btn-sm btn-success">nouveau module</a></td>
		<td><a href="redaction.php?id=<?= $_SESSION['id']?>" class="btn-sm btn-primary">publier un article</a></td>
		<td><a href="deconnexion.php" class="btn-sm btn-danger">deconnexion</a></td>
		</tr>
		</table>
	</div><br>

	<div class="container">
<table class="table">
	<p align="center"><b>LISTE DES ETUDIANTS</b></p>
	<tr class="alert-info">
		<th>id</th>
		<th>matricule</th>
		<th>nom</th>
		<th>prenom</th>
		<th>sanction</th>
		<th>absence</th>
		<th>action</th>
	</tr>
	<?php while($m = $etudiants->fetch()) {  ?>
	<tr >
		<td><?= $m['id']?></td>
		<td><?= $m['matricule']?></td>
		<td><?= $m['first']?></td>
		<td><?= $m['last']?></td>
		<td><?= $m['sanction']?></td>
		<td><?= $m['absence']?></td>
		<td><p style="margin:5px;"><br><br>
		 <a class="btn-sm btn-danger" href="enseignant.php?absence=<?= $m['id']?>">ajouter absence</a> <br><br>
		<a class="btn-sm btn-warning" href="enseignant.php?sanction=<?= $m['id']?>">sanction</a>
		<a class="btn-sm btn-info" href="enseignant.php?info=<?= $m['id'] ?>">info</a>
	</p></td>

	</tr>
	<?php } ?>
</table><br>
</div>
</body>
</html>
<?php }
else{
	header('Location:util.php');
}

 ?>
