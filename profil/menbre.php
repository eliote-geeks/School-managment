<!DOCTYPE html>
<html>
<head>
	<title>menbre</title>

	<meta charset="utf-8">
	<meta name="author" content="paul">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Inscription etudiant</title>
	<meta name="description" content="...">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="style/sty.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome.min.css">
	<style type="text/css">
 *{
      font-family: 'poppins';
    }
  </style>  

</head>
<body style="background: #eee;">

<?php

	$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
	$final = 0;
if (isset($_POST['cy'])) {
  if (isset($_POST['cycle']) AND !empty($_POST['cycle'])) {
    $cy = $bdd->prepare("SELECT * FROM cycle WHERE nom = ?");
    $cy->execute(array(htmlspecialchars($_POST['cycle'])));
    if ($cy->rowCount() > 0) {
      $cycle_fetch = $cy->fetch();
      $final = 1;
    }
    else{
      $erreur = "Ce cycle n'existe pas vous pouvez le creer";
    }
  }
  else{
    $erreur = 'Tous les champs doivent etre rempli';
  }
}

if($final == 1){
$mati = $bdd->prepare("SELECT * FROM matiere WHERE cycle = ?");
$mati->execute(array($cycle_fetch['nom']));
}
$cycle = $bdd->query("SELECT * FROM cycle ORDER BY id DESC");
	$setting = $bdd->query("SELECT * FROM settings");	
	$s = $setting->fetch();
	if(isset($_POST['form_inscription']))
	{
		if(!empty($_POST['name']) AND !empty($_POST['name2'])  AND !empty($_POST['mail'])  AND !empty($_POST['pseudo']) AND !empty($_POST['age']) AND !empty($_POST['lieu']) AND !empty($_POST['pass']) AND !empty($_POST['pass2']))
		{
			$name = htmlspecialchars($_POST['name']);
			$name2 = htmlspecialchars($_POST['name2']);
			$mail = htmlspecialchars($_POST['mail']);
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$matiere = htmlspecialchars($_POST['matiere']);
			$age = htmlspecialchars($_POST['age']);
			$lieu = htmlspecialchars($_POST['lieu']);
			$niveau = htmlspecialchars($_POST['niveau']);
			$session = htmlspecialchars($_POST['session']);
			$sexe = htmlspecialchars($_POST['sexe']);
			$naiss = htmlspecialchars($_POST['date_de_naissance']);
			$pass = $_POST['pass'];
			$pass2 = $_POST['pass2'];
			$lenght_name = strlen($_POST['name']);
			$lenght_name2 = strlen($_POST['name2']);
			$lenght_pseudo = strlen($_POST['pseudo']);
			$cycle = htmlspecialchars($_POST['cycle']);
			if (preg_match("/^[a-zA-Z ]*$/",$name) AND preg_match("/^[a-zA-Z ]*$/",$name2)) {
			if(($lenght_name<=255) AND ($lenght_name2<=255) AND ($lenght_pseudo<=7))
			{
				if(filter_var($mail,FILTER_VALIDATE_EMAIL))
				{
					$reqmail = $bdd->prepare("SELECT * FROM menbre WHERE email = ?");
					$reqmail->execute(array($mail));
					$mailexist = $reqmail->rowCount();
					if($mailexist == 0){
						if($pass == $pass2)
							{
								$reqpseudo = $bdd->prepare("SELECT * FROM menbre WHERE pseudo =?");
								$reqpseudo->execute(array($pseudo));
								$pseudoexist = $reqpseudo->rowCount();
								if(($pseudoexist == 0) AND preg_match("/^[a-zA-Z ]*$/",$pseudo))
								{
								$mdp = strlen($pass);
								if($mdp>=6)
								{
									if(($age>=18) AND ($age<35) )
									{
										$lk = 12;
										$k = "";
										for ($i=0; $i < $lk; $i++) { 
											$k .= mt_rand(0,9).str_shuffle("le roi paul");
										}
										$key = "";
										$key = date('y').str_shuffle($pseudo).str_shuffle(rand(1000,2999));
										$pass = sha1($_POST['pass']);
										$pass2 = sha1($_POST['pass2']);	
										$random_id = rand(time(),100000);
										$status = "en ligne";
										$insertmbr = $bdd->prepare("INSERT INTO menbre(cycle,unique_id,status,first,last,email,pseudo,niveau,specialite,age,naissance,lieu,sexe,password,matricule,session,confirmkey,date_enreg) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
										$insertmbr->execute(array($cycle,$random_id,$status,$name,$name2,$mail,$pseudo,$niveau,$matiere,$age,$naiss,$lieu,$sexe,$pass,$key,$session,$k)); 
										$eleve = $bdd->prepare("SELECT * FROM menbre WHERE pseudo = ?");
										$eleve->execute(array($pseudo));
										$poid = $eleve->fetch();
										// $header="MIME-Version: 1.0\r\n";
										// $header.='From:"mashashiee"<support@mashashiee.com>'."\n";
										// $header.='Content-Type:text/html; charset="uft-8"'."\n";
										// $header.='Content-Transfer-Encoding: 8bit';

										// $message='
										// <html>
										//     <body>
										//         <div align="center">
										//         <a href="http://localhost/menbre/confirmation.php?pseudo='.urlencode($pseudo).'$k='.$k.'">Confirmez votre compte</a>
										//         </div>
										//     </body>
										// </html>
										// ';

										// mail($mail, "Confirmation de compte !", $message, $header);
										header('Location:choose_pp.php?id='.$poid['id']);
									}
									else{
										$erreur = "vous n'etes pas admissibles dans notre centre";
									}	
								}
								else{
									$erreur = "oups!! votre mot de passe doit depasser 6 caracteres";
								}
							}
							else{
								$erreur = "oups pseudo existe deja ou invalide";
							}

							}
							else{
								$erreur = "oups!! vos mots de passe ne correspondent pas";
							}
					}	
					else{
						$erreur = "oups!! cette addresse email existe deja";
					}
				}
				else{
					$erreur = " oups!! veuillez inserez une adresse email valide";
				}
			}
			else{
				$erreur = "oups votre pseudo , nom et prenom doivent etre inferieur a 255 caracteres";
			}
		}
		else{
			$erreur = "Only letters and white space allowed";
		}
		}
		else{
			$erreur = "Tous les champs doivent etres rempli";
		}
	}




 ?>

 
</div>
</div>
<div class="wrapper">
  <section class="form login">
    <header>
      <h2>INSCRIPTION  ETUDIANT &copy</h2>
    </header>
    <?php if($final == 0){ ?>
    		<h4 style="font-size:20px; text-decoration:underline;"	 align="center">BIENVENUE DANS NOTRE CENTRE AVANT TOUT CHOISISSSEZ LE CYCLE QUE VOUS SOUHAITEZ SUIVRE</h4><br><br>
    	<?php } ?>
                <form method="post" action="" autocomplete="off">
          <div class="form-group">
    	          <div class="form-group" align="center">
                    <label for="inputEmail1" class="col-lg-2 control-label">Choisissez votre parcours</label>
                    <div class="col-lg-10">
                      <select required="required" class="form-control" id="inputEmail1" name="cycle">     
        <option>Choississez un cycle</option>
        <?php while ($c = $cycle->fetch()) {  ?>
      <option><?= $c['nom'];?></option>
      <?php } ?>
    </select>
                      <p class="help-block"></p>
                    </div>
	                  </div><br>
            <div align="center"><button style="padding: 5px; color:white; background: black; border:none; border-radius: 3px; margin:0 auto;" type="submit" class="btn btn-danger" name="cy">Valider</button></div>
                </form>
	                  <br><br>

    <?php if($final == 1) {?>
    <form action="" method="post" enctype="multipart/form-data">
            <?php if(isset($erreur)) { ?>
      <div class="error-txt"><?php echo $erreur ?></div>
            <?php }?>
          <div class="field input">
          <label>Addresse email:</label>
          <input type="email" name="mail" required placeholder="addresse email">
        </div>

         <div class="field input">
          <label>age:</label>
          <input type="number" required="required" name="age">   
        </div>


         <div class="field input">
          <label>Pseudo:</label>
          <input type="text" required="required" name="pseudo">   
        </div>

         <div class="field input">
          <label>session:</label>
          <select required="required" name="session">
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
      <option>NOVEMBRE</option>
      <option>DECEMBRE</option>
      </select>
        </div>

	<div class="field input">
		<label>Niveau d'etude:</label>
        <select required="required" name="niveau">
			<option></option>
			<option>BEPC</option>
			<option>CAP</option>
			<option>PROBATOIRE</option>
			<option>BAC</option>
			<option>BAC SCI</option>
			<option>PLUS..</option>
		</select>
		</div>

         <div class="field input">
          <label>Specialite:</label>
          <select name="matiere" required="required">     
        <option></option>
        <?php while($mat = $mati->fetch()) {  ?>
      <option><?= $mat['matiere'];?></option>
      <?php } ?>
    </select>
        </div>

              <div class="field input">
          <label>date de naissance:</label>
          <input type="date" name="date_de_naissance" required="required" >   
        </div>

                   <div class="field input">
          <label>nom:</label>
          <input type="text" required="required" name="name">   
        </div>

        <div class="field input">
          <label>Prenom:</label>
          <input type="text" required="required" name="name2">   
        </div>


               <div class="field input">
          <label>Lieu de naissance:</label>
          <input type="text" required="required" name="lieu">   
        </div>

            <div class="field input">
          <label>sexe:</label>
          <select required="required" name="sexe">
        <option></option>
      <option>M</option>
      <option>F</option>
      </select>
        </div>

          <div class="field input">
          <label>Mot de passe:</label>
          <input type="password" required="required" name="pass" placeholder="mot de passe">
        <i class="fa fa-eye"></i>
        </div>

         <div class="field input">
          <label>Confirmer le mot de passe:</label>
          <input type="password" required="required" name="pass2" placeholder="mot de passe">
        <i class="fa fa-eye"></i>
        </div>

        <div class="field button">
          <input type="submit" value="continuer" name="form_inscription">
        </div>
    </form>
  <?php } ?>
    <div class="link" align="center"><span>revenir <a href="../Resi/index.php">acceuil</a></span><br>
    	<span> en validant ce formulaire vous acceptez<a href="politique.php"> les conditions generales d'utilisations</a></span><br>
    	<?php if($s['affiche_admin'] == 0){ ?>
             <li><a class="btn btn-quote" href="">Vous ne pouvez pas vous connecter..</a></li>
           <?php }else{ ?>
    	<span id="f">je suis deja inscris&nbsp;<a href="connexion.php">connexion</a></span>            
          <?php } ?>
    </div>
  </section>
</div>

<script src="pass.js"></script>


</body>
</html>
