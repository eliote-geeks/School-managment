<?php include_once('head.php'); ?>
<?php 
include_once('config.php');

  if(isset($_SESSION['id']) AND $_SESSION['user_admin'] == 1){    
    $adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();
    
    if (isset($_POST['notif'])) {
      if (isset($_POST['categorie'],$_POST['contenu'],$_POST['titre'])  AND !empty($_POST['categorie']) AND !empty($_POST['titre']) AND !empty($_POST['contenu'])) {
        $categorie = htmlspecialchars($_POST['categorie']);
        $contenu = htmlspecialchars($_POST['contenu']);
        $titre = htmlspecialchars($_POST['titre']);
        if ($categorie == 'General') {
          $insert_notif = $bdd->prepare("INSERT INTO notification(titre,categorie,message,date_note) VALUES(?,?,?,NOW())");
          $insert_notif->execute(array($titre,$categorie,$contenu));

          $insert_noti = $bdd->prepare("INSERT INTO notif_en(titre,categorie,message,date_note) VALUES(?,?,?,NOW())");
          $insert_noti->execute(array($titre,$categorie,$contenu));
          $reussie = "annonce generale postee";
        }
        elseif(($categorie == 'Etudiant') OR ($categorie == 'Fun')){
          $insert_notif = $bdd->prepare("INSERT INTO notification(titre,categorie,message,date_note) VALUES(?,?,?,NOW())");
          $insert_notif->execute(array($titre,$categorie,$contenu));
          $reussie = "annonce etudiant postee";

        }
        elseif($categorie == 'Enseignant'){
          $insert_noti = $bdd->prepare("INSERT INTO notif_en(titre,categorie,message,date_note) VALUES(?,?,?,NOW())");
          $insert_noti->execute(array($titre,$categorie,$contenu));
          $reussie = "annonce enseignant postee"; 
      }
        elseif($categorie == 'Tag'){
          $tag = htmlspecialchars($_POST['tag']);
    function mention($matches){
        global $bdd;
        global $titre;
        global $contenu;
        $eg = $bdd->prepare("SELECT * FROM menbre WHERE first = ? OR pseudo = ?"); 
        $eg->execute(array($matches[1],$matches[1]));
        if ($eg->rowCount() > 0) {
          $idutilisateur = $eg->fetch()['first'];
          $insert_noti = $bdd->prepare("INSERT INTO notification(titre,message,tag,date_note) VALUES(?,?,?,NOW())");
          $insert_noti->execute(array($titre,$contenu,$idutilisateur));
          return '<a href="index.php">'.$idutilisateur.' est l"etudiant que vous avez tague</a>';
        }
          return 'le tag n"a pas fonctionne'.$matches[0];
      }

      $top =  preg_replace_callback('#@([A-Za-z0-9]+)#', 'mention', $tag);
      echo $top;
          $reussie = "tag reussie"; 
      }
      else{
        die('erreur:arret volontaire du programme');
        exit();
      }
    }


    }

    if (isset($_POST['envoi_message'])) {
      $message = htmlspecialchars($_POST['message']);
      $outgoing_id = htmlspecialchars($_POST['outgoing_id']);

      if (isset($_POST['message']) AND !empty($_POST['message']) AND !empty($_POST['outgoing_id'])) {
        $in = $bdd->prepare("INSERT INTO message(first,outcoming_id,message,grade,temps) VALUES(?,?,?,?,NOW())");
        $in->execute(array($admin['user_name']." ".$admin['user_last'],$outgoing_id,$message,$admin['grade']));
      }
    }
    if (isset($admin['id'])) {
      $mes  = $bdd->query("SELECT * FROM message");
    }


$mati  =$bdd->query("SELECT * FROM matiere");
$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}
$moine = $bdd->query("SELECT * FROM module");
$mo = 0;
while ($mooi = $moine->fetch()) {
  $mo+=1;
}


