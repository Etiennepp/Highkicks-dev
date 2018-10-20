<!DOCTYPE html>
<html>
<head>
	<title>Marketplace</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="../menu-style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="slick-1.8.0/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="slick-1.8.0/slick/slick-theme.css"/>
	<link rel="icon" type="image/png" sizes="196x196" href="bg.png">
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


					  __  __            _        _         _                
					 |  \/  |          | |      | |       | |               
					 | \  / | __ _ _ __| | _____| |_ _ __ | | __ _  ___ ___ 
					 | |\/| |/ _` | '__| |/ / _ \ __| '_ \| |/ _` |/ __/ _ \
					 | |  | | (_| | |  |   <  __/ |_| |_) | | (_| | (_|  __/
					 |_|  |_|\__,_|_|  |_|\_\___|\__| .__/|_|\__,_|\___\___|
					                                | |                     
					                                |_|                     


================================ W E L C O M E   D E V' ========================================!-->

<body>
	<?php include '../menu.php'; 
	?>

	<div id="body-wrap">
		<h2 id="title-marketplace">MARKETPLACE</h2>
		<a href="https://highkicks.fr/marketplace/add/" id="add-article">> Ajoutez votre article !</a>

		<div id="shop-menu">
			<div id="categories-wrap">
				<h2>Catégories : </h2>	
				<select id="select-type" class="dropdown-select-shop">
					 <option value="all">Tous</option>
					 <option value="shoes">Chaussures</option>
					 <option value="tshirts">T-shirts</option>
					 <option value="jackets">Vestes</option>
					 <option value="other">Autres...</option>
				</select> 
			</div>

			<div id="order-by-wrap">
				<h2>Trier par : </h2>	
				 <select id="select-order-by" class="dropdown-select-shop">
					 <option value="def">Les plus récents</option>
					 <option value="desc">Prix décroissants</option>
					 <option value="asc">Prix croissants</option>
				</select> 
			</div>
		</div>










	</div>
</body>
<?php include("../footer.php") ?>
</html>