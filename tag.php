<?php 
$bdd = new PDO("mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8","root","");

$topic = "Salut @netrick comment vous allez bien j'espere mon roi ";

function mention($matches){
	global $bdd;
	$req = $bdd->prepare("SELECT * FROM menbre WHERE first = ? OR pseudo = ?"); 
	$req->execute(array($matches[1],$matches[1]));
	if ($req->rowCount() > 0) {
		$idutilisateur = $req->fetch()['first'];
		return '<a href="">'.$idutilisateur.'</a>';
	}
		return $matches[0];
}

$top =  preg_replace_callback('#@([A-Za-z0-9]+)#', 'mention', $topic);
echo $top;
 ?>