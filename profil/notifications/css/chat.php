	<?php 
	session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre;charset=utf8','root','');
if (isset($_GET['user_id'])) {
	$user_id = (int) $_GET['user_id'];
	$req =  $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
	$req->execute(array($user_id));
	$id = $req->fetch();

	if (isset($_POST['valid'])) {
			if (isset($_SESSION['unique_id'],$_POST['message'],$_POST['incoming_id'],$_POST['outgoing_id']) AND !empty($_POST['message'])) {
		$message = htmlspecialchars($_POST['message']);
		$incoming_id = htmlspecialchars($_POST['incoming_id']);
		$outgoing_id = htmlspecialchars($_POST['outgoing_id']);
		$insert = $bdd->prepare("INSERT INTO messages(incoming_id,outcoming_id,msg) VALUES(?,?,?)");
		$insert->execute(array($incoming_id,$outgoing_id,$message));
	}
	}
		$outgoing = htmlspecialchars($_SESSION['unique_id']);
	$incoming = $user_id;
	$requ = $bdd->prepare("SELECT * FROM messages WHERE (outcoming_id = ? AND incoming_id = ?) OR (outcoming_id	 = ? AND incoming_id = ?) ");
	$requ->execute(array($outgoing,$incoming,$incoming,$outgoing));



 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="sty.css">
	<title>
		chat
	</title>
</head>
<body>

<div class="wrapper">
	<section class="chat-area">
		<header>


			<a href="use.php?idi=<?= $_SESSION['unique_id']?>" class="back-icon"><i style="background:black; color: white; border-radius: 5px; padding:5px;" class="fa fa-arrow-left">retour</i></a>
			<img src="photo/<?=$id['photo'] ?>" alt="">
			<div class="details">
				<span><?= $id['first']." ".$id['last']?></span>
				<p><?= $id['status']?></p>
			</div>
		</header>
	<div class="chat-box">
			<?php while($mes = $requ->fetch()){ ?>
				<?php if ($mes['outcoming_id'] == $outgoing) { ?>		
			<div class="chat outgoing">
				<div class="details">		
				<p>	<?= $mes['msg'] ?></p>          
				</div>
			</div> 
			<?php } ?>
<?php if ($mes['outcoming_id'] == $incoming) { ?>		
			<div class="chat incoming">
				<img src="photo/<?=$id['photo'] ?>" alt="">
				<div class="details">
					<p> <?= $mes['msg'] ?></p>          
				</div>
			</div>
			<?php } ?>
		<?php } ?>	
		</div>
<form action="" method="post" class="typing-area">
			<input type="text" value="<?php echo $_SESSION['unique_id'];?>" name="outgoing_id" hidden>
			<input type="text" value=" <?php if(isset($user_id)) echo $user_id ?>" name="incoming_id" hidden>
			<input type="text" class="input-field" placeholder="entrez votre message" name="message"> 
			<button type="submit" name="valid">Envoyer</button>
		</form>
</form>
</body>
</html>
<?php } ?>