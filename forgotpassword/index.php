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


====================================================================================================



						                                  _ _ 
							     /\                      (_) |
							    /  \   ___ ___ _   _  ___ _| |
							   / /\ \ / __/ __| | | |/ _ \ | |
							  / ____ \ (_| (__| |_| |  __/ | |
							 /_/    \_\___\___|\__,_|\___|_|_|


================================ W E L C O M E   D E V' ========================================!-->


<body>

	
	<?php include("../menu.php") ?>




	<div id="body-wrap">

		<h2 id="title-forgot">MOT DE PASSE OUBLIÉ</h2>
		<br/>
		<p id="info-forgot">Entrez votre nom d'utilisateur et un lien de réinitialisation de mot de passe sera envoyé sur l'adresse mail associée à ce compte.</p> <br/>
		<form method="post" action="request.php">	
			<label for="pseudo_fg" id="psd_lbl">Nom d'utilisateur :</label>
			<input type="text" name="pseudo" id="pseudo_fp"></input> 
			<br/>
			<?php if (isset($_GET['error'])) { if ($_GET['error']="not_found"){?>
				<p id="not_found">Ce pseudo n'éxiste pas !</p>
		<?php }}?>
			<input type="submit" name="sub_fpass" value="Réinitialiser le mot de passe" id="sub_fpass" />
		</form>


	</div>
	
<?php include("../footer.php") ?>
</body>
</html>