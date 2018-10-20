<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="admin-style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/set2.css"/>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />

	<link rel="stylesheet" type="text/css" href="css/demo.css" />

	<link rel="icon" href="../data/image/logo.png">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://highkicks.fr/jquery-bar-rating-master/dist/themes/bars-pill.css">



    <link href="http://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet" type="text/css">
</head>
<body>
<?php header( 'content-type: text/html; charset=utf-8' );?>

<h1 id="titre-admin">ADMINISTRATION</h1>

<?php
session_start();
header( 'content-type: text/html; charset=utf-8' );


try {
	$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]"); 
	$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
    $bdd->exec('SET NAMES utf8');
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
};
?>




<?php if (isset($_GET['action'])) {   
	if ($_GET['action']=='add') { //===============================================================================================?>

<h2 id="title-add" class="action-title">AJOUTER UN ARTICLE</h2>

	<button id="retour-button" onclick="window.location.href = 'https://highkicks.fr/admin/index.php';">RETOUR</button>




<form class="content" method="post" action="index.php" enctype="multipart/form-data">
<br/>
				<span class="input input--yoshiko">
					<input class="input__field input__field--yoshiko" type="text" id="input-11" name="nom" required="true"/>
					<label class="input__label input__label--yoshiko" for="input-11">
						<span class="input__label-content input__label-content--yoshiko" data-content="Nom de l'article">Nom de l'article</span>
					</label>
				</span>
<br/>
				<span class="input input--yoshiko">
					<input class="input__field input__field--yoshiko" type="number" id="input-11" name="prix" required="true" step="0.01" />
					<label class="input__label input__label--yoshiko" for="input-11">
						<span class="input__label-content input__label-content--yoshiko" data-content="Prix">Prix</span>
					</label>
				</span>
<br/>
				<select id="select-type" class="dropdown-select-shop" name="type">
					<option value="" selected disabled hidden>Type d'article</option>
					<option value="sneaks">Sneakers</option>
					<option value="top">Top</option>
					<option value="bottom">Bottom</option>
					<option value="accessories">Accessoires</option>
				</select> 
<br/>
<br/>
				<select id="brand-selector" class="dropdown-select-shop" name="marque">
					<option value="" selected disabled>Marque - Choisissez un type de produit</option>
				</select> 
<br/>
				<p id="choose-sizes" class="subtitles">Tailles disponibles</p>

				<div id="radio-sizes-container">
					<p>Sélectionnez un type de produit</p>
				</div>
<br/>
				<p id="desc" class="subtitles">Description</p>
				<div id="textarea-wrap">
					<textarea name="description"></textarea>
				</div>
<br/>

				<p id="aj-phot" class="subtitles">Condition du produit</p>

				<select id="condition-rate" name="condition">
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				</select>


<br/>

				<p id="aj-phot" class="subtitles">Ajouter des photos</p>
				<div id="photo-input-wrap">	
					<input type="file" name="photo1" id="photo1" required accept=".jpg, .png, .jpeg, .gif">
					<input type="file" name="photo2" id="photo2"  accept=".jpg, .png, .jpeg, .gif">
					<input type="file" name="photo3" id="photo3"  accept=".jpg, .png, .jpeg, .gif">
				</div>
<br/>

				<p id="choix-place" class="subtitles">Où publier l'article</p>
				<select id="select-place" class="dropdown-select-shop" name="place">
					<option value="shop">Boutique</option>
					<option value="marketplace">Marketplace</option>

				</select> 
<br/>
				
				<input type="submit" name="sub-add-article" value="AJOUTER L'ARTICLE" id="submit-add-article"></input>
</form>
<?php } else if ($_GET['action']=='modif') { //========================================================================================?>


	<h2 id="title-add" class="action-title">GÉRER LES ARTICLES</h2>

	<button id="retour-button" onclick="window.location.href = 'https://highkicks.fr/admin/index.php';">RETOUR</button>

	<table id="article_table" cellpadding=15 rules=rows >
				<thead>
					<th>Nom</th>
					<th>Prix</th>
					<th>Type</th>
					<th>Tailles</th>
					<th>id</th>
					<th>Action</th>
				</thead>

	<?php $query_select_article = $bdd->query("SELECT * FROM Articles");

	while($articles = $query_select_article -> fetch()) { ?>
		<tr class="article_rows">
				   		<td class="cell-dblclk"><?php echo $articles['nom'];?></td>
				   		<td class="cell-dblclk"><?php echo $articles['prix'] ?></td>
				   		<td class="cell-dblclk"><?php echo $articles['type_article']?></td>
				   		<td class="cell-dblclk"><?php echo $articles['tailles']?></td>
				   		<td class="cell-dblclk"><?php echo $articles['id']?></td>
				   		<td class="tweaks"><a class="suppr-article article_tweaks"><img src="https://highkicks.fr/data/image/delete.png"></a></td>
				   		<td class="cell-dblclk" style="display: none;overflow: scroll; width: 10%;"><?php echo $articles['description']?></td>
				   	</tr>

	<?php } ?>
</table>

<?php }} else { //======================================================================================================================?>

<button id="plus-article-button" class="nav-button" onclick="window.location.href = 'https://highkicks.fr/admin/index.php?action=add';">AJOUTER UN ARTICLE</button>
<button id="plus-article-button" class="nav-button" onclick="window.location.href = 'https://highkicks.fr/admin/index.php?action=modif';">GÉRER LES ARTICLES</button>


<?php } ?>