if (isset($_GET['tout'])) {
  $tout = (int) $_GET['tout'];
  $toutdel = $bdd->query("TRUNCATE message");
  header('Location:index.php?id='.$_SESSION['id']);
}



    $udget = $bdd->query("SELECT * FROM paiement");
    $budget = 0;
    while($dget = $udget->fetch()){
      $budget  += $dget['montant']; 
    }

    $total = $bdd->query("SELECT * FROM menbre");
    $nombre = 0;
    $nombreclasse = 0;
    while($t = $total->fetch()){
      $nombre+=1;
    }

    while($nclasses = $mati->fetch()){
      $nombreclasse +=1;
    }


    if (isset($_GET['trash'])) {
      $trash = (int) $_GET['trash'];
      $delmsg = $bdd->prepare("DELETE FROM messages WHERE id = ?");
      $delmsg->execute(array($trash));
      header('Location:index.php?id='.$_SESSION['id']);
    }

        if (isset($_GET['confirm']) AND !empty($_GET['confirm'])) {
      $confirm = (int) $_GET['confirm'];
      $req = $bdd->prepare("UPDATE menbre SET confirm = 1 WHERE id = ?");
      $req->execute(array($confirm));
       echo "<script>alert('confirmation reussie');</script>";
    }

    if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare("DELETE FROM menbre WHERE id = ?");
      $req->execute(array($supprime));
      echo "<script>alert('suppression reussie');</script>";
    }

    if (isset($_GET['info']) AND !empty($_GET['info'])) {
      $info = (int) $_GET['info'];
      $req = $bdd->prepare("SELECT * FROM menbre WHERE id = ?");
      $req->execute(array($info));
      $i = $req->fetch();
      echo "<div class =\"info\">";
      echo "<center><p class = \" alert alert-info\">profil de <i class=\" fas fa-user-clock\"></i> <font color=\"green\"><b>".$i['pseudo']."</b></font></p></center>";
      echo "<p class = \" alert alert-info\">matricule: <font color=\"green\"><b>".$i['matricule']."</b></font></p>";
      echo "<p class = \" alert alert-info\">filiere: <font color=\"green\"><b>".$i['specialite']."</b></font></p>";
      echo "<p class = \" alert alert-info\">nom: <font color=\"green\"><b>".$i['first']."</b></font></p>";
      echo "<p class = \" alert alert-info\">prenom: <font color=\"green\"><b>".$i['last']."</b></font></p>";
      echo "<p class = \" alert alert-info\">age: <font color=\"green\"><b>".$i['age']."</b></font></p>";
      echo "<p class = \" alert alert-info\">date de naissance: <font color=\"green\"><b>".$i['naissance']."</b></font></p>";
      echo "<p class = \" alert alert-info\">addresse mail: <font color=\"green\"><b>".$i['email']."</b></font></p>";
      echo "<p class = \" alert alert-info\">lieu: <font color=\"green\"><b>".$i['lieu']."</b></font></p>";
      echo "<p class = \" alert alert-info\">diplome: <font color=\"green\"><b>".$i['niveau']."</b></font></p>";
      echo "<p class = \" alert alert-info\">session: <font color=\"green\"><b>".$i['session']."</b></font></p>";
      echo "<p class = \" alert alert-info\">date d'entree: <font color=\"green\"><b>".$i['date_enreg']."</b></font></p>";
      echo "<p align=\"center\"><a  href=\"index.php?id=".$_SESSION['id'].">&nbsp;Retour</a></p>";
      echo "</div>";
      echo "<a  href=\"index.php?id=".$_SESSION['id']."\">fermer <i class=\"fa fa-times\"></i></a><br>";
      echo "<a  href=\"media.php?id=".$i['id']."\">imprimer <i class=\"fa fa-print\"></i></a>";
    }

$ok_paiement = $bdd->query("SELECT * FROM paiement WHERE status_paiement = 'en cours'");
$enseignant = $bdd->query("SELECT * FROM enseignant");
$cycle = $bdd->query("SELECT * FROM cycle");
$menbre = $bdd->query("SELECT * FROM menbre ORDER BY id DESC LIMIT 10");
 ?>

