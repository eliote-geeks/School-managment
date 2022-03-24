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
              <li><i class="fa fa-files-o"></i>Liste du personnel enseignant</li>
            </ol>
          </div>
        </div>

            <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="post" action="li_e.php">
                    <div class="form-group ">
                      <label for="cname" class="control-label col-lg-2">Filiere <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <select class="form-control" name="matiere" required>
                      <option>Permis de conduire</option>
                      <?php while ($mat = $mati->fetch()) {  ?>
                      <option><?= $mat['matiere'];?></option>
                      <?php } ?>
                    </select>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cemail" class="control-label col-lg-2">session <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <select class="form-control" name="session" required>
                            <option></option>    
                            <option>JANVIER</option>
                            <option>FEVRIER</option>
                            <option>MARS</option>
                            <option>AVRIL</option>
                            <option>MAI</option>
                            <option>JUIN</option>
                            <option>JUILLET</option>    
                            <option>AOUT</option>
                            <option>SEPTEMBRE</option>
                            <option>OCTOBRE</option>
                            <option>NOVEMBRE</span></option>
                            <option>DECEMBRE</span></option>
                        </select>                        
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="curl" class="control-label col-lg-2">Annee scolaire <span class="required">*</span></label>
                      <div class="col-lg-10">
                        <input class="form-control " id="curl" type="year" name="annee" required />
                      </div>
                    </div>                    
                    
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button name="valid" class="btn btn-primary" type="submit">Envoyer</button>
                        <button class="btn btn-default" type="button">Retour</button>
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
