<?php 
include_once('config/config.php');


            if (!$_SESSION['unique_id'] OR !$_GET['user_id']) {
                header('Location:login.php');               
        }


    $req = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ? ");
    $req->execute(array($_SESSION['unique_id']));
    $user = $req->fetch();



    $user_id = (int) $_GET['user_id'];
    $req=  $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ?");
    $req->execute(array($user_id));
    $id = $req->fetch();



    $outgoing = htmlspecialchars($_SESSION['unique_id']);
    $incoming = $user_id;
    $requ = $bdd->prepare("SELECT * FROM messages WHERE (outcoming_id = ? AND incoming_id = ?) OR (outcoming_id = ? AND incoming_id = ?) ");
    $requ->execute(array($outgoing,$incoming,$incoming,$outgoing));

 ?>
            <a href="" class="back-icon"><i class="fa fa-arrow-left"></i></a>
            <img src="inscription/photo/<?= $id['img']?>" alt="">
            <div class="details">
                <span><?= $id['fname']." ".$id['iname']?> </span>
                <p><?= $id['status']?></p>
            </div>
