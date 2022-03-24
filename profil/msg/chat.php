<!DOCTYPE html>
<html>
<head>
	<!-- Icons -->
	<link rel="apple-touch-icon" href="apple-touch-icon.png">	
	<meta charset="utf-8">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<title>login</title>
	<style type="text/css">
		*{
			font-family: "Poppins";
		}
		.form form .error-txt{
	color:#721c24;
	background: #f8d7da;
	padding: 8px 10px;
	text-align: center;
	border-radius: 5px;
	margin-bottom: 10px;
	border:1px solid #f5c6cb;
	display: none;
}
	</style>
</head>
<?php 
include_once('config/config.php');


			if (!$_SESSION['unique_id'] OR !$_GET['user_id']) {
				header('Location:/../deconnexion.php');				
		}


  	$req = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ? ");
  	$req->execute(array($_SESSION['unique_id']));
  	$user = $req->fetch();



    $user_id = (int) $_GET['user_id'];
    $req=  $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
    $req->execute(array($user_id));
    $id = $req->fetch();



    $outgoing = htmlspecialchars($_SESSION['unique_id']);
    $incoming = $user_id;
    $requ = $bdd->prepare("SELECT * FROM messages WHERE (outcoming_id = ? AND incoming_id = ?) OR (outcoming_id = ? AND incoming_id = ?) ");
    $requ->execute(array($outgoing,$incoming,$incoming,$outgoing));


 ?>

<body>
<div class="wrapper">
	<section class="chat-area">
		<header>
			<a href="use.php" class="back-icon" style="background: black; color: #fff; padding: 5px 5px 5px 5px; border-radius: 3px;" >retour<i class="fa fa-arrow-left"></i></a>
			<img src="/../niceAdmin/profil/photo/<?= $id['photo']?>" alt="">
			<div class="details">
				<span><?= $id['first']." ".$id['last']?></span>
				<p><?= $id['status']?></p>
			</div>
		</header>
<div class="chat-box">
		</div>
<form action="" method="post" class="typing-area">
			<input type="text" value="<?php echo $_SESSION['unique_id'];?>" name="outgoing_id" hidden>
			<input type="text" value=" <?php if(isset($user_id)) echo $user_id ?>" name="incoming_id" hidden>
			<input type="text" class="input-field" placeholder="entrez votre message" name="message"> 
			<button type="submit" name="valid">Envoyer</button>
		</form>

	</section>
</div>
<script src="js/chat.js"></script>
</body>
</html>