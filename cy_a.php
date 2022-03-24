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

$admis = $bdd->query("SELECT * FROM note");
$cycle = $bdd->query("SELECT * FROM cycle ORDER BY id DESC");
$mat = $bdd->prepare("SELECT * FROM matiere WHERE cycle = ?");
$nom = '';

if (isset($_GET['del'])) {
  $delete = (int) $_GET['del'];
  $req = $bdd->prepare("DELETE FROM cycle WHERE id = ?");
  $req->execute(array($delete));
  header('Location:cy_a.php');
}

?>
      
            <?php include 'aside.php'; ?>
          <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> CYCle</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Acceuil</a></li>
              <li><i class="icon_document_alt"></i>cycle</li>
            </ol>
          </div>
        </div>
          cycle/filiere
            <div class="panel-body">
              <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
              </header>              
              <table class="table">
                <thead>
                  <tr>
                    <th>cycle</th>
                    <th>duree</th>
                    <th>Action</th>
                  </tr>
                </thead>
                  <?php while($c = $cycle->fetch()){ 
                    $mat->execute(array($c['nom']));
                      while ($m = $mat->fetch()) {
                       $nom .= "<b>".$m['matiere']."</b> ||  ";
                      }
                    ?>                                        
                <tbody>
                  <tr class="active">
                    <td>
                      <h4><?= $c['nom']?></h4>
                      <p><?=$nom?></p>
                    </td>
                    <td><?=$c['duree']?> an(s)</td>
                    <td><a href="cy_a.php?del=<?=$c['id']?>"><i style="font-size: 19px;" class="fa fa-times-circle"></i></a></td>
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
