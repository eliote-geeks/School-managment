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
if (isset($_POST['valid'])) {
  $name = htmlspecialchars($_POST['first']);
  $name2 = htmlspecialchars($_POST['last']);
  $email = htmlspecialchars($_POST['email']);
  $ad = htmlspecialchars($_POST['addresse']);
  $matiere = htmlspecialchars($_POST['matiere']);
  $sexe = htmlspecialchars($_POST['sexe']);
  $mdp = 'CFPAM-STA-'.date('y');
  $mdp2 = 'CFPAM-STA-'.date('y');
  if (preg_match("/^[a-zA-Z ]*$/",$name) AND preg_match("/^[a-zA-Z ]*$/",$name2)) {
    if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $reqmail = $bdd->prepare("SELECT * FROM stagiaire WHERE email = ?");
      $reqmail->execute(array($email));
      if ($reqmail->rowCount()==0) {
        if ($mdp == $mdp2) {
          $pass = sha1($mdp);
          $key = "";
          $key = date('y').'STA'.str_shuffle(rand(1000,2999));
          $insert = $bdd->prepare("INSERT INTO stagiaire(matricule,first,last,email,addresse,sexe,specialite,date_debut,password) VALUES(?,?,?,?,?,?,?,NOW(),?)");
          $insert->execute(array($key,$name,$name2,$email,$ad,$sexe,$matiere,$pass));
          echo ": <script>alert('Le matricule est le ".$key."');</script>";

        }
        else{
          $erreur = "Vos mots de passe ne correspondent pas";
        }
      }
      else{
        $erreur = "Votre addresse mail existe deja";
      }

    }
    else{
      $erreur = "veuillez entrezune addresse mail valide";
    }
  }else{
    $erreur = "Votre nom ou prenom ne doit pas contenir des caracteres speciaux";
  }

}

