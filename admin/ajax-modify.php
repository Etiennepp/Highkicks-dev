<?php
	
	$new_price = $_POST['prix'];
	$new_name = $_POST['name'];
	$new_type = $_POST['type-art'];
	$new_sizes = $_POST['newsizes'];
	$new_desc = $_POST['description'];

	$new_sizes_string = implode('/', $new_sizes);
try {
	$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]"); 
	$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
    $bdd->exec('SET NAMES utf8');

    $update_article = $bdd -> prepare("UPDATE Articles SET nom=:newnom, prix=:newprix, type_article=:newtype_article, description=:description, tailles=:tailles WHERE id=".$_POST['id']);
	$update_article -> bindValue(':newnom', $new_name, PDO::PARAM_STR);
	$update_article -> bindValue(':newprix', $new_price, PDO::PARAM_STR);
	$update_article -> bindValue(':newtype_article', $new_type, PDO::PARAM_STR);
	$update_article -> bindValue(':description', $new_desc, PDO::PARAM_STR);
	$update_article -> bindValue(':tailles', $new_sizes_string, PDO::PARAM_STR);

	$update_article -> execute();
	echo "success#".$new_sizes_string;

	}
	catch(Exception $e) {
	    echo "error";
	};

?>