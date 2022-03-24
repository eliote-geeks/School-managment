
<!DOCTYPE html>
<html>
<head>
	<title>login_learn</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
 <link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="js/pass.js">	
 <style type="text/css">
 	*{
		font-family: 'poppins';
	}
 </style>
</head>

<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if(isset($_POST['valid']))
{
	if(isset($_POST['nom'],$_POST['pass'],$_POST['matiere'],$_POST['session']) AND !empty($_POST['nom']) AND !empty($_POST['pass']) AND !empty($_POST['matiere']) AND !empty($_POST['session']))
	{
		$session = htmlspecialchars($_POST['session']);
		$nom = htmlspecialchars($_POST['nom']);
		$pass = htmlspecialchars($_POST['pass']);
		$matiere = htmlspecialchars($_POST['matiere']);
		$req = $bdd->prepare("SELECT * FROM enseignant WHERE pseudo = ? AND filiere = ? AND session = ?");
		$req->execute(array($nom,$matiere,$session));
		$exist = $req->rowCount();
		$user = $req->fetch();
		$_SESSION['id'] = $user['id'];
	$_SESSION['pseudo'] = $user['pseudo'];
	$_SESSION['first'] = $user['first'];
	$_SESSION['last'] = $user['last'];
	$_SESSION['email'] = $user['email'];
	$_SESSION['filiere'] = $user['filiere'];
	$_SESSION['sexe'] = $user['sexe'];
	$_SESSION['unique_id'] = $user['unique_id'];
	$_SESSION['autre'] = $user['autre'];
	$_SESSION['lieu'] = $user['lieu'];
	$_SESSION['status'] = $user['status'];
	$_SESSION['pass'] = $user['pass'];
	$_SESSION['session'] = $user['session'];
	$_SESSION['date_en'] = $user['date_en'];
		
		if(password_verify($pass,$user['pass'])==1){ 
		$fil = $bdd->prepare("SELECT * FROM enseignant  WHERE filiere = ? AND session = ?");
	$fil->execute(array($_SESSION['filiere'],$_SESSION['session']));

	$el = $bdd->prepare("SELECT * FROM menbre WHERE specialite = ? AND session = ?");
	$el->execute(array($_SESSION['filiere'],$_SESSION['session']));
	$et = $el->fetch();
	header('Location:pro.php?id='.$_SESSION['id']);
	}else{
		$erreur =  "Identifiants Incorrectes";
	}
	}
	else{
		$erreur =  "tous les champs doivent etre rempli";
	}
}

$mati  =$bdd->query("SELECT * FROM matiere");

 ?>

<div class="wrapper">
  <section class="form login">
    <header>Enseignant <i class="fa fa-circle"></i></header>
    <form action="" method="post">
            <?php if(isset($erreur)) { ?>
      <div class="error-txt"><?php echo $erreur ?></div>
            <?php }?>
          <div class="field input">
          <label>Pseudo:</label>
          <input type="text" name="nom" placeholder="addresse email">
        </div>

        <div class="field input">
        	<label>filiere</label>
       <select required="required"  id="inputEmail1" name="matiere">     
        <option></option>
        <?php while ($mat = $mati->fetch()) {  ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
    </select>
        </div>
        <div class="field input">
        	<label>session</label>
        	<select  required="required" name="session">
    <option></option>    
    <option>JANVIER</option>
    <option>FEVRIER</option>
    <option>MARS</option>
    <option>AVRIL</option>
    <option>MAI</option>
    <option>JUIN</option>
    <option>JUILLET</option>    
    <option>AOUT</option>
    <option>SEPTEMBRE</option>
    <option>OCTOBRE</option>
    <option>NOVEMBRE</span></option>
    <option>DECEMBRE</span></option>
  </select>
        </div>
          <div class="field input">
          <label>Mot de passe:</label>
          <input type="password" name="pass" placeholder="mot de passe">
        <i class="fa fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="continuer" name="valid">
        </div>
    </form>
    <div class="link" align="center"><span>Espace enseignant.. revenir <a href="../Resi/index.html">acceuil</a></span></div>
  </section>
</div>

<script src="js/pass.js"></script>
</body>
</html>