<script src="js/classie.js"></script>
<script>
			(function() {
				// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
				if (!String.prototype.trim) {
					(function() {
						// Make sure we trim BOM and NBSP
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					// in case the input is already filled..
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}

					// events:
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );

				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}

				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
			})();




</script>


<?php

	if (isset($_POST['sub-add-article'])) {


		$sizes = array();

		$max_width = 120;
		$max_height = 120;

		include_once('thumbnailer.php');
		include_once('src/class.upload.php');



		// $width = getWidth($large_image_location);
  //       $height = getHeight($large_image_location);

		if (isset($_POST['tsize'])) {

			foreach($_POST['tsize'] as $sent_sizes){
				
				$sizes[] = $sent_sizes;

			}
		} else if (isset($_POST['sneakssize'])) {
			foreach($_POST['sneakssize'] as $sent_sizes){
				
				$sizes[] = $sent_sizes;

			}
		} else {
			$sizes[] = 'nosize';
		}

		$formatted_sizes = implode('/', $sizes);



		$id1 = uniqid('highkicks_');
		$id1_thb = $id1."_thb";

		//$id1.=".".pathinfo($_FILES['photo1']['name'], PATHINFO_EXTENSION);
		$id1_thb.=".".pathinfo($_FILES['photo1']['name'], PATHINFO_EXTENSION);

		$nom1 = "/home/highkicks/public_html/data/photo-articles/";
		$result = move_uploaded_file($_FILES['photo1']['tmp_name'],$nom1);
		

        $foo = new upload($_FILES['photo1']['tmp_name']); 
        $foo->file_new_name_body   = $id1;
        $foo->image_resize = true;
        $foo->image_ratio_crop = true;
        $foo->image_y = 500;
        $foo->image_x = 500;

		$foo->process($nom1);

		$id1.= '.jpg'; 

       
		imagethumb($nom1, "../data/photo-articles/".$id1_thb, 300);

		if (isset($_FILES['photo2']) && $_FILES['photo2']['name']!="") { 
			$id2 = uniqid('highkicks_'); 
			$nom2 = "../data/photo-articles/";


			$foo2 = new upload($_FILES['photo2']['tmp_name']); 
			$foo2->file_new_name_body   = $id2;
			$foo2->image_resize = true;
			$foo2->image_ratio_crop = true;
			$foo2->image_y = 200;
			$foo2->image_x = 200;

			$foo2->process($nom2);
			$id2.= '.jpg'; 



		} else {
			$id2="";
		}
		if (isset($_FILES['photo3']) && $_FILES['photo3']['name']!="") {
			$id3 = uniqid('highkicks_'); 
			$nom3 = "../data/photo-articles/";

			$foo3 = new upload($_FILES['photo3']['tmp_name']); 
			$foo3->file_new_name_body   = $id3;
			$foo3->image_resize = true;
			$foo3->image_ratio_crop = true;
			$foo3->image_y = 200;
			$foo3->image_x = 200;

			$foo3->process($nom3);
			$id3.= '.jpg'; 


		} else {
			$id3="";
		}

		if ($_POST['place']=='shop') {
			$table_insert = "Articles";
		} else {
			$table_insert = "Marketplace";
		}
		$query_article = $bdd -> prepare("INSERT INTO ".$table_insert."(nom,prix,type_article, marque, condition_produit,description, tailles,image1,image2,image3, date_ajout) VALUES (:nom,:prix,:type, :marque,:condition,:desc, :tailles,:image1,:image2,:image3,:date_ajout)");
		$query_article -> execute(array(
			'nom' => $_POST['nom'],
			'prix' => $_POST['prix'],
			'type' => $_POST['type'],
			'marque' => $_POST['marque'],
			'condition' => $_POST['condition'],
			'desc' => $_POST['description'],
			'tailles' => $formatted_sizes,
			'image1' => $id1,
			'image2' => $id2,
			'image3' => $id3,
			'date_ajout' => date("Y-m-d H:i:s")));
	}

?>


<script type="text/javascript">var sheet = document.createElement('style'),  
  $rangeInput = $('.range input'),
  prefs = ['webkit-slider-runnable-track', 'moz-range-track', 'ms-track'];

