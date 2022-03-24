<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');

$req = $bdd->query("SELECT * FROM settings WHERE id = 1");
$a = $req->fetch();
 ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>A propos</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
<style type="text/css">
    body {
    background: #eeeeee;

    font-family: 'Poppins', sans-serif;

    padding: 0px !important;

    margin: 0px !important;

    font-size:14px !important;

}
</style>
</head>
<body>
<a style="text-align: center; margin-left: 40pc; font-size: 20px;" href="index.php">Acceuil</a>
    <h1 style="font-family:'Poppins';">POLITIQUE DE CONFIDENTIALITE</h1>
<?php echo $a['apropos']; ?>
</body>
</html>