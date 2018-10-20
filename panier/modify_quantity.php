<?php
session_start();
$new_qte = $_POST['quantity'];
$related = $_POST['related'];
include_once("fonctions-panier.php");
if (is_numeric($new_qte) && $new_qte < 11 ) {
	if (intval($new_qte)==$new_qte) {
		modifierQTeArticle($related, $new_qte);
	};
	
};
?>