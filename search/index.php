<!DOCTYPE html>
<html>
<head>
	<title>High Kicks</title>
	<link rel="stylesheet" type="text/css" href="./style.css">
	<link rel="stylesheet" type="text/css" href="../menu-style.css">
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


							                _   _      _      
							     /\        | | (_)    | |     
							    /  \   _ __| |_ _  ___| | ___ 
							   / /\ \ | '__| __| |/ __| |/ _ \
							  / ____ \| |  | |_| | (__| |  __/
							 /_/    \_\_|   \__|_|\___|_|\___|



================================ W E L C O M E   D E V' ========================================!-->
<body>
<?php 
include("../menu.php");
include_once("../panier/fonctions-panier.php");
if (isset($_GET['action'])) {
	if ($_GET['action']=='add') {
		creationPanier();
		ajouterArticle($_GET['id'],1);
		modifierTaille($_GET['id'], $_GET['taille']);
        echo "<script type='text/javascript'>document.location.replace('https://highkicks.fr/article/?id=".$_GET['id']."');</script>";		
	}
	
}

try {
		$istry = true;
		$Id = $_GET['id'];


		$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    
		$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
	    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
	    $bdd->exec('SET NAMES utf8');

	    $query_select_articles = $bdd->query("SELECT * FROM Articles WHERE id=".$Id."");
	    $article = $query_select_articles -> fetch();
	    

	    if (empty($article)) {

	    	$istry = false;
	    };
	}
	catch(Exception $e) {
	    
	};

	if ($istry){
		$prix = $article['prix'];
		$nom = $article['nom'];
		$description = $article['description'];
		$txtsize = $article['tailles'];
		
		if($article['image1'] != ''){
			$image1 = $article['image1'];
		}else{
			$image1 = "noir.png";
		} ;
		if($article['image2'] != ''){
			$image2 = $article['image2'];
		}else{
			$image2 = "noir.png";
		} ;
		if($article['image3'] != ''){
			$image3 = $article['image3'];
		}else{
			$image3 = "noir.png";
		} ;
		
		
		
	};
	if(!$istry){
		$prix = "0";
		$nom = "plus disponible";
		$description = "désolé ce produit n'est plus disponible !";
		$image1 = "noir.png";
		$image2 = "noir.png";
		$image3 = "noir.png";
	};

$size = explode("/", $txtsize);



?>

