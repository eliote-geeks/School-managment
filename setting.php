<?php 
include_once('config.php');
include_once('head.php');
    $adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();

$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;

while($co = $c->fetch()){
  $con+=1;

}

if (isset($_REQUEST['confirm'])) {
	$id = htmlspecialchars($_REQUEST['confirm']);
	$update = $bdd->prepare("UPDATE paiement SET status_paiement = 'effectue' WHERE id = ?");
	$update->execute(array($id));
	header('Location:setting.php');
}

    $adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();

$reponsesparpages = 3;
$reponsesTotallesReq = $bdd->query("SELECT * FROM paiement");
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

	$req = $bdd->prepare("SELECT * FROM paiement WHERE status_paiement = ? LIMIT ".$depart.",".$reponsesparpages);
	$req->execute(array('en cours'));

	$req2 = $bdd->prepare("SELECT * FROM paiement WHERE status_paiement = ? LIMIT ".$depart.",".$reponsesparpages);
	$req2->execute(array('effectue'));

 ?>

 


   <section id="container" class="">
    <!--header start-->
     <?php include_once('aside.php'); ?>

    <!--main content start-->
    <section id="main-content"> 
            <br><br><br>
          <div class="col-lg-12">

              <div class="panel-body">
<!--                 <a class="btn btn-success" data-toggle="modal" href="#myModal">
                                  Dialog
                              </a> -->

                  <table class="table" >
                  	<tr>
                  		<th>Noms</th>
                  		<th>Email</th>
                  		<th>Infornations bancaires</th>
                  		<th>Status</th>
                  		<th>montant</th>
                  		<th>Date de Paiement</th>
                  		<th>action</th>
                  	</tr>
                  	<?php  while($nc = $req->fetch()){ 
                  			

                  		?>
                  	<tr>
                  		<td <?php if($nc['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=$nc['menbre_nom'] ?></td>
                  		<td <?php if($nc['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=$nc['menbre_mail'] ?></td>
                  		<td <?php if($nc['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=htmlspecialchars($nc['bank_info_transaction'])?></td>
                  		<td <?php if($nc['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=htmlspecialchars($nc['status_paiement'])?></td>
                  		<td <?php if($nc['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=htmlspecialchars($nc['montant'].' fcfa')?></td>
                  		<td <?php if($nc['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=htmlspecialchars($nc['date_paiement'])?></td>
                  		<td <?php if($nc['status_paiement'] == 'en cours') { ?> class="alert alert-danger " <?php } ?>> <a class="btn btn-warning" data-toggle="modal" href="setting.php?confirm=<?=$nc['id']?>">Confirmer</a></td>
                  	<?php } ?>
                  	</tr>
                  </table>            



                                    <table class="table" >
                  	<tr>
                  		<th>Noms</th>
                  		<th>Email</th>
                  		<th>Infornations bancaires</th>
                  		<th>Status</th>
                  		<th>montant</th>
                  		<th>action</th>
                  	</tr>
                  	<?php  while($n = $req2->fetch()){?>
                  	<tr>
                  		<td <?php if($n['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=$n['menbre_nom'] ?></td>
                  		<td <?php if($n['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=$n['menbre_mail'] ?></td>
                  		<td <?php if($n['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=htmlspecialchars($n['bank_info_transaction'])?></td>
                  		<td <?php if($n['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=htmlspecialchars($n['status_paiement'])?></td>
                  		<td <?php if($n['status_paiement'] == 'en cours') { ?> class="alert alert-danger" <?php } ?>> <?=htmlspecialchars($n['montant'])?></td>                  	
                  	<?php } ?>
                  	</tr>
                  </table>            
                                           <div align="center" style="margin-left:450px;">
  <?php 
for ($i=1; $i < $pagesTotales ; $i++) { 
  if($i == $pageCourante){
    echo " page ".$i."  ";
  }
  else{
    echo "<a style='border:1px solid black; padding:5px; background:black; color:white; margin-left:9px;' href='setting.php?page=".$i."'>".$i."</a>";
  }
}
 ?>
</div>
                <div  class="modal fade" id="<?= $_GET['id']?>myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Confirmation paiement</h4>
                      </div>
                      <div class="modal-body">Attention vous allez confirmer un paiement</div>
                      <div class="modal-footer">
                      	<form method="post" action="">
                        <input type="hidden" name="id">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                        <button class="btn btn-warning" name="confirm"  type="submit"> Confirmer</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- modal -->
                <!-- Modal -->
                <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal Tittle</h4>
                      </div>
                      <div class="modal-body">

                        Body goes here...

                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-danger" type="button"> Ok</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- modal -->

              </div>
            </section>
            <!--modal start-->

              </div>
            <!--modal start-->

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