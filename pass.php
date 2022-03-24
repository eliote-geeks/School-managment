<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
$adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();
$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}
$mati = $bdd->query("SELECT * FROM matiere");
if(isset($_GET['id'])){
  $id = (int) $_GET['id'];
  $noti = $bdd->prepare("SELECT * FROM module WHERE id = ?");
  $noti->execute(array($id));
  $mo = $noti->fetch();
  ?>

<section class="panel">

              <div class="panel-body">
                <a href="#myModal-1" data-toggle="modal" class="btn  btn-warning">
            Modification de mot de passe
                                </a> <a href="http://localhost/niceAdmin/pass.php">actualiser</a>
                

               

                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">Modifier le mot de passe de l'etudiant</h4>
                      </div>
                      <div class="modal-body">

                        <form class="form-horizontal" role="form" method="post" action="">
                    <?php if(isset($erreur)){?>
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                      <input  type="text" class="form-control alert-danger" value="<?= $erreur?>" id="inputPassword1">
                    </div>
                  </div>                  
                <?php }?>                  
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Mot de passe</label>
                    <div class="col-lg-10">
                      <input type="password" name="mdp" class="form-control" id="inputPassword1" placeholder="mot de passe">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Confirmer le mot de passe</label>
                    <div class="col-lg-10">
                      <input type="password" name="mdp2" placeholder="confirmez le mot de passe" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" name="validon" class="btn btn-danger">envoyer</button>
                    </div>
                  </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

  <?php

  if (isset($_POST['validon'])) {
  if (isset($_POST['mdp'], $_POST['mdp2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
        $mdp = htmlspecialchars($_POST['mdp']);
        $mdp2 = htmlspecialchars($_POST['mdp2']);
        if ($mdp == $mdp2) {
        	$pass = sha1($mdp);
        	if (isset($_GET['id'])) {
        		$id = intval($_GET['id']);
        		$mod = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
        		$mod->execute(array($id));
        		$mp  = $mod->fetch();
        		$up = $bdd->prepare("UPDATE menbre SET password = ? WHERE matricule = ? ");
        		$up->execute(array($pass,$mp['matricule']));
        		$success = "mot de passe modifiee avec success";
        	}
        }
        else{
        	$erreur  = "Les mots de passes ne correspondent pas";
        }   

    } 
    else{
      $erreur = "Tous les champs doivent etre rempli";
    } 
}
}

if (isset($_POST['valid'])) {
  if (isset($_POST['matricule']) AND !empty($_POST['matricule'])) {
    $matricule = htmlspecialchars($_POST['matricule']);
    $req = $bdd->prepare("SELECT * FROM menbre WHERE matricule = ?");
    $req->execute(array($matricule));
    $molsu = $req->fetch();
    $existmodule = $req->rowCount();
     if($existmodule == 1){ 
      header('Location:pass.php?id='.$molsu['id']);
}
else{	
  $erreur = "le matricule est incorrect";	
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
 <?php include_once('aside.php'); ?>

    <!--main content start-->
    <section id="main-content">
            <br><br><br>
            
        <!-- Basic Forms & Horizontal Forms-->

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
				Modifier le mot de passe
		              </header>
              <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="">

                  <?php if(isset($erreur)){?>
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                    <input readonly="<?= $erreur?>" value="<?= $erreur?>" type="text" class="form-control alert-danger" id="inputPassword1">
                    </div>
                  </div>                  
                <?php }?>

                                  <?php if(isset($success)){?>
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                    <input readonly="<?= $success?>" value="<?= $success?>" type="text" class="form-control alert-success" id="inputPassword1">
                    </div>
                  </div>                  
                <?php }?>

                            <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Matricule</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="matricule" placeholder="entrez le matricule de l'etudiant">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" name="valid" class="btn btn-danger">envoyer</button>
                    </div>
                  </div>
                </form>
              </div>
            </section>
          </div>
        </div>
        
        
        <!-- page end-->
      </section>
    </section>
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


</body>

</html>
