<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
$adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();

echo "<br>";

if (isset($_GET['info']) AND !empty($_GET['info'])) {
      $info = (int) $_GET['info'];  
      $mo = $bdd->prepare("SELECT * FROM matiere WHERE id = ?");
          $mo->execute(array($_GET['info']));
          $ou = $mo->fetch();
          echo "<div class=\"container\">";
          echo "<p class=\" alert-info\"> FILIERE: ".$ou['matiere']."</p>";
           echo "<p class=\" alert-info\"> SCOLARITE: ".$ou['scolarite']."</p>";
          echo "</div>";
        }

if (isset($_GET['edit']) AND !empty($_GET['edit'])) {
      $edit = (int) $_GET['edit'];  
      $mo = $bdd->prepare("SELECT * FROM matiere WHERE id = ?");
          $mo->execute(array($_GET['edit']));
          $ou = $mo->fetch();
          
            echo "
    <section class=\"panel\">
              <header class=\"panel-heading\">
                decision
              </header>
              <div class=\"panel-body\">
                <div class=\"alert alert-warning fade in\">
                  <button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">
                                      <i class=\"icon-remove\"></i>
                                  </button>
                  <strong>edition de ".$ou['matiere']."</strong> 
                </div>

              </div>
            </section>";
?>
  <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
        EDITER une matiere
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
                    <label for="inputPassword1" class="col-lg-2 control-label">nom de la matiere</label>
                    <div class="col-lg-10">
                      <input name="newmatiere" value="<?= $ou['matiere']?>" type="text" class="form-control" id="inputPassword1" placeholder="matricule de l'etudiant">
                    </div>
                  </div>                  

                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Scolarite</label>
                    <div class="col-lg-10">
                      <input type="number" name="scolarite" value="<?= $ou['scolarite']?>" class="form-control" id="inputPassword1" placeholder="scolarite" >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button onclick="return(confirm('voulez-vous vraiment editer cette specialite?'))" type="submit" class="btn btn-danger" name="val">envoyer</button>
                    </div>
                  </div>
                </form>
              </div>
            </section>
          </div>
        </div>
        
<?php 
if (isset($_POST['val'])) {
if(isset($_POST['newmatiere']) AND !empty($_POST['newmatiere']) AND !empty($_POST['scolarite']) ){
          $newmatiere = htmlspecialchars($_POST['newmatiere']);
          $scolarite = htmlspecialchars($_POST['scolarite']);

          $ex = $bdd->prepare("SELECT * FROM matiere WHERE matiere = ?");
          $ex->execute(array($newmatiere));

          if(($ex->rowCount() == 0)){
          $editmatiere = $bdd->prepare("UPDATE menbre SET specialite = ? WHERE specialite = ?");
          $editmatiere->execute(array($newmatiere,$ou['matiere']));

          $editmaiere = $bdd->prepare("UPDATE enseignant SET filiere = ? WHERE filiere = ?");
          $editmaiere->execute(array($newmatiere,$ou['matiere']));

          $sts = $bdd->prepare("UPDATE stagiaire SET specialite = ? WHERE specialite = ?");
          $sts->execute(array($newmatiere,$ou['matiere']));


           $ediiere = $bdd->prepare("UPDATE note SET specialite = ? WHERE id = ?");
          $ediiere->execute(array($newmatiere,$_GET['edit']));


           $ediiere = $bdd->prepare("UPDATE pension SET filiere = ? WHERE id = ?");
          $ediiere->execute(array($newmatiere,$_GET['edit']));


           $ediiere = $bdd->prepare("UPDATE module SET specialite = ? WHERE id = ?");
          $ediiere->execute(array($newmatiere,$_GET['edit']));

          $b = $bdd->prepare("SELECT * FROM menbre WHERE specialite = ?");
          $b->execute(array($newmatiere));      

          $ediiere = $bdd->prepare("UPDATE matiere SET matiere = ? WHERE id = ?");
          $ediiere->execute(array($newmatiere,$_GET['edit']));

          $diiere = $bdd->prepare("UPDATE module SET specialite = ? WHERE id = ?");
          $diiere->execute(array($newmatiere,$_GET['edit']));
         
           $ediiere = $bdd->prepare("UPDATE matiere SET scolarite = ? WHERE id = ?");
            $ediiere->execute(array($scolarite,$_GET['edit']));
           
            echo "
    <section class=\"panel\">
              <header class=\"panel-heading\">
                decision
              </header>
              <div class=\"panel-body\">
                <div class=\"alert alert-warning fade in\">
                  <button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">
                                      <i class=\"icon-remove\"></i>
                                  </button>
                  <strong>matiere modifiee</strong> 
                </div>

              </div>
            </section>";
          }
          else{
      $erreur = "Oups cette specialite existe deja";
    }
          
    }
else{
  $erreur = "Tous les champs doivent etre rempli";
}
}

}

