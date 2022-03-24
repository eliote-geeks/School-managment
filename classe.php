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

if($final == 1){
$mati = $bdd->prepare("SELECT * FROM matiere WHERE cycle = ?");
$mati->execute(array($cycle_fetch['nom']));
}
$cycle = $bdd->query("SELECT * FROM cycle ORDER BY id DESC");

if(isset($_POST['valid'])){ 
  if(isset($_POST['session'],$_POST['matiere'],$_POST['annee']) AND !empty($_POST['session']) AND !empty($_POST['session']) AND !empty($_POST['session'])){ 
  $session = htmlspecialchars($_POST['session']);
  $matiere = htmlspecialchars($_POST['matiere']);
  $annee = htmlspecialchars($_POST['annee']);
  $eleve = $bdd->prepare("SELECT * FROM menbre WHERE session = ? AND  specialite = ? AND date_enreg LIKE '%".$annee."%'  ORDER BY id DESC");
  $eleve->execute(array($session,$matiere));
  $exist = $eleve->rowCount();
  }
}

 if (isset($_GET['confirm']) AND !empty($_GET['confirm'])) {
      $confirm = (int) $_GET['confirm'];
      $req = $bdd->prepare("UPDATE menbre SET confirm = 1 WHERE id = ?");
      $req->execute(array($confirm));
        echo "<script>alert('confirmation reussie');</script>";
    }

    if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      echo "<script>alert('suppression reussie');</script>";
      $req = $bdd->prepare("DELETE FROM menbre WHERE id = ?");
      $req->execute(array($supprime));
      echo "<script>alert('suppression reussie');</script>";
    }


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
				classes
		              </header>
              <div class="panel-body">
                <div class="container">
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
                <?php if($final == 1){ ?>
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
          <label>annee:</label>
          <input type="annee" name="annee" placeholder="annee" class="form-control">
        </div>

        
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" class="btn btn-danger" name="valid">envoyer</button>
                    </div>
                  </div>
        <div class="link">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Je souhaite revenir <a href="index.php?id=<?=$_SESSION['id']?>" class="btn-sm btn-primary">&nbsp;Retour</a></span></div>          
                </form>
              <?php } ?>
                </div>
              </div>
            </section>
          </div>
        </div>
        <?php if(isset($eleve)) { ?>
<div class="container">
  <table class="table" border="2">
    
      <th>specialite</th>
      <th>session</th>
      <th>annee</th>
      <tr>
        <td><?= $matiere?></td>
        <td><?= $session?></td>
        <td><?= $annee?></td>
      </tr>
    </table>
  <div class="row">
    <table class="table" border="2">
      <th>matricule</th>
      <th>nom</th>
      <th>prenom</th>
      <th>age</th>
      <th>date de naissance</th>
      <th>date d'inscription</th>
      <th>action</th>
      <?php while($eli = $eleve->fetch()) { ?>
      <tr>
        <td><?= $eli['matricule']?></td>
        <td><?= $eli['first']?></td>
        <td><?= $eli['last']?></td>
        <td><?= $eli['age']?></td>
        <td><?= $eli['naissance']?></td>
        <td><?= $eli['date_enreg']?></td>
<td>
   <div class="btn-group">
         <a class="btn-sm btn-primary" href="edition.php?edit=<?=$eli['id']?>"><i class=" far fa-edit"></i></a>

<?php if($eli['confirm'] == 0) {  ?><a onclick="return(confirm('voulez-vous vraiment confirmer cet etudiant? attention cette action est irreversible'))" class="btn-sm btn-success" href="classe.php?confirm=<?= $eli['id'] ?>"><i class="icon_check_alt2"></i></a><?php } ?>

 <a class="modal-title btn-sm btn-info"  href="index.php?info=<?= $eli['id'] ?>"><i class="fas fa-info-circle"></i></a>

 <a onclick="return(confirm('voulez-vous vraiment supprimer cet etudiant ?attention cette action est irreversible'))" class="btn-sm btn-danger" href="classe.php?supprime=<?= $eli['id'] ?>"><i class="fa fa-times-circle"></i> </a>

                      </div>
                    </td> 
          
      </tr>
      <?php } ?>
    </table>
   
    <?php if($exist == 0){  ?>
        <p class="text-center alert-sm alert-danger">aucun resultat</p>
        <?php } ?>
  </div>
</div>
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
