<?php

session_start();
	try {
		$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]"); 
		$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
	    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
	    $bdd->exec('SET NAMES utf8');

	    $query_select_articles = $bdd->query("SELECT * FROM Articles WHERE id=5");
	    $article = $query_select_articles -> fetch();
	}
	catch(Exception $e) {
	    echo 'Exception -> ';
	    var_dump($e->getMessage());
	};


use \PayPal\Api\PaymentExecution;
use \PayPal\Rest\ApiContext;
use \PayPal\Auth\OAuthTokenCredential;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payer;
use \PayPal\Api\ItemList;
use \PayPal\Api\Item;
use \PayPal\Api\Amount;
use \PayPal\Api\Details;
use \PayPal\Api\Transaction;
use \PayPal\Exception\PayPalConnectionException;

require 'vendor/autoload.php';

$ids = require('paypal.php');

$apiContext = new ApiContext(
	new OAuthTokenCredential(
		$ids['id'],
		$ids['secret']
	)
);

$payment = \PayPal\Api\Payment::get($_GET['paymentId'], $apiContext);



$execution = (new PaymentExecution())
	->setPayerId($_GET['PayerID'])
	->setTransactions($payment->getTransactions());


try {
	$payment->execute($execution, $apiContext);
	var_dump($payment->getTransactions()[0]->getCustom());
	var_dump($payment);
}catch (PayPalConnectionException $e) {
	var_dump(json_decode($e->getData()));
}
