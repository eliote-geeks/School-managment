<?php include_once('recut.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		media
	</title>
	<link rel="stylesheet" type="text/css" href="media.css" media="print">
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
<H1>RECU DE CAISSE DE L'ETUDIANT No. <?= $client['id_paiement']?></H1>
<p>Matricule: <b><?= $client['matricule']?></b><p>
<p>Addresse email du client: <b><?= $client['menbre_mail']?></b><p>
<p>Noms et prenoms: <b><?= $client['menbre_nom']?></b><p>
<p>Informations bancaire: <b><?= htmlspecialchars($client['bank_info_transaction'])?></b><p>	
<p>Specialite: <b><?= $client['specialite']?></b><p>
<p>session: <b><?= $client['session']?><b/><p>
<p>solde ajoute: <b><?= $client['montant']?><b/><p>
<p>Deja paye: <b><?= $s ?><b/><p>
<p>Total: <b><?= $s ?><b/><p>

<p>montant de la filiere: <b><?= $somme['scolarite']?><b/><p>
<p>date de paiement: <b><?= $client['date_paiement']?></b><p>
<p>Methode de paiement: <b><?= $client['method_paiement']?></b><p>
<?php if($s == $somme['scolarite']) { ?><span>Pension terminee merci d'avoir choisi le CFPAM</span> <?php } ?>
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