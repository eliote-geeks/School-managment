<?php
include_once('config.php');
 $adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();
    $eleve = $bdd->query("SELECT * FROM site_users ORDER BY grade");
$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}

        if (isset($_GET['confirm']) AND !empty($_GET['confirm'])) {
      $confirm = (int) $_GET['confirm'];
      $req = $bdd->prepare("UPDATE site_users SET user_admin = 1 WHERE id = ?");
      $req->execute(array($confirm));
        header('Location:liste.php');
    }

    if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      echo "<script>alert('suppression reussie');</script>";
      $req = $bdd->prepare("DELETE FROM site_users WHERE id = ?");
      $req->execute(array($supprime));
      header('Location:liste.php');
    }

if(isset($_POST['valid']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $nom = htmlspecialchars($_POST['nom']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $email = htmlspecialchars($_POST['email']);
    $naissance = htmlspecialchars($_POST['naissance']);
    $grade = htmlspecialchars($_POST['grade']);
    $pays = htmlspecialchars($_POST['pays']);
    $pass = htmlspecialchars($_POST['pass']);
    $apropos = htmlspecialchars($_POST['apropos']);
    $occupation = htmlspecialchars($_POST['occupation']);
    $prenom = htmlspecialchars($_POST['prenom']);
  if(isset($_POST['nom'],$_POST['pays'],$_POST['occupation'],$_POST['mobile'],$_POST['apropos']) AND !empty($_POST['nom']))
  {
    if (empty($_POST['grade'])) {
      $site = " ";
    }

    $l = strlen($pseudo);
    if($l >= 4)
    {
      if($l >= 6)
      {
        $hash = password_hash($pass,PASSWORD_BCRYPT,['cost'=>11]);
        $req = $bdd->prepare("SELECT * FROM site_users WHERE pseudo = ?");
        $req->execute(array($pseudo));
        $exist = $req->rowCount();
        if($exist == 0)
        { 
          $insert = $bdd->prepare("INSERT INTO site_users(user_name,user_last,naissance,pays,occupation,email,mobile,apropos,grade,pseudo,user_password,user_admin) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
          $insert->execute(array($nom,$prenom,$naissance,$pays,$occupation,$email,$mobile,$apropos,$grade,$pseudo,$hash,1));
          echo "<script>alert('inscription reussie connectez-vous avec votre pseudo');</script>";
        } 
        else{
          $erreur = "oups ce pseudo existe deja";
        }
      }
      else{
        $erreur = "le pseudo est trop court";
      }
    }
    else{
      $erreur = "Le nom d'utilisateur est trop court";
    }
  }
  else{
    $erreur = "Tous les champs doivent etre rempli";
  }
}



?>
<?php include_once('head.php'); ?>

<body>

  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
         <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.php" class="logo"><?=$_SESSION['user_name']?> <span class="lite">admin&copy;</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        <ul class="nav top-menu">
          <li>
            <form class="navbar-form" method="get" action="">
              <input class="form-control" placeholder="Search" type="text">
            </form>
          </li>
        </ul>
        <!--  search form end -->
      </div>
      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">
          <!-- task notificatoin end -->
          <!-- inbox notificatoin start-->
          <li id="mail_notificatoin_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="icon-envelope-l"></i>
                            <span class="badge bg-important"><?= $con?></span>
                        </a>
            <ul class="dropdown-menu extended inbox">
              <div class="notify-arrow notify-arrow-blue"></div>
              <li>
                <p class="blue"><?php echo $con." menbres ne sont pas encore confirnes"?></p>
              </li>                                   
            </ul>
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img style="width:35px; height:35px; border-color: whitesmoke; color:springgreen;" alt="" src="img/log.ico">
                            </span>
                            <span class="username"><?= $_SESSION['user_name']?></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="profile.php?id=<?$_SESSION['id']?>"><i class="icon_profile"></i> Mon Profile</a>
              </li>
              <li>
                <a href="message/conn.php"><i class="icon_mail_alt"></i> Ma messagerie</a>
              </li>
              <li>
                <a href="logout.php"><i class="icon_key_alt"></i> Deconnexion</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

<?php include_once('aside.php'); ?>
    <section id="main-content"><br><br><br>

        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> Administration</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php?id=<?$_SESSION['id']?>">Home</a></li>
              <li><i class="icon_document_alt"></i>Forms</li>
              <li><i class="fas fa-balance-scale"></i>admin</li>
            </ol>
          </div>
        </div>
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
                            <div class="col-lg-6">
                              <textarea    id="" class="form-control" cols="30" rows="5" name="apropos"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Pays</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="c-name" placeholder=" " name="pays">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Birthday</label>
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
                            <label class="col-lg-2 control-label">addresse mail</label>
                            <div class="col-lg-6">
                              <input type="text" class="form-control" id="email" name="email" placeholder=" ">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Mobile</label>
                            <div class="col-lg-6">
                              <input type="text" value="+237" class="form-control" name="mobile" id="mobile" placeholder=" ">
                            </div>
                          </div>


                          <div class="form-group">
                                    <label class="col-lg-2 control-label">Grade</label>
                                    <div class="col-lg-6">
                                    <select required="required" name="grade" class="form-control"> 
                                      <option></option>
                                      <option>root</option>
                                      <option>user</option>
                                    </select>
                                    </div>
                                  </div>

                          <div class="form-group">
                            <label class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-6">
                              <input type="password" value="+>.," class="form-control" name="pass" id="mobile" placeholder=" ">
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
                          <!--main content start-->
       
<table class="table" border="2">
<tr>
<th>PSEUDO</th>
<th>NOMS et PRENOMS</th>
<th>date de naissance</th>
<th>grade</th>
<th>mobile</th>
<th>ACTION</th>
</tr>
<?php while($eliu = $eleve->fetch()) {  ?>
<tr>
<td><?= $eliu['pseudo']?> </td>
<td><?= $eliu['user_name']." ".$eliu['user_last']?></td>
<td><?= $eliu['naissance']?> </td>
<td><?= $eliu['grade']?> </td>
<td><?= $eliu['mobile']?> </td>
   <td>
   <div class="btn-group">

<?php if($eliu['user_admin'] == 0) {  ?><a class="btn-sm btn-success" href="liste.php?confirm=<?= $eliu['id'] ?>"><i class="icon_check_alt2"></i></a><?php } ?>

 <a onclick="return(confirm('voulez-vous vraiment effectuer cette action?'))" class="btn-sm btn-danger" href="admin.php?supprime=<?= $eliu['id'] ?>"><i class="fa fa-times-circle"></i></a>

                      </div>
                    </td>
</tr>
<?php } ?>
</table>    

                    </section>
                  </div>
                </section>

  
  <!-- container section end -->
  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

  <!-- jquery ui -->
  <script src="js/jquery-ui-1.9.2.custom.min.js"></script>

  <!--custom checkbox & radio-->
  <script type="text/javascript" src="js/ga.js"></script>
  <!--custom switch-->
  <script src="js/bootstrap-switch.js"></script>
  <!--custom tagsinput-->
  <script src="js/jquery.tagsinput.js"></script>

  <!-- colorpicker -->

  <!-- bootstrap-wysiwyg -->
  <script src="js/jquery.hotkeys.js"></script>
  <script src="js/bootstrap-wysiwyg.js"></script>
  <script src="js/bootstrap-wysiwyg-custom.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/bootstrap-colorpicker.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <!-- ck editor -->
  <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
  <!-- custom form component script for this page-->
  <script src="js/form-component.js"></script>
  <!-- custome script for all page -->
  <script src="js/scripts.js"></script>

<script type="text/javascript">
 function cli(e){
  if(confirm("etes-vous sur de vouloir effectuer cette action?: ")!=0){
    e.preventDefault();
  }
  alert("non pas bonjour");
  
 }
</script>
</body>

</html>
