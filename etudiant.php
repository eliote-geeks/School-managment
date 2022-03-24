<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
$adoudou = $bdd->prepare("SELECT * FROM site_users WHERE id = ?");
    $adoudou->execute(array($_SESSION['id']));
    $admin = $adoudou->fetch();
$mati  =$bdd->query("SELECT * FROM matiere");
$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}

      if (isset($_POST['v'])) {
        if (isset($_POST['first'],$_POST['last'],$_POST['mail'],$_POST['date_de_naissance'],$_POST['session'],$_POST['niveau'],$_POST['matiere'],$_POST['sexe'],$_POST['age'],$_POST['naissance']) AND !empty($_POST['first']) AND !empty($_POST['last']) AND !empty($_POST['mail']) AND !empty($_POST['session']) AND !empty($_POST['niveau']) AND !empty($_POST['matiere']) AND !empty($_POST['sexe']) AND !empty($_POST['age']) AND !empty($_POST['naissance'])AND !empty($_POST['date_de_naissance'])) {
          $name = htmlspecialchars($_POST['first']);
          $name2 = htmlspecialchars($_POST['last']);
          $mail = htmlspecialchars($_POST['mail']);
          $pseudo =htmlspecialchars($_POST['pseudo']);
          $matiere = htmlspecialchars($_POST['matiere']);
          $age = htmlspecialchars($_POST['age']);
          $lieu = htmlspecialchars($_POST['naissance']);
          $niveau = htmlspecialchars($_POST['niveau']);
          $session = htmlspecialchars($_POST['session']);
          $residence = htmlspecialchars($_POST['residence']);
          $sexe = htmlspecialchars($_POST['sexe']);
          $naiss = htmlspecialchars($_POST['date_de_naissance']);
          $lenght_name = strlen($_POST['first']);
          $lenght_name2 = strlen($_POST['last']);
          if (preg_match("/^[a-zA-Z ]*$/",$name) AND preg_match("/^[a-zA-Z ]*$/",$name2)){
            if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
          $reqmail = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
          $reqmail->execute(array($mail));
          $mailexist = $reqmail->rowCount();
          if($mailexist == 0){
            if(($age>=18) AND ($age<35)){
                    $random_id = rand(time(),100000);
                    $status = "en ligne";
                    $key = "";
                    $key = date('y').str_shuffle("CFPAM").str_shuffle(rand(1000,2999));
                    $pass = "CFPAM-".date('y');
                    $d = $pass;
                    $crypt = sha1($pass);
                    $insertmbr = $bdd->prepare("INSERT INTO menbre(unique_id,status,first,last,email,pseudo,niveau,specialite,age,naissance,lieu,sexe,password,matricule,session,residence,date_enreg) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
                    $insertmbr->execute(array($random_id,$status,$name,$name2,$mail,$pseudo,$niveau,$matiere,$age,$naiss,$lieu,$sexe,$crypt,$key,$session,$residence)); 
                    $eleve = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ?");
                    $eleve->execute(array($pseudo));
                    $poid = $eleve->fetch();

                    $upd = $bdd->prepare("UPDATE menbre SET confirm = 1 WHERE id = ?");
                    $upd->execute(array($poid['id']));
                    echo "<script>alert('inscription reussie');</script>";
                    echo "<script>alert('le mot de passe par defaut est ".$d."');</script>";
                  }
                  else{
                    $erreur = "vous n'etes pas admissibles dans notre centre";
                  } 
                }else{
            $erreur = "oups cette addresse mail existe deja";
          }
        }
        else{
          $erreur = "addresse mail invalide";
        }
          }
          else{
            $erreur = "veuillez entrez un identifiant valide";
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
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-files-o"></i> etudiant</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
              <li><i class="icon_document_alt"></i>Forms</li>
              <li><i class="fa fa-files-o"></i>Form Validation</li>
            </ol>
          </div>
        </div>
        <!-- Form validations -->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                etudiant
              </header>
              <div class="panel-body"><br><br>
    <?php if(isset($erreur)) { ?>
      <input class="alert-danger form-control" value = "<?= $erreur?>">
    <?php } ?>
    <form method="post" action="">
      <p align="center">--PSEUDO--<input required="required"  type="text" name="pseudo" placeholder="identifiant" class="form-control"></p>
      <p align="center">--NOM--<input required="required"  type="text" name="first" placeholder="identifiant" class="form-control"></p>
      <p align="center">--PRENOM--<input required="required" type="text" name="last" placeholder="identifiant" class="form-control"></input></p>
      <p align="center">--MAIL--<input required="required" type="email" name="mail" placeholder="addresse mail" class="form-control"></input></p>
       <p align="center">--RESIDENCE--<input required="required" type="text" name="residence" placeholder="residence" class="form-control"></input></p>
      <p align="center">--DATE DE NAISSANCE-- <input type="date" class="form-control" name="date_de_naissance"></input></p>
      <p align="center">--SESSION-- <select  required="required" class="form-control" name="session">
    <option></option>    
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
    <p align="center">--NIVEAU D'ETUDE--
    <select class="form-control" required="required" name="niveau">
      <option></option>
      <option>BEPC</option>
      <option>CAP</option>
      <option>PROBATOIRE</option>
      <option>BAC</option>
      <option>BAC SCI</option>
      <option>PLUS..</option>
    </select></p>
    <p align="center">--Specialite--
       <select class="form-control" required="required" name="matiere">
       <option></option>      
        <?php while ($mat = $mati->fetch()) { ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
      </select></p> 
      <p align="center">--SEXE-- <select required="required" class="form-control" name="sexe">
        <option></option>
        <option>M</option>
        <option>F</option>
      </select></p>
      <p align="center">--AGE--<input required="required" type="number" name="age" placeholder="identifiant" class="form-control"></input></p>
      <p align="center">--LIEU DE NAISSANCE--<input required="required" type="text" name="naissance" placeholder="lieu de naissance" class="form-control"></input></p>
      <button onclick="return(confirm('voulez-vous vraiment ajouter un nouvel etudiant?'))" type="submit" class="btn-sm btn-info form-control" name="v">inscrire</button>
    </form>
</div>
            </section>
          </div>
        </div>
  </section>
  <!-- container section end -->

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
