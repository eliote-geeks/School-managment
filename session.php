<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
$adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();
$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}
if(isset($_POST['valid'])){
  if(isset($_POST['session'],$_POST['annee'],$_POST['cycle']) AND !empty($_POST['session']) AND !empty($_POST['annee']) AND !empty($_POST['cycle'])){
    $session = htmlspecialchars($_POST['session']);
    $annee = htmlspecialchars($_POST['annee']);
    $cycle = htmlspecialchars($_POST['cycle']);
    $req = $bdd->prepare('SELECT * FROM menbre RIGHT JOIN cycle ON cycle.nom = menbre.cycle  WHERE menbre.session  = ? AND cycle.nom = ? AND menbre.date_enreg LIKE "%'.$annee.'%"');
    $req->execute(array($session,$cycle));
    $n = $req->rowCount();
  }else{
    echo  "<font color=\"red\">tous les champs doivent etre rempli</font>";
  }
}
$cycle  = $bdd->query("SELECT * FROM cycle ORDER BY id DESC");
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

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
				  liste par session
		              </header>
              <div class="panel-body">
                <a class="btn-sm btn-warning" href="index.php?id=<?=$_SESSION['id']?>">&nbsp;Retour</a>

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                session
              </header>
              <div class="panel-body">
                <form class="form-inline" role="form" method="post">

                  <div class="form-group">
                    <select  required="required" class="form-control" name="cycle">
                    <label class="sr-only" for="exampleInputPassword2"></label>
    <option>Selectionner un cycle</option>    
<?php while($c = $cycle->fetch()){ ?>
  <option><?= $c['nom']?></option>
<?php } ?>
  </select>
                  </div>

                  <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword2">session</label>
                    <select  required="required" class="form-control" name="session">
    <option>Selectionner une session</option>    
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
    <option>NOVEMBRE</span></option>
    <option>DECEMBRE</span></option>
  </select>
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2">annee</label>
                    <input type="annee" class="form-control" name="annee" id="exampleInputEmail2" placeholder="entrez une annee">
                  </div>
                  
                  <button type="submit" class="btn btn-primary" name="valid">Valider</button>
                </form>

              </div>
            </section>

          </div>
        </div>

  
  <table class="table" >
    <tr><?php if(isset($m)){ ?> <label><?= $m['session']?></label> <?php } ?>
      <th>matricule</th>
      <th>nom</th>
      <th>prenom</th>
      <th>date de naissance</th>
      <th>age</th>
      <th>specialite</th>     
      <th>action</th>
    </tr>

<?php if(isset($_POST['valid'])){ ?>
<?php if(@$n == 0)
{
  echo "aucun resultat";
}
 ?>
 <?php if(isset($req)){ ?>
    <?php while($m = $req->fetch()) { ?>
    <tr>
      <td><?= $m['matricule']?></td>
      <td><?= $m['first']?></td>
      <td><?= $m['last']?></td>
      <td><?= $m['naissance']?></td>
       <td><?= $m['age']?></td>
      <td><?= $m['specialite']?></td>
 <td>
   <div class="btn-group">
         <a class="btn-sm btn-primary" href="edition.php?edit=<?=$m['id']?>"><i class=" far fa-edit"></i></a>

<?php if($m['confirm'] == 0) {  ?><a class="btn-sm btn-success" onclick="return(confirm('voulez-vous vraiment confirmer cet etudiant?'))" href="index.php?confirm=<?= $m['id'] ?>"><i class="icon_check_alt2"></i></a><?php } ?>

 <a class="modal-title btn-sm btn-info"  href="index.php?info=<?= $m['id'] ?>"><i class="fas fa-info-circle"></i></a>

 <a class="btn-sm btn-danger" onclick="return(confirm('voulez-vous vraiment supprimer cet etudiant ? attention cette action est irreversible'))" href="index.php?supprime=<?= $m['id'] ?>"><i class="fa fa-times-circle"></i></a>
    </div>
  </td> 
       <?php } ?>

      </tr>
    <?php } ?>
  </table>
  <?php } ?>
              </div>           
            </section>
          </div>
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
