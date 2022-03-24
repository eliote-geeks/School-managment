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
if (isset($_GET['delete'])) {
  $delete = (int) $_GET['delete'];
  $req = $bdd->prepare("DELETE FROM note WHERE id = ?");
  $req->execute(array($delete));
  echo "<script>alert('suppression reussie');</script>";
}

  if (isset($_POST['valid'])) {
  if (isset($_POST['matiere'],$_POST['session']) AND !empty($_POST['session']) AND !empty($_POST['session'])) {
    $matiere  =htmlspecialchars($_POST['matiere']);
    $session = htmlspecialchars($_POST['session']);
    $req = $bdd->prepare("SELECT * FROM note WHERE session = ? AND specialite = ? ");
    $req->execute(array($session,$matiere));

  }
  else{
    $erreur =  "Tous les champs doivent etre rempli ";
  }
}
if (isset($_GET['ed'])) {
  $n = (int) $_GET['ed'];
  $re = $bdd->prepare("SELECT * FROM note WHERE id = ?");
  $re->execute(array($n));
  $note = $re->fetch();
  ?>
  <section class="panel">

              <div class="panel-body">
                <a href="#myModal-1" data-toggle="modal" class="btn  btn-warning">
            cliquez ici si vous souhaitez continuer
                                </a>
                

               

                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">modification note de <?= $note['pseudo']." n.mat".$note['matricule']?></h4>
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
                    <label for="inputEmail1" class="col-lg-2 control-label">note</label>
                    <div class="col-lg-10">
                      <input type="number" name="newnote" placeholder="note" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" onclick="return(confirm('voulez-vous vraiment modifier cette note?'))" name="validon" class="btn btn-danger">modifier</button>
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
    if (isset($_POST['newnote']) AND !empty($_POST['newnote'])) {
      $newnote = htmlspecialchars($_POST['newnote']);
      $mod = $bdd->prepare("UPDATE note SET note = ? WHERE id  = ?");
      $mod->execute(array($newnote,$n));
      echo "<script>alert('note modifiee avec success');</script>";
      ?>
      <p><a class="btn-sm btn-success" href="bulletin.php">actualiser</a></p>
      <?php
    }
    else{
      $erreur = "Tous les champs doivent etre rempli";
    }
  }
}

$mati = $bdd->query("SELECT * FROM matiere");
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
            
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
				bulletin
		              </header>
              <div class="panel-body">
                <div class="container">
                <form class="form-horizontal" role="form" method="post" action="">
                  <?php if(isset($erreur)){?>
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control alert-danger" value="<?= $erreur?>" id="inputPassword1">
                    </div>
                  </div>                  
                <?php }?>

               <div class="form-group">
          <label>Specialite:</label>
          <select name="matiere" required="required" class="form-control">     
        <option></option>
        <?php while($mat = $mati->fetch()) {  ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
    </select>
        </div>

                <div class="form-group">
          <label>session:</label>
          <select required="required" name="session" class="form-control">
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
      <option>NOVEMBRE</option>
      <option>DECEMBRE</option>
      </select>
        </div>


                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button onclick="return(confirm('voulez-vous vraiment ajouter cette note?'))" type="submit" class="btn btn-danger" name="valid">envoyer</button>
                    </div>
                  </div>


              </div>
            </section>
<?php if (isset($req)){ ?>
         <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Table de notes
              </header>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Matricule</th>
                      <th>Noms et Prenoms</th>
                      <th>session</th>
                      <th>specialite</th>
                      <th>module</th>
                      <th>note</th>
                      <th>action</th>
                      
                    </tr>
                  </thead>


              <?php while($bul = $req->fetch()){ ?>
                  <tbody>
                    <tr>
                      <td><?= $bul['id']?></td>
                      <td><?= $bul['matricule']?></td>
                      <td><?= $bul['first']." ".$bul['last']?></td>
                      <td><?= $bul['session']?></td>
                      <td><?= $bul['specialite']?></td>
                      <td><?= $bul['module']?></td>
                      <td><?= $bul['note']?></td>
                      <td><a class="btn btn-success"  href="bulletin.php?ed=<?=$bul['id']?>">modifier</a></td>
                      <td><a href="bulletin.php?delete=<?=$bul['id']?>"> <i class=" btn-sm btn-danger fa fa-times-circle"></i></a></td>
                    </tr>
                </tbody>
            <?php } ?>
                </table>

          <?php if($req->rowCount() == 0){  ?>
            <p class="alert alert-danger">Aucun resultat</p>
          <?php } ?>
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

<script type="text/javascript">
 function cli(e){
  if(confirm("etes-vous sur de vouloir effectuer cette action?: ")!=0){
    e.preventDefault();
  }
  alert("non pas bonjour");
  
 }
</script>
</body>

</html>
