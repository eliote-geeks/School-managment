<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');


if (isset($_GET['unique_id']) AND $_GET['unique_id'] > 0) 
  {
    $getid = intval($_GET['unique_id']);
    $requser = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch(); 
    if(isset($_SESSION['unique_id']) AND $userinfo['unique_id'] == $_SESSION['unique_id'])
    {
 ?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta http-equiv="refresh" content="30">
  <title>admin</title>
  <meta name="description" content="...">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Icons -->
  <link rel="apple-touch-icon" href="apple-touch-icon.png">

  <!-- CSS -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="material-design-iconic-font/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/select2.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/fontello.css">
  <link rel="stylesheet" href="css/chartist.min.css">
  <link rel="stylesheet" href="css/app.min.css">
  
  <!-- Modernizr -->
  <script src="js/modernizr-2.8.3.min.js"></script>
  <title>Profil</title>
  <meta charset="utf-8">
  <style type="text/css">
    img{
      width: 200px; 
    }
    .form{
      display: table-row;
    }
    .form p{
      display: table-header-group;
    }
    .form button{
      display: grid;
      margin:10px;
    }

  </style>
</head>
<body style="background: #eee;">
    <h1 class="container alert alert-info" align="right">PROFIL DE L'ETUDIANT&copy</h1>
<div align="center" class="container-form" >
  
    <h4  style="width: 500px; text-transform: lowercase;">--HEURE D'ABSENCE: <?php echo $userinfo['absence']; ?>... </h4>
     <h4  style="width: 500px; text-transform: lowercase;">--sanction:<p class="alert-danger"><?php echo $userinfo['sanction']; ?>...</p>  </h4>
  
  <div class="container">
    <h4 class="alert alert-success" style="width: 500px; text-transform: uppercase;">--PROFIL de <?php echo $userinfo['pseudo']; ?>-- </h4>   
  </div>
  <div align="center"> <b><p>--SESSION DE  <?php echo $userinfo['session']; ?>--</p></b></div>
<div align="left" class="form">
  <table border="2">
    <tr>
      <td><img class="img-thumbnail" src="photo/<?php echo $userinfo['photo']; ?>" ></td>
    </tr>
  </table>
            <div>
            <p>Paiement = <?php echo $userinfo['paiement']; ?></p>
  <p>Pseudo = <?php echo $userinfo['pseudo']; ?></p>
 <p> Mail = <?php echo $userinfo['email']; ?></p>
  <p> specialite = <?php echo $userinfo['specialite']; ?></p>
   <p> age = <?php echo $userinfo['age']; ?></p>
   <p> niveau = <?php echo $userinfo['niveau']; ?></p>
   <p> date de naissance = <?php echo $userinfo['naissance']; ?></p>
    <p> lieu de naissance = <?php echo $userinfo['lieu']; ?></p>
     <p> sexe = <?php echo $userinfo['sexe']; ?></p>
      <p> nom = <?php echo $userinfo['first']; ?></p>
      <p>Matricule = <?php echo $userinfo['matricule']; ?></p>
       <p> prenom = <?php echo $userinfo['last'];  ?></p><br>
      </div><br><p>lana fever</p>
     

   <?php 
        if(isset($_SESSION['unique_id']) AND $userinfo['unique_id'] == $_SESSION['unique_id'])
        {
        ?>
        <table class="table" border="3">
          <tr>
            <th>MESSSAGE</th>
          </tr>
          <tr>
            <td><a href="envoi.php?unique_id=<?=$_SESSION['unique_id']?>" style="margin-right: 5px;" class="btn btn-info">contacts</a></td>
          
            <td><a href="reception.php?unique_id=<?=$_SESSION['unique_id']?>" class="btn btn-info">Boite de reception</a></td>
       </tr>
        </table>
        <!-- l'etudiant ne peut que recevoir les informations du professeur et de l' admin-->
        

        <?php 
        }
        else{
          header('Location:connexion.php');
        }
         ?><br><br>

         <table class="table" border="2">
          <tr>
            <th>SERVICES</th>
          </tr>
           <tr>
           <td> <a class="btn-sm btn-warning" style="margin:3px;" href="edition.php?id=<?= $_SESSION['unique_id']?>">edition</a></td>
           <td><a  href="deconnexion.php" style="text-decoration: none; margin:15px; border-radius: 5px; padding:5px; " class="btn-sm btn-danger">Deconnexion</a></td>
           <td> <a  href="index.php?id=<?=$_SESSION['unique_id']?>"  class="btn-sm btn-danger">articles</a></td>
          </tr> 
         </table>
 </div>

</body>
</html>
<?php }
else{
  header('Location:connexion.php');
} ?>
<?php }
else{
  header('Location:connexion.php');
}
 ?>
