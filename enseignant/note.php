<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if (isset($_SESSION['id']) AND $_SESSION['id'] > 0) 
  {
    $getid = intval($_SESSION['id']);
    $requser = $bdd->prepare("SELECT * FROM enseignant WHERE id = ?");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch(); 
    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
    {

    	if(isset($_GET['idi'])){
  $id = (int) $_GET['idi'];
  $noti = $bdd->prepare("SELECT * FROM module WHERE id = ?");
  $noti->execute(array($id));
  $mo = $noti->fetch();
  ?>


            <div class="row">
          <div class="col-lg-12" style="margin-left: 100px; margin-right: 30px; ">
            <section class="panel">
              <header class="text-center panel-heading" >
                <h1 style="font-family:poppins;" align="center">ajouter les notes des etudiants dans ce module</h1>
              </header>
              <div class="panel-body">
    <form class="form-inline" role="form" method="post" action="">
                    <?php if(isset($erreur)){?>
                  <div class="form-group" align="center">
                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                      <input  type="text" class="form-control alert-danger" value="<?= $erreur?>" id="inputPassword1">
                    </div>
                  </div>                  
                <?php }?>

                <div class="form-group" align="center">
                    <label for="inputPassword1" class="col-lg-2 control-label">matricule &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <div class="col-lg-10">
                      <input style="width:400px; padding: 10px 15px; margin: 10px; border: #5d2a 1px solid;" name="matricule" type="text" class="form-control" id="inputPassword1" placeholder="matricule de l'etudiant">
                    </div>
                  </div>                        

                  <div class="form-group" align="center">
                    <label for="inputPassword1" class="col-lg-2 control-label">pseudo </label>
                    <div class="col-lg-10">
                      <input type="text" style="width:400px; padding: 10px 15px; margin: 10px; border: #5d2a 1px solid;" name="pseudo" class="form-control" id="inputPassword1" placeholder="pseudo de l'etudiant">
                    </div>
                  </div>

                  <div class="form-group" align="center">
                    <label for="inputEmail1" class="col-lg-2 control-label">note</label>
                    <div class="col-lg-10">
                      <input type="number" style="width:400px; padding: 10px 15px; margin: 10px; border: #5d2a 1px solid;" name="note" placeholder="note" class="form-control">
                    </div>
                  </div>
                  <div class="form-group" align="center">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" style="width:400px; padding: 10px 15px; margin: 10px; border: #5d2a 1px solid;" name="validon" class="btn btn-danger">envoyer</button>
                    </div>
                  </div>

                </form>

              </div>
            </section>

          </div>
        </div>

  <?php

  if (isset($_POST['validon'])) {
  if (isset($_POST['pseudo'], $_POST['matricule'],$_POST['note']) AND !empty($_POST['note']) AND !empty($_POST['pseudo']) AND !empty($_POST['matricule'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
     $matricule = htmlspecialchars($_POST['matricule']);
     $note = htmlspecialchars($_POST['note']);
    $req = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ? AND matricule = ? ");
    $req->execute(array($pseudo,$matricule));
    $exist = $req->rowCount();
    if($exist == 1){
    $e = $req->fetch();
      if(($mo['specialite'] == $e['specialite']) ){
        if($e['confirm'] == 1){
      $insert =  $bdd->prepare("INSERT INTO note(first,last,matricule,specialite,session,pseudo,note,module,temps) VALUES(?,?,?,?,?,?,?,?,NOW())");
       $insert->execute(array($e['first'],$e['last'],$matricule,$mo['specialite'],$e['session'],$pseudo,$note,$mo['module']));
       echo "<script>alert('ajout note reussi de ".$e['first']."');</script>";
        }
        else{
          $erreur = "l'etudiant n'est pas confirme";
        }
      }else{
        $erreur = "l'etudiant n'est pas de cette classe";
      }
    }
    else{
      $erreur = "cet etudiant n'existe pas";
    }      
    } 
    else{
      $erreur = "Tous les champs doivent etre rempli";
    } 
}
}

if (isset($_POST['valid'])) {
  if (isset($_POST['module'],$_POST['filiere']) AND !empty($_POST['module']) AND !empty($_POST['filiere'])) {
    $module = htmlspecialchars($_POST['module']);
    $filiere = htmlspecialchars($_POST['filiere']);
    $req = $bdd->prepare("SELECT * FROM module WHERE module = ? AND specialite = ?");
    $req->execute(array($module,$filiere));
    $molsu = $req->fetch();
    $existmodule = $req->rowCount();
     if($existmodule == 1){ 
      header('Location:note.php?idi='.$molsu['id']);
      ?>

      <?php
      if(isset($_POST['valide'])){
       $pseudo = htmlspecialchars($_POST['pseudo']);
     $matricule = htmlspecialchars($_POST['matricule']);
     $note = htmlspecialchars($_POST['note']);
    $pseureq = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ? AND matricule = ? ");
    $pseureq->execute(array($pseudo,$matricule));
    $pseuexist = $pseureq->rowCount();
    if($pseuexist == 1){
      echo "<script>alert('ouais c est bom');<script>";
    }else{
      $erreur = "cet etudiant n'existe pas";
    }
}
else{
  $erreur = "continuer avec le formulaire du dessus";
}
}
else{
  $erreur = "module inexistant";
}
  }
  else{
    $erreur = "Tous les champs doivent etre rempli";
  }
}


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
			<a href="di.php?id=<?= $_SESSION['id']?>">
				<i class=" fas fa-frown"></i>
				<span class="links_name">Note</span>
			</a>
			<span class="tooltip"></span>
		</li>

    <li>
      <a href="notifications/notification.php?id=<?= $_SESSION['id']?>">
        <i class=' far fa-user ' ></i>
        <span class="links_name">notification</span>
      </a>
      <span class="tooltip">notification</span>
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
<div class="home_content"> 
	<section class="panel" style="width:600px; margin-left: 300px;">
              <header class="panel-heading">
				<h1 align="center" <?php if(isset($_GET['idi'])){ ?>hidden <?php } ?> style="font-family: poppins;">ajouter note</h1><br>
		              </header>
              <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="">

                  <?php if(isset($erreur)){?>
                  <div class="form-group" align="center">
                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                    <input readonly="<?= $erreur?>" style="color: red; width:400px; padding: 10px 15px; margin: 10px; border: #5d2a 1px solid;" value="<?= $erreur?>" type="text" class="form-control alert-danger" id="inputPassword1">
                    </div>
                  </div>                  
                <?php }?>
                            <div class="form-group" align="center" <?php if(isset($_GET['idi'])){ ?>hidden <?php } ?>>
                    <label for="inputEmail1" class="col-lg-2 control-label" style="font-size: 30px;">module</label>
                    <div class="col-lg-10">
                      <input type="text" style="width:400px; padding: 10px 15px; margin: 10px; border: #5d2a 1px solid;" class="form-control" name="module" placeholder="entrez le module">
                    </div>
                  </div>


                  <div class="form-group" hidden>
                    <label for="inputEmail1" class="col-lg-2 control-label">filiere</label>
                    <div class="col-lg-10" >
                    	<input type="text" name="filiere" value="<?=$userinfo['filiere'] ?>">
                      <p class="help-block"></p>
                    </div>
                  </div>

                  <div class="form-group" align="center" <?php if(isset($_GET['idi'])){ ?>hidden <?php } ?>>
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" name="valid" class="btn btn-danger">envoyer</button>
                    </div>
                  </div>
                </form>
              </div>
            </section>
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
