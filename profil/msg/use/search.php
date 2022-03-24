<?php 
include_once('../config/config.php');
include_once('use.php');
?>

		<?php
				$searchTerm = htmlspecialchars($_POST['searchTerm']);
		$requ = $bdd->query("SELECT * FROM menbre WHERE first LIKE'%".$searchTerm."%' OR last LIKE '%".$searchTerm."%'");		
			 while($use = $requ->fetch()) {
				$req2  =$bdd->prepare("SELECT * FROM messages WHERE (incoming_id = ? OR outcoming_id = ?) AND (incoming_id = ? OR outcoming_id = ?) ORDER BY id DESC LIMIT 1");
 					$req2->execute(array($use['unique_id'],$use['unique_id'], $outgoing, $outgoing));
 					$mdr = $req2->fetch();
 					if($req2->rowCount() == 1){
 						$result = $mdr['msg'];
 					}else{
 						$result = "aucun message";
 					}

 	(strlen($result) >28) ? $msg = substr($result, 0,40).'...' :$msg = $result;
 		($outgoing == $mdr['outcoming_id']) ? $you = "<b>vous:</b> " :$you = "";
 		// $use['status'] == "hors ligne" ? $offline = "offline" : $offline = "";
				if($use['unique_id'] != $_SESSION['unique_id']){ 
			  ?>
			<a href="chat.php?user_id=<?=$use['unique_id']?>">
				<div class="content">
					<img src="/../niceAdmin/profil/photo/<?php echo  $use['photo']; ?>" alt="">
					<div class="details">
						<span><?=$use['first'].' '.$use['last'] ?></span>
						<p><?php echo $you." ".$msg?></p>
					</div>
				</div>
				<div class="status-dot offline"><i <?php if($use['status'] == 'hors ligne'){ ?> style="color:#eee ;" <?php }else {?> style="color: springgreen;" <?php }?> class="fa fa-circle">en ligne</i></div>
			</a>
			<?php } } ?>
			<?php if($requ->rowCount() == 0){ ?>
			<span>aucun utilisateur</span>
			<?php } ?>

 