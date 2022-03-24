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
$cycle = $bdd->query("SELECT * FROM cycle");
if (isset($_POST['valid'])) {
  if (isset($_POST['cycle'],$_POST['duree']) AND !empty($_POST['cycle']) AND !empty($_POST['duree'])) {
    $cycle = htmlspecialchars($_POST['cycle']);
    $duree = htmlspecialchars($_POST['duree']);
    $req = $bdd->prepare("SELECT * FROM cycle WHERE nom = ?");
    $req->execute(array($cycle));
    if ($req->rowCount() == 0) {
      if (strlen($cycle <= 12) AND ($duree > 0) AND ($duree < 10)) {
        $ins = $bdd->prepare("INSERT INTO cycle(nom,duree,date_en) VALUES(?,?,NOW())");
        $ins->execute(array($cycle,$duree));
        $reussie = "ajout reussie consulter la liste de cycle";
      }
      else{
        $erreur = "Oups une erreur empeche l'envoi du formulaire verifier vos champs";
      }
    }
    else{
      $erreur = "Oups ce cycle existe deja";
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

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
        ajouter un cycle
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
                                  <?php if(isset($reussie)){?>
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label"></label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control alert-primary" value="<?= $reussie?>" id="inputPassword1">
                    </div>
                  </div>                  
                <?php }?>
<!--                   <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Cycle</label>
                    <div class="col-lg-10">
                      <select name="cycle" type="text" class="form-control" id="inputPassword1">
                        <option></option>
                        <?php while($c = $cycle->fetch()){ ?>
                          <option value="<?=$c['nom']?>"><?=$c['nom']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div> -->                                 
                  
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">nom du cycle</label>
                    <div class="col-lg-10">
                      <input name="cycle" type="text" class="form-control" id="inputPassword1" placeholder="bts ..">
                    </div>
                  </div>   


                  
                  <div class="form-group">
                    <label for="inputPassword1" class="col-lg-2 control-label">Duree</label>
                    <div class="col-lg-10">
                      <input type="number" name="duree" class="form-control" id="inputPassword1" placeholder="exemple 1 a 2 ans" >
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button onclick="return(confirm('voulez-vous vraiment ajouter un nouveau cycle?'))" type="submit" class="btn btn-danger" name="valid">envoyer</button>
                    </div>
                  </div>
                </form>
              </div>
            </section>
            

              
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

