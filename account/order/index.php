<?php session_start(); ?>

<!DOCTYPE html>

<html>x

<head>

	<title>High Kicks</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<link rel="stylesheet" type="text/css" href="../../menu-style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



	<link rel="icon" href="https://highkicks.fr/data/image/logo.png">

	 <META NAME="Description" CONTENT="Venez acheter et vendre vos produits sur highkicks.fr ! Highkicks vous propose une large selection de produits : Sneakers, Top, Bottom...">

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





================================================================================================!-->





<body>



	

	<?php

	if (!isset($_SESSION['connected_id'])) { ?>

	 	<script type="text/javascript">

window.location.href = 'https://highkicks.fr/';

</script>

	<?php  } 

	include("../../menu.php");

	try {

	$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]"); 

	$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);

    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);

    $bdd->exec('SET NAMES utf8');


    $account_details_query = $bdd-> prepare('SELECT * FROM comptes WHERE id=:id');
    $account_details_query->execute(array(':id'=>$_SESSION['connected_id']));

    $account_details = $account_details_query -> fetch();

    $buyer = $account_details['Prenom'].' '.$account_details['Nom'];

    $select_orders = $bdd -> prepare('SELECT * FROM commandes WHERE acheteur=:buyer');
	$select_orders -> bindValue(':buyer', $buyer, PDO::PARAM_STR);

	$select_orders -> execute();

	}

	catch(Exception $e) {

	}; ?>







	<div id="body-wrap">



		<h2 id="title-order">Mes commandes</h2>



		<span id="usr-tips">Retrouvez ici le récapitulatif de vos commandes</span>



<?php

	if ($select_orders->rowCount() == 0) { ?>

		<p id="usr-notif-empty">Vous n'avez encore jamais effectué de commande sur HighKicks. Commandez des articles dès maintenant sur la <a href="https://highkicks.fr/boutique/" id="redirect-shop">boutique</a> !</p>

	<?php } else { ?>
		 <table style="width:90%" id="order-recap-table">
		 	<tr>
		 		<th>Produit(s)</th>
		 		<th>Montant</th>
		 		<th>Livraison</th>
		 		<th>Facture</th>
		 	</tr>


		 	<?php while ($order = $select_orders->fetch()) { 

		 		$order_details_query = $bdd->prepare('SELECT * FROM details_commandes WHERE no_commande_associee=:no_commande');
		 		$order_details_query -> execute(array(":no_commande" => $order['id_commande']));
		 		$order_detail = $order_details_query->fetchAll();

		 		$splited_adress = preg_split('~\s+(?=[0-9]{5})~', $order['adresse']);

		 		$names = array();

		 		foreach (array_column($order_detail, 'article_id') as $detail) {
		 			$get_article_name = $bdd->prepare('SELECT nom  FROM Articles WHERE id=:id_art');
		 			$get_article_name->execute(array(":id_art" => $detail));

		 			$names[] = $get_article_name-> fetch()[0];
		 		};
		 		?>
		 		<tr>
		 			<td><?php foreach ($names as $name) {echo $name; echo "<br/>"; } ?></td>
		 			<td><?php echo $order['montant']; ?></td>
		 			<td><?php echo $splited_adress[0]; ?><br/><?php echo $splited_adress[1]; ?></td>
		 			<td><a href="<?php ?>">Télécharger la facture</a></td>
		 		</tr>
		 	<?php } ?>


		 </table> 



	<?php }

	?>

	</div>

	

<?php include("../footer.php") ?>

</body>

</html>