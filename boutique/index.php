<!DOCTYPE html>

<html>

<head>

	<title>Boutique</title>

	<link rel="stylesheet" type="text/css" href="./style.css">

	<link rel="stylesheet" type="text/css" href="https://highkicks.fr/menu-style.css">

	<link rel="icon" href="../data/image/logo.png">

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

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



						  ____              _   _                  

						 |  _ \            | | (_)                 

						 | |_) | ___  _   _| |_ _  __ _ _   _  ___ 

						 |  _ < / _ \| | | | __| |/ _` | | | |/ _ \

						 | |_) | (_) | |_| | |_| | (_| | |_| |  __/

						 |____/ \___/ \__,_|\__|_|\__, |\__,_|\___|

						                             | |           

						                             |_|           





================================ W E L C O M E   D E V' ========================================!-->

<body>



	<?php include '../menu.php'; ?>





	<div id="body-wrap">

		<h2 id="title-boutique">BOUTIQUE</h2>



		<div id="shop-menu">

			<div id="categories-wrap">

				<h2>Catégories : </h2>	

				<select id="select-type" class="dropdown-select-shop">

					 <option value="all">Tous</option>

					 <option value="sneaks">Sneakers</option>

					 <option value="top">Top</option>

					 <option value="bottom">Bottom</option>

					 <option value="accessories">Accessoires</option>

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



	<div id="article-wrap">



	</div>

</div>

<script type="text/javascript">
	
	$("#article-wrap").append("<img src='loading.gif' id='loading-shop'/>");
	$("#article-wrap").load("article_load.php", function() {
		$('.article-thumbnail').each(function() {
			$(this).attr('src', $(this).attr('data-src'));
			$(this).load(function() {
			$(this).parent().parent().removeAttr('data-loading');
			});
		});
	}); 



	$ord_val = $('#select-order-by').val();



	$(document).on('change','#select-type',function(){

		$("#article-wrap").empty();
		$("#article-wrap").append("<img src='loading.gif' id='loading-shop'/>");


			$type_val = $('#select-type').val();

			$("#article-wrap").load("article_load.php?type="+$type_val+"&ord="+$ord_val, function() {
		$('.article-thumbnail').each(function() {
			$(this).attr('src', $(this).attr('data-src'));
			$(this).load(function() {
			$(this).parent().parent().removeAttr('data-loading');
			});
		});
	}); 

});

	$(document).on('change','#select-order-by',function(){

		$ord_val = $('#select-order-by').val();		

		$("#article-wrap").empty();
		$("#article-wrap").append("<img src='loading.gif' id='loading-shop'/>");


			$type_val = $('#select-type').val();

		$("#article-wrap").load("article_load.php?type="+$type_val+"&ord="+$ord_val, function() {
		$('.article-thumbnail').each(function() {
			$(this).attr('src', $(this).attr('data-src'));
			$(this).load(function() {
			$(this).parent().parent().removeAttr('data-loading');
			});
		});
	}); 



});



</script>



<?php include("../footer.php") ?>

</body>



</html>