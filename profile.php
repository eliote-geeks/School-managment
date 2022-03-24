<?php 
session_start();
require 'util.php';
if(isset($_SESSION['id'])){    
  $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
  $adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();
  $c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}

  $requser = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();


$recup = $bdd->query("SELECT * FROM site_users");

if(isset($_POST['pseudo']) AND !empty($_POST['pseudo']) AND $_POST['pseudo'] != $user['pseudo'])
{
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $insertpseudo = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $insertpseudo->execute(array($_SESSION['id']));
  
  $newpseudo = $bdd->prepare("UPDATE site_users SET pseudo = ? WHERE id = ?");
  $newpseudo->execute(array($pseudo,$_SESSION['id']));
  $user = $newpseudo->fetch();
  echo "<script>alert('edition reussie');</script>";
}


if(isset($_POST['nom']) AND !empty($_POST['nom']) AND $_POST['nom'] != $user['user_name'])
{
  $nom = htmlspecialchars($_POST['nom']);
  $insertnom = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $insertnom->execute(array($_SESSION['id']));
  
  $newnom = $bdd->prepare("UPDATE site_users SET user_name = ? WHERE id = ?");
  $newnom->execute(array($nom,$_SESSION['id']));
  $user = $newnom->fetch();
  echo "<script>alert('edition reussie');</script>";
}

if(isset($_POST['prenom']) AND !empty($_POST['prenom']) AND $_POST['prenom'] != $user['user_last'])
{
  $prenom = htmlspecialchars($_POST['prenom']);
  $insertprenom = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $insertprenom->execute(array($_SESSION['id']));
  
  
  $editprenom = $bdd->prepare("UPDATE site_users SET user_last = ? WHERE id = ?");
  $editprenom->execute(array($prenom,$_SESSION['id']));
  $user = $editprenom->fetch();
  echo "<script>alert('edition reussie');</script>";
}


if(isset($_POST['email']) AND !empty($_POST['email']) AND $_POST['email'] != $user['email'])
{
  $email = htmlspecialchars($_POST['email']);
  $emai = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $emai->execute(array($_SESSION['id']));
  
  
  $editemail = $bdd->prepare("UPDATE site_users SET email = ? WHERE id = ?");
  $editemail->execute(array($email,$_SESSION['id']));
  $user = $editemail->fetch();
  echo "<script>alert('edition reussie');</script>";
}

if(isset($_POST['pays']) AND !empty($_POST['pays']) AND $_POST['pays'] != $user['pays'])
{
  $pays = htmlspecialchars($_POST['pays']);
  $pay = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $pay->execute(array($_SESSION['id']));
  
  
  $editpays = $bdd->prepare("UPDATE site_users SET pays = ? WHERE id = ?");
  $editpays->execute(array($pays,$_SESSION['id']));
  $user = $editpays->fetch();
  echo "<script>alert('edition reussie');</script>";
}

if(isset($_POST['occupation']) AND !empty($_POST['occupation']) AND $_POST['occupation'] != $user['occupation'])
{
  $occupation = htmlspecialchars($_POST['occupation']);
  $occupatio = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $occupatio->execute(array($_SESSION['id']));
  
  $editoccupation = $bdd->prepare("UPDATE site_users SET occupation = ? WHERE id = ?");
  $editoccupation->execute(array($occupation,$_SESSION['id']));
  $user = $editoccupation->fetch();
  echo "<script>alert('edition reussie');</script>";
}


if(isset($_POST['apropos']) AND !empty($_POST['apropos']) AND $_POST['apropos'] != $user['apropos'])
{
  $apropos = htmlspecialchars($_POST['apropos']);
  $apropo = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $apropo->execute(array($_SESSION['id']));
  
  $editapropos = $bdd->prepare("UPDATE site_users SET apropos = ? WHERE id = ?");
  $editapropos->execute(array($apropos,$_SESSION['id']));
  $user = $editapropos->fetch();
  echo "<script>alert('edition reussie');</script>";
}


if(isset($_POST['mobile']) AND !empty($_POST['mobile']) AND $_POST['mobile'] != $user['mobile'])
{
  $mobile = htmlspecialchars($_POST['mobile']);
  $mobil = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $mobil->execute(array($_SESSION['id']));
  
  $editmobile = $bdd->prepare("UPDATE site_users SET mobile = ? WHERE id = ?");
  $editmobile->execute(array($mobile,$_SESSION['id']));
  $user = $editmobile->fetch();
  echo "<script>alert('edition reussie');</script>";
}



if(isset($_POST['naissance']) AND !empty($_POST['naissance']) AND $_POST['naissance'] != $user['naissance'])
{
  $naissance = htmlspecialchars($_POST['naissance']);
  $naissanc = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
  $naissanc->execute(array($_SESSION['id']));
  
  
  $editemail = $bdd->prepare("UPDATE site_users SET naissance = ? WHERE id = ?");
  $editemail->execute(array($naissance,$_SESSION['id']));
  $user = $editemail->fetch();
  echo "<script>alert('edition reussie');</script>";
}






 ?>
<?php include_once('head.php'); ?>
<body>
  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
