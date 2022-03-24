<?php 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_menbre','root','');
$article = $bdd->query("SELECT * FROM article ORDER BY date_time_publication DESC");

 ?>



  <!DOCTYPE html>
 <html>
 <head>
 	<title>article</title>
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 	<style type="text/css">
 		p{
 			letter-spacing: 4px;
 			text-transform: uppercase;
 		}

 	</style>
 </head>
 <body style="background: #eee;"><br><br>
 	<div class="container">
 		<?php if (isset($erreur)) {
 			echo "<p class = \"alert alert-danger\"><font color = \"red\">".$erreur."</font></p>";
 		} ?>

 		<?php if (isset($reussie)) {
 			echo "<p class = \"alert alert-link\"><font color = \"green\">".$reussie."</font></p>";
 		} ?>
 	</div>
 	<table border="7" class="container table">
 		<th>ARTICLES</th>
<?php while($a = $article->fetch()) {  ?>
<tr>
	<td><a href="publication.php?id=<?= $a['id']?>"><?= $a['titre']?></a></td>
</tr>
<?php } ?>
</table>
 </body>
 </html>