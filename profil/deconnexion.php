<?php 
session_start();
if (isset($_SESSION['unique_id'])) {
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
    $update = $bdd->prepare("UPDATE menbre SET status = 'hors ligne' WHERE unique_id = ? ");
    $update->execute(array($_SESSION['unique_id']));
    $_SESSION = array();
    session_destroy();
    header('Location:connexion.php');
}
else{
    header('Location:/../404.html');
}

 ?>
