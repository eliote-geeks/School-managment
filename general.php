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

$req2 = $bdd->query("SELECT * FROM settings");
$req3 = $req2->fetch();
if (isset($_GET['id'])) {
  if ($_GET['id'] == 'et') {
    if ($req3['affiche_etudiant'] == 0) 
      $req = "UPDATE settings SET affiche_etudiant = 1";          
    else
     $req = "UPDATE settings SET affiche_etudiant = 0";      
  }

    if ($_GET['id'] == 'en') {
      if ($req3['affiche_enseignant'] == 0) 
      $req = "UPDATE settings SET affiche_enseignant = 1";        
    else
    $req = "UPDATE settings SET affiche_enseignant = 0";

  }


  if ($_GET['id'] == 'ad') {
          if ($req3['affiche_admin'] == 0)
      $req = "UPDATE settings SET affiche_admin = 1";          
    else
      $req = "UPDATE settings SET affiche_admin = 0";
  }


  if ($_GET['id'] == 'let') {
         if ($req3['newsletter'] == 0) 
      $req = "UPDATE settings SET newsletter = 1";      
    else
      $req = "UPDATE settings SET newsletter = 0";
  }


  if ($_GET['id'] == 'in') {
    if ($req3['affiche_ins'] == 0) 
      $req = "UPDATE settings SET affiche_ins = 1";
    else
      $req = "UPDATE settings SET affiche_ins = 0";
  }



  $upt = $bdd->query($req);
  $erreur = "Activation  reussie";
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
              <li><i class="fa fa-files-o"></i>Parametres generaux du site</li>
            </ol>
          </div>
        </div>

                      <section class="panel">
              <header class="panel-heading">
                Activer la connexion au site
              </header>
              <div class="panel-body">
                <?php if(isset($reussie)){ ?><?=$reussie?><?php } ?>
                <div class="btn-group btn-group-justified">
                  <a class="btn btn-primary" href="general.php?id=et"><?php if($req3['affiche_etudiant'] == 0){ ?> Activer les etudiants <?php }else{ ?>desactiver les etudiants <?php } ?></a>
                  <a class="btn btn-success" href="general.php?id=en"><?php if($req3['affiche_enseignant'] == 0 ){?> Activer les enseignants <?php }else{ ?>desactiver les enseignants <?php } ?></a>
                  <a class="btn btn-info" href="general.php?id=ad"><?php if($req3['affiche_admin'] == 0){ ?> Activer les admins <?php }else{ ?>desactiver les admins <?php } ?></a>
                  <a class="btn btn-warning" href="general.php?id=in"><?php if( $req3['affiche_ins'] == 0 ){ ?> Activer les inscriptions <?php }else{ ?>desactiver les inscriptions <?php } ?></a>
                  <a class="btn btn-danger" href="general.php?id=let"><?php if($req3['newsletter'] == 0){ ?> Activer la newsletter <?php }else{ ?>desactiver la newsletter <?php } ?></a>
                </div>
              </div>
            </section>




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
