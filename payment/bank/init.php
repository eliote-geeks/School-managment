<?php
include("../../head.php");
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if (!isset($_SESSION['id'])) {
	die();
	header('Location:404.html');
}
?>
<body style="background:#eee;">
	
<?php
if (isset($_POST['editor1'])) {
	if (!empty($_POST['editor1'])) {
		$paiement_id = time();
		$informations = htmlspecialchars($_POST['editor1']);
		$nom = htmlspecialchars($_POST['nom']);
		$id_menbre = htmlspecialchars($_POST['id']);
		$email = htmlspecialchars($_POST['email']);
		$montant = htmlspecialchars($_POST['montant']);
	    $bank_info = $bdd->prepare("INSERT INTO paiement(id_menbre,menbre_nom,menbre_mail,date_paiement,txnid,montant,n_card,card_cvv,card_month,card_year,bank_info_transaction,method_paiement,status_paiement,id_paiement) VALUES(?,?,?,NOW(),?,?,?,?,?,?,?,?,?,?)");
		$bank_info->execute(array($id_menbre,$nom,$email,'',$montant,'','','','',$informations,'Depot bancaire','en cours',$paiement_id));
		echo "<a href='../../recu.php?id=".$id_menbre."'>paiement reussie veuillez imprimer  les informations de l'etudiant !!!</a>";
	}
	else{
		die('erreur');
	}
}
?>
</body>