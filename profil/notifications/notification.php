<?php 
include_once('notif.php');


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
<html lang="fr" dir="ltr">
<head>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  <!-- font icon -->
  <link href="elegant-icons-style.css" rel="stylesheet" />
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
		ul{
			list-style: none;
		}
		ul li{
			font-size: 15px;
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
			<a href="../pro.php?unique_id=<?= $userinfo['unique_id']?>">
				<i class=' far fa-user ' ></i>
				<span class="links_name">Mon Profil</span>
			</a>
			<span class="tooltip">profil</span>
		</li>

	</ul>
	<div class="profile_content">
		<div class="profile">
			<div class="profile_details">
				
				<div class="name_job"><?php 
				$result = $userinfo['first']." ".$userinfo['last'];
				(strlen($result) >13 ) ? $msg = substr($result, 0,13).'..' :$msg = $result; ?>
					<div class="name"><?= $msg?></div>
					<div class="job"><?= $userinfo['specialite']?></div>
				</div>
				 <a style="color:white;" onclick="" href="../deconnexion.php?id=<?= $_SESSION['unique_id']?>"><i class="far fa-share-square" id="log_out"></i></a>
			</div>
		</div>
	</div>
</div>
<div class="home_content">
	<div class="text" style="color:whitesmoke;">NOTIFICATIONS  <br><br>

<u><label>ANNONCES</label></u><br>
<ul>
<?php 
		$sn = $bdd->prepare("SELECT * FROM notification WHERE tag = ? OR tag = ? ORDER BY id DESC LIMIT 0,1");
		$sn->execute(array($userinfo['pseudo'],$userinfo['first']));
		$snt = $sn->fetch();

		if ($sn->rowCount() > 0) {
	?>
					<li style="font-size: 13px;">un administrateur vous a identifie</li>
	       <li><?= $snt['titre']?></li>
	       <li><?= $snt['message'].' <b>'.$snt['tag'].'</b>'?></li><br><br><br>
<?php 
 }

?>
<?php while($note = $notifications->fetch()) { 
					
 if(!empty($note['message']) AND !empty($note['titre']) AND empty($note['tag'])){
 	?>
 	<li style="font-size: 13px;">Notifications generales</li>
 	<li><?= $note['titre']?></li>
 	<li><?= $note['categorie']?></li>
 	<li><?= $note['message']?></li>
 	<?php 
 }



   } ?>
</ul>







<ul>
		<?php while ($re = $req->fetch()) {
	     		?><br><br>

			<?php if(isset($re2['pseudo'])) { ?>

				<li>
					<a href="../msg/use.php?idi=<?= $_SESSION['unique_id']?>"> <?= " nouveau message de <b> ".$re2['first'].' '.$re2['last'].'  </b>  envoye le <b>'.$re['date_en'].'</b>'?> 
					 </a>	
			  </li>
			<?php }else { ?>
					<li>aucune notification par message</li><?php } ?>
<?php } ?>
</ul>
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
