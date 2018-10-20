<?php session_start();
if (isset($_GET['pay'])) {
	if (isset($_SESSION['connected_id'])) {
			header('Location: https://highkicks.fr/paypal2/payement.php');
	} else {
		$not_connected = true;
	}
}
?>

<!DOCTYPE html>

<html>

<head>

	<title>Panier</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<link rel="stylesheet" type="text/css" href="https://highkicks.fr/menu-style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="icon" href="../data/image/logo.png">

</head>

<!--================================================================================================





		 /$$   /$$ /$$           /$$             /$$   /$$ /$$           /$$                

		| $$  | $$|__/          | $$            | $$  /$$/|__/          | $$                

		| $$  | $$ /$$  /$$$$$$ | $$$$$$$       | $$ /$$/  /$$  /$$$$$$$| $$   /$$  /$$$$$$$

		| $$$$$$$$| $$ /$$__  $$| $$__  $$      | $$$$$/  | $$ /$$_____/| $$  /$$/ /$$_____/

		| $$__  $$| $$| $$  \ $$| $$  \ $$      | $$  $$  | $$| $$      | $$$$$$/ |  $$$$$$ 

		| $$  | $$| $$| $$  | $$| $$  | $$      | $$\  $$ | $$| $$      | $$_  $$  \____  $$

		| $$  | $$| $$|  $$$$$$$| $$  | $$      | $$ \  $$| $$|  $$$$$$$| $$ \  $$ /$$$$$$$/

		|__/  |__/|__/ \____  $$|__/  |__/      |__/  \__/|__/ \_______/|__/  \__/|_______/ 

		               /$$  \ $$                                                            

		              |  $$$$$$/                                                            

		               \______/                                                             

====================================================================================================





								  _____            _           
								 |  __ \          (_)          
								 | |__) |_ _ _ __  _  ___ _ __ 
								 |  ___/ _` | '_ \| |/ _ \ '__|
								 | |  | (_| | | | | |  __/ |   
								 |_|   \__,_|_| |_|_|\___|_|   





================================ W E L C O M E   D E V' ========================================!-->

<body>

	<?php

		try {

			$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    

			$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);

		    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);

		    $bdd->exec('SET NAMES utf8');



		    $query_articles = $bdd->prepare("SELECT * FROM Articles");

		    $query_articles -> execute();

		    $articles = $query_articles -> fetchAll();



		    $get_id_query = $bdd->prepare("SELECT id FROM Articles");

		    $get_id_query -> execute();

		    $ids = $get_id_query -> fetchAll();

		}

		catch(Exception $e) {

		    echo 'Exception -> ';

		    var_dump($e->getMessage());

		}

	?>







<?php

error_reporting(0);

include_once("fonctions-panier.php");

creationPanier();



$erreur = false;



$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;

if($action !== null)

{

   if(!in_array($action,array('ajout', 'suppression', 'refresh')))

   $erreur=true;



   //récuperation des variables en POST ou GET

   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;

   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;

   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;



   //Suppression des espaces verticaux

   $l = preg_replace('#\v#', '',$l);

   //On verifie que $p soit un float

   $p = floatval($p);



   //On traite $q qui peut etre un entier simple ou un tableau d'entier

    

   if (is_array($q)){

      $QteArticle = array();

      $i=0;

      foreach ($q as $contenu){

         $QteArticle[$i++] = intval($contenu);

      }

   }

   else

   $q = intval($q);

    

}



if (!$erreur){

   switch($action){

      Case "ajout":

         ajouterArticle($l,$q,$p);

         break;



      Case "suppression":

         supprimerArticle($l);

         break;



      Case "refresh" :

         for ($i = 0 ; $i < count($QteArticle) ; $i++)

         {

            modifierQTeArticle($_SESSION['panier']['id'][$i],round($QteArticle[$i]));

         }

         break;



      Default:

         break;

   }

} ?>

<?php include '../menu.php'; ?>



	<div id="body-wrap">

		<h2 id="title-panier">PANIER</h2>





		<?php 		

			if (!empty($_SESSION['panier']['id'])) {

				$total = 0;?>



			<table id="tablePanier" cellpadding=15 rules=rows >

				<thead>

					<th>Article</th>

					<th>Prix</th>

					<th>Taille</th>

					<th>Quantité</th>

					<th>Action</th>

				</thead>



				<tr></tr>

				<?php

				if (creationPanier())

				{

				   foreach ($_SESSION['panier']['id'] as $panier) { 

				   		$get_id_tmp = $bdd->prepare("SELECT * FROM Articles WHERE id=".$panier." LIMIT 1");

		    			$get_id_tmp -> execute();

		    			$id_tmp3 = $get_id_tmp->fetch();

		    			$id_tmp2= array_search($panier, $_SESSION['panier']['id']);

				   		



				   		$total+= $id_tmp3['prix']*floatval($_SESSION['panier']['qteProduit'][$id_tmp2]);



				   ?>

				   	<tr>

				   		<td onclick="location.href='https://highkicks.fr/article/?id=<?php echo $panier?>'" class="nomprod"><?php echo $id_tmp3['nom'];?></td>

				   		<td class="prix"><?php echo number_format($id_tmp3['prix']*floatval($_SESSION['panier']['qteProduit'][$id_tmp2]), 2, ',', ' ')?>€ (<?php echo number_format(floatval($id_tmp3['prix']), 2, ',', ' ')?>€ / unité)</td>

				   		<td class="tailles_panier"><?php echo $_SESSION['panier']['taille'][$id_tmp2];?></td>

				   		<td>
				   			
				   			<select class="quantity" data-related='<?php echo $panier?>'>
				   				<option value="1">1</option>
				   				<option value="2">2</option>
				   				<option value="3">3</option>
				   				<option value="4">4</option>
				   				<option value="5">5</option>
				   				<option value="6">6</option>
				   				<option value="7">7</option>
				   				<option value="8">8</option>
				   				<option value="9">9</option>
				   				<option value="10">10</option>
				   			</select>

				   			
				   				
				   		</td>

				   		<td><a class="suppr" href="https://highkicks.fr/panier/?action=suppression&l=<?php echo $panier;?>">Supprimer</a></td>

				   	</tr>

				   	<script type="text/javascript">
				   		$('.quantity').last().val(<?php echo $_SESSION['panier']['qteProduit'][$id_tmp2]?>);
				   	</script>

				   <?php } ?>

			</table>

			<div id="test">

				<p id="total">Total : <?php echo number_format($total, 2, ',', ' ');?> €</p>

				<div id="payement">

					<img src="https://highkicks.fr/data/image/paypallogo.png">

				</div>

			</div>

				

				

				<?php }

				?>



			







		<?php } else {?>

			<p id="empty_basket">Votre panier est vide, vous pouvez ajoutez des articles dans <a href="https://highkicks.fr/boutique">la boutique</a>.</p>

		<?php } ?>



	</div>

	<?php include("../footer.php") ?>

<script type="text/javascript">
	$('.quantity').change(function(){
		var quantity = $(this).val();
		var related = $(this).attr('data-related');

		var data = [quantity, related];
		$.ajax({
		    type: 'post',
		    url: 'modify_quantity.php',
		    data: {"quantity": quantity, "related": related},
	        success: function (data) {
				
	        	location.reload(true);
			}

		})
	});

	$('#payement').click(function(){
		location.href="https://highkicks.fr/panier/?pay=p";

	});

	<?php if ($not_connected) {
		echo "alert('Connectez vous pour procéder au paiement !');";
	} ?>

</script>

</body>

</html>