document.body.appendChild(sheet);

var getTrackStyle = function (el) {  
  var curVal = el.value,
      val = (curVal - 1) * 16.666666667,
      style = '';
  
  // Set active label
  $('.range-labels li').removeClass('active selected');
  
  var curLabel = $('.range-labels').find('li:nth-child(' + curVal + ')');
  
  curLabel.addClass('active selected');
  curLabel.prevAll().addClass('selected');
  
  // Change background gradient
  for (var i = 0; i < prefs.length; i++) {
    style += '.range {background: linear-gradient(to right, #37adbf 0%, #37adbf ' + val + '%, #fff ' + val + '%, #fff 100%)}';
    style += '.range input::-' + prefs[i] + '{background: linear-gradient(to right, #37adbf 0%, #37adbf ' + val + '%, #b2b2b2 ' + val + '%, #b2b2b2 100%)}';
  }

  return style;
}

$rangeInput.on('input', function () {
  sheet.textContent = getTrackStyle(this);
});

// Change input value on label click
$('.range-labels li').on('click', function () {
  var index = $(this).index();
  
  $rangeInput.val(index + 1).trigger('input');
  
});</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://highkicks.fr/jquery-bar-rating-master/dist/jquery.barrating.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript">
   $(function() {
      $('#condition-rate').barrating({
        theme: 'bars-pill',
        hoverState: false,
        showValues: true,
        initialRating: 5,
        onSelect: function(value, text, event) {
    if (typeof(event) !== 'undefined') {
      // rating was selected by a user
      if(parseInt(value)<=2) {
      	$('.br-current-rating').text("Mauvaise");
      } else if(parseInt(value)<=4) {
      	$('.br-current-rating').text("Médiocre");
      } else if(parseInt(value)<=6) {
      	$('.br-current-rating').text("Moyenne");
      } else if(parseInt(value)<=8) {
      	$('.br-current-rating').text("Bonne");
      } else if(parseInt(value)<=10) {
      	$('.br-current-rating').text("Deadstock");
      }
    }
  }
      });
   });

$( document ).ready(function() {
    $('.br-current-rating').text("Moyenne");
});

</script>


<div id="form-dialog-container">
	
	<form id="dialog-prompt-form" action="ajax-modify.php" method="post">
		<fieldset>
			<label for="name">Nom</label><br/>
			<input type="text" name="name" id="name" value="" class="text ui-widget-content ui-corner-all"><br/>
			<label for="prix">Prix</label><br/>
			<input type="number" step="0.01" min="0" name="prix" id="prix" value="" class="text ui-widget-content ui-corner-all"><br/>
			<label for="select-types">Type d'article</label><br/>

			<select id="select-types" class="dropdown-select-shop" name="type-art">
				<option value="sneaks">Sneakers</option>
				<option value="top">Top</option>
				<option value="bottom">Bottom</option>
				<option value="accessories">Accessoires</option>
			</select>       <br/>
			       <br/>

			<div id="dialog-chkbx-container">
				
			</div>
			       <br/>

			<label for="select-types">Description</label><br/>
			<textarea id="desc-textarea" name="description"></textarea> <br/>
			<input type="hidden" id="id_article" name="id"> <br/>
			<div id="submit-dialog-wrap">

				<input type="submit">

			</div>
		</fieldset>
	</form>
</div>

<script src="brands.js"></script>

