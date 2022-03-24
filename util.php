<?php 
if (isset($_SESSION['user_admin']) AND $_SESSION['user_admin'] == 1) {
	$merci_gims;
}
else{
	echo "non";
}

 ?>