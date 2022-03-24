
<?php 
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if(isset($_POST['form_connexion']))
{
  if(!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect']))
  {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    $requser = $bdd->prepare("SELECT * FROM menbre WHERE email = ? AND password = ?");
    $requser->execute(array($mailconnect,$mdpconnect));
    $userexist = $requser->rowCount();
    if( $userexist == 1)
    {
      $userinfo = $requser->fetch();
      $_SESSION['confirm'] = $userinfo['confirm'];
      if($userinfo['confirm'] == 1)
        {
          $update = $bdd->prepare("UPDATE menbre SET status = 'en ligne' WHERE unique_id = ? ");
        $update->execute(array($userinfo['unique_id']));
      $_SESSION['cle'] = $userinfo['cle'];
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['first'] = $userinfo['first'];
      $_SESSION['last'] = $userinfo['last'];
      $_SESSION['niveau'] = $userinfo['niveau'];
      $_SESSION['photo'] = $userinfo['photo'];
      $_SESSION['email'] = $userinfo['email'];
      $_SESSION['pseudo'] = $userinfo['pseudo'];
      $_SESSION['specialite'] = $userinfo['specialite'];
      $_SESSION['age'] = $userinfo['age'];
      $_SESSION['naissance'] = $userinfo['naissance'];
      $_SESSION['lieu'] = $userinfo['lieu'];
      $_SESSION['date'] = $userinfo['date'];
      $_SESSION['matricule'] = $userinfo['matricule'];
      $_SESSION['session'] = $userinfo['session'];
      $_SESSION['unique_id'] = $userinfo['unique_id'];
      $_SESSION['status'] = $userinfo['status'];
      $_SESSION['confirm'] = $userinfo['confirm'];
      header('Location:pro.php?unique_id='.$_SESSION['unique_id']);
      }else{
        $erreur = "votre compte n'as pas encore ete confirme verifier vos mails";

      }
    }
    else{
      $erreur = "Identifiants Incorrectes :( contacter l'administrateur";
    }
  }
  else{
    $erreur = "tous les champs doivent etres rempli";
      header('Location:connexion.php');    
  }
}


 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Connexion</title>
 <link rel="stylesheet" type="text/css" href="style/style.css">
 <link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="js/pass.js">
<style type="text/css">
 *{
      font-family: 'poppins';
    }
  </style>  

</head>
<body>

<div class="wrapper">
  <section class="form login">
    <header>CONNEXION &copy</header>
    <form action="" method="post">
            <?php if(isset($erreur)) { ?>
      <div class="error-txt"><?php echo $erreur ?></div>
            <?php }?>
          <div class="field input">
          <label>Addresse email:</label>
          <input type="email" name="mailconnect" placeholder="addresse email">
        </div>
          <div class="field input">
          <label>Mot de passe:</label>
          <input type="password" name="mdpconnect" placeholder="mot de passe">
        <i class="fa fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="continuer" name="form_connexion">
        </div>
    </form>
    <div class="link" align="center"><span>revenir <a href="../Resi/index.php">acceuil</a></span><br>
        <span>mot de passe oublie contacter un administrateur</span><br><span>Je ne suis pas inscris<a href="menbre.php">&nbsp;inscription</a></span></div>
  </section>
</div>

<script src="pass.js"></script>
</body>
</html>