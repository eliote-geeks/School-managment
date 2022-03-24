
<?php 
 include_once('config.php'); 
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


if (isset($_GET['delete'])) {
  $delete =htmlspecialchars( $_GET['delete']);
  $req = $bdd->prepare("DELETE FROM module WHERE module = ?");
  $req->execute(array($delete));
}
if($final == 1){
$mati = $bdd->prepare("SELECT * FROM matiere WHERE cycle = ?");
$mati->execute(array($cycle_fetch['nom']));
}

$cycle = $bdd->query("SELECT * FROM cycle ORDER BY id DESC");
if(isset($_POST['valid'])){
  if (isset($_POST['module'],$_POST['filiere']) AND !empty($_POST['module']) AND !empty($_POST['filiere'])) {
    $module = htmlspecialchars($_POST['module']);
    $credit = htmlspecialchars($_POST['credit']);
    $filiere = htmlspecialchars($_POST['filiere']);
    $req = $bdd->prepare("SELECT * FROM module WHERE module = ? AND specialite  = ? ");
    $req->execute(array($module,$filiere));
    $exist = $req->rowCount();
    if($exist == 0){
      $unique = 0;
      $unique .= mt_rand(0,1000);
      $insert = $bdd->prepare("INSERT INTO module(credit,module,unique_id,specialite,temps) VALUES(?,?,?,?,NOW())");
      $insert->execute(array($credit,$module,$unique,$filiere));
      
    }
    else{
      $erreur = "Ce module existe deja";
    }
  }
  else{
    $erreur = "Tous les champs doivent etre rempli";
  }
}

$reponsesparpages = 10;
$reponsesTotallesReq = $bdd->query("SELECT * FROM module");
$reponsestotal = $reponsesTotallesReq->rowCount();
$pagesTotales = ceil($reponsestotal/$reponsesparpages);

if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND  $_GET['page'] <= $pagesTotales) {
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
}
else{
    $pageCourante = 1;
}

$depart = ($pageCourante - 1) * $reponsesparpages;

$mood = $bdd->query("SELECT * FROM module LEFT JOIN matiere ON module.specialite = matiere.matiere ORDER BY module.id DESC");


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
				ajout de module
		              </header>
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
                <form class="form-horizontal" role="form" method="post" action="">
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
                    <label for="inputPassword1" class="col-lg-2 control-label">nom de module</label>
                    <div class="col-lg-10">
                      <input type="text" name="module" class="form-control" id="inputPassword1" placeholder="nom de module">
                    </div>
                  </div>

                <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">nombre de credit du module</label>
                    <div class="col-lg-10">
                      <input type="number" name="credit" class="form-control" id="inputPassword1" placeholder="credit">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button onclick="return(confirm('voulez-vous vraiment creer un nouveau module?'))" name="valid" type="submit" class="btn btn-danger">envoyer</button>
                    </div>
                  </div>
                <?php } ?>
                </form>
              </div>
            </section>
          </div>
        </div>


        
        
<?php if (isset($mood)){ ?>
         <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Table de modules
              </header>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>cycle</th>
                      <th>filiere</th>
                      <th>Nom du module</th>
                      <th>Credit</th>
                      <th>action</th>
                      
                    </tr>
                  </thead>


              <?php while($bul = $mood->fetch()){ ?>
                  <tbody>
                    <tr>
                      <td><?= $bul['id']?></td>
                      <td><?= $bul['cycle']?></td>
                      <td><?= $bul['specialite']?></td>
                      <td><?= $bul['module']?></td>
                      <td><?= $bul['credit']?></td>
                      <td><a onclick="return(confirm('voulez-vous vraiment supprimer ce module?'))" href="module.php?delete=<?=$bul['module']?>"> <i class=" btn-sm btn-danger fa fa-times-circle"></i></a></td>
                    </tr>
                  </tbody>

            <?php } ?>

                </table>
              </div>

            </section>
                                    <div align="center" style="margin-left:450px;">
  <?php 
for ($i=1; $i < $pagesTotales ; $i++) { 
  if($i == $pageCourante){
    echo " page ".$i."  ";
  }
  else{
    echo "<a style='border:1px solid black; padding:5px; background:black; color:white; margin-left:9px;' href='liste.php?page=".$i."'>".$i."</a>";
  }
}
 ?>
</div>
          </div>
        </div>
          </div>
        </div>
        
        </form>
      </div>
    </div>
    <?php  }?>
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
