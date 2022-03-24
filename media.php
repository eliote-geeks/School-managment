<?php include_once('print.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		media
	</title>
	<link rel="stylesheet" type="text/css" href="media.css" media="print">
	<link rel="shortcut icon" href="favicon.ico">
</head>
<body>
	<div class="c">
<div class="titre1">
	<p>REPUBLIQUE DU CAMEROUN</p>
	<p>**********</p>
<p>Paix – Travail- Patrie</p>
<p>**********</p>
<p>MINISTERE DE L’ENSEIGNEMENT SUPERIEUR</p>
</div>

<div class="logo">
	<img src="logo.png">
</div>
<div  class="titre2">
	<p>REPUBLIC OF CAMEROON</p>
	<p>**********</p>
<p>Peace – Work- Fatherland</p>
<p>**********</p>
<p>MINISTRY OF HIGHER EDUCATION</p>
</div>
</div>
<H1>INFORMATIONS ETUDIANT</H1>
<p><img style="width:25% ;" src="profil/photo/<?php echo $p['photo']; ?>"></p>
<p>pseudo: <b><?= $p['pseudo']?><b/><p>
<p>Noms et Prenoms:<b><?= $p['first']." ".$p['last']?> <b/><p>
<p>Addresse Email:<b><?= $p['email']?><b/> <p>
<p>Specialite: <b><?= $p['specialite']?></b><p>
<p>Session:<b><?= $p['session']?> </b><p>
<p>Diplome:<b><?= $p['niveau']?></b> <p>
<p>Matricule:<b> <?= $p['matricule']?></b></p>
<p>Date de naissance:<b> <?= $p['naissance']?></b><p>
<button type="submit" style="font-size:15px; padding:15px;">imprimer</button>

<a href="index.php?id=<?= $_SESSION['id']?>">retour</a>
 <script type="text/javascript">
 	document.querySelector("button").addEventListener("click",(e)=>{
 	document.querySelector("button").display = "none";
 		window.print();
 	});
 </script>
</body>
</html>