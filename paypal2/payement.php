<?php
session_start();
$qt=0;
	try {
		$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]"); 
		$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
	    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
	    $bdd->exec('SET NAMES utf8');

	    
	}
	catch(Exception $e) {
	    echo 'Exception -> ';
	    var_dump($e->getMessage());
	};


require 'vendor/autoload.php';

use \PayPal\Rest\ApiContext;
use \PayPal\Auth\OAuthTokenCredential;
use \PayPal\Api\Payment;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payer;
use \PayPal\Api\ItemList;
use \PayPal\Api\Item;
use \PayPal\Api\Amount;
use \PayPal\Api\Details;
use \PayPal\Api\Transaction;
use \PayPal\Exception\PayPalConnectionException;

$ids = require('paypal.php');
$prix = 0;




$apiContext = new ApiContext(
	new OAuthTokenCredential(
		$ids['id'],
		$ids['secret']
	)
);

$apiContext->setConfig(
            array(
                'mode' => 'live'
            )
    );






$list = new ItemList();

foreach ($_SESSION['panier']['id'] as $articleid){
	$article_info_query = $bdd->prepare("SELECT * FROM Articles WHERE id = '".$articleid."'");
	$article_info_query -> execute();
	$AArticle = $article_info_query -> fetch();
	
    $item = (new Item())
	->setName($AArticle[0])
	->setPrice($AArticle[1])
	->setCurrency('EUR')
	->setQuantity($_SESSION['panier']['qteProduit'][$qt]);

	$prix += $AArticle[1]*$_SESSION['panier']['qteProduit'][$qt];
	
	$list->addItem($item);

	$qt = $qt+1;
}


$details = (new Details())
	->setSubtotal($prix);

$amount = (new Amount())
	->setTotal($prix)
	->setCurrency('EUR')
	->setDetails($details);

$transaction = (new Transaction())
	->setItemList($list)
	->setAmount($amount)
	->setCustom('Paiement Highkicks');


$payment = new Payment();

$payment->setTransactions([$transaction]);

$payment->setIntent('sale');


$redirectUrls = (new RedirectUrls())
	->setReturnUrl('http://highkicks.fr/return')
	->setCancelUrl('http://highkicks.fr/cancel');

$payment->setRedirectUrls($redirectUrls);


$payer = (new Payer())
	->setPaymentMethod('paypal');

$payment->setPayer($payer);


try{

$payment->create($apiContext);
	




header('Location:' . $payment->getApprovalLink());

}catch (PayPalConnectionException $e) {
	var_dump(json_decode($e->getData()));
}

?>