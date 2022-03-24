<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');

if (isset($_GET['id'])) {
	$get = htmlspecialchars($_GET['id']);
	//recupere  le menbre ayant paye par son id
	$req = $bdd->prepare("SELECT * FROM paiement LEFT JOIN menbre ON menbre.id = paiement.id_menbre WHERE menbre.id = ? ORDER BY  paiement.id DESC");
	$req->execute(array($get));
	if ($req->rowCount() > 0) {
		$client = $req->fetch();//le client

		$montant_total = $bdd->prepare("SELECT * FROM menbre LEFT JOIN matiere ON matiere.matiere = menbre.specialite WHERE menbre.id = ?");
		$montant_total->execute(array($get));
		$somme = $montant_total->fetch(); //le montant total de la specialite

		$calcul = $bdd->prepare("SELECT * FROM paiement WHERE id_menbre = ?");
		$calcul->execute(array($get)); 
		$s = 0;		
		while ($c = $calcul->fetch()) {
			$s += $c['montant'];
		}
		
	}
	else{
		die('Oups!!');
	}
}
else{
	header('Location:404.html');
}


 ?>