<body>
  <!-- container section start -->
  <section id="container" class="">
    <?php include_once('aside.php'); ?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php?id=<?=$_SESSION['id']?>">Home</a></li>
              <li><i class="fa fa-laptop"></i>Dashboard</li>
            </ol>
          </div>
        </div>

        <div class="row">


          <div class="col-lg-12 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box dark-bg">
              <i class="fa fa-dollar"></i>
              <div class="count"><?= $budget?></div>
              <div class="title">budget total</div>
            </div>
            <!--/.info-box-->
          </div>

         <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box orange-bg">
              <i class="fa fa-dollar"></i>
              <div class="count"><?= $ok_paiement->rowCount() ?></div>
              <div class="title">Paiement en cours</div>
            </div>
            <!--/.info-box-->
          </div>


          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box blue-bg">
              <i class="fa fa-cloud-download"></i>
              <div class="count"><?php echo $nombre; ?></div>
              <div class="title">eleves inscrits</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box yellow-bg">
              <i class="fas fa-certificate"></i>
              <div class="count"><?= $cycle->rowCount()?></div>
              <div class="title">Cycle</div>
            </div>
            <!--/.info-box-->
          </div>

             <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box red-bg">
              <i class="fas fa-user-graduate"></i>
              <div class="count"><?= $enseignant->rowCount()?></div>
              <div class="title">Enseignant</div>
            </div>
            <!--/.info-box-->
          </div>

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box brown-bg">
              <i class="fa fa-shopping-cart"></i>
              <div class="count"><?= $nombreclasse?></div>
              <div class="title">filieres au total</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="info-box green-bg">
              <i class="fa fa-cubes"></i>
              <div class="count"><?= $mo?></div>
              <div class="title">modules</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

        </div>
        <!-- Today status end -->




        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                registrers users
              </header>
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th><i class="icon_profile"></i> Full Name</th>
                    <th><i class="fab fa-magento"></i> Matricule</th>
                    <th><i class="fas fa-user"></i> Pseudo</th>
                    <th><i class="icon_calendar"></i> Date</th>
                    <th><i class="icon_mail_alt"></i> Email</th>
                    <th><i class="icon_pin_alt"></i> filiere</th>
                    <th><i class="icon_mobile"></i> session</th>
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                    <?php while($m = $menbre->fetch()) { ?>
                  <tr>
                    <td><?= $m['first']." ". $m['last']?></td>
                    <td><?= $m['matricule']?></td>
                    <td><?= $m['pseudo']?></td>
                    <td><?= $m['naissance']?></td>
                    <td><?= $m['email']?></td>
                    <td><?= $m['specialite']?></td>
                    <td><?= $m['session']?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="edition.php?edit=<?=$m['id']?>"><i class=" far fa-edit"></i></a>
                        <?php if($m['confirm'] == 0) {  ?><a onclick="return(confirm('voulez-vous vraiment confirmer cet etudiant ?'))" class="btn btn-success" href="index.php?confirm=<?= $m['id'] ?>"><i class="icon_check_alt2"></i></a><?php } ?>
                        <a class="modal-title btn btn-info"  href="index.php?info=<?= $m['id'] ?>"><i class="fas fa-info-circle"></i></a>


                        <a onclick="return(confirm('voulez-vous vraiment supprimer cet etudiant'))" class="btn btn-danger" href="index.php?supprime=<?= $m['id'] ?>"><i class="fa fa-times-circle"></i></a>
                      </div>
                    </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </section>
          </div>
        </div>
<br><br>

<div class="row">
          <div class="col-md-10 portlets">
            <!-- Widget -->
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="pull-left">Message</div>
                 <div style="float: right;"><a onclick="return(confirm('voulez-vous vraiment vider la table?'))" href="index.php?tout=9090909090909090090909999090909090990"> <i class=" far fa-trash-alt"></i></a></div>
                
                <div class="clearfix"></div>
              </div>

              <div class="panel-body">
                <!-- Widget content -->
                <?php while($mignon = $mes->fetch()){  ?>
                <div class="padd sscroll">

                  <ul class="chats">

                    <li class="by-other">
                    
                      <div class="avatar pull-right">
                 </div>

                      <div class="chat-content">                
                     
                     <?= $mignon['message']?> 

                  <?php   if($admin['user_name']." ".$admin['user_last'] == $mignon['first']) {  ?> 
                    <div class="widget-icons pull-right">
                  <a href="index.php?trash=<?= $mignon['id']?>" class="wminimize"><i class=" far fa-trash-alt"></i></a>
                </div>
                  <?php } ?>
                     <div class="chat-meta"><?= $mignon['temps']?> <span class="pull-right"><?= $mignon['first']?></span>&nbsp;<b style="color:springgreen;"> <?= $mignon['grade']?></b></div>
                        <div class="clearfix"></div>
                      </div>
                    </li>
                  </ul>
                </div>
              <?php } ?>
                <div class="widget-foot">

                  <form class="form-inline" method="post">
                    <div class="form-group">
                      <input  style="width:800px;" type="text" class="form-control" placeholder="Taper votre message..." name="message">
                    </div>
                    <div class="form-group">
                      <input  type="text" class="form-control" value="<?= $_SESSION['id']?>" name = "outgoing_id" style="display: none;">
                    </div>
                    <button type="submit" class="btn btn-info" name="envoi_message"><i  class="fab fa-telegram-plane"></i></button>
                  </form>
<div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                </div>

                </div>

              </div>

            </div>

          <div class="col-md-12 portlets">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="pull-left">ANNONCES</div>
                <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                <div class="padd">

                  <div class="form quick-post">
                    <!-- Edit profile form (not working)-->
                    <form class="form-horizontal" method="post" action="">
                      <?php if(isset($erreur)){ ?>
                                  <div class="form-group">                   
                        <div class="col-lg-10">
                          <input type="text" class="form-control"  readonly value="<?= $erreur?>">
                        </div>
                      </div>
                    <?php } ?>
                      <!-- Title -->
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="title">Titre</label>
                        <div class="col-lg-10">
                          <input type="text" class="form-control" id="title" name="titre">
                        </div>
                      </div>
                      <!-- Content -->
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="content">Contenu</label>
                        <div class="col-lg-10">
                          <textarea class="form-control" id="content" name="contenu"></textarea>
                        </div>
                      </div>
                      <!-- Cateogry -->
                      <div class="form-group">
                        <label class="control-label col-lg-2">Categorie</label>
                        <div class="col-lg-10">
                          <select class="form-control" name="categorie">
                                                  <option >- Choisir une categorie -</option>
                                                  <option >General</option>
                                                  <option >Etudiant</option>
                                                  <option >Enseignant</option>
                                                  <option >Tag</option>
                                                  <option >Fun</option>
                                                </select>
                        </div>
                      </div>
                      <!-- Tags -->
                      <div class="form-group">
                        <label class="control-label col-lg-2" for="tags">Tags</label>
                        <div class="col-lg-10">
                          <input type="text" placeholder="@etudiant1  " name="tag" class="form-control" id="tags">
                        </div>
                      </div>

                      <!-- Buttons -->
                      <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-lg-offset-2 col-lg-9">
                          <button type="submit" class="btn btn-primary" name="notif" onclick="return(confirm('cette annonce sera notifie sur le profil des menbres confirmer votre action'))">Publier</button>
                          <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                      </div>
                    </form>
                  </div>


                </div>
          </div>
</div>




      </section>
      <div class="text-right">
        <div class="credits">
          <p class="credit"></p>
        </div>
      </div>
    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- nice scroll -->
  <script src="js/jquery.scrollTo.min.js"></script>
  <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
  <!-- charts scripts -->
  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <<script src="js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>
    <script src="js/xcharts.min.js"></script>
    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>
    <script src="js/charts.js"></script>
    <script src="js/jquery.slimscroll.min.js"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>

</body>

</html>

<?php }
else{
  header('Location:404.html');
}

 ?>