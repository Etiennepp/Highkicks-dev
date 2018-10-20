<!DOCTYPE html>
<html>
<head>
	<title>Administration</title>
	<link rel="stylesheet" type="text/css" href="admin-style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/set2.css"/>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/demo.css" />

	<link rel="icon" href="../data/image/logo.png">

</head>
<body>

<h1 id="titre-admin">ADMINISTRATION</h1>

<?php
session_start();
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

	<button id="retour-button" onclick="window.location.href = 'https://highkicks.fr/admin/administration.php';">RETOUR</button>




<form class="content" method="post" action="administration.php" enctype="multipart/form-data">
<br/>
				<span class="input input--yoshiko">
					<input class="input__field input__field--yoshiko" type="text" id="input-11" name="nom" required="true"/>
					<label class="input__label input__label--yoshiko" for="input-11">
						<span class="input__label-content input__label-content--yoshiko" data-content="Nom de l'article">Nom de l'article</span>
					</label>
				</span>
<br/>
				<span class="input input--yoshiko">
					<input class="input__field input__field--yoshiko" type="text" id="input-11" name="prix" required="true"/>
					<label class="input__label input__label--yoshiko" for="input-11">
						<span class="input__label-content input__label-content--yoshiko" data-content="Prix">Prix</span>
					</label>
				</span>
<br/>

				<select id="select-type" class="dropdown-select-shop" name="type">
					<option value="default">Type d'article</option>
					<option value="shoes">Chaussure</option>
					<option value="tshirts">T-shirt</option>
					<option value="jackets">Blouson / Pull</option>
					<option value="other">Autre...</option>
				</select> 
<br/>

				<div class="range">
				  <input type="range" min="1" max="10" steps="1" value="1" list="tickmarks">
				</div>


<br/>

				<p id="aj-phot">Ajouter des photos</p>
				<div id="photo-input-wrap">	
					<input type="file" name="photo1" id="photo1" required accept=".jpg, .png, .jpeg, .gif">
					<input type="file" name="photo2" id="photo2"  accept=".jpg, .png, .jpeg, .gif">
					<input type="file" name="photo3" id="photo3"  accept=".jpg, .png, .jpeg, .gif">
				</div>
<br/>
				
				<input type="submit" name="sub-add-article" value="AJOUTER L'ARTICLE" id="submit-add-article"></input>
</form>
<?php } else if ($_GET['action']=='modif') { //========================================================================================?>


	<h2 id="title-add" class="action-title">SUPPRIMER UN ARTICLE</h2>

	<button id="retour-button" onclick="window.location.href = 'https://highkicks.fr/admin/administration.php';">RETOUR</button>

	<?php $query_select_article = $bdd->query("SELECT * FROM Articles");

	while($articles = $query_select_article -> fetch()) { ?>

	<div class="wrap-article-modif">
		<img src="https://highkicks.fr/data/photo-articles/<?php echo $articles['image1']; ?>">
		<p class="nom-article"><?php echo $articles['nom']; ?></p>
		<button class="suppr-article" onclick="window.location.href = 'https://highkicks.fr/admin/administration.php?action=modif&suppr=<?php echo $articles['id'];?>';">SUPPRIMER</button>
	</div>

	<?php } ?>


<?php }} else { //======================================================================================================================?>

<button id="plus-article-button" class="nav-button" onclick="window.location.href = 'https://highkicks.fr/admin/administration.php?action=add';">AJOUTER UN ARTICLE</button>
<button id="plus-article-button" class="nav-button" onclick="window.location.href = 'https://highkicks.fr/admin/administration.php?action=modif';">SUPPRIMER UN ARTICLE</button>


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
		echo("--" + $_FILES['photo1']['tmp_name']);

		$nom1 = "../data/photo-articles/".$_FILES['photo1']['name'];
		$resultat1 = move_uploaded_file($_FILES['photo1']['tmp_name'],$nom1);
		echo "dssd7878";

		if (isset($_FILES['photo2']) && $_FILES['photo2']['name']!="") { 
			echo "dsds";
			echo "dsdsds";
			$nom2 = "../data/photo-articles/".$_FILES['photo2']['name'];

			$resultat2 = move_uploaded_file($_FILES['photo2']['tmp_name'],$nom2);
		}
		if (isset($_FILES['photo3']) && $_FILES['photo3']['name']!="") { 
			$nom3 = "../data/photo-articles/".$_FILES['photo3']['name'];
			$resultat3 = move_uploaded_file($_FILES['photo3']['tmp_name'],$nom3);
		}


		$query_article = $bdd -> prepare("INSERT INTO Articles(nom,prix,type_article,image1,image2,image3, date_ajout) VALUES (:nom,:prix,:type,:image1,:image2,:image3,:date_ajout)");
		$query_article -> execute(array(
			'nom' => $_POST['nom'],
			'prix' => $_POST['prix'],
			'type' => $_POST['type'],
			'image1' => $_FILES['photo1']['name'],
			'image2' => $_FILES['photo2']['name'],
			'image3' => $_FILES['photo3']['name'],
			'date_ajout' => date("Y-m-d H:i:s")));
	}

	if (isset($_GET['suppr'])) {
		$query = "DELETE FROM Articles WHERE id=".$_GET['suppr'];
		$bdd -> query($query);

		?>
		<script type="text/javascript">
		window.location.href = 'https://highkicks.fr/admin/administration.php?action=modif';</script>
	<?php } ?>


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

</body>
</html>