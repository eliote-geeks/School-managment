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


			if (!$_SESSION['unique_id']) {
				// header('Location:login.php');
				echo "non";
			}
	include_once('use/use.php');
 ?>

<body>
<div class="wrapper" style="width: 500px;">
	<section class="users">
		<header>
			<div class="content">
				<img src="/../niceAdmin/profil/photo/<?= $user['photo']?>" alt="">
				<div class="details">
					<span><?= $user['first']." ".$user['last']?> <br><i style="font-size:15px;"><?= $grade?></i></span>
					<p><?= $user['status']?></p>					
				</div>
			</div>
				<a class="logout" href="/../niceAdmin/profil/pro.php?unique_id=<?= $_SESSION['unique_id']?>">retour</a>
		</header>
		<form method="post" action=""> 
		<div class="search">	
			<span class="text">Selectionner un utilisateur sur le chat</span> 
			<input type="text" name="barre" placeholder="entrez le nom recherche..">
			<button type="button"><i class="fa fa-search"></i>&copy;</button>
		</div>
</form>
		<div class="users-list">

		</div>
	</section>
</div>

<script src="js/use.js"></script>
</body>
</html>

