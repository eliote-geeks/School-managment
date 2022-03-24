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
$mati = $bdd->query("SELECT * FROM matiere");
$admis = $bdd->query("SELECT * FROM note");

if (isset($_POST['valid'])) {
  if (isset($_POST['session'],$_POST['annee']) AND !empty($_POST['session']) AND !empty($_POST['annee'])) {    
    $session = htmlspecialchars($_POST['session']);
    $annee = htmlspecialchars($_POST['annee']);
    $req = $bdd->prepare("SELECT * FROM auto WHERE session = ? AND date_enreg LIKE '%".$annee."%' ");
    $req->execute(array($session));
    if ($req->rowCount() > 0) {
         // var_dump($bdd);
    }
    else{
      header('Location:li_ca.php');
    }
   
      
  }
  else{
    $erreur = "Tous les champs doivent etre rempli";
  }
}

if (isset($_GET['del'])) {
  $delete = (int) $_GET['del'];
  $req = $bdd->prepare("DELETE FROM enseignant WHERE id = ?");
  $req->execute(array($delete));
  echo "<p class = \"container alert alert-danger\">suppresion reussie</p>";
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
              <li><i class="fa fa-files-o"></i>Admis</li>
            </ol>
          </div>
        </div>

            <div class="panel-body">
              <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
                <b>Permis de conduire:</b> <?=$_POST['session']." ".$_POST['annee']?>
              </header>
              <?php if(isset($erreur)){ ?><p style="color:red;"><?=$erreur?></p><?php } ?>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Noms et prenoms</th>
                    <th>Age</th>
                    <th>Date de naissance</th>
                    <th>Ville</th>
                    <th>sexe</th>
                    <th>session</th>
                    <th>Annee Scolaire</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($n = $req->fetch()){ ?>
                    
                  <tr class="active">
                    <td><?= $n['id']?></td>
                    <td><?= $n['first']." ".$n['last']?></td>
                    <td><?= $n['age']?></td>
                    <td><?= $n['naissance']?></td>
                    <td><?= $n['lieu']?></td>
                    <td><?= $n['sexe']?></td>
                    <td><?= $n['session']?></td>
                    <td><?= $_POST['annee']?></td>
                    <td><a href="li_e.php?del=<?=$n['id']?>"><i style="font-size: 19px;" class="fa fa-times-circle"></i></a></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
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
