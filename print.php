<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if (isset($_GET['id']) AND !empty($_GET['id'])) {
	$id_print  = intval($_GET['id']);
	 $req = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
	 $req->execute(array($id_print));
	 $p = $req->fetch();
}
 ?>