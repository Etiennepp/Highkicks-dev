<!DOCTYPE html>

<html>
<head>
	<title>High Kicks</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="../menu-style.css">
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


!-->

<body>

	<?php include("../menu.php") ?>




	<div id="body-wrap">

<?php
    header( 'content-type: text/html; charset=utf8' );

try {
	$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    
	$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
    $bdd->exec('SET NAMES UTF8');

	$key_query = $bdd->prepare("SELECT forgot_pass_key FROM comptes WHERE Pseudo = '".$_GET['name']."'");
	$key_query -> execute();

	$key = $key_query -> fetch();

	if ($key[0]==$_GET['key'] && isset($_GET['key']) && isset($_GET['name'])) {?>
		<h2 id="reset_title">Réinitialisation du mot de passe</h2>
		<h3 id="reset_account">Compte : <b><?php echo $_GET['name'] ?></b></h3>


	<form method="post" action="reset.php" id="reset_pass">
		<label for="new_password">Nouveau mot de passe : </label>
		<input type="password" name="new_password" id="new_password"></input> <br/>
		<input type="hidden" name="psd" value="<?php echo $_GET['name'] ?>">
		<input type="submit" value="Changer le mot de passe" name="change_pass" id="submit_new_pass"></input>
	</form>

<?php


	} else if (!isset($_POST['change_pass'])) { ?>
		<p id="error_r">Erreur lors de la demande de réinitialisation ! Veuillez contacter les administrateurs si le problème persiste.</p>
	<?php }
}catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}

if (isset($_POST['change_pass'])) {
	$change_pass_query = $bdd->prepare("UPDATE comptes SET mdpasse='".md5($_POST['new_password'])."' WHERE Pseudo='".$_POST['psd']."'");
	$change_pass_query -> execute();

	$reset_key = $bdd ->prepare("UPDATE comptes SET forgot_pass_key='".bin2hex(openssl_random_pseudo_bytes(16))."' WHERE Pseudo='".$_POST['psd']."'");
	$reset_key -> execute(); 
	if ($change_pass_query && $reset_key) {?>
		<p id="res_success">Le mot de passe a bien été modifié !</p>
		<p id="countdown_redirect">Vous allez être redirigé vers la page d'accueil dans quelques instants...</p>
		<script type="text/javascript">
			window.setTimeout(function(){

	        	// Move to a new location or you can do something else
	        	window.location.href = "https://highkicks.fr";

	   		}, 3000);

		</script>
<?php } else { ?>
		<p id="error_r">Erreur lors de la demande de réinitialisation ! Veuillez contacter les administrateurs si le problème persiste.</p>

<?php }} ?>

	</div>
	
<?php include("../footer.php") ?>
</body>
</html>