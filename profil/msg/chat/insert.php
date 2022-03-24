<?php 
	include_once('../config/config.php');
    $message = htmlspecialchars($_POST['message']);
    $incoming_id = htmlspecialchars($_POST['incoming_id']);
    $outgoing_id = htmlspecialchars($_POST['outgoing_id']);
    if (isset($_SESSION['unique_id'],$_POST['message'],$_POST['incoming_id'],$_POST['outgoing_id']) AND !empty($_POST['message'])) {
    $insert = $bdd->prepare("INSERT INTO messages(incoming_id,outcoming_id,msg) VALUES(?,?,?)");
    $insert->execute(array($incoming_id,$outgoing_id,$message));   

    $ins = $bdd->prepare("INSERT INTO notification(id_expe,id_rec,date_en) VALUES(?,?,NOW())");
    $ins->execute(array($incoming_id,$outgoing_id));
}


 ?>

 			<?php while($mes = $requ->fetch()){ 				
				?>
				<?php if ($mes['outcoming_id'] == $outgoing) {											
				 ?>		
			<div class="chat outgoing">
				<div class="details">		
				<p>	<?php echo $mes['msg']?></p>      
				</div>
			</div> 
			<?php } ?>
<?php if ($mes['outcoming_id'] == $incoming) { ?>
			<div class="chat incoming">
				<img src="inscription/photo/<?=$id['img'] ?>" alt="">
				<div class="details">
					<p> <?= $mes['msg'] ?></p>          
				</div>
			</div>
			<?php } ?>
		<?php } ?>	