$mati  =$bdd->query("SELECT * FROM matiere");
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

              <div class="panel-body">
                <a href="#myModal-1" data-toggle="modal" class="btn  btn-warning">
            ajouter un stagiaire
                                </a>
                

               

                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 class="modal-title">ajouter stagiaire</h4>
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
                    <label for="inputPassword1" class="col-lg-2 control-label">nom</label>
                    <div class="col-lg-10">
                      <input name="first" type="text" class="form-control" id="inputPassword1" placeholder="nom">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">prenom</label>
                    <div class="col-lg-10">
                      <input name="last" type="text" class="form-control" id="prenomm" placeholder="matricule de l'etudiant">
                    </div>
                  </div>                        


                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">mail</label>
                    <div class="col-lg-10">
                      <input name="email" type="text" class="form-control" id="inputPassword1" placeholder="mail">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">addresse</label>
                    <div class="col-lg-10">
                      <input name="addresse" type="text" class="form-control" id="inputPassword1" placeholder="addresse">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">sexe</label>
                    <div class="col-lg-10">
                      <select id="sexe" class="form-control" required="required" name="sexe">
    <option></option>
    <option>M</option>
    <option>F</option>
  </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">filiere</label>
                    <div class="col-lg-10">

       <select id="matiere" class="form-control" required="required" name="matiere">      
        <option></option>
        <?php  while ($mat = $mati->fetch()) { ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button type="submit" name="valid" class="btn btn-danger">envoyer</button>
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
        
        
        <!-- page end-->
      </section>

<table class="table">
  <tr>
    <td align="right"><a href="stage.php?id=<?=$_SESSION['id']?>" class="btn-sm btn-info">actualiser<i class="icon icon-close"></i></a></td>
  </tr>
  <tr>
    <td align="right"><a href="administration.php?id=<?=$_SESSION['id']?>" class="btn-sm btn-info">retour<i class="icon icon-close"></i></a></td>
  </tr>
</table>
<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
$req = $bdd->query("SELECT * FROM stagiaire");                                        
if (isset($_GET['confirm']) AND !empty($_GET['confirm'])) {
      $confirm = (int) $_GET['confirm'];
      $req = $bdd->prepare("UPDATE stagiaire SET confirm = 1 WHERE id = ?");
      $req->execute(array($confirm));
      echo "<p style=\"margin-left: 200px;\" class = \"container alert alert-info\">confirmation reussie</p>";
    }

    if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare("DELETE FROM stagiaire WHERE id = ?");
      $req->execute(array($supprime));
      echo "<p style=\"margin-left: 200px;\" class = \"container alert alert-danger\">suppresion reussie</p>";
    }

    if (isset($_GET['info']) AND !empty($_GET['info'])) {
      $info = (int) $_GET['info'];
      $req = $bdd->prepare("SELECT * FROM stagiaire WHERE id = ?");
      $req->execute(array($info));
      $i = $req->fetch();
      echo "<p style=\"margin-left: 200px;\"  class = \"container alert alert-info\">matricule: <font color=\"green\"><b>".$i['matricule']."</b></font></p>";
      echo "<p style=\"margin-left: 200px;\"  class = \"container alert alert-info\">filiere: <font color=\"green\"><b>".$i['specialite']."</b></font></p>";
      echo "<p style=\"margin-left: 200px;\"  class = \"container alert alert-info\">nom: <font color=\"green\"><b>".$i['first']."</b></font></p>";
      echo "<p style=\"margin-left: 200px;\"  class = \"container alert alert-info\">prenom: <font color=\"green\"><b>".$i['last']."</b></font></p>";
      
      echo "<p style=\"margin-left: 200px;\"  class = \"container alert alert-info\">date de naissance: <font color=\"green\"><b>".$i['sexe']."</b></font></p>";
      echo "<p style=\"margin-left: 200px;\"  class = \"container alert alert-info\">addresse mail: <font color=\"green\"><b>".$i['email']."</b></font></p>";
      echo "<p style=\"margin-left: 200px;\"  class = \"container alert alert-info\">lieu: <font color=\"green\"><b>".$i['heures']."</b></font></p>";
      
      echo "<p style=\"margin-left: 200px;\"  class = \"container alert alert-info\">date d'entree: <font color=\"green\"><b>".$i['date_debut']."</b></font></p>";
      echo "<p style=\"margin-left: 200px;\" class = \"container alert alert-info\"> addresse: <font color=\"green\"><b>".$i['addresse']."</b></font></p>";
    }

    if (isset($_GET['edit'])) {
      $edit = (int) $_GET['edit'];
      $req = $bdd->prepare("SELECT * FROM stagiaire WHERE id = ?");
      $req->execute(array($edit));
      
      if(isset($_POST['newmatiere']) AND !empty($_POST['newmatiere'])){
          $newmatiere = htmlspecialchars($_POST['newmatiere']);
          $editmatiere = $bdd->prepare("UPDATE stagiaire SET specialite = ? WHERE id = ?");
          $editmatiere->execute(array($newmatiere,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";      
          
    }

      if(isset($_POST['newfirst']) AND !empty($_POST['newfirst'])){
          $newfirst = htmlspecialchars($_POST['newfirst']);
          $editfirst = $bdd->prepare("UPDATE stagiaire SET first = ? WHERE id = ?");
          $editfirst->execute(array($newfirst,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
           
    }
    if(isset($_POST['newsexe']) AND !empty($_POST['newsexe'])){
          $newsexe = htmlspecialchars($_POST['newsexe']);
          $editsexe = $bdd->prepare("UPDATE stagiaire SET sexe = ? WHERE id = ?");
          $editsexe->execute(array($newsexe,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
           
    }
    if(isset($_POST['newlast']) AND !empty($_POST['newlast'])){
          $newlast = htmlspecialchars($_POST['newlast']);
          $editlast = $bdd->prepare("UPDATE stagiaire SET last = ? WHERE id = ?");
          $editlast->execute(array($newlast,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
           
    }
    if(isset($_POST['newmail']) AND !empty($_POST['newmail'])){
          $newmail = htmlspecialchars($_POST['newmail']);
          $editmail = $bdd->prepare("UPDATE stagiaire SET email = ? WHERE id = ?");
          $editmail->execute(array($newmail,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
           
    }
    if(isset($_POST['newaddresse']) AND !empty($_POST['newaddresse'])){
          $newaddresse = htmlspecialchars($_POST['newaddresse']);
          $editaddresse = $bdd->prepare("UPDATE stagiaire SET addresse = ? WHERE id = ?");
          $editaddresse->execute(array($newaddresse,$_GET['edit']));
          echo "<script>alert('edition reussie');</script>";
           

    }
    $mati = $bdd->query("SELECT * FROM matiere");
    ?>
<?php  $requ = $bdd->prepare("SELECT * FROM stagiaire WHERE id = ? ");
      $requ->execute(array($_GET['edit']));
      $m = $requ->fetch();
        ?>
        <h6 class="text-center alert-warning">edition de : <?= $m['first']?> <?= $m['last']?> </h6><p class="text-center"><b>matricule:</b> <?=$m['matricule']?></p>
      
      <div style="margin-left: 200px;" class="container">
        <form method="post" action="">
    <p >--Specialite--
       <select class="form-control" name="newmatiere" style="width: 50%;">
       <option></option>      
        <?php while ($mat = $mati->fetch()) { ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
      </select></p> 

    <p>addresse mail: </p><input style="width: 50%;" type="email" name="newmail" placeholder="addresse mail.."  class="form-control"><br>

       <p>nom: </p><input style="width: 50%;" type="name" name="newfirst" placeholder="nom.." class="form-control"><br>

       <p>prenom: </p><input style="width: 50%;" type="name" name="newlast" placeholder="prenom.." class="form-control"><br>

       <p>sexe: </p><select style="width: 50%;" class="form-control" name="newsexe"><option></option> <option>M</option><option>F</option></select><br>

         <p>addresse: </p><input style="width: 50%;" type="name" name="newaddresse" placeholder="addresse.." class="form-control"><br>
         <button name="valider" style="width: 50%;" type="submit" class="form-control btn-sm btn-info">modifier</button><br><br><hr>
         </form>
</div>
<?php 

    }
  

 ?>
 <section class="panel">
 
 <table style="margin-left: 200px; width: 20px;" class="table">
  <tr>
    <th>id</th>
    <th><b>MATRICULE</b></th>
    <th><b>NOM</b></th>
    <th><b>PRENOM</b></th>
    <th><b>FILIERE</b></th>
    <th><b>HEURES</b></th>
    <th><b>DATE DEBUT</b></th>
    <th><b>SEXE</b></th>
    <th><b>EMAIL</b></th>
    <th><b>ADDRESSE</b></th>
    <th><b>ACTION</b></th>
  </tr>
 <?php while($st = $req->fetch()) {?>
  <tr>
    <td><?=$st['id'] ?></td>
    <td><?=$st['matricule'] ?></td>
    <td><?=$st['first'] ?></td>
    <td><?=$st['last'] ?></td>
    <td><?=$st['specialite'] ?></td>
    <td><?=$st['heures'] ?></td>
    <td><?=$st['date_debut'] ?></td>
    <td><?=$st['sexe'] ?></td>
    <td><?=$st['email'] ?></td>
    <td><?=$st['addresse'] ?></td>
    <td><a class="btn-sm btn-info" href="stage.php?info=<?= $st['id'] ?>">info</a></td>
          <td><a href="stage.php?edit=<?=$st['id']?>" class="btn-sm btn-primary">editer</a></td>
          <td><a class="btn-sm btn-danger" href="stage.php?supprime=<?= $st['id'] ?>">&times</a></td>
          <td><?php if($st['confirm'] == 0) {  ?> <a class="btn-sm btn-primary" href="stage.php?confirm=<?= $st['id'] ?>">confirme</a> <?php } ?></td>
  </tr>
<?php } ?>
</table>
</div>
</section>
        <!-- page end-->
  
  
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
