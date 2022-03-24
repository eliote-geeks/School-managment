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
            ajouter une note
                                </a>
                

               

                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">note</h4>
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
                    <label for="inputPassword1" class="col-lg-2 control-label">matricule de l'etudiant</label>
                    <div class="col-lg-10">
                      <input name="matricule" type="text" class="form-control" id="inputPassword1" placeholder="matricule de l'etudiant">
                    </div>
                  </div>                        

                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">pseudo de l'etudiant</label>
                    <div class="col-lg-10">
                      <input type="text" name="pseudo" class="form-control" id="inputPassword1" placeholder="pseudo de l'etudiant">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">note</label>
                    <div class="col-lg-10">
                      <input type="number" name="note" placeholder="note" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" name="validon" onclick="return(confirm('voulez-vous vraiment ajouter une note a cet etudiant?'))" class="btn btn-danger">envoyer</button>
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
       echo "<script>alert('ajout note reussi');</script>";
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
      header('Location:note.php?id='.$molsu['id']);
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
  $erreur = "module ou filiere invalide";
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
				ajouter note
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
                            <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">module</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" name="module" placeholder="entrez le module">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">filiere</label>
                    <div class="col-lg-10">
                      <select required="required" class="form-control" id="inputEmail1" name="filiere">     
        <option></option>
        <?php while ($mat = $mati->fetch()) {  ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
    </select>
                      <p class="help-block"></p>
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
