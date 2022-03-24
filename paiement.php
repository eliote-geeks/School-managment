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

if (isset($_POST['valid'])) {
  if (isset($_POST['mat'],$_POST['pseu'],$_POST['pension']) AND !empty($_POST['mat']) AND !empty($_POST['pseu']) AND !empty($_POST['pension']) AND !empty($_POST['tranche'])) {
    $pseu = htmlspecialchars($_POST['pseu']);
     $mat = htmlspecialchars($_POST['mat']);
     $pension = intval(htmlspecialchars($_POST['pension']));
     $tranche = htmlspecialchars($_POST['tranche']);
     $menbre = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ? AND matricule = ?");
     $menbre->execute(array($pseu,$mat));
     if ($menbre->rowCount() > 0) {
                $id = $menbre->fetch();

                $req = $bdd->prepare("SELECT * FROM matiere LEFT JOIN menbre ON menbre.specialite = matiere.matiere WHERE menbre.pseudo = ? AND menbre.matricule = ?");
                $req->execute(array($pseu,$mat));
                $scolarite = $req->fetch();

                $select = $bdd->prepare("SELECT * FROM paiement LEFT JOIN menbre ON menbre.id = paiement.id_menbre WHERE menbre.pseudo = ?");
                $select->execute(array($pseu));

                $y_t = $bdd->prepare("SELECT * FROM paiement WHERE id_menbre = ?");            
                $y_t->execute(array($id['id']));

                $a = 0;
                while ($i = $y_t->fetch()) {
                  $a += $i['montant'];
                }                
                $pe = $scolarite['scolarite'] - $a ;

                // var_dump($pe); //reste
                // var_dump($scolarite['scolarite']); //scolarite total
                // var_dump($pension); //pension
                // var_dump($a);//pension presente de l'eleve avant la pension

                echo "<h1 align='center' class='alert alert-info'> Reste net a payer pour cet etudiant!!!!: ".$pe.' fcfa</h1>';
        if (($scolarite['scolarite'] >= $a) AND ($pension > 0) AND ($pension <= $scolarite['scolarite']) AND ($pe > 0)) {  
          if ($req->rowCount() > 0) {          
            if ($select->rowCount() == 0) {

           ?>
            <div class="row">     
              <div class="col-lg-12">
                <section class="panel">
                  <header class="panel-heading">
                    Informations du client          
                  </header>
                  <div class="panel-body">
                    <div class="form">
                      <form action="payment/bank/init.php" class="form-horizontal" method="post" >
                        <?php 
                        $info = $bdd->query("SELECT * FROM settings");
                        $informations = $info->fetch();            
                         ?>
                        <textarea class="form-control " name="editor1" rows="6" readonly><?= $informations['bank_details']; ?></textarea>
                        <div class="form-group">
                          <label class="control-label col-sm-2">Entrez les informations du client</label>
                          <div class="col-sm-10">
                            <input type="hidden" name="id" value="<?= $scolarite['id']?>">
                            <input type="hidden" name="nom" value="<?= $scolarite['first'].' '.$scolarite['last']?>">
                            <input type="hidden" name="email" value="<?= $scolarite['email']?>">
                            <input type="hidden" name="montant" value="<?= $pension?>">
                            <textarea class="form-control ckeditor" name="editor1" rows="6"></textarea>
                        <button class="btn-info" >Depot bancaire</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
              </div>
            </div>            
            <?php      
            }
            else{
              $montant_actuelle_base = $bdd->prepare("SELECT * FROM paiement WHERE id_menbre = ?");
              $montant_actuelle_base->execute(array($scolarite['id']));
              $montant_actuelle = $montant_actuelle_base->fetch();
              $montant_ajoute = 0;
              $montant_ajoute = $pension;
              
      ?>
      <div class="row">     
              <div class="col-lg-12">
                <section class="panel">
                  <header class="panel-heading">
                    Informations du client
                  </header>
                  <div class="panel-body">
                    <div class="form">
                      <form action="payment/bank/init.php" class="form-horizontal" method="post" >
                        <?php 
                        $info = $bdd->query("SELECT * FROM settings");
                        $informations = $info->fetch();
                         ?>
                        <textarea class="form-control " name="editor1" rows="6" readonly><?= $informations['bank_details']; ?></textarea>
                        <div class="form-group">
                          <label class="control-label col-sm-2">Entrez les informations du client</label>
                          <div class="col-sm-10">
                            <input type="hidden" name="id" value="<?= $scolarite['id']?>">
                            <input type="hidden" name="nom" value="<?= $scolarite['first'].' '.$scolarite['last']?>">
                            <input type="hidden" name="email" value="<?= $scolarite['email']?>">
                            <input type="hidden" name="montant" value="<?= $montant_ajoute?>">
                            <textarea class="form-control " name="editor1" rows="6"></textarea>
                        <button class="btn-info" >depot bancaire</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
              </div>
            </div>
       <?php
            }         
        }
        else{
          die('erreur : oups une erreur innatendue est survenue');
        }
     }
        else{
    $erreur = "Verifier le montant et reesayer";
   }
   }
     else{
      $erreur = "Ce menbre n'existe pas dans notre centre";
     }


      }
      else{
        $erreur = "Tous les champs doivent etre rempli";
      }
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
            
        <!-- Basic Forms & Horizontal Forms-->

<!--         <?php 
        $nom[] = $_SESSION['id'];
        $nom[] = $_SESSION['user_last'];
        $nom[] = $_SESSION['user_name'];
        foreach ($_SESSION as $key => $l ) {
          var_dump($_SESSION['id']);
        }

        ?> -->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
        pension de l'etudiant
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
                    <label for="inputPassword1" class="col-lg-2 control-label">Tranche de paiement</label>
                    <div class="col-lg-10">
                      <select class="form-control" name="tranche">
                        <option></option>
                        <option>TRANCHE 1</option>
                        <option>TRANCHE 2</option>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label">Pension</label>
                    <div class="col-lg-10">
                      <input type="number" placeholder="pension" class="form-control" name="pension"></input>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button onclick="return(confirm('voulez-vous vraiment payer la pension de cet etudiant? attention cette action est irreversible'))" type="submit" class="btn btn-danger" name="valid">depot bancaire</button>
                    </div>
                  </div>
                </form>
              </div>
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
