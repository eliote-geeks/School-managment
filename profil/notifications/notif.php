<?php 
include_once('../msg/config/config.php');

$req = $bdd->prepare("SELECT * FROM menbre LEFT JOIN notification ON  menbre.unique_id = notification.id_expe WHERE menbre.unique_id = ? ORDER BY notification.id DESC LIMIT 0,10");
$req->execute(array($_SESSION['unique_id']));


$req2 = $bdd->prepare("SELECT * FROM menbre LEFT JOIN notification ON menbre.unique_id = notification.id_rec WHERE notification.id_expe = ?");
$req2->execute(array($_SESSION['unique_id']));
$re2 = $req2->fetch();



$notifications = $bdd->query("SELECT * FROM notification ORDER BY date_note DESC LIMIT 0,7");







 ?>