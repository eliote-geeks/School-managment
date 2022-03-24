<?php 
include_once('config.php');
$re = $bdd->query("SELECT * FROM notif_en ORDER BY date_note DESC LIMIT 0,7");





 ?>