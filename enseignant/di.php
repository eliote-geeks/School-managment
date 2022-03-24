<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');


if (isset($_GET['id']) AND $_GET['id'] > 0) 
  {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare("SELECT * FROM enseignant WHERE id = ?");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch(); 
    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
    {
    	$req = $bdd->prepare("SELECT * FROM note WHERE session = ? AND specialite = ? ");
    	$req->execute(array($userinfo['session'],$userinfo['filiere']));
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
			<a href="pro.php?id=<?= $userinfo['id']?>">
				<i class=' far fa-user ' ></i>
				<span class="links_name">Mon Profil</span>
			</a>
			<span class="tooltip">profil</span>
		</li>

		<li>
			<a href="info.php?id=<?= $userinfo['id']?>">
				<i class="fas fa-info-circle"></i>
				<span class="links_name">Mes infos</span>
			</a>
			<span class="tooltip">Info</span>
		</li>

		<li>
			<a href="liste.php?id=<?= $userinfo['id']?>">
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
			<a href="di.php?id=<?= $userinfo['id']?>">
				<i class=" fas fa-frown"></i>
				<span class="links_name">notes des eleves</span>
			</a>
			<span class="tooltip"></span>
		</li>
				<li>
			<a href="notifications/notification.php?id=<?= $userinfo['id']?>">
				<i class=' far fa-bell' ></i>
				<span class="links_name">Notifications</span>
			</a>
			<span class="tooltip">notifications</span>
		</li>
	
	</ul>
	<?php $result = $userinfo['first_en']." ".$userinfo['last_en']." ".$userinfo['session'];
				(strlen($result) >18 ) ? $msg = substr($result, 0,21).'..' :$msg = $result; ?>
	<div class="profile_content">
		<div class="profile">
			<div class="profile_details">
				<div class="name_job">
					<div class="name"><?= $msg?></div>
					<div class="job"><?= $userinfo['filiere']?></div>
				</div>
				 <a style="color:white;" onclick="" href="deconnexion.php"><i class="far fa-share-square" id="log_out"></i></a>
			</div>
		</div>
	</div>
</div><br>
<div class="home_content">  <p class="text-center" style="font-size:40px;">Notes des etudiants </p>
	<?php if (isset($req)){ ?>
         <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Table de notes
              </header>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Matricule</th>
                      <th>Noms et Prenoms</th>
                      <th>session</th>
                      <th>specialite</th>
                      <th>module</th>
                      <th>action</th>
                      
                    </tr>
                  </thead>


              <?php while($bul = $req->fetch()){ ?>
                  <tbody>
                    <tr>
                      <td><?= $bul['id']?></td>
                      <td><?= $bul['matricule']?></td>
                      <td><?= $bul['first']." ".$bul['last']?></td>
                      <td><?= $bul['session']?></td>
                      <td><?= $bul['specialite']?></td>
                      <td><?= $bul['module']?></td>
                      <td><?= $bul['note']?></td>
                    </tr>
                </tbody>
            <?php } ?>
                </table>

          <?php if($req->rowCount() == 0){  ?>
            <p class="alert alert-danger">Aucun resultat</p>
          <?php } ?>
              </div>
            </section>
          </div>
        </div>
          </div>
        </div>
        
        </form>
      </div>
    </div>
    <?php  }?>

	
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
