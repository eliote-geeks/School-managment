<?php include_once('head.php'); ?>
<?php 
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if (isset($_GET['init'])) {
  $req = $bdd->query("DELETE FROM site_users WHERE id > 0");
}
if(isset($_POST['valid']))
{
  if(isset($_POST['nom'],$_POST['pass'],$_POST['grade']) AND !empty($_POST['nom']) AND !empty($_POST['pass']))
  {
    $nom = htmlspecialchars($_POST['nom']);
    $pass = htmlspecialchars($_POST['pass']);
    $grade = htmlspecialchars($_POST['grade']);
    $req = $bdd->prepare("SELECT * FROM site_users WHERE pseudo = ? AND grade = ?");
    $req->execute(array($nom,$grade));
    $exist = $req->rowCount();
    $user = $req->fetch();
    
    if(password_verify($pass,$user['user_password'])==1){   
  
    $_SESSION['id'] = $user['id'];
    $_SESSION['user_name'] = $user['user_name'];
    $_SESSION['user_admin'] = $user['user_admin'];
    $_SESSION['birthay'] = $user['birthay'];
    $_SESSION['occupation'] = $user['occupation'];
    $_SESSION['mobile'] = $user['mobile'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['user_password'] = $user['user_password'];
    $_SESSION['user_last'] = $user['user_last'];
    $_SESSION['naissance'] = $user['naissance'];
    $_SESSION['site'] = $user['site'];
    $_SESSION['grade'] = $user['grade'];
    $_SESSION['apropos'] = $user['apropos'];
    $_SESSION['pays'] = $user['pays'];
        header('Location:index.php?id='.$_SESSION['id']);


  }else{
    $erreur =  "Identifiants Incorrectes";
  }
  }
  else{
    $erreur =  "tous les champs doivent etre rempli";
  }
}
$sel = $bdd->query("SELECT* FROM site_users");
 ?>
<body class="login-img3-body">
  <div class="container">
    <form class="login-form" action="" method="post" autocomplete="off">
      <?php if(isset($erreur)) {?>
        <p class="alert alert-danger"><?=$erreur?></p>
        <?php }?>
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="password" name="nom" class="form-control" placeholder="Pseudo" autofocus >
        </div>

        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <select required="required" name="grade" class="form-control"> 
            <option></option>
            <option>root</option>
            <option>user</option>
          </select>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="pass" class="form-control" placeholder="Password">
        </div>
        <label class="checkbox">
                <input type="checkbox" value="remember-me"> se souvenir de moi
            </label>
        <button class="btn btn-primary btn-lg btn-block" name="valid" type="submit">connexion</button>
        <a  href="Resi/index.php" class="btn btn-danger btn-lg btn-block" type="submit">Acceuil</a>
        <?php if($sel->rowCount() == 0){  ?>
        <a class="btn btn-primary btn-lg btn-block" type="submit" href="inscription.php"><span style="color:white;">inscription</span></a>
      <?php } ?>
      </div>
    </form>
  </div>
</body>
</html>
