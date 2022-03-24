<?php include_once('config.php'); ?>
<?php include_once('head.php'); 
$adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();
$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}
$zonemodif = 0;

if (isset($_GET['edit']) AND !empty($_GET['edit'])) {
  $edit = htmlspecialchars($_GET['edit']);
  $ed = $bdd->prepare("SELECT * FROM module WHERE unique_id = ?");
  $ed->execute(array($edit));
  if ($ed->rowCount() > 0) {
    $zonemodif = 1;
    $edit_ce_module = $ed->fetch();

    if(isset($_POST['valider'])){
  if (isset($_POST['module'],$_POST['credit']) AND !empty($_POST['module']) AND !empty($_POST['credit'])) {
    $module = htmlspecialchars($_POST['module']);
    $credit = htmlspecialchars($_POST['credit']);
      $UPT = $bdd->prepare("UPDATE module SET credit = ?, module = ? WHERE unique_id = ?");
      $UPT->execute(array($credit,$module,$edit));
      header('Location:listemodule.php');      
    }
    
  else{
    $erreur = "Tous les champs doivent etre rempli";
  }
}


    
  }
  else{
    header('Location:mo_a.php');
  }
}


if (isset($_POST['valid'])) {
  if (isset($_POST['filiere'],$_POST['annee']) AND !empty($_POST['filiere']) AND !empty($_POST['annee'])) {    
    $filiere = htmlspecialchars($_POST['filiere']);
    $annee = htmlspecialchars($_POST['annee']);
    $req = $bdd->prepare("SELECT * FROM module LEFT JOIN matiere ON module.specialite = matiere.matiere WHERE module.specialite = ? AND module.temps LIKE '%".$annee."%' ");
    $req->execute(array($filiere));
    if ($req->rowCount() > 0) {
         // var_dump($bdd);
    }
    else{
      header('Location:listemodule.php');
      // var_dump($req);
    }
   
      
  }
  else{
    $erreur = "Tous les champs doivent etre rempli";
  }
}

if (isset($_GET['del'])) {
  $delete = (int) $_GET['del'];
  $req = $bdd->prepare("DELETE FROM module WHERE module = ?");
  $req->execute(array($delete));
}


?>
      
            <?php include 'aside.php'; ?>
          <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> Form Validation</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Acceuil</a></li>
              <li><i class="icon_document_alt"></i>Formulaire</li>
              <li><i class="fa fa-files-o"></i>Module</li>
            </ol>
          </div>
        </div>

              <?php if($zonemodif == 1){ ?>

                <form method="post" action="" autocomplete="off">

              <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">nom de module</label>
                    <div class="col-lg-10">
                      <input type="text" name="module" value="<?=$edit_ce_module['module']?>" class="form-control" id="inputPassword1" placeholder="nom de module">
                    </div>
                  </div><br><br>

                <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">nombre de credit du module</label>
                    <div class="col-lg-10">
                      <input type="number" name="credit" class="form-control" value="<?=$edit_ce_module['credit']?>" id="inputPassword1" placeholder="credit">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button onclick="return(confirm('voulez-vous vraiment modifier ce module?'))" name="valider" type="submit" class="btn btn-danger">envoyer</button>
                    </div>
                  </div>
              </form>
           <?php } ?>


              <?php if(isset($erreur)){ ?><p style="color:red;"><?=$erreur?></p><?php } ?>
              <?php if($zonemodif == 0){ ?>
                          <div class="panel-body">
              <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
                Modules
              </header>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>                    
                    <th>Module</th>
                    <th>Credit</th>
                    <th>filiere</th>
                    <th>Annee Scolaire</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($n = $req->fetch()){ ?>
                    
                  <tr class="active">
                    <td><?= $n['id']?></td>
                    <td><?= $n['module']?></td>
                    <td><?= $n['credit']?></td>
                    <td><?= $n['matiere']?></td>                    
                    <td><?= $_POST['annee']?></td>
                    <td><a href="mo_a.php?del=<?=$n['module']?>"><i style="font-size: 19px;" class="fa fa-times-circle"></i></a></td>
                    <td><a href="mo_a.php?edit=<?=$n['unique_id']?>"><i style="font-size: 19px;" class="fa fa-edit"></i></a></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            <?php } ?>
            </section>
          </div>
        </div>
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
  <script src="js/form-validation-script.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>


</body>

</html>
