<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');


if (isset($_GET['unique_id']) AND $_GET['unique_id'] > 0) 
  {
    $getid = intval($_GET['unique_id']);
    $requser = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch(); 
    $req = $bdd->prepare("SELECT * FROM sanction WHERE pseudo = ?");
    $req->execute(array($userinfo['pseudo']));
    $as = $req->fetch();
    $a = 0;
    while ($sc = $req->fetch()) {
    	$a += $sc['absence'];
    }


    if(isset($_SESSION['unique_id']) AND $userinfo['unique_id'] == $_SESSION['unique_id'])
    {
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
td{color: black;
}</style>
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
			<a href="pro.php?unique_id=<?= $userinfo['unique_id']?>">
				<i class=' far fa-user ' ></i>
				<span class="links_name">Mon Profil</span>
			</a>
			<span class="tooltip">profil</span>
		</li>

		<li>
			<a href="info.php?unique_id=<?= $_SESSION['unique_id']?>">
				<i class="fas fa-info-circle"></i>
				<span class="links_name">Mes infos</span>
			</a>
			<span class="tooltip">Info</span>
		</li>

		<li>
			<a href="msg/use.php?idi=<?= $userinfo['unique_id']?>">
				<i class="far fa-comment"></i>
				<span class="links_name">messages</span>
			</a>
			<span class="tooltip">messages</span>
		</li>

		<li>
			<a href="edition.php">
				<i class=" fas fa-sliders-h"></i>
				<span class="links_name">Editer profil</span>
			</a>
			<span class="tooltip">edition</span>
		</li>

		<li>
			<a href="discipline.php?unique_id=<?= $_SESSION['unique_id']?>">
				<i class="fas fa-wheelchair"></i>
				<span class="links_name">Discipline</span>
			</a>
			<span class="tooltip">Discipline</span>
		</li>
						<li>
			<a href="notifications/notification.php?unique_id=<?= $_SESSION['unique_id']?>">
				<i class="fas fa-bell"></i>
				<span class="links_name">Notifications</span>
			</a>
			<span class="tooltip">Notifications</span>
		</li>
	</ul>
	<div class="profile_content">
		<div class="profile">
			<div class="profile_details">
				<img src="photo/<?php echo $userinfo['photo']; ?>" alt="<?= $userinfo['pseudo']?>">
				<div class="name_job"><?php 
				$result = $userinfo['first']." ".$userinfo['last'];
				(strlen($result) >13 ) ? $msg = substr($result, 0,13).'..' :$msg = $result; ?>
					<div class="name"><?= $msg?></div>
					<div class="job"><?= $userinfo['specialite']?></div>
				</div>
				 <a style="color:white;" onclick="" href="deconnexion.php?id=<?= $_SESSION['unique_id']?>"  ><i class="far fa-share-square" id="log_out"></i></a>
			</div>
		</div>
	</div>
</div><br>
<div class="home_content">  <p style="font-size:40px; margin-left: 500px;">Indicipline</p>
	<div class="text" style="color:whitesmoke;">
  <?php if(isset($req)) {  ?>
<br><br><br><br><br><br>
<div align="center">
<div align="center" style="display: inline-flex;"><br><br><br>

		<img class="thumbnail" width="100" height="100" src="photo/<?php echo  $userinfo['photo'];?>" style="margin: 10px; width: 220px;">
	<div class="details" align="left" style="font-size:12px; font-family: cursive; display: inline-block;margin-top: 20px; ">
		<label>etudiant au CFPAM <b><?php if( $userinfo['sexe'] == 'M') echo "masculin";else echo "feminin" ?>  de <?= $userinfo['lieu']?></b></label>
		<label></label>
		<label></label>
		<hr style="clear: right;">
	<label>id de l'etudiant <?= $as['id']?></label>
	<label>Matricule <b> <?= $userinfo['matricule']?></b></label>
	<?php if(!empty($as['absence'])) { ?><label>absence <b> <?= $a ?> heures</b></label><?php } else echo "aucune absence"; ?>
	<?php if(!empty($as['sanction'])) { ?><label>sanction  <?= $as['sanction']?></label><?php } else echo "aucune sanction"; ?>
	<label>menbre depuis le <?= $userinfo['date_enreg']?></label>
	<hr style="clear: right;">
	<label><font color='green'>Consulter un administrateur pour plus de details</font></label>	

	</div>
</div>
</div>
  	<?php }else{ echo "<p>Aucun resultat</p>";} ?>
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
  header('Location:connexion.php');
} ?>
<?php }
else{
  header('Location:connexion.php');
}
 ?>
