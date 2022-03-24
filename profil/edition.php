<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if (isset($_SESSION['unique_id'])) 
  {
    $mati = $bdd->query("SELECT * FROM matiere");
$requser = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
$requser->execute(array($_SESSION['unique_id']));
$user = $requser->fetch();
$_SESSION['unique_id'] = $user['unique_id'];



if(isset($_FILES['newphoto']['name']) AND !empty($_FILES['newphoto']['name']) AND $_FILES['newphoto']['name'] != $user['photo'])
{
  $newphoto = htmlspecialchars($_FILES['newphoto']['name']);
  $file_tmp_name = $_FILES['newphoto']['tmp_name'];
  echo "modification en cours..veuillez patienter";
  $photo_verify =  move_uploaded_file($file_tmp_name,"./photo/$newphoto");

  if($photo_verify == 1){ 
  $insertphoto = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertphoto->execute(array($_SESSION['unique_id']));

  $editphoto = $bdd->prepare("UPDATE menbre SET photo = ? WHERE unique_id = ?");
  $editphoto->execute(array($newphoto,$_SESSION['unique_id']));
  header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
}else{
  $erreur = "oups une erreur s'est produite o_O ";
}
}


if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['email'])
{
  $newmail = htmlspecialchars($_POST['newmail']);
  $insertmail = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertmail->execute(array($_SESSION['unique_id']));
  $mail = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
  $mail->execute(array($newmail));
  $mailexist = $mail->rowCount();

  if($mailexist == 0){ 
  $editmail = $bdd->prepare("UPDATE menbre SET email = ? WHERE unique_id = ?");
  $editmail->execute(array($newmail,$_SESSION['unique_id']));
  $user = $editmail->fetch();
  header('Location:pro.php?unique_id='.$_SESSION['id']);
}else{
  $erreur = "cet addresse email existe deja";
}
}


if(isset($_POST['newage']) AND !empty($_POST['newage']) AND $_POST['newage'] != $user['age'])
{
  $newage = htmlspecialchars($_POST['newage']);
  $insertage = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertage->execute(array($_SESSION['unique_id']));
  
  
  $editage = $bdd->prepare("UPDATE menbre SET age = ? WHERE unique_id = ?");
  $editage->execute(array($newage,$_SESSION['unique_id']));
  $user = $editage->fetch();
  header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
}


if(isset($_POST['newdate']) AND !empty($_POST['newdate']) AND $_POST['newdate'] != $user['date'])
{
  $newdate = htmlspecialchars($_POST['newdate']);
  $insertdate = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertdate->execute(array($_SESSION['unique_id']));
  
  
  $editdate = $bdd->prepare("UPDATE menbre SET naissance = ? WHERE unique_id = ?");
  $editdate->execute(array($newdate,$_SESSION['unique_id']));
  $user = $editdate->fetch();
  header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
}


if(isset($_POST['newsession']) AND !empty($_POST['newsession']) AND $_POST['newsession'] != $user['session'])
{
  $newsession = htmlspecialchars($_POST['newsession']);
  $insertsession = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertsession->execute(array($_SESSION['unique_id']));
  
  
  $editsession = $bdd->prepare("UPDATE menbre SET session = ? WHERE unique_id = ?");
  $editsession->execute(array($newsession,$_SESSION['unique_id']));
  $user = $editsession->fetch();
  header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
}


if(isset($_POST['newmatiere']) AND !empty($_POST['newmatiere']) AND $_POST['newmatiere'] != $user['specialite'])
{
  $newmatiere = htmlspecialchars($_POST['newmatiere']);
  $insertmatiere = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertmatiere->execute(array($_SESSION['unique_id']));
  
  
  $editmatiere = $bdd->prepare("UPDATE menbre SET specialite = ? WHERE unique_id = ?");
  $editmatiere->execute(array($newmatiere,$_SESSION['unique_id']));
  $user = $editmatiere->fetch();
  header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
}



if(isset($_POST['newfirst']) AND !empty($_POST['newfirst']) AND $_POST['newfirst'] != $user['first'])
{
  $newfirst = htmlspecialchars($_POST['newfirst']);
  $insertfirst = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertfirst->execute(array($_SESSION['unique_id']));
  
  
  $editfirst = $bdd->prepare("UPDATE menbre SET first = ? WHERE unique_id = ?");
  $editfirst->execute(array($newfirst,$_SESSION['unique_id']));
  $user = $editfirst->fetch();
  header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
}

