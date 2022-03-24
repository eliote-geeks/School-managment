
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
if (isset($_POST['valid_sanction'])) {
  if (isset($_POST['mat'],$_POST['pseu'],$_POST['sanction']) AND !empty($_POST['mat']) AND !empty($_POST['pseu']) AND !empty($_POST['sanction'])) {
    $pseu = htmlspecialchars($_POST['pseu']);
     $mat = htmlspecialchars($_POST['mat']);
     $sanction = htmlspecialchars($_POST['sanction']);
    $req = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ? AND matricule = ? ");
    $req->execute(array($pseu,$mat));
    $exist = $req->rowCount();
    if($exist == 1){
      $r = $req->fetch();
    $ifsanction = $bdd->prepare("SELECT * FROM sanction WHERE pseudo =? AND matricule = ?  AND sanction = ?");
    $ifsanction->execute(array($pseu,$mat,$sanction));
    $isanction = $ifsanction->rowCount();
    if($isanction == 0){
      $req = $bdd->prepare("INSERT INTO sanction(first,last,pseudo,matricule,sanction,temps) VALUES(?,?,?,?,?,NOW())");
      $req->execute(array($r['first'],$r['last'],$pseu,$mat,$sanction));
      echo "<script>alert('sanction ajoutee');</script>";
    }
    else{
      $erreur = "attention cet etudiant a deja recu cette sanction";
    }
   }
   else{
    $erreur = "Cet etudiant n'existe pas";
  }
  }
  else{
    $erreur = "Tous les champs doivent etre rempli";
  }
}

if (isset($_POST['valide'])) {
  if (isset($_POST['matricule'],$_POST['pseudo'],$_POST['absence'],$_POST['jour']) AND !empty($_POST['matricule']) AND !empty($_POST['jour']) AND !empty($_POST['pseudo']) AND !empty($_POST['absence'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $jour = htmlspecialchars($_POST['jour']);
     $matricule = htmlspecialchars($_POST['matricule']);
     $absence = htmlspecialchars($_POST['absence']);
    $req = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ? AND matricule = ? ");
    $req->execute(array($pseudo,$matricule));
    $exist = $req->rowCount();
    $io = $req->fetch();
    if($exist == 1){
      $insert = $bdd->prepare("INSERT INTO sanction(first,last,pseudo,matricule,absence,jour,temps) VALUES(?,?,?,?,?,?,NOW())");
      $insert->execute(array($io['first'],$io['last'],$pseudo,$matricule,$absence,$jour));
      echo "<script>alert('absence ajoutee');</script>";
   }
   else{
    $erreur = "Cet etudiant n'existe pas";
  }
  }
  else{
    $erreur = "Tous les champs doivent etre rempli";
  }
}

$abse  = $bdd->query("SELECT * FROM sanction WHERE absence!=0 OR sanction!='' ");

 ?>
<?php include_once('head.php'); ?>
<body>

  <!-- container section start -->
  <section id="container" class="">
<?php include_once('aside.php'); ?>
    <!--main content start-->
    <section id="main-content">
            <br><br><br>
            
        <!-- Basic Forms & Horizontal Forms-->

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
				sanction
		              </header>
              <div class="panel-body">
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
                    <label for="inputPassword1" class="col-lg-2 control-label">matricule de l'etudiant</label>
                    <div class="col-lg-10">
                      <input name="mat" type="text" class="form-control" id="inputPassword1" placeholder="matricule de l'etudiant">
                    </div>
                  </div>                  

                  
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">pseudo de l'etudiant</label>
                    <div class="col-lg-10">
                      <input type="text" name="pseu" class="form-control" id="inputPassword1" placeholder="pseudo de l'etudiant">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">sanction</label>
                    <div class="col-lg-10">
                    	<select class="form-control" name="sanction" id="inputEmail1" required="required" name="session">
        <option></option>
          <option>avertissement 1</option>
            <option>avertissement 2</option>
              <option>avertissement 3</option>
      <option>exclusion</option>
      <option>conseil de discipline</option>
      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" class="btn btn-danger" name="valid_sanction">envoyer</button>
                    </div>
                  </div>
                </form>
              </div>
            </section>
            <section class="panel">
              <div class="panel-body">
                <a href="#myModal-1" data-toggle="modal" class="btn  btn-warning">
						ajouter absence
	                              </a>
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">absence</h4>
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
                    <label for="inputPassword1" class="col-lg-2 control-label">matricule de l'etudiant</label>
                    <div class="col-lg-10">
                      <input name="matricule" type="text" class="form-control" id="inputPassword1" placeholder="matricule de l'etudiant">
                    </div>
                  </div>                        

                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">pseudo de l'etudiant</label>
                    <div class="col-lg-10">
                      <input type="text" name="pseudo" class="form-control" id="inputPassword1" placeholder="pseudo de l'etudiant">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">absence</label>
                    <div class="col-lg-10">
                    	<input type="number" name="absence" placeholder="absence" name="absence" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">jour</label>
                    <div class="col-lg-10">
                      <input type="date" name="jour" class="form-control" id="inputPassword1" placeholder="entrez la date ou l'etudiant a ete absent">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" name="valide" class="btn btn-danger">envoyer</button>
                    </div>
                  </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
        
<header> &nbsp;effectif sanctionnaires</header>
<table class="table container">
  <tr>
    <th>Id</th>
  <th>Matricule</th>
  <th>Pseudo</th>
  <th>Noms et Prenoms</th>
  <th>absence</th>
  <th>Sanction</th>
  <th>jour</th>
  <th>Action</th>
</tr>
<?php while($as = $abse->fetch()) {?>

<tr>
   <td><?= $as['id']?></td>
  <td><?= $as['matricule']?></td>
  <td><?= $as['pseudo']?></td>
   <td><?= $as['first']." ".$as['last']?></td>
  <td><?= $as['absence']?>h</td>
  <td><?= $as['sanction']?></td>
  <td><?= $as['jour']?></td>
  <td>
   <div class="btn-group">
         <a class="btn-sm btn-primary" href="sanction.php?edit=<?=$as['id']?>"><i class=" far fa-edit"></i></a>

 <a class="btn-sm btn-danger" href="sanction.php?supprime=<?= $as['id'] ?>"><i class="fa fa-times-circle"></i></a>

                      </div>
                    </td>
</tr>

<?php } ?>

        
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