<?php include_once('aside.php'); ?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Acceuil</a></li>
              <li><i class="icon_documents_alt"></i>Pages</li>
              <li><i class="fa fa-user-md"></i>Profile</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <!-- profile-widget -->
          <div class="col-lg-12">
            <div class="profile-widget profile-widget-info">
              <div class="panel-body">
                <div class="col-lg-2 col-sm-2">
                  <h4><?=$user['user_name']." ".$user['user_last']?></h4>
                  <div class="follow-ava">
                    <img src="img/log.ico" alt="">
                  </div>
                  <h6>Administrateur</h6>
                </div>
                <div class="col-lg-4 col-sm-4 follow-info">
                  <p>Hello je suis <?= $user['user_name']." ".$user['user_last'].", ".$user['apropos']?>.</p>
                  <p><?=$user['email']?></p>
                  <p><i class="fa fa-twitter"> <?=$user['user_name']?></i></p>
                  <div class="xml"> 
                                </div>
                </div>
                <div class="col-lg-2 col-sm-6 follow-info weather-category">
                  <ul>
                    <li class="active">

                      <i class="fa fa-comments fa-2x"> </i><br> je suis un super admin
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- page start-->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading tab-bg-info">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a data-toggle="tab" href="#recent-activity">
                                          <i class="icon-home"></i>
                                          acceuil
                                      </a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#profile">
                                          <i class="icon-user"></i>
                                          Profile
                                      </a>
                  </li>
                  <li class="">
                    <a data-toggle="tab" href="#edit-profile">
                                          <i class="icon-envelope"></i>
                                          Edit Profile
                                      </a>
                  </li>
                </ul>
              </header>
              <div class="panel-body">
                <div class="tab-content">
                  <div id="recent-activity" class="tab-pane active">
                    <div class="profile-activity">
                      <?php while($adolf = $recup->fetch()) {  ?>
                      <div class="act-time">
                        <div class="activity-body act-in">
                          <span class="arrow"></span>
                          <div class="text">
                            
                            <p class="attribution"><a href="#"><?= $adolf['user_name']." ".$adolf['user_last']?></a> <?= $adolf['mobile'].", ".$adolf['email']?></p>
                            <p><?= $adolf['occupation']?></p>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                  </div><br><br>
                  <!-- profile -->
                  <div id="profile" class="tab-pane">
                    <section class="panel">
                      <div class="bio-graph-heading">
                        <?= $user['apropos']?>
                      </div>
                      <div class="panel-body bio-graph-info">
                        <h1>Bio Graph</h1>
                        <div class="row">
                          <div class="bio-row">
                            <p><span>First Name </span>: <?= $user['user_name']?> </p>
                          </div>
                          <div class="bio-row">
                            <p><span>Last Name </span>: <?= $user['user_last']?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Birthday</span>: <?= $user['naissance']?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Occupation </span>: <?= $user['occupation']?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Email </span>:<?= $user['email']?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Mobile </span>: <?= $user['mobile']?></p>
                          </div>
                          <div class="bio-row">
                            <p><span>Grade </span>: <?= $user['grade']?></p>
                          </div>
                        </div>
                      </div>
                    </section>
                    <section>
                      <div class="row">
                      </div>
                    </section>
                  </div>
                  <!-- edit-profile -->
                  <div id="edit-profile" class="tab-pane">
                    <section class="panel">
                      <div class="panel-body bio-graph-info">
                        <h1> Profile Info</h1>
                        <form class="form-horizontal" role="form" method="post">
                          <div class="form-group">
                            <?php if(isset($erreur)) {?>
                              <p class="alert alert-danger"><?= $erreur?></p>
                          <?php } ?>
                            <label class="col-lg-2 control-label">Pseudo</label>
                            <div class="col-lg-6">
                              <input type="text" name="pseudo" class="form-control" id="f-name" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Nom</label>
                            <div class="col-lg-6">
                              <input type="text" name="nom" class="form-control" id="f-name" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Prenom</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="l-name" placeholder=" " name="prenom">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">A propos de moi</label>
                            <div class="col-lg-10">
                              <textarea    id="" class="form-control" cols="30" rows="5" name="apropos"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">date de naissance</label>
                            <div class="col-lg-6">
                              <input type="date" class="form-control" id="b-day" placeholder=" " name="naissance">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Occupation</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="occupation" name="occupation" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="email" name="email" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Mobile</label>
                            <div class="col-lg-6">
                              <input type="text"  class="form-control" name="mobile" id="mobile" placeholder="+237 ">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <button type="submit" name="valid" class="btn btn-primary">Save</button>
                              <a href="index.php?id=<?$_SESSION['id']?>"  class="btn btn-danger">retour</a>
                            </div>
                          </div>
                        </form>
                      </div>
                    </section>
                  </div>

                </div>
              </div>
            </section>
          </div>
        </div>

        <!-- page end-->
      </section>
    </section><br><br><br><br><br><br><br><br><br><br>
    <!--main content end-->
    <div class="text-center">
      <div class="credits">
            <a href="">cfpam <?= $user['user_name'] ?></a>
        </div>
    </div>
  </section>
  <!-- container section end -->
  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- jquery knob -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>
   <script src="xl.js"></script>

  <script>
    //knob
    $(".knob").knob();
  </script>


</body>

</html>
<?php 
}
else{
  header('Location:404.html');
}
 ?>
