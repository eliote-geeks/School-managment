
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
$reponsesparpages = 2;
$reponsesTotallesReq = $bdd->query("SELECT * FROM menbre");
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
$req = $bdd->query("SELECT * FROM menbre ORDER BY id DESC LIMIT ".$depart.",".$reponsesparpages);
$c = $req->rowCount();
  
if(isset($_GET['barre']) AND !empty($_GET['barre'])) {
  $barre = htmlspecialchars($_GET['barre']);
  $barre_array = explode(' ',$barre);
  $eleve = $bdd->query('SELECT * FROM menbre WHERE first LIKE "%'.$barre.'%" OR matricule LIKE "%'.$barre.'%" OR last LIKE "%'.$barre.'%" OR pseudo LIKE "%'.$barre.'%"   ORDER BY id  DESC');
}


        if (isset($_GET['confirm']) AND !empty($_GET['confirm'])) {
      $confirm = (int) $_GET['confirm'];
      $req = $bdd->prepare("UPDATE menbre SET confirm = 1 WHERE id = ?");
      $req->execute(array($confirm));
        header('Location:liste.php');
    }

    if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      echo "<script>alert('suppression reussie');</script>";
      $req = $bdd->prepare("DELETE FROM menbre WHERE id = ?");
      $req->execute(array($supprime));
      header('Location:liste.php');
    }

 ?>

<?php include_once('head.php'); ?>
<body>

  <!-- container section start -->
  <section id="container" class="">
    <!--header start--><?php include_once('aside.php'); ?>

    <!--main content start-->
    <section id="main-content">
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
				  liste des etudiants
		              </header>

                
  <div class="top-search bg-highlight-theme">
       <div class="container">
         <form class="search-form" action="" method="GET" accept-charset="utf-8">
           <div class="input-group">
             <span class="input-group-addon cursor-pointer">
               <button class="search-form_submit fas fa-search font-size18 text-white"  type="submit"></button>
             </span>
             <input type="text" class="search-form_input form-control" name="barre" autocomplete="off" placeholder="taper & appuyer entrer..">
             <a href="liste.php"> <span class="input-group-addon close-search "><i class="fas fa-times font-size18 line-height-28 margin-5px-top"></i></span></a>
           </div>
         </form>

         <?php if(isset($eleve)) {?>
 <table class="table" border="2">
<tr>
<th>MATRICULE</th>
<th>PSEUDO</th>
<th>NOMS et PRENOMS</th>
<th>DATE DE NAISSANCE</th>
<th>SESSION</th>
<th>FILIERE</th>
<th>ACTION</th>
<th></th>
<th></th>
<th></th>
</tr>
          <p>Total  (<?= $eleve->rowCount()?>) </p>
<?php while($eliu = $eleve->fetch()) {  ?>
<tr>
<td><?= $eliu['matricule']?> </td>
<td><?= $eliu['pseudo']?> </td>
<td><?= $eliu['first']." ".$eliu['last']?></td>
<td><?= $eliu['naissance']?> </td>
<td><?= $eliu['session']?> </td>
<td><?= $eliu['specialite']?> </td>
   <td>
   <div class="btn-group">
         <a class="btn-sm btn-primary" href="edition.php?edit=<?=$eliu['id']?>"><i class=" far fa-edit"></i></a>

<?php if($eliu['confirm'] == 0) {  ?><a onclick="return(confirm('voulez-vous vraiment confirmer cet etudiant?'))" class="btn-sm btn-success" href="liste.php?confirm=<?= $eliu['id'] ?>"><i class="icon_check_alt2"></i></a><?php } ?>

 <a class="modal-title btn-sm btn-info"  href="index.php?info=<?= $eliu['id'] ?>"><i class="fas fa-info-circle"></i></a>

 <a class="btn-sm btn-danger" onclick="return(confirm('voulez-vous vraiment supprimer cet etudiant attention cette action est irreversible ?'))" href="liste.php?supprime=<?= $eliu['id'] ?>"><i class="fa fa-times-circle"></i></a>

                      </div>
                    </td>
</tr>
<?php } ?>
</table>
<?php if(isset($_GET['barre']) AND ($ma = $eleve->rowCount()==0)) {  ?>
<p class="text-center alert-danger">aucun resultat .. <?= $barre?>...</p>
<?php } ?>
<?php } ?>
</div>
  </div>
  <div class="container ">
    <?php if($c == 0)
    {
      echo "<p> Aucun resultat</p>";
    }

     ?>
     <div class="conatainer">
      <table class="table container">
  <tr>
  <th>Photo</th>
  <th></th>
  <th></th>
  <th>Matricule</th>
  <th>Pseudo</th>
  <th>Nom et Prenoms</th>
  <th>sexe</th>
  <th>email</th>
  <th>filiere</th>
  <th>session</th>
  <th>date de naissance</th>
  <th>action</th>
  <th></th>
  <th></th>
</tr>
  <p>Total  (<?= $req->rowCount()?>) </p>
  <?php while($m = $req->fetch()) {  ?>

<tr>
  <div class=""><td colspan="3" width="100"><img style="width:100px;" src="profil/photo/<?= $m['photo']?>"></td></div>
  <td><?= $m['matricule']?></td>
  <td><?= $m['pseudo']?></td>
  <td><?= $m['first']." ".$m['last']?></td>
  <td><?= $m['sexe']?></td>
  <td><?= $m['email']?></td>
  <td><?= $m['specialite']?></td>
  <td><?= $m['session']?></td>
  <td><?= $m['naissance']?></td>
  <td colspan="3" width="100%" align="center">
   <div class="btn-group">
         <a class="btn-sm btn-primary" href="edition.php?edit=<?=$m['id']?>"><i class=" far fa-edit"></i></a>

<?php if($m['confirm'] == 0) {  ?><a class="btn-sm btn-success" onclick="return(confirm('voulez-vous vraiment confirmer cet etudiant?'))" href="session.php?confirm=<?= $m['id'] ?>"><i class="icon_check_alt2"></i></a><?php } ?>

 <a class="modal-title btn-sm btn-info"  href="index.php?info=<?= $m['id'] ?>"><i class="fas fa-info-circle"></i></a>

 <a onclick="return(confirm('voulez-vous vraiment supprimer cet etudiant attention cette action est irreversible?'))" class="btn-sm btn-danger" href="session.php?supprime=<?= $m['id'] ?>"><i class="fa fa-times-circle"></i></a>

                      </div>
                    </td>
</tr>

         <?php } ?>

</table>
        </div>
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
            </section>
          </div>
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
