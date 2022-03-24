 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<link rel="apple-touch-icon" href="apple-touch-icon.png">

	<!-- CSS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	
	<!-- Modernizr -->
	<script src="js/modernizr-2.8.3.min.js"></script>
 	<title>confirmation par mail</title>
 </head>
 <body><br> <br>
<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if (isset($_GET['pseudo'],$_GET['k']) AND !empty($_GET['pseudo']) AND !empty($_GET['k'])) {
	$pseudo =  htmlspecialchars(urldecode($_GET['pseudo']));
	$k = htmlspecialchars($_GET['k']);
	$req = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ? AND confirmkey = ?");
	$req->execute(array($pseudo,$k));

	$userexist = $req->rowCount();
	if ($userexist == 1) {
		$user = $req->fetch();
		if ($user['confirm'] == 0) {
			$updateuser = $bdd->prepare("UPDATE menbre SET confirm = 1 WHERE pseudo = ? AND confirmkey = ?");
			$updateuser->execute(array($pseudo,$k));
			$reussie = "Votre compte a bien ete confirme";
		}
		else{
			$erreur = "votre compte a deja ete confirme!!";
		}
	}
	else{
		$erreur = "l'utilisateur n'existe pas!!";
	}

}
 ?>
 	<?php if(isset($erreur)) {  ?>
 		<div class="container alert-danger">
 			<p><?= $erreur ?></p>
 		</div>
 	<?php } ?>

 	<?php if(isset($reussie)) {  ?>
 		<div class="container alert-danger">
 			<p><?= $reussie ?></p>
 		</div>
 	<?php } ?>
 </body>
 </html>