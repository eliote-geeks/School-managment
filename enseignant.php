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
        if (isset($_POST['first'],$_POST['last'],$_POST['ville'],$_POST['mail'],$_POST['date_de_naissance'],$_POST['diplome'],$_POST['matiere'],$_POST['sexe'],$_POST['age'],$_POST['naissance']) AND !empty($_POST['first']) AND !empty($_POST['last']) AND !empty($_POST['mail'])  AND !empty($_POST['diplome']) AND !empty($_POST['matiere']) AND !empty($_POST['sexe']) AND !empty($_POST['age']) AND !empty($_POST['pseudo']) AND !empty($_POST['pass']) AND !empty($_POST['naissance'])AND !empty($_POST['date_de_naissance'])) {
          $name = htmlspecialchars($_POST['first']);
          $name2 = htmlspecialchars($_POST['last']);
          $mail = htmlspecialchars($_POST['mail']);
          $pseudo = htmlspecialchars($_POST['pseudo']);
          $matiere = htmlspecialchars($_POST['matiere']);
          $age = htmlspecialchars($_POST['age']);
          $lieu = htmlspecialchars($_POST['naissance']);
          $ville = htmlspecialchars($_POST['ville']);
          $diplome = htmlspecialchars($_POST['diplome']);
          $autre = htmlspecialchars($_POST['autre']);
          $sexe = htmlspecialchars($_POST['sexe']);
          $session = htmlspecialchars($_POST['session']);
          $naiss = htmlspecialchars($_POST['date_de_naissance']);
          $lenght_name = strlen($_POST['first']);
          $lenght_name2 = strlen($_POST['last']);
          $pass = htmlspecialchars($_POST['pass']);
          if (preg_match("/^[a-zA-Z ]*$/",$name) AND preg_match("/^[a-zA-Z ]*$/",$name2)){
            if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
          $reqmail = $bdd->prepare("SELECT * FROM enseignant WHERE email = ?");
          $reqmail->execute(array($mail));
          $mailexist = $reqmail->rowCount();
          if($mailexist == 0){
            if(($age>=25) AND ($age<60)){
              $hash = password_hash($pass,PASSWORD_BCRYPT,['cost'=>11]);
              $key = 0;
              $key = mt_rand(0,100);
                 $insertmbr = $bdd->prepare("INSERT INTO enseignant(pseudo,session,first_en,last_en,email,diplome,ville,filiere,age,autre,naissance,lieu,sexe,unique_id,pass,date_en) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
                    $insertmbr->execute(array($pseudo,$session,$name,$name2,$mail,$diplome,$ville,$matiere,$age,$autre,$naiss,$lieu,$sexe,$key,$hash)); 
                    
                    echo "<script>alert('inscription reussie nouvel enseignant: ".$name." ".$name2."');</script>";
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

$query = $bdd->query("SELECT * FROM enseignant");
 ?>     
<?php include_once('head.php'); ?>
<body>
  <!-- container section start -->
  <section id="container" class="">
    <?php include_once('aside.php'); ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-linux"></i> Enseignant</h3>
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
                Enseignant
              </header>
              <div class="panel-body"><br><br>
    <?php if(isset($erreur)) { ?>
      <input class="alert-danger form-control" value = "<?= $erreur?>">
    <?php } ?>
    <form method="post" action="">
      <p align="center">--PSEUDO--<input required="required"  type="text" name="pseudo" placeholder="identifiant" class="form-control"></input></p>
      <p align="center">--NOM--<input required="required"  type="text" name="first" placeholder="identifiant" class="form-control"></input></p>
      <p align="center">--PRENOM--<input required="required" type="text" name="last" placeholder="identifiant" class="form-control"></input></p>
      <p align="center">--MAIL--<input required="required" type="email" name="mail" placeholder="addresse mail" class="form-control"></input></p>
      <p align="center">--DATE DE NAISSANCE-- <input type="date" class="form-control" name="date_de_naissance"></p>
    <p align="center">--diplome --
    <input class="form-control" type="text" name="diplome" placeholder="diplome"></input></p>
    <p align="center">--Specialite--
       <select class="form-control" required="required" name="matiere">
       <option>Permis de conduire</option>      
        <?php while ($mat = $mati->fetch()) { ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
      </select></p> 
      <p align="center">--Session-- 
                          <select  required="required" class="form-control" name="session">
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
      </p>
      <p align="center">--SEXE-- <select required="required" class="form-control" name="sexe">
        <option></option>
        <option>M</option>
        <option>F</option>
      </select></p>
      <p align="center">--AGE--<input required="required" type="number" name="age" placeholder="identifiant" class="form-control"></input></p>
      <p align="center">--LIEU DE NAISSANCE--<input required="required" type="text" name="naissance" placeholder="lieu de naissance" class="form-control"></p>
      <p align="center">--DOMICILE--<input required="required" type="text" name="ville" placeholder="domicile" class="form-control"></p>
      <p align="center">--AUTRE--<textarea class="form-control" name="autre" placeholder="autre information"> </textarea> </p>

        <p align="center">--MOT DE PASSE-- <input type="password" class="form-control" name="pass"></p>
      <br>
      <button onclick="return(confirm('voulez-vous vraiment ajouter un nouvel enseignant?'))" type="submit" class="btn-sm btn-info form-control" name="v">inscrire</button>
    </form>
</div>
            </section>
          </div>
        </div>
  </section>
  <!--  -->
      
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
