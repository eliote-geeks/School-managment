<?php include_once('head.php'); ?>
<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
$c = $bdd->query("SELECT * FROM menbre WHERE confirm = 0");
$con = 0;
while($co = $c->fetch()){
  $con+=1;

}
if(isset($_POST['valid']))
{
  if(isset($_POST['nom'],$_POST['pass']) AND !empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['pass2']) AND !empty($_POST['pass']))
  {
    $nom = htmlspecialchars($_POST['nom']);
    $pass = htmlspecialchars($_POST['pass']);
    $pass2 = htmlspecialchars($_POST['pass2']);
    $email = htmlspecialchars($_POST['email']);

    if (preg_match("/^[a-zA-Z ]*$/",$nom)) {
        if (filter_var($email,FILTER_VALIDATE_EMAIL)) {
          if ($pass == $pass2) {
              if (strlen($pass) >= 6) {
                $v = $bdd->prepare("SELECT * FROM site_users WHERE email = ?");
                $v->execute(array($email));
                if ($v->rowCount() == 0) {
                  $req = $bdd->prepare("SELECT * FROM site_users WHERE pseudo = ?");
                  $req->execute(array($nom));
                  if ($req->rowCount() == 0) {
                    $hash = password_hash($pass,PASSWORD_BCRYPT,['cost'=>11]);
                    $insert = $bdd->prepare("INSERT INTO site_users(email,pseudo,user_password,user_admin,grade) VALUES(?,?,?,?,?)");
                    $insert->execute(array($email,$nom,$hash,1,'root'));
                    echo "<script>alert('inscription reussie connectez-vous avec votre pseudo.. vous etes l\'administrateur vous disposer de tous les droits..');</script>"; 
                  }
                  else{
                    $erreur = "oups ce pseudo existe deja";
                  }                   
                  
                }
                else{
                  $erreur = "Cete addresse email exise deja";
                }

              }
              else{
                $erreur = "votre mot de passe est trop  court ";
              }
          }
          else{
            $erreur = "vos mots de passe ne correspondent pas";
          }
        }
        else{
          $erreur = "Votre addresse email est invalide";
        }

    }else{
      $erreur = " syntaxe invalide du pseudo";
    }

      
  }
  else{
    $erreur =  "tous les champs doivent etre rempli";
  }
}
 ?>
<body class="login-img3-body">
  <div class="container">
    <form style="margin-bottom: 30px;" class="login-form" action="" method="post">
      <?php if(isset($erreur)) {?>
        <p class="alert alert-danger"><?=$erreur?></p>
        <?php }?>
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
       
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_cloud-upload_alt"></i></span>
          <input type="email" name="email" class="form-control" placeholder="email" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" name="nom" class="form-control" placeholder="Pseudo" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="pass" class="form-control" placeholder="Password">
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="pass2" class="form-control" placeholder="confirm Password">
        </div>
        <label class="checkbox">
                <input required="required" type="checkbox" value="remember-me">j'accepte les conditions d'utilisations
            </label>
        <button class="btn btn-primary btn-lg btn-block" name="valid" type="submit">inscription</button>
        <a class="btn btn-primary btn-lg btn-block" type="submit" href="login.php"><span style="color:white;">connexion</span></a>
      </div>
    </form>
  </div>

</body>
</html>
