<?php 

function get_image_width($image){
	$s = getimagesize($image);
	return $s['0'];
}
function get_image_heigth($image){
	$s = getimagesize($image);
	return $s['1'];
}

function get_name($id){
	global $bdd;
	$name = $bdd->prepare("SELECT * FROM menbres WHERE id= ?");
	$name->execute(array($id));
	$name = $name->fetch();
	$name = $name['pseudo'];
	return $name;
}

// function pagination($reponsesParpages = 5){
// 		// $reponsesTotalesReq = $bdd->prepare("SELECT * FROM f_message WHERE id_topic= ?");
// 		// $reponsesTotalesReq->execute(array($get_id));
// 		// $reponsesTotales = $reponsesTotalesReq->rowCount();
// 		$pagesTotales = ceil($reponsesTotales/$reponsesParpages);
// 		if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND  $_GET['page'] <= $pagesTotales) {
// 			$_GET['page'] = intval($_GET['page']);
// 			$pageCourante = $_GET['page'];
// 		}else{
// 			$pageCourante = 1;
// 		}
// 		$depart = (($pageCourante-1) * $reponsesParpages);
// 		return $depart;
// }

function get_thumb_icon($type){
	if($type == 'video'){
		$icon = 'play';
	}
	elseif($type == 'article'){
		$icon = 'pencil2';
	}
	elseif($type == 'externe'){
		$icon ='link';
	}
	else{
		$icon = '';
	}
	return $icon;
}

function get_profile_pic($id){
	global $bdd;
	$avatar = $bdd->prepare("SELECT photo FROM menbres WHERE id = ?");
	$avatar->execute(array($id));
	$avatar = $avatar->fetch();
	$avatar = $avatar['avatar'];
	return $avatar;
}

function truncate_text($text,$maxchars=200,$points=1){
	//Test de la longeur d'un texte
	if (strlen($text) > $maxchars) {
		//Selection du maximum de mots
		$text = substr($text, 0, $maxchars);
		//recuperation de la position de la derniere espace
		$position_espace = strrpos($text, " ");
		$text = substr($text,0, $position_espace);
		//ajout des "..."
		if ($points == 1) {
			$text = $text."...";
		}
	}
	return $text;
}

function Pension()
{
   if(!isset($_SESSION['pension']))
   {
      $_SESSION['pension'] = array();
      $_SESSION['pension']['nom'] = array();
      $_SESSION['pension']['id'] = array();
      $_SESSION['pension']['montant'] = array();
      $_SESSION['pension']['pseudo'] = array();
      $_SESSION['pension']['email'] = array();
   }
}
//------------------------------------
function ajouterPension($nom, $id, $montant, $pseudo, $email)
{
    creationDuPanier(); 
    $position_produit = array_search($id,  $_SESSION['pension']['id']);    

    if($position_produit !== false)
    {
         $_SESSION['pension']['montant'][$position_produit] += $montant ;
    }
    else
    {
        $_SESSION['pension']['nom'][] = $nom;
        $_SESSION['pension']['id'][] = $id;
        $_SESSION['pension']['montant'][] = $montant;
        $_SESSION['pension']['pseudo'][] = $pseudo;
        $_SESSION['pension']['email'][] = $email;
    }
}
//------------------------------------
function montantTotal()
{
   $total=0;
   for($i = 0; $i < count($_SESSION['pension']['id']); $i++)
   {
      $total += $_SESSION['pension']['montant'][$i] ;
   }
   return round($total,2); 
}
//------------------------------------
function retirerProduitDuPanier($id_a_supprimer)
{
    $position_produit = array_search($id_a_supprimer,  $_SESSION['panier']['id']);
    if ($position_produit !== false)
    {s
        array_splice($_SESSION['panier']['titre'], $position_produit, 1);
        array_splice($_SESSION['panier']['id'], $position_produit, 1);
        array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
        array_splice($_SESSION['panier']['prix'], $position_produit, 1);
        array_splice($_SESSION['panier']['photo'], $position_produit, 1);
    }
}

