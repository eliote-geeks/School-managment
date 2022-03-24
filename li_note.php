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
  if (isset($_POST['session'],$_POST['annee'],$_POST['matiere']) AND !empty($_POST['matiere']) AND !empty($_POST['session']) AND !empty($_POST['annee'])) {
    $matiere = htmlspecialchars($_POST['matiere']);
    $session = htmlspecialchars($_POST['session']);
    $annee = htmlspecialchars($_POST['annee']);
    $req = $bdd->prepare("SELECT * FROM note WHERE specialite = ? AND session = ? AND temps LIKE '%".$annee."%' ");
    $req->execute(array($matiere,$session));
    if ($req->rowCount() > 0) {
         // var_dump($bdd);
    }
    else{
      header('Location:ac.php');
    }
   
      
  }
  else{
    $erreur = "Tous les champs doivent etre rempli";
  }
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
                <b>Classe:</b> <?=$_POST['session']." ".$_POST['matiere']." ".$_POST['annee']?>
              </header>
              <?php if(isset($erreur)){ ?><p style="color:red;"><?=$erreur?></p><?php } ?>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Noms et prenoms</th>
                    <th>Specialites</th>
                    <th>Session</th>
                    <th>note</th>
                    <th>Decision</th>
                    <th>Annee</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($n = $req->fetch()){ ?>
                    <?php if($n['note']==12){ ?>
                  <tr class="active">
                    <td><?= $n['id']?></td>
                    <td><?= $n['first']." ".$n['last']?></td>
                    <td><?= $n['specialite']?></td>
                    <td><?= $n['session']?></td>
                    <td><?= $n['note']?></td>
                    <td>admis</td>
                    <td><?= $_POST['annee']?></td>
                  </tr>
                <?php } ?>
                    <?php if($n['note'] > 14){ ?>
                  <tr class="success">
                    <td><?= $n['id']?></td>
                    <td><?= $n['first']." ".$n['last']?></td>
                    <td><?= $n['specialite']?></td>
                    <td><?= $n['session']?></td>
                    <td><?= $n['note']?></td>
                    <td>admis et excellent</td>
                    <td><?= $_POST['annee']?></td>
                  </tr>
                <?php } ?>
                <?php if($n['note']<12){ ?>
                  <tr class="warning">                    
                    <td><?= $n['id']?></td>
                    <td><?= $n['first']." ".$n['last']?></td>
                    <td><?= $n['specialite']?></td>
                    <td><?= $n['session']?></td>
                    <td><?= $n['note']?></td>
                    <td>Echec mais peux encore</td>
                    <td><?= $_POST['annee']?></td>>
                  </tr>
                <?php } ?>
              <?php if($n['note']<9){ ?>
                  <tr class="danger">
                    <td><?= $n['id']?></td>
                    <td><?= $n['first']." ".$n['last']?></td>
                    <td><?= $n['specialite']?></td>
                    <td><?= $n['session']?></td>
                    <td><?= $n['note']?></td>
                    <td>Echec</td>
                    <td><?= $_POST['annee']?></td>
                  </tr>
                <?php } ?>
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
