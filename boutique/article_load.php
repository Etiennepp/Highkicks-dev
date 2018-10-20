<?php
header( 'content-type: text/html; charset=utf-8' );

	$ord_val = 'ORDER BY id DESC';
	if (isset($_GET['ord'])) {
		switch($_GET['ord']) {
			case 'def':
				$ord_val = 'ORDER BY id DESC';
			break;

			case 'asc':
				$ord_val = 'ORDER BY prix ASC';
			break;

			case 'desc':
				$ord_val = 'ORDER BY prix DESC';
			break;
		}
	}
	if (isset($_GET['type'])) {
		if ($_GET['type']!="all") {

		try {
				$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    
				$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
			    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
			    $bdd->exec('SET NAMES utf8');

			    $query_select_articles = $bdd->query("SELECT * FROM Articles WHERE type_article='".$_GET['type']."' ".$ord_val."");
			}
			catch(Exception $e) {
			    echo 'Exception -> ';
			    var_dump($e->getMessage());
			};
		}
		else {
			try {
			$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    
			$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
		    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
		    $bdd->exec('SET NAMES utf8');

		    $query_select_articles = $bdd->query("SELECT * FROM Articles ".$ord_val."");
		}
		catch(Exception $e) {
		    echo 'Exception -> ';
		    var_dump($e->getMessage());
		};
		}

	} else {

		try {
			$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    
			$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
		    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
		    $bdd->exec('SET NAMES utf8');

		    $query_select_articles = $bdd->query("SELECT * FROM Articles ".$ord_val."");
		}
		catch(Exception $e) {
		    echo 'Exception -> ';
		    var_dump($e->getMessage());
		};
	}
?>

<?php
if ($query_select_articles->rowCount() > 0) {
while($articles = $query_select_articles -> fetch()) { ?>

			<article onclick="location.href='../article/?id=<?php echo $articles['id'] ?>'" data-loading="loading">
				<div class="thumbnail">
					<img data-src="https://highkicks.fr/data/photo-articles/<?php echo $articles['image1']?>" class="article-thumbnail">
				</div>
				<span class="article-name"><?php echo $articles['nom']?></span>
				<span class="article-brand"><?php echo $articles['marque']?></span>
				<span class="price"><?php echo $articles['prix']?>€</span>
			</article>

<?php }} else {?>

			<p id="no_article_found" style="color: white; font-family:'Roboto-M'; text-align:center; display:block; margin:auto; margin-bottom: 20px">Aucun article trouvé</p>

 <?php } ?>