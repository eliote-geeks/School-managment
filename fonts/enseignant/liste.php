<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
if(isset($_GET['id']) AND !empty($_GET['id'])){
	$req = $bdd->prepare("SELECT * FROM enseignant WHERE id = ?");
	$req->execute(array($_GET['id']));
	$ide = $req->fetch();

	$eleve = $bdd->prepare("SELECT * FROM menbre WHERE specialite = ? AND session = ?");
	$eleve->execute(array($ide['filiere'],$ide['session']));
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
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
<style type="text/css">
*{
	font-family: 'poppins';
}
	td{
		color: black;
		font-size: 15px;
		font-family: berlin sans fb;
	}
</style>	

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
			<a href="pro.php?id=<?= $ide['id']?>">
				<i class=' far fa-user ' ></i>
				<span class="links_name">Mon Profil</span>
			</a>
			<span class="tooltip">profil</span>
		</li>

		<li>
			<a href="info.php?id=<?= $ide['id']?>">
				<i class="fas fa-info-circle"></i>
				<span class="links_name">Mes infos</span>
			</a>
			<span class="tooltip">Info</span>
		</li>

		<li>
			<a href="liste.php?id=<?= $ide['id']?>">
				<i class="fas fa-users"></i>
				<span class="links_name">etudiants</span>
			</a>
			<span class="tooltip">liste des etudiants</span>
		</li>

		<li>
			<a href="note.php?id=<?= $_SESSION['id']?>">
				<i class="  fas fa-clipboard-list"></i>
				<span class="links_name">ajouter note</span>
			</a>
			<span class="tooltip">note des etudiants</span>
		</li>

		<li>
			<a href="di.php?id=<?= $ide['id']?>">
				<i class=" fas fa-frown"></i>
				<span class="links_name">Notes</span>
			</a>
			<span class="tooltip"></span>
		</li>
				<li>
			<a href="notifications/notification.php?id=<?= $ide['id']?>">
				<i class=' far fa-bell ' ></i>
				<span class="links_name">notification</span>
			</a>
			<span class="tooltip">profil</span>
		</li>
	</ul>
	<?php $result = $ide['first']." ".$ide['last']." ".$ide['session'];
				(strlen($result) >18 ) ? $msg = substr($result, 0,21).'..' :$msg = $result; ?>
	<div class="profile_content">
		<div class="profile">
			<div class="profile_details">
				<div class="name_job">
					<div class="name"><?= $msg?></div>
					<div class="job"><?= $ide['filiere']?></div>
				</div>
				 <a style="color:white;" onclick="" href="deconnexion.php"><i class="far fa-share-square" id="log_out"></i></a>
			</div>
		</div>
	</div>
</div>
<div class="home_content">
	<div class="text" style="color:whitesmoke;">

         <?php if(isset($eleve)) {?>
 <table class="table" border="2">
<tr>
<th>MATRICULE</th>
<th>PSEUDO</th>
<th>NOMS et PRENOMS</th>
<th>DATE DE NAISSANCE</th>
<th>SESSION</th>
<th>FILIERE</th>
<th>SEXE</th>
</tr>
<?php while($eliu = $eleve->fetch()) {  ?>
<tr>
<td><?= $eliu['matricule']?> </td>
<td><?= $eliu['pseudo']?> </td>
<td><?= $eliu['first']." ".$eliu['last']?></td>
<td><?= $eliu['naissance']?> </td>
<td><?= $eliu['session']?> </td>
<td><?= $eliu['specialite']?> </td>
<td><?= $eliu['sexe']?> </td>
</tr>
<?php } ?>
</table>
<?php } ?>

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
