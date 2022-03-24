<?php 
include_once('../config/config.php');
        
    
        //     if (!$_SESSION['unique_id'] OR !$_GET['user_id']) {
        //         echo "nonono";               
        // }

    
    $incoming_id = htmlspecialchars($_POST['incoming_id']);
    $outgoing_id = htmlspecialchars($_POST['outgoing_id']);

    $req = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ? ");
    $req->execute(array($outgoing_id));   
    $user = $req->fetch();



    $req=  $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
    $req->execute(array($incoming_id));
    $id = $req->fetch();



    $requ = $bdd->prepare("SELECT * FROM messages WHERE (outcoming_id = ? AND incoming_id = ?) OR (outcoming_id = ? AND incoming_id = ?) ");
    $requ->execute(array($outgoing_id,$incoming_id,$incoming_id,$outgoing_id));
    ?>

            <?php while($mes = $requ->fetch()){                 
                ?>
                <?php if ($mes['outcoming_id'] == $outgoing_id) {                                          
                 ?>     
            <div class="chat outgoing">
                <div class="details">       
                <p> <?php echo $mes['msg']?></p>      
                </div>
            </div> 
            <?php } ?>
<?php if ($mes['outcoming_id'] == $incoming_id) { ?>
            <div class="chat incoming">
                <img src="/../niceAdmin/profil/photo/<?=$id['photo'] ?>" alt="">
                <div class="details">
                    <p> <?= $mes['msg'] ?></p>          
                </div>
            </div>
            <?php } ?>
        <?php } ?>  

 