if(isset($_POST['newlast']) AND !empty($_POST['newlast']) AND $_POST['newlast'] != $user['last'])
{
  $newlast = htmlspecialchars($_POST['newlast']);
  $insertlast = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertlast->execute(array($_SESSION['unique_id']));
  
  
  $editlast = $bdd->prepare("UPDATE menbre SET last = ? WHERE unique_id = ?");
  $editlast->execute(array($newlast,$_SESSION['unique_id']));
  $user = $editlast->fetch();
  header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
}



if(isset($_POST['newsexe']) AND !empty($_POST['newsexe']) AND $_POST['newsexe'] != $user['sexe'])
{
  $newsexe = htmlspecialchars($_POST['newsexe']);
  $insertsexe = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertsexe->execute(array($_SESSION['unique_id']));
  
  
  $editsexe = $bdd->prepare("UPDATE menbre SET sexe = ? WHERE unique_id  = ?");
  $editsexe->execute(array($newsexe,$_SESSION['unique_id']));
  $user = $editsexe->fetch();
  header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
}


  if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND $_POST['newmdp'] != $user['password'])
{
 
  $insertsexe = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
  $insertsexe->execute(array($_SESSION['unique_id']));
  
  
  $newmdp = htmlspecialchars($_POST['newmdp']);
$newmdp2 = htmlspecialchars($_POST['newmdp2']);

if($newmdp == $newmdp2)
{
  $newmdp = sha1($newmdp);
  $editmdp = $bdd->prepare("UPDATE menbre SET password = ? WHERE unique_id = ?");
  $editmdp->execute(array($newmdp,$_SESSION['unique_id']));
  $user = $editmdp->fetch();
  header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
  }
else{
  $erreur = "Vos mots de passe ne correspondent pas";
}

}



 ?>


<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <title>pro</title>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
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
  <link rel="stylesheet" type="text/css" href="style/sty.css">
<style type="text/css">
    *{
      font-family: 'poppins';
    }

  </style>    
  <!-- Modernizr -->
  <script src="js/modernizr-2.8.3.min.js"></script>
</head>
<body style="background: #eee;">
<div class="wrapper">
  <section class="form login">
    <header>
      <h2>EDITER MON profil &copy</h2>
   <p>etudiant. <?php echo $user['first']." ".$user['last']; ?></p>
    </header>
    <form action="" method="post" enctype="multipart/form-data">
            <?php if(isset($erreur)) { ?>
      <div class="error-txt"><?php echo $erreur ?></div>
            <?php }?>
          <div class="field input">
          <label>Addresse email:</label>
          <input type="email" name="newmail" placeholder="addresse email">
        </div>

        <div class="field input">
          <label>Photo de profil:</label>
          <input type="file" name="newphoto" accept=".jpg, .jfif, .gif, .png">   
        </div>

         <div class="field input">
          <label>age:</label>
          <input type="number" name="newage">   
        </div>

              <div class="field input">
          <label>date de naissance:</label>
          <input type="date" name="newdate">   
        </div>

                   <div class="field input">
          <label>nom:</label>
          <input type="text" name="newfirst">   
        </div>


                   <div class="field input">
          <label>Prenom:</label>
          <input type="text" name="newlast">   
        </div>

            <div class="field input">
          <label>sexe:</label>
          <select name="newsexe">
        <option></option>
      <option>M</option>
      <option>F</option>
      </select>
        </div>

          <div class="field input">
          <label>Mot de passe:</label>
          <input type="password" name="newmdp" placeholder="mot de passe">
        <i class="fa fa-eye"></i>
        </div>

         <div class="field input">
          <label>Confirmer le mot de passe:</label>
          <input type="password" name="newmdp2" placeholder="mot de passe">
        <i class="fa fa-eye"></i>
        </div>

        <div class="field button">
          <input type="submit" value="continuer" name="valid">
        </div>
    </form>
    <div class="link">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>revenir a la page precedente<a href="pro.php?unique_id=<?=$_SESSION['unique_id']?>">&nbsp;retour</a></span><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; je souhaite me deconnecter <a href="deconnexion.php">deconnexion</a></div>
  </section>
</div>

<script src="js/pass.js"></script>
</body>
</html>

<?php }
else{
  header('Location:connexion.php');
}
 ?>
