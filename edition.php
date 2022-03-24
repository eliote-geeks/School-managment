<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
$adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();
$mati  =$bdd->query("SELECT * FROM matiere");
$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}
?>
<?php include_once('head.php'); ?>
<body>

  <!-- container section start -->
  <section id="container" class="">
    <!--header start-->
       <?php include_once('aside.php'); ?>
       <br><br><br><br><br>
    <!--sidebar end-->

        <?php
    if (isset($_GET['edit']) AND !empty($_GET['edit'])) {
      $edit = (int) $_GET['edit'];  
      if(isset($_POST['newmatiere']) AND !empty($_POST['newmatiere'])){
          $newmatiere = htmlspecialchars($_POST['newmatiere']);
          $editmatiere = $bdd->prepare("UPDATE menbre SET specialite = ? WHERE id = ?");
          $editmatiere->execute(array($newmatiere,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";      
    }

    if(isset($_POST['newdate']) AND !empty($_POST['newdate'])){
          $newdate = htmlspecialchars($_POST['newdate']);
          $editdate = $bdd->prepare("UPDATE menbre SET naissance= ? WHERE id = ?");
          $editdate->execute(array($newdate,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
    }
      if(isset($_POST['newfirst']) AND !empty($_POST['newfirst'])){
          $newfirst = htmlspecialchars($_POST['newfirst']);
          $editfirst = $bdd->prepare("UPDATE menbre SET first = ? WHERE id = ?");
          $editfirst->execute(array($newfirst,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
    }
    if(isset($_POST['newlast']) AND !empty($_POST['newlast'])){
          $newlast = htmlspecialchars($_POST['newlast']);
          $editlast = $bdd->prepare("UPDATE menbre SET last = ? WHERE id = ?");
          $editlast->execute(array($newlast,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
    }
    if(isset($_POST['newsexe']) AND !empty($_POST['newsexe'])){
          $newsexe = htmlspecialchars($_POST['newsexe']);
          $editsexe = $bdd->prepare("UPDATE menbre SET sexe = ? WHERE id = ?");
          $editsexe->execute(array($newsexe,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
    }
    if(isset($_POST['newsession']) AND !empty($_POST['newsession'])){
          $newsession = htmlspecialchars($_POST['newsession']);
          $editsession = $bdd->prepare("UPDATE menbre SET session = ? WHERE id = ?");
          $editsession->execute(array($newsession,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
    }

    if(isset($_POST['newmail']) AND !empty($_POST['newmail'])){
          $newmail = htmlspecialchars($_POST['newmail']);
          $editmail = $bdd->prepare("UPDATE menbre SET email = ? WHERE id = ?");
          $editmail->execute(array($newmail,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
    }
?>

<div align="center">
  <form method="post"  action="">
      
    

      <?php 
      $requ = $bdd->prepare("SELECT * FROM menbre WHERE id = ? ");
      $requ->execute(array($_GET['edit']));
      $m = $requ->fetch();
        ?>
        <h1 style="text-transform: uppercase; font-size: 22px;" class="data-original-title">edition de : <b><?= $m['first']?> <?= $m['last']?></b> matricule:<b><?=$m['matricule']?></b> </h1>
      <br><br>
    <p align="center">--Specialite--
       <select class="form-control" name="newmatiere" style="width: 50%;">
       <option></option>      
        <?php while ($mat = $mati->fetch()) { ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
      </select></p> 

       <label>date de naissance: </label><input style="width: 50%;" type="date" name="newdate" placeholder="date de naissance.." class="form-control"><br>

       <label>addresse mail: </label><input style="width: 50%;" type="email" name="newmail" placeholder="addresse mail.."  class="form-control"><br>

       <label>nom: </label><input style="width: 50%;" type="name" name="newfirst" placeholder="nom.." class="form-control"><br>

       <label>prenom: </label><input style="width: 50%;" type="name" name="newlast" placeholder="prenom.." class="form-control"><br>

       <label>sexe: </label><select style="width: 50%;" class="form-control" name="newsexe"><option></option> <option>M</option><option>F</option></select><br>
      --SESSION-- <select style="width: 50%;" class="form-control" name="newsession">
    <option value="<?php if(isset($newsession)){ echo $newsession;} ?>"></option>
    <option></span></option>
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
  </select><br>

  <button onclick="return(confirm('voulez-vous vraiment editer cet etudiant?'))" name="valider" style="width: 50%;" type="submit" class="form-control btn-sm btn-info">modifier</button><br><br><hr>
</form>
<p align="center"><a class="btn-sm btn-warning" href="index.php?id=<?=$_SESSION['id']?>">&nbsp;Retour</a></p>


<?php 
}
 ?>
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
