<!DOCTYPE html>



<html lang="fr">

<head>

	<title>High Kicks - We have your kicks !</title>

	<link rel="stylesheet" type="text/css" href="style.css">

	<link rel="stylesheet" type="text/css" href="menu-style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" type="text/css" href="slick-1.8.0/slick/slick.css"/>

	<link rel="stylesheet" type="text/css" href="slick-1.8.0/slick/slick-theme.css"/>

	<link rel="icon" href="data/image/logo.png">

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



	<?php

	try {

		$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    

		$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);

	    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);

	    $bdd->exec('SET NAMES UTF8');







	    $query_articles = $bdd->query("SELECT * FROM Articles ORDER BY id DESC LIMIT 10");

	    $nb_articles_query = $bdd->query("SELECT COUNT(*) FROM Articles");

	    $nb_articles = $nb_articles_query ->fetch();



	}

	catch(Exception $e) {

	    echo 'Exception -> ';

	    var_dump($e->getMessage());

	}

	?>

	<?php include("menu.php") ?>









	<div id="body-wrap">

		<div id="latest-arival">

			<h2 id="latest-arival-title">Nouveaux produits</h2>

			<div id="article-wrap" class="article-wrap">



			<?php while($articles = $query_articles -> fetch()) { ?>



				<article onclick="location.href='https://highkicks.fr/article/?id=<?php echo $articles['id']?>'">
					<div class="thumbnail" >
						<img alt="" src="/data/photo-articles/<?php echo $articles['image1']?>" class="article-thumbnail" >
					</div>
					<span class="article-name"><?php echo $articles['nom']?></span>
					<span class="article-brand"><?php echo $articles['marque']?></span>
					<span class="price"><?php echo number_format($articles['prix'],2,',', ' ')?>€</span>
				</article>

			<?php }; ?>
				

			</div>



			<div id="shop-link-wrap">

 				<a href="https://highkicks.fr/boutique/" id="link-shop">Voir tous les articles</a>

			</div>

				



		</div>


	</div>

	<script

			  src="https://code.jquery.com/jquery-2.2.4.js"

			  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="

			  crossorigin="anonymous"></script>

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<script src="slick-1.8.0/slick/slick.min.js"></script>

	

	<script>

	$(document).ready(function(){

<?php if ($nb_articles[0]>4) {?>

  $('.article-wrap').slick({

    slidesToShow: 4,

  slidesToScroll: 1,

  autoplay: true,

  autoplaySpeed: 3000,

  });

});

<?php }; ?>



	</script>



<?php include("footer.php") ?>

</body>

</html>