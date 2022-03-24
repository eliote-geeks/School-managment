<?php include_once('config.php'); ?>
<?php include_once('head.php'); 
$final = 0;
$adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();
$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}
if (isset($_POST['cy'])) {
  if (isset($_POST['cycle']) AND !empty($_POST['cycle'])) {
    $cy = $bdd->prepare("SELECT * FROM cycle WHERE nom = ?");
    $cy->execute(array(htmlspecialchars($_POST['cycle'])));
    if ($cy->rowCount() > 0) {
      $cycle_fetch = $cy->fetch();
      $final = 1;
    }
    else{
      $erreur = "Ce cycle n'existe pas vous pouvez le creer";
    }
  }
  else{
    $erreur = 'Tous les champs doivent etre rempli';
  }
}

if($final == 1){
$mati = $bdd->prepare("SELECT * FROM matiere WHERE cycle = ?");
$mati->execute(array($cycle_fetch['nom']));
}
$cycle = $bdd->query("SELECT * FROM cycle ORDER BY id DESC");


?>
      
            <?php include 'aside.php'; ?>
          <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> Form Validation</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Acceuil</a></li>
              <li><i class="icon_document_alt"></i>module</li>
              <li><i class="fa fa-files-o"></i>Liste des modules specifiques</li>
            </ol>
          </div>
        </div>
<div class="panel-body">
                <form method="post" action="" autocomplete="off">
                                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Choisissez un Cycle</label>
                    <div class="col-lg-10">
                      <select required="required" class="form-control" id="inputEmail1" name="cycle">     
        <option></option>
        <?php while ($c = $cycle->fetch()) {  ?>
      <option><?= $c['nom'];?></option>
      <?php } ?>
    </select>
                      <p class="help-block"></p>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-danger" name="cy">Valider</button>
                </form>
                <form class="form-horizontal" role="form" method="post" action="mo_a.php">
                  <?php if(isset($erreur)){?>
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                      <input readonly="" type="text" class="form-control alert-danger" value="<?= $erreur?>" id="inputPassword1">
                    </div>
                  </div>                  
                <?php }?>                  

                <?php if($final == 1){ ?>
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
                    <label for="inputPassword1" class="col-lg-2 control-label">annee</label>
                    <div class="col-lg-10">
                      <input type="year" name="annee" class="form-control" id="inputPassword1" placeholder="annee">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button name="valid" type="submit" class="btn btn-danger">envoyer</button>
                    </div>
                  </div>
                <?php } ?>
                </form>
              </div>
                         </section>
          </div>
        </div>
        <!-- page end-->
      </section>
    </section>
      <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- jquery validate js -->
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>

  <!-- custom form validation script for this page-->
  <!-- <script src="js/form-validation-script.js"></script> -->
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>


</body>

</html>
