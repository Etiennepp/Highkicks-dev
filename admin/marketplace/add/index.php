<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un article</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="../../menu-style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/set2.css"/>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<link rel="stylesheet" href="/slider/css/rSlider.min.css">

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
====================================================================================================!-->
<body>
	<?php include '../../menu.php'; ?>

		<div id="body-wrap">
		<h2 id="title-add">AJOUTER UN ARTICLE</h2>
<form class="content" method="post" action="add-article.php" enctype="multipart/form-data">
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

				<select id="select-type" class="dropdown-select-shop add-select" name="type" class="input">
					<option value="" selected disabled hidden>Type d'article</option>
					<option value="shoes">Chaussure</option>
					<option value="tshirts">T-shirt</option>
					<option value="jackets">Blouson / Pull</option>
					<option value="other">Autre...</option>
				</select> 
<br/>			

				<select id="select-qual" class="dropdown-select-shop add-select" name="type" class="input">
					<option value="" selected disabled hidden>État de l'article</option>
					<option value="neuf">Comme neuf</option>
					<option value="tshirts">Moyen</option>
					<option value="jackets">Usé</option>
				</select> 

				<p class="add-inf">Description du produit (obligatoire)</p>

				<textarea name="description" rows="10" cols="30" required="true" minlength="30"></textarea>

<br/>


				<p class="add-inf">Ajouter des photos (1 min. - 3 max.)</p>
				<div id="photo-input-wrap">	
					<input type="file" name="photo1" id="photo1" required accept=".jpg, .png, .jpeg, .gif">
					<input type="file" name="photo2" id="photo2"  accept=".jpg, .png, .jpeg, .gif">
					<input type="file" name="photo3" id="photo3"  accept=".jpg, .png, .jpeg, .gif">
				</div>
<br/>
				
				<input type="submit" name="sub-add-article" value="AJOUTER L'ARTICLE" id="submit-add-article"></input>
</form>
		



	</div>
<script src="js/classie.js"></script>
<script>
			(function() {
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
<script type="text/javascript">
var sheet = document.createElement('style'),  
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
  
});
</script>

	<script src="slider/js/rSlider.min.js"></script>

<script type="text/javascript">
var slider = new rSlider({
                    target: '#slider',
                    values: [2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015],
                    range: true,
                    set: [2010, 2013],
                    onChange: function (vals) {
                        console.log(vals);
                    }
                });
</script>
</body>




</html>