function url_custom_encode($titre,$categorie=0){
    $titre = htmlspecialchars($titre);
    $find =    array('é','à','-','%20','','');  
    $replace = array('e','a',' ','-','','');
    $titre = str_replace($find, $replace, $titre);
    $titre = strtolower($titre);
    $mots = preg_split('/[^A-Z^a-z^0-9]+/', $titre);

    $encoded = "";
    foreach ($mots as $mot) {
        if ($categorie == 0) {
            if (strlen($mot) >=3 OR str_replace(['0','1','2','3','4','5','6','7','8','9'], '', $mot) != $mot) {
                $encoded .= $mot.'-';
            }else{
                $encoded .= $mot.'-';
            }
        }

    }

        $encoded = substr($encoded,0,-1);
        return $encoded;
}


function url_custom_encode($titre,$categorie=0){
	$titre = htmlspecialchars($titre);
	$find =    array('é','à','-','%20','','');	
	$replace = array('e','a',' ','-','','');
	$titre = str_replace($find, $replace, $titre);
	$titre = strtolower($titre);
	$mots = preg_split('/[^A-Z^a-z^0-9]+/', $titre);

	$encoded = "";
	foreach ($mots as $mot) {
		if ($categorie == 0) {
			if (strlen($mot) >=3 OR str_replace(['0','1','2','3','4','5','6','7','8','9'], '', $mot) != $mot) {
				$encoded .= $mot.'-';
			}else{
				$encoded .= $mot.'-';
			}
		}

	}

		$encoded = substr($encoded,0,-1);
		return $encoded;
}


function derniere_reponse_categorie($id_categorie){
	global $bdd;
	$rep = $bdd->prepare("SELECT f_message.* FROM f_message LEFT JOIN f_topics_categorie ON f_topics_categorie.id_topic = f_message.id_topic WHERE f_topics_categorie.id_categorie= ? ORDER BY f_message.date_heure_post DESC LIMIT 0,1");
	$rep->execute(array($id_categorie));

	if($rep->rowCount() > 0){ 
		$rep = $rep->fetch();
		$dr = $rep['date_heure_post'];
		$dr .= '<br> de '.get_name($rep['id_posteur']);
	}
	else{
		$dr = "Aucune reponse..";
	}
	return $dr;
}

function derniere_reponse_topic($id_topic){
	global $bdd;
	$rep = $bdd->prepare("SELECT f_message.* FROM f_message LEFT JOIN f_topics ON f_topics.id = f_message.id_topic WHERE f_topics.id = ? ORDER BY f_message.date_heure_post DESC LIMIT 0,1");
	$rep->execute(array($id_topic));
	if($rep->rowCount() == 1){ 
		$rep = $rep->fetch();
		$dr = $rep['date_heure_post'];
		$dr .= '<br> de '.get_name($rep['id_posteur']);
	}
	else{
		$dr = "Aucun message";
	}
	return $dr;
}

function reponse_nbr_categorie($id_categorie){
	global $bdd;
	$nbr = $bdd->prepare("SELECT f_message.id FROM f_message LEFT JOIN f_topics_categorie ON f_topics_categorie.id_topic = f_message.id_topic WHERE f_topics_categorie.id_categorie= ?");
	$nbr->execute(array($id_categorie));
	return $nbr->rowCount();
}

function reponse_nbr_topic($id_topic){
	global $bdd;
	$nbr = $bdd->prepare("SELECT f_message.id FROM f_message LEFT JOIN f_topics ON f_topics.id = f_message.id_topic WHERE f_topics.id= ?");
	$nbr->execute(array($id_topic));
	return $nbr->rowCount();
}



// echo url_custom_encode('dédà','efd');

// echo truncate_text("bonjour le roi",13,0);








 ?>