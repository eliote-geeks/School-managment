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


if (isset($_POST['a'])) {
    if (isset($_POST['apropos']) AND !empty($_POST['apropos'])) {
    $apropos = $_POST['apropos'];
    $ins = $bdd->prepare("UPDATE settings SET apropos = ? WHERE id = 1");
    $ins->execute(array($apropos));
    $reussie = "Page apropos postee avec success";
    }
    else{
        $erreur = "Tous les champs doivent etre rempli ";
    }
}

if (isset($_POST['p'])) {
    if (isset($_POST['politique']) AND !empty($_POST['politique'])) {
    $politique = $_POST['politique'];
    $ins = $bdd->prepare("UPDATE settings SET politique = ? WHERE id = 1");
    $ins->execute(array($politique));        
    $reussie = "Page politique de confidentialite postee avec success";
    }
    else{
        $erreur = "Tous les champs doivent etre rempli ";
    }
}



$req = $bdd->query("SELECT * FROM settings");


include_once('head.php');

 ?>
 <body>
 	

   <section id="container" class="">
    <!--header start-->
     <?php include_once('aside.php'); ?>

    <!--main content start-->
    <section id="main-content"> 
                 <div class="row">
              <!-- Bootsrep Editor -->
              <div class="col-lg-12">
                <section class="panel">
<!--                   <header class="panel-heading">
                    Bootsrep Editor
                  </header>
                  <div class="panel-body">
                    <div id="editor" class="btn-toolbar" data-role="editor-toolbar" data-target="#editor"></div>
                  </div> -->
                </section>
              </div>
              <!-- CKEditor --><br><br>
              <h1 align="center">PAge >> <?php if(isset($erreur)){ ?><a style="color:red;"> <?=$erreur?><?php } ?> <?php if(isset($reussie)){ ?><abbr><?= $reussie?></abbr> <?php } ?></a></h1>
              <div class="col-lg-12">
                <section class="panel">
                  <header class="panel-heading">
                   Page  'A propos'
                  </header>
                  <div class="panel-body">
                    <div class="form">
                      <form action="#" class="form-horizontal" method="post">
                        <div class="form-group">
                          <label class="control-label col-sm-2">a propos de nous</label>
                          <div class="col-sm-10">
                            <textarea  class="form-control ckeditor" name="apropos" rows="13"></textarea>
                          </div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-info" name="a">envoyer</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>


                  <header class="panel-heading">
                   Page  'Politique et confidentialite'
                  </header>
                  <div class="panel-body">
                    <div class="form">
                      <form action="#" class="form-horizontal" method="post">
                        <div class="form-group">
                          <label class="control-label col-sm-2">reglement</label>
                          <div class="col-sm-10">
                            <textarea  class="form-control ckeditor" name="politique" rows="13"></textarea>
                          </div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-info" name="p">envoyer</button>
                          </div>                          
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
              </div>
            </div>
          </div>
        </div>
        <!-- page end-->
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
