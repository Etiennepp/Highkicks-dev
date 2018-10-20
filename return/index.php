<?php
session_start();
if (!isset($_SESSION['connected_id']) || !isset($_SESSION['panier']) || !isset($_GET['PayerId'])) {
	header('Location: https://highkicks.fr/');
}
require '../paypal2/vendor/autoload.php';
$ids = require('../paypal2/paypal.php');


$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $ids['id'],
        $ids['secret']
    )
);
$apiContext->setConfig(
            array(
                'mode' => 'live'
            )
    );
$payment = \PayPal\Api\Payment::get($_GET['paymentId'], $apiContext);

$execution = (new \PayPal\Api\PaymentExecution());

$execution -> setPayerId($_GET['PayerID']);


try {
    $payment->execute($execution, $apiContext);

?>
<!DOCTYPE html>

<html>
<head>
	<title>High Kicks</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<link rel="stylesheet" type="text/css" href="../menu-style.css">
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


							  _____      _                    
							 |  __ \    | |                   
							 | |__) |___| |_ _   _ _ __ _ __  
							 |  _  // _ \ __| | | | '__| '_ \ 
							 | | \ \  __/ |_| |_| | |  | | | |
							 |_|  \_\___|\__|\__,_|_|  |_| |_|
                                  


================================ W E L C O M E   D E V' ========================================!-->
<body>






<?php $_SESSION['panier']['verrou']=true ?>
<?php
$panier_recap=array();
$arr2='';
try {
	$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    
	$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
    $bdd->exec('SET NAMES utf8');
    $query_mail = $bdd->prepare("SELECT mail FROM comptes WHERE id = '".$_SESSION['connected_id']."'");
    $query_mail -> execute();
	$mail = $query_mail -> fetch();

	$get_name = $bdd->prepare("SELECT * FROM comptes WHERE id = ?");
    $get_name -> execute(array($_SESSION['connected_id']));
	$coordonnees = $get_name -> fetch();

	$query_articles = $bdd->prepare("SELECT * FROM Articles");
    $query_articles -> execute();
	$articles = $query_articles -> fetchAll();


	foreach ($_SESSION['panier']['id'] as $panier) {
		$query_articles_recap = $bdd->prepare("SELECT * FROM Articles WHERE id=:id");
    	$query_articles_recap -> execute(array(':id' => $panier));
		$articles_recap = $query_articles_recap -> fetch();	

		$array_tmp=array();
		$id_tmp = array_search($panier, $_SESSION['panier']['id']);
		$id_bdd = array_search($panier, $articles['id']);
		//print_r($id_bdd);

		$qte= $_SESSION['panier']['qteProduit'][$id_tmp];

		$total+= floatval($articles_recap[1])*intval($qte);

		$array_tmp[]= $articles_recap[0];	
		$array_tmp[]=number_format(strval($articles_recap[1]), 2, ',', ' ')." EUR";
		$array_tmp[]=strval($qte);	
		$array_tmp[]=$_SESSION['panier']['taille'][$id_tmp];
		$array_tmp[]=strval("/");	
		$array_tmp[]=number_format(strval(intval($qte)*$articles_recap[1]), 2, ',',' ')." EUR";
		//print_r($array_tmp);

		$panier_recap[]=$array_tmp;


	}
	date_default_timezone_set('Europe/Paris');
	$insert_commande = $bdd->prepare("INSERT INTO commandes (vendeur, acheteur, adresse, date_commande, montant) VALUES (:vendeur, :acheteur, :adresse, :date_commande, :montant)");
	
	$acheteur = $coordonnees[0] . " " . $coordonnees[1];

	$insert_commande -> execute(array(
		':vendeur' => 'Highkicks',
		':acheteur' => $acheteur,
		':adresse' => $coordonnees['adresse'],
		':date_commande' => date("Y-m-d H:i:s"),
		':montant' => $total));

	$id = $bdd->lastInsertId();

	$no_commande = date("Ymd").$id;

	$updt_no_order = $bdd->prepare("UPDATE commandes SET id_commande=:id_commande WHERE id=:id");
	$updt_no_order->execute(array(
		':id_commande'=>$no_commande,
		':id' => $id));

	require("../phptopdf/index.php");

	foreach ($panier_recap as $panier) {

		$id_tmp = array_search($panier, $panier_recap);
		$id_article = $_SESSION['panier']['id'][$id_tmp];

		$details_commande = $bdd->prepare('INSERT INTO details_commandes (article_id, prix, quantite, no_commande_associee) VALUES (:article_id, :prix, :quantite, :no_commande_associee)');
		$details_commande ->execute(
			array(':article_id' => $id_article, 
				':prix' => $panier[1], 
				':quantite' => $panier[2], 
				':no_commande_associee' => $no_commande));


	
	}

	$updt_fac_path = $bdd->prepare("UPDATE commandes SET facture=:facture WHERE id=:id");
	$updt_no_order->execute(array(
		':id_commande'=>$no_commande,
		':id' => $id));
	require("sendmail.php");



	unset($_SESSION['panier']);


}


catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}


include("../menu.php");

?>
	<div id="body-wrap">
		<h1 id="thk-retrn">Merci !</h1>
		<h3>Toute l'équipe High Kicks vous remercie pour votre achat. Nous vous souhaitons une bonne reception. 
		<br/><br/> Vous pouvez télécharger votre facture en cliquant <a href="https://highkicks.fr/data/commandes/resume/<?php echo $_SESSION['connected_id']?>/<?php echo $filename?>" target="_blank">ici</a>.
		<br/><br/> Cette facture vous a été envoyé par mail.
		<br/><br/> En cas de problème, merci de contacter le service après vente : sav@highkicks.fr.
		</h3> 


	</div>



<?php include("../footer.php");?>
</body>



</html>


<?php 
} catch (\PayPal\Exception\PayPalConnectionException $e) {
    header('HTTP 500 Internal Server Error', true, 500);
    var_dump(json_decode($e->getData()));
}
?>