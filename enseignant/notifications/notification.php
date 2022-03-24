<?php

include_once('notif.php');
if(isset($_SESSION['id']) AND !empty($_SESSION['id'])){
	$req = $bdd->prepare("SELECT * FROM enseignant WHERE id = ?");
	$req->execute(array($_SESSION['id']));
	$ide = $req->fetch();

	$req2 = $bdd->prepare("SELECT * FROM menbre WHERE specialite = ? AND session = ?");
	$req2->execute(array($ide['filiere'],$ide['session']));
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- full calendar css-->
  <link href="assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
  <link href="assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
  <link href="css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/fullcalendar.css">
  <link href="css/widgets.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/xcharts.min.css" rel=" stylesheet">
	<meta charset="utf-8">
	<title>espce menbre</title>
	<meta name="viewport" content="width-device=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.2.css">
	

</head>
<body>
<div class="sidebar">
	<div class="logo_content">
		<div class="logo">
			<i class="fab fa-codiepie"></i>
			<div class="logo_name">CFPAM</div>
		</div>
		<i class='fas fa-bars' id="btn"></i>
	</div>
	<ul class="nav_list">

		<li>
			<a href="../pro.php?id=<?= $ide['id']?>">
				<i class=' far fa-user ' ></i>
				<span class="links_name">Mon Profil</span>
			</a>
			<span class="tooltip">profil</span>
		</li>


	</ul>
<?php $result = $ide['first_en']." ".$ide['last_en']." ".$ide['session'];
				(strlen($result) >18 ) ? $msg = substr($result, 0,19).'..' :$msg = $result; ?>
	<div class="profile_content">
		<div class="profile">
			<div class="profile_details">
				<div class="name_job">
					<div class="name"><?= $msg?></div>
					<div class="job"><?= $ide['filiere']?></div>
				</div>
				 <a style="color:white;" onclick="" href="../deconnexion.php"><i class="far fa-share-square" id="log_out"></i></a>
			</div>
		</div>
	</div>
</div>
<div class="home_content">
	<div class="text" style="color:whitesmoke;"> Notifications

						<br>
		<div align="center">
<?php while($note = $re->fetch()) { ?>
<label style="text-transform:uppercase;"> <?= $note['titre']?>: <?= $note['message']." ".$note['tag']?> publie le <?= $note['date_note']?></label><br>
	<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	let btn = document.querySelector("#btn");
	let sidebar = document.querySelector(".sidebar");
	let searchbtn = document.querySelector(".bx-search");
	btn.onclick = ()=>{
		sidebar.classList.toggle("active");
	}


	searchbtn.onclick = ()=>{
		sidebar.classList.toggle("active");
	}
	let conf = document.querySelector('#log_out').addEventListener("click",(e)=>{
			if (!(confirm('voulez-vous vraiment etre deconnecte: '))) {
			e.preventDefault();
			return false;
		}
		
	});
</script>
</body>
</html>
<?php }
else{
	header('Location:util.php');
}

 ?>
