
<!DOCTYPE html>
<html>
<head>
	<title>photo de profil</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="barre.css">
	<style type="text/css">
		*{
			font-family: 'poppins';
		}

	</style>	
</head>
<body>
<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
if (isset($_GET['id']) AND !empty($_GET['id'])) {
			$getid = (int) $_GET['id'];
			$req = $bdd->prepare("SELECT * FROM menbre WHERE id= ?");
			$req->execute(array($getid));
			$nom = $req->fetch();

	if(isset($_POST['ok'])){
		if(isset($_FILES['photo']['name']) AND !empty($_FILES['photo']['name']))
		{
			  $photo = htmlspecialchars($_FILES['photo']['name']);
			  $file_tmp_name = $_FILES['photo']['tmp_name'];
			  $photo_verify =  move_uploaded_file($file_tmp_name,"./photo/$photo");

			  if($photo_verify == 1){
			  	$insert = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
			  	$insert->execute(array($getid));
			  	$et = $insert->fetch();
			  	$_SESSION['id'] = $et['id'];
			  	$_SESSION['photo'] = $et['photo'];
			  $editphoto = $bdd->prepare("UPDATE menbre SET photo = ? WHERE id = ?");
			  $editphoto->execute(array($photo,$_SESSION['id']));
			echo "<h1> <a class=\"btn btn-success\" style=\"color:blue;\" href=\"connexion.php\">connexion</a></h1>";
		}
		else{
			echo "erreur reessayer!!";
		}
			
		}
		else{
			echo "ce champs doit etre rempli";
		}
	}

 ?>
 <?php if(isset($nom)) {  ?>
 <div align="center"><font color="white" style="font-size: 11px; text-transform: uppercase; font-family: sans-serif;"><b style="color: blue"><?= $nom['pseudo']?></b> selectionner une photo de profil pour faciliter votre identification</font></div>
 <?php } ?>

<form method="post" action="" enctype="multipart/form-data">
	<input  id="file" type="file" accept="image/*" name="photo" onchange="loadFile(event)">
	<img id="output"/>
	<label for="file">photo de profil</label>
	<button type="submit" name="ok" style="margin-left:640px; font-size: 18px; border:0; margin-top: 400px;">ENVOYER</button>
</form>
<div align="center"><p style="color: white;"><a href="connexion.php"> plus tard ?</a></p></div>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
</body>
</html>
<?php 
}
else{
	echo "noo";
	header('Location:connexion.php');
}
 ?>