if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare("DELETE FROM matiere WHERE id = ?");
      $req->execute(array($supprime));
      echo "
    <section class=\"panel\">
              <header class=\"panel-heading\">
                Alerts
              </header>
              <div class=\"panel-body\">
                <div class=\"alert alert-danger fade in\">
                  <button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">
                                      <i class=\"icon-remove\"></i>
                                  </button>
                  <strong>matiere supprimee</strong> 
                </div>

              </div>
            </section>";
    }


if (isset($_POST['valid'])) {
  $matiere = htmlspecialchars($_POST['matiere']);
  $scolarite = htmlspecialchars($_POST['scolarite']);
  if(isset($_POST['matiere']) AND !empty($_POST['matiere'])){
    $req = $bdd->prepare("SELECT * FROM matiere WHERE matiere = ?");
    $req->execute(array($matiere));
    $exist = $req->rowCount();
    if($exist == 0){
      $insert = $bdd->prepare("INSERT INTO matiere(matiere,scolarite) VALUES(?,?)");
      $insert->execute(array($matiere,$scolarite));
      echo "
    <section class=\"panel\">
              <header class=\"panel-heading\">
                Alerts
              </header>
              <div class=\"panel-body\">
                <div class=\"alert alert-success fade in\">
                  <button data-dismiss=\"alert\" class=\"close close-sm\" type=\"button\">
                                      <i class=\"icon-remove\"></i>
                                  </button>
                  <strong>nouvelle matiere ajoutee</strong> 
                </div>

              </div>
            </section>";
    }
    else{
      echo "<script>alert('oups cette filiere existe deja');</script>";
    }
  }
  else{
    echo "<script>alert('tous les champs doivent etre rempli');</script>";
  }
}
    $mati = $bdd->query("SELECT * FROM matiere");

 ?>



<?php include_once('head.php'); ?>
 <body style="background: #eee;"><br><br><br>
  <section class="main-content">

  <div align="right" class="container ">
   
      <a href="index.php?id=<?$_SESSION['id']?>" class="btn-sm btn-info">retour</a><br><br>
      <a class="btn-sm btn-warning" href="filiere.php">&nbsp;actualiser</a>

       <section id="main-content">
            <br><br><br>
            
        <!-- Basic Forms & Horizontal Forms-->

        
        
        
        <!-- page end-->
      </section>
    </section>
  </section>
<h6 class="container" style="color:black; border:2px solid black; padding: 30px; width: 300px; text-align: center;">LISTE MATIERE</h6><br>
  <table class="table" border="2">

    <tr>
      <th>Id</th>
      <th>MATIERES</th>
      <th>SCOLARITE</th>
      <th>ACTIONS</th>
    </tr>
    <?php while ($ma = $mati->fetch()) {?>
    <tr>
      <td><?=$ma['id']?></td>
    <td><?=$ma['matiere']?></td>
    <td><?=$ma['scolarite']?></td>
    <td><a onclick="return(confirm('voulez-vous vraiment supprimer cette specialite ? attention cette action est irreversible'))" href="filiere.php?supprime=<?=$ma['id']?>" class="btn btn-danger" style="cursor: pointer;">&times</a></td>
    <td><a href="filiere.php?edit=<?=$ma['id']?>" onclick="return(confirm('voulez-vous vraiment modifier cette specialite?'))" class="btn btn-success" style="cursor: pointer;">modifier</a></td>
    </tr>
            
    <?php }?>
  </table>

  </div>
 </div>
 </section>
 </body>
 </html>