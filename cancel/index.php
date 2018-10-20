<?php
session_start();
include_once("../panier/fonctions-panier.php");
creationPanier();
if ($_SESSION['panier']['verrou']!=true){?>
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


								   _____                     _ 
								  / ____|                   | |
								 | |     __ _ _ __   ___ ___| |
								 | |    / _` | '_ \ / __/ _ \ |
								 | |___| (_| | | | | (_|  __/ |
								  \_____\__,_|_| |_|\___\___|_|
                               
                               

================================ W E L C O M E   D E V' ========================================!-->

<body>
<?php require("../phptopdf/index.php");?>

<?php 
include ('../menu.php');  
if (isset($_GET['token'])) {

	$erreur = $_GET['token'];
} else {
	$erreur = "0000AAAA";
};
?>

	<div id="body-wrap">
		<h3><br/>Votre payement PayPal a été annulé.<br/>
		<br/><a href="https://highkicks.fr/" id="to_home">Retourner à l'accueil</a></h3>
	</div>
		

<?php include("../footer.php") ?>
</body>
</html>
<?php } else {
    header("Location: https://highkicks.fr");
}

?>