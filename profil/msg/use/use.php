<?php 
$outgoing = $_SESSION['unique_id'];

  	$req = $bdd->prepare("SELECT * FROM menbre WHERE unique_id = ? ");
  	$req->execute(array($_SESSION['unique_id']));
  	$user = $req->fetch();

            $grade_req = $bdd->prepare("SELECT * FROM messages WHERE incoming_id = ? OR outcoming_id = ?");
    $grade_req->execute(array($outgoing,$outgoing));
    $grade = $grade_req->rowCount();

    if ($grade == 0) {
        $grade = "menbre debutant";
    }
    elseif ($grade > 0 AND $grade < 10) {
        $grade = 'menbre junor';
    }
    elseif ($grade >= 10 AND $grade < 50) {
        $grade = 'menbre habitue';
    }
    else{
        $grade = 'menbre expert';
    }

//   	if(isset($_GET['barre']) AND !empty($_GET['barre'])) {
// 	$barre = htmlspecialchars($_GET['barre']);
// 	$barre_array = explode(' ',$barre);
// 	$eleve = $bdd->query('SELECT * FROM users WHERE fname LIKE "%'.$barre.'%" ORDER BY id  DESC');
// 	echo "bonjour";
// }
 ?>