<script type="text/javascript">

	var top_sizes = ['XS','S', 'M', 'L', 'XL'];
  	var sneakers_sizes = ['35','36','37','38','39','40', '41', '42', '43', '44', '45', '46', '47', '48'];



	var selected_row;
	$("#form-dialog-container").dialog({
      autoOpen: false
  });
	$('.article_rows').click(function(e) {

		if (e.target.nodeName !== 'IMG') {
		selected_row = $(this);

		var is_checked;

		var sizes = $(this).find('td:nth-child(4)').html().split('/');


		$('#submit-dialog-wrap').css('background-image', '');

		$('#name').val($(this).find('td:nth-child(1)').html());
		$('#prix').val($(this).find('td:nth-child(2)').html());
		$('#desc-textarea').val($(this).find('td:nth-child(7)').html());
		var ident = $(this).find('td:nth-child(5)').html();
		$('#select-types option[value="' + $(this).find('td:nth-child(3)').html() + '"]').attr("selected", "selected");
		$('#id_article').attr("value", $(this).find('td:nth-child(5)').html());
		$( "#form-dialog-container" ).dialog('open');

		$('#dialog-chkbx-container').empty();


		if ($('#select-types').val() == 'top' || $('#select-types').val() == 'bottom') {

			$.each(top_sizes, function(i,v){

				is_checked = $.inArray(v, sizes);

				if (is_checked > -1) {
					check = true;
				} else {
					check = false;
				};

				$('<div>').appendTo($('#dialog-chkbx-container'));
				$('<label />', { 'for': 'tsize'+v, text: v }).appendTo($('#dialog-chkbx-container div:last-child'));
				$('<input />', { type: 'checkbox', id: 'tsize'+v, value: v , name: 'newsizes[]', checked: check}).appendTo($('#dialog-chkbx-container div:last-child'));
			});
		} else if ($('#select-types').val() == 'sneaks') {

			$.each(sneakers_sizes, function(i,v){

				is_checked = $.inArray(v, sizes);

				if (is_checked > -1) {
					check = true;
				} else {
					check = false;
				};
				$('<div>').appendTo($('#dialog-chkbx-container'));
				$('<label />', { 'for': 'tsize'+v, text: v }).appendTo($('#dialog-chkbx-container div:last-child'));
				$('<input />', { type: 'checkbox', id: 'tsize'+v, value: v , name: 'newsizes[]', checked: check}).appendTo($('#dialog-chkbx-container div:last-child'));
			});
		} else {
			$('#dialog-chkbx-container').append( "<p>Aucune taille disponible pour ce type de produit</p>" );
		}
	}


});

	$('#dialog-prompt-form').on('submit', function (e) {
		e.preventDefault();
    	var formData = $('#dialog-prompt-form').serialize();
    	$('#submit-dialog-wrap').css('background-image', 'url("https://highkicks.fr/data/image/Rolling-1s-200px.gif")');


		$.ajax({
		    type: 'post',
		    url: 'ajax-modify.php',
		    data: $('#dialog-prompt-form').serialize(),
	        success: function (data) {

	        	return_request = $.trim(data).split('#');

				if (return_request[0]=='error') {
					$('#submit-dialog-wrap').css('background-image', 'url("https://highkicks.fr/data/image/red-cross.png")');

				}
				if (return_request[0]=='success') {
					

					selected_row.find('td:nth-child(1)').html($('#name').val());
					selected_row.find('td:nth-child(2)').html($('#prix').val());
					selected_row.find('td:nth-child(3)').html($('#select-types').val());
					selected_row.find('td:nth-child(4)').html(return_request[1]);
					selected_row.find('td:nth-child(7)').html($('#desc-textarea').val());

    				$('#submit-dialog-wrap').css('background-image', 'url("https://highkicks.fr/data/image/baseline_check_black_36dp.png")');
				}

			}

		})
	});


  	$('#select-type').change(function(){
  		$('#radio-sizes-container').empty();
  		$('#brand-selector').empty();
  		
  		$('#brand-selector').append('<option value="" selected disabled hidden>Marque</option>');

  		if ($('#select-type').val() == 'top' || $('#select-type').val() == 'bottom') {


  			$.each(top_sizes, function(i,v){
  				$('<div>').appendTo($('#radio-sizes-container'));
  				$('<input />', { type: 'checkbox', id: 'tsize'+v, value: v , name: 'tsize[]', class: 'input_size_chk'}).appendTo($('#radio-sizes-container div:last-child'));
   				$('<label />', { 'for': 'tsize'+v, text: v , class: 'label_size_chk'}).appendTo($('#radio-sizes-container div:last-child'));
  			});

  			$.each(streatwear_brands, function(i, v){
  				$('#brand-selector').append('<option value="'+v+'">'+v+'</option>');
  			});

  		} else if ($('#select-type').val() == 'sneaks') {

  			$.each(sneakers_sizes, function(i,v){
  				$('<div>').appendTo($('#radio-sizes-container'));
  				$('<input />', { type: 'checkbox', id: 'tsize'+v, value: v , name: 'sneakssize[]', class: 'input_size_chk'}).appendTo($('#radio-sizes-container div:last-child'));
   				$('<label />', { 'for': 'tsize'+v, text: v , class: 'label_size_chk'}).appendTo($('#radio-sizes-container div:last-child'));
  			});

  			$.each(sneakers_brands, function(i, v){
  				$('#brand-selector').append('<option value="'+v+'">'+v+'</option>');
  			});
  		} else {
  			$('#radio-sizes-container').append( "<p>Aucune taille disponible pour ce type de produit</p>" );
  			$.each(all_brands, function(i, v){
  				$('#brand-selector').append('<option value="'+v+'">'+v+'</option>');
  			});
  		}




  		
  	});

  	$( document ).ready(function() {
  		$('.suppr-article').click(function(e){
  			var id_suppr = $(this).parent().parent().find('td:nth-child(5)').html();
  			$.ajax({
  				type: 'POST',
  				url: 'delete.php',
  				context: this,
  				data: {suppr: id_suppr},
  				success: function (data) {

  					$(this).parent().parent().remove();

  				}

  			})

  		});
  	});
  </script>

</body>
</html>