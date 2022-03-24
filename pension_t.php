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

$reponsesparpages = 10;
$reponsesTotallesReq = $bdd->query("SELECT * FROM menbre LEFT JOIN paiement ON menbre.id = paiement.id_menbre WHERE paiement.montant > 0");
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


$req = $bdd->query("SELECT * FROM menbre LEFT JOIN matiere ON matiere.matiere = menbre.specialite ORDER BY menbre.id DESC LIMIT ".$depart.",".$reponsesparpages);

$req2 = $bdd->query("SELECT * FROM menbre LEFT JOIN paiement ON menbre.id = paiement.id_menbre WHERE paiement.montant > 0 LIMIT ".$depart.",".$reponsesparpages);

if (isset($_GET['sta'])) {
  $delete = (int) $_GET['sta'];
  $req = $bdd->prepare("UPDATE menbre SET status = 'hors ligne' WHERE id = ?");
  $req->execute(array($delete));
}

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
              <li><i class="fa fa-files-o"></i>Admis</li>
            </ol>
          </div>
        </div>

            <div class="panel-body">
              <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
              </header>
              <?php if(isset($erreur)){ ?><p style="color:red;"><?=$erreur?></p><?php } ?>
              <table class="table">
                <h1 align="center" style="font-size: 20px;">Tous les Etudiants et le montant a Payer</h1>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Noms et prenoms</th>
                    <th>Email</th>
                    <th>pseudo</th>
                    <th>Diplome</th>
                    <th>Domicile</th>
                    <th>sexe</th>
                    <th>Specialite</th>
                    <th>Session</th>
                    <th>Status</th>
                    <th>Annee Scolaire</th>
                    <th>Pension</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($n = $req->fetch()){ ?>
                    
                  <tr class="active">
                    <td><?= $n['id']?></td>
                    <td><?= $n['first']." ".$n['last']?></td>
                    <td><?= $n['email']?></td>
                    <td><?= $n['pseudo']?></td>
                    <td><?= $n['niveau']?></td>
                    <td><?= $n['lieu']?></td>
                    <td><?= $n['sexe']?></td>
                    <td><?= $n['matiere']?></td>
                    <td><?= $n['session']?></td>
                    <td><?= $n['status']?></td>
                    <td><?= $n['date_enreg']?></td>
                    <td><?= $n['scolarite']?></td>
                    <td><a href="pension_t.php?sta=<?=$n['id']?>">Deconnecte</a></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>

            </section>
          </div>
        </div>

                            <table class="table">
                              <h1 align="center" style="font-size: 20px;">Etudiants ayant deja payes une partie ou la totalite de la pension</h1>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Noms et prenoms</th>
                    <th>Email</th>
                    <th>pseudo</th>
                    <th>Diplome</th>
                    <th>Domicile</th>
                    <th>sexe</th>
                    <th>Specialite</th>
                    <th>Session</th>
                    <th>Status</th>
                    <th>Annee Scolaire</th>
                    <th>Montant</th>
                    <th>Informations de compte</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while($q = $req2->fetch()){ ?>
                    
                  <tr class="active">
                    <td><?= $q['id']?></td>
                    <td><?= $q['first']." ".$q['last']?></td>
                    <td><?= $q['email']?></td>
                    <td><?= $q['pseudo']?></td>
                    <td><?= $q['niveau']?></td>
                    <td><?= $q['lieu']?></td>
                    <td><?= $q['sexe']?></td>
                    <td><?= $q['specialite']?></td>
                    <td><?= $q['session']?></td>
                    <td><?= $q['status']?></td>
                    <td><?= $q['date_enreg']?></td>
                    <td><?= $q['montant']?></td>
                    <td><?= $q['bank_info_transaction']?></td>                    
                  </tr>
                <?php } ?>
                </tbody>
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
    echo "<a style='border:1px solid black; padding:5px; background:black; color:white; margin-left:9px;' href='pension_t.php?page=".$i."'>".$i."</a>";
  }
}
 ?>
</div>

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
  <script src="js/form-validation-script.js"></script>
  <!--custome script for all page-->
  <script src="js/scripts.js"></script>


</body>

</html>