<div id="body-wrap">

		

		<div id="latest-arival">

			<h2 id="latest-arival-title"><?php echo $nom ?></h2>


			


		</div>
		<div id="indic-wrap">
		<div id="images-article">
			<img id="image-principal" src="../data/photo-articles/<?php echo $image1 ?>">
			<div id="sousimage">
			    <img id="image-1" class="article"  src="../data/photo-articles/<?php echo $image1 ?>">
        		<img id="image-2"  class="article" src="../data/photo-articles/<?php echo $image2 ?>">
        		<img id="image-3" class="article" src="../data/photo-articles/<?php echo $image3 ?>">

			</div>
        		
		</div>


		<div id="indication">
			
			<h2 class="indic-description" id="price"><?php echo $prix ?> €</h2>
			<h2 class="indic-description"> </h2>
			<h2 class="indic-description" id="description">  <?php echo $description ?></h2>
			
			<div id="wrap-product-info">
				
					<?php if ($size[0] != 'nosize') { ?>
					<select id="select-size" class="dropdown-select-shop" name="taille">
						<option value="" selected disabled hidden>Taille</option>
						<?php
						if ($article['type_article'] == 'top' || $article['type_article'] == 'bottom') {
							foreach (['XS','S', 'M', 'L', 'XL'] as $size_) { 
								?>
								<option value="<?php echo $size_?>" <?php if (!in_array($size_, $size)) {echo "disabled";}?>><?php echo $size_?><?php if (!in_array($size_, $size)) {echo " - Indisponible";}?></option>
								<?php
							}
						} else {
							foreach (['35','36','37','38','39','40', '41', '42', '43', '44', '45', '46', '47', '48'] as $size_) { 
								?>
								<option value="<?php echo $size_?>" <?php if (!in_array($size_, $size)) {echo "disabled";}?>>EU <?php echo $size_?><?php if (!in_array($size_, $size)) {echo " - Indisponible";}?></option>
								<?php
							}
						};
						?>
					</select> 
					<?php } ?>
				<div id="button">Ajouter au panier</div>

			</div>
			<p id="err_unvalid_size" style="display: none;">Veuillez sélectionner une taille !</p>
		</div>
		<div>

		</div>

		<script>
			$('#button').click(function(){

				<?php if ($size[0] != 'nosize' && $article['type_article'] == 'sneaks') { ?>

					if ($.isNumeric($('#select-size').val())) {


						$('#button').css('background-color', 'gray');
						$('#button').html('...');
						//location.href='https://highkicks.fr/article/?id='+<?php echo $_GET['id'];?>+'&action=add&taille='+$('#select-size').val();
						$.ajax({
							type: 'get',
							url: 'add_to_cart.php',
							data: 'article=<?php echo $_GET['id'];?>&size='+$('#select-size').val(),
							success: function (data) {

								if ($('#nb_article').html()!='') {
									$('#nb_article').html(String(parseInt($('#nb_article').html()) + 1));
								} else {
									$('#nb_article').show();
									$('#nb_article').text('1');
								};

								$('#button').css('background-color', 'green');
								$('#button').html('Ajouté !');
						$('#err_unvalid_size').css('display', 'none');
						$('#select-size').css('border', 'none');



							}

						});

					} else {
						$('#err_unvalid_size').css('display', 'block');
						$('#select-size').css('border', '2px solid red');
					}

				<?php } else if ($article['type_article'] == 'top' || $article['type_article'] == 'bottom') {  ?>

					if ($.inArray($('#select-size').val(), ['XS','S', 'M', 'L', 'XL']) != -1) {


						$('#button').css('background-color', 'gray');
						$('#button').html('...');
						$.ajax({
							type: 'get',
							url: 'add_to_cart.php',
							data: 'article=<?php echo $_GET['id'];?>&size='+$('#select-size').val(),
							success: function (data) {
								if ($('#nb_article').html()!='') {
									$('#nb_article').html(String(parseInt($('#nb_article').html()) + 1));
								} else {
									$('#nb_article').show();
									$('#nb_article').text('1');
								};

								$('#button').css('background-color', 'green');
								$('#button').html('Ajouté !');
						$('#err_unvalid_size').css('display', 'none');
						$('#select-size').css('border', 'none');
								

							}

						});
					}else {
						$('#err_unvalid_size').css('display', 'block');
						$('#select-size').css('border', '2px solid red');
					}

				<?php } else { ?>


					$('#button').css('background-color', 'gray');
					$('#button').html('...');
					$.ajax({
						type: 'get',
						url: 'add_to_cart.php',
						data: 'article=<?php echo $_GET['id'];?>&size=/',
						success: function (data) {


							if ($('#nb_article').html()!='') {
								$('#nb_article').html(String(parseInt($('#nb_article').html()) + 1));
							} else {
								$('#nb_article').show();
								$('#nb_article').text('1');
							};

								$('#button').css('background-color', 'green');
								$('#button').html('Ajouté !');
						$('#err_unvalid_size').css('display', 'none');
						$('#select-size').css('border', 'none');
						}

					});

				<?php } ?>

			});
		</script>
		
</div>







	</div>
	
	
	<script
			  src="http://code.jquery.com/jquery-2.2.4.js"
			  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
			  crossorigin="anonymous"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="slick-1.8.0/slick/slick.min.js"></script>

    <script>
        if("<?php echo $image3 ?>"=="noir.png"){
            $("#image-3").css('display', 'none');
            if("<?php echo $image2 ?>"=="noir.png"){
                 $("#image-2").css('display', 'none');
            
        }
        }
    </script>

<?php include("../footer.php") ?>
</body>



</html>