<?php 
include_once('config.php');
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



if (isset($_GET['id'])) {
  $req = $bdd->query("TRUNCATE note");
}

?>
<?php include_once('head.php'); ?>
<body>
  

  <!-- container section start -->
 <section id="container" class="">
<?php include_once('aside.php'); ?>

    <!--main content start-->
    <section id="main-content">
            <br><br><br>
            <?php if (isset($admis)){ ?>
         <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Table des admis
              </header>
                 <div align="center"><a style="font-size: 27px;" onclick="return(confirm('voulez-vous vraiment vider la table?'))" href="admis.php?id=truncate"><i class="fas fa-trash-alt"></i></a> </div>
              <div class="table-responsive">
                <table class="table"> 
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>matricule</th>
                      <th>Noms et prenoms</th>
                      <th>module</th>
                      <th>filiere</th>
                      <th>note</th>
                      <th>decision</th>
                      
                    </tr>
                  </thead>


              <?php while($bul = $admis->fetch()){ ?>
                  <tbody>
                    <tr>
                      <td><?= $bul['id']?></td>
                      <td><?= $bul['matricule']?></td>
                      <td><?= $bul['first']." ".$bul['last'] ?></td>
                      <td><?= $bul['module']?></td>
                      <td><?= $bul['specialite']?></td>
                      <td><?= $bul['note']?></td>
                      <?php if($bul['note'] < 12){  ?><td style="color:RED;"><b>ECHEC</b></td><?php } else{?>
                        <td style="color: green;"><b>ADMIS<b></td><?php }?>
                    </tr>
                  </tbody>

            <?php } ?>
                </table>
              </div>
            </section>
          </div>
        </div>
          </div>
        </div>
        

        </form>
      </div>
    </div>
    <?php  }?>
        <!-- page end-->
            
        <!-- Basic Forms & Horizontal Forms-->

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
				barbillard
		              </header>
              <div class="panel-body">
               
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
