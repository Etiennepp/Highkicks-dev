<?php session_start();
$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"); ?>

<!DOCTYPE html>
<html>
<head>
	<title>High Kicks</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/set2.css"/>
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<link rel="icon" href="../data/image/logo.png">
	<link rel="stylesheet" type="text/css" href="../menu-style.css">

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
					  _____                     _       _   _             
					 |_   _|                   (_)     | | (_)            
					   | |  _ __  ___  ___ _ __ _ _ __ | |_ _  ___  _ __  
					   | | | '_ \/ __|/ __| '__| | '_ \| __| |/ _ \| '_ \ 
					  _| |_| | | \__ \ (__| |  | | |_) | |_| | (_) | | | |
					 |_____|_| |_|___/\___|_|  |_| .__/ \__|_|\___/|_| |_|
					                             | |                      
					                             |_|                      
 ================================ W E L C O M E   D E V' ========================================!-->


 <body>



 	<?php include('../menu.php') ?>





 	<div id="body-wrap">



 		<h3 id="inscription-title">INSCRIPTION</h3>

 		<p id="warning-info">CES INFORMATIONS SERONT UTILISÉES LORS DES COMMANDES, VEILLEZ À LES REMPLIR CORRECTEMENT</p>



 		<form  id="inscription-form" class="content" method="post">

 			<span class="form-delimiter">Informations personnelles</span> <br/>

 			<span class="input input--yoshiko">
 				<input class="input__field input__field--yoshiko" type="text" id="input-10" name="nom" required="true" minlength="2" />
 				<label class="input__label input__label--yoshiko" for="input-10">
 					<span class="input__label-content input__label-content--yoshiko" data-content="Nom">Nom</span>
 				</label>
 			</span>


 			<br/>
 			<span class="input input--yoshiko">
 				<input class="input__field input__field--yoshiko" type="text" id="input-11" name="prenom" required="true" minlength="2"/>
 				<label class="input__label input__label--yoshiko" for="input-11">
 					<span class="input__label-content input__label-content--yoshiko" data-content="Prénom">Prénom</span>
 				</label>
 			</span>

 			<br/>

 			<span class="input input--yoshiko">
 				<input class="input__field input__field--yoshiko" type="text" id="input-12" name="pseudo_inscription" required="true" minlength="2"/>
 				<label class="input__label input__label--yoshiko" for="input-12">
 					<span class="input__label-content input__label-content--yoshiko" data-content="Nom d'utilisateur">Nom d'utilisateur</span>
 				</label>
 			</span>


 			<br/>



 			<span class="input input--yoshiko">
 				<input class="input__field input__field--yoshiko" type="password" id="input-13" name="mdp" required="true"/>
 				<label class="input__label input__label--yoshiko" for="input-13">
 					<span class="input__label-content input__label-content--yoshiko" data-content="Mot de passe">Mot de passe</span>
 				</label>
 			</span>


 			<br/>



 			<span class="input input--yoshiko">
 				<input class="input__field input__field--yoshiko" type="password" id="input-14" name="mdp_confirm" required="true"/>
 				<p id="passsword-error" class="error_form">Le mot de passe ne correspond pas</p>
 				<label class="input__label input__label--yoshiko" for="input-14">
 					<span class="input__label-content input__label-content--yoshiko" data-content="Confirmer le mot de passe">Confirmer le mot de passe</span>
 				</label>
 			</span>


 			<br/>


 			<span class="form-delimiter">Coordonnées</span> <br/>

 			<span class="input input--yoshiko">
 				<input class="input__field input__field--yoshiko" type="text" id="input-15" name="mail" required="true"/>
 				<p id="mail-error" class="error_form">L'adresse mail n'est pas valide !</p>
 				<label class="input__label input__label--yoshiko" for="input-15">
 					<span class="input__label-content input__label-content--yoshiko" data-content="Adresse mail">Adresse mail</span>
 				</label>
 			</span>


 			<br/>



 			<span class="input input--yoshiko details">
 				<input type="text" class="input__field input__field--yoshiko" id="input-16" name="adresse" placeholder="" required="true"></input>
 				<p id="adresse-error" class="error_form">Veuillez saisir une adresse !</p>
 				<label class="input__label input__label--yoshiko" for="input-16">
 					<span class="input__label-content input__label-content--yoshiko" data-content="Adresse">Adresse (ex : 5 rue de Rivoli)</span>
 				</label>
 			</span>
 			<br/>


 			<span class="input input--yoshiko">
 				<input class="input__field input__field--yoshiko" type="text" id="input-17" name="zipcode" required="true"/>
 				<p id="codezip-error" class="error_form">Veuillez saisir un code postal !</p>
 				<label class="input__label input__label--yoshiko" for="input-17">
 					<span class="input__label-content input__label-content--yoshiko" data-content="Code postal">Code postal</span>
 				</label>
 			</span>
 			<br/>


 			<span class="input input--yoshiko details">
 				<input type="text" class="input__field input__field--yoshiko" name="ville" id="input-18" placeholder="" required="true"></input>
 				<p id="ville-error" class="error_form">Veuillez saisir une ville !</p>
 				<label class="input__label input__label--yoshiko" for="input-18">
 					<span class="input__label-content input__label-content--yoshiko" data-content="Ville">Ville</span>
 				</label>
 			</span>
 			<br/>
 			
 			<br/>
 				
 			<select name="pays" id="country_select">
 				<?php foreach ($countries as $country) { ?>
 					<option value="<?php echo $country; ?>" <?php if($country == 'France'){echo "selected";} ?>><?php echo $country; ?></option>
 				<?php } ?>
 			</select>



 			<br/>
 			<br/>

 			<input type="submit" value="S'INSCRIRE" id="submit-inscription"></input>

 		</form>



 		</div>



 	<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">

 	<style>

 	#locationField, #controls {

 		position: relative;

 	}

 	#autocomplete {

 		position: absolute;

 		top: 0px;

 		left: 0px;

 	}

 	.label {

 		display: none;

 	}

 	#address {

 		border: 1px solid #000090;

 		background-color: #f0f0ff;

 		padding-right: 2px;

 	}

 	#address td {

 		font-size: 10pt;

 	}

 	.field {

 	}

 	.slimField {

 		display: none;

 	}

 	.wideField {

 		display: none;

 	}

 	#locationField {

 		height: 20px;

 		margin-bottom: 2px;

 		width: calc(100%);



 	}

 </style>



 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWcvoRgYENVRrqMexCQtAJk8Heq0YuWCQ&libraries=places&types=park&callback=initAutocomplete"

 async defer></script>

 <script src="js/classie.js"></script>



 <script>

function isValidEmailAddress(e) {
    return /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(e)
}! function() {
    var e;

    function t(e) {
        classie.add(e.target.parentNode, "input--filled")
    }

    function u(e) {
        "" === e.target.value.trim() && classie.remove(e.target.parentNode, "input--filled")
    }
    String.prototype.trim || (e = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, String.prototype.trim = function() {
        return this.replace(e, "")
    }), [].slice.call(document.querySelectorAll("input.input__field")).forEach(function(e) {
        "" !== e.value.trim() && classie.add(e.parentNode, "input--filled"), e.addEventListener("focus", t), e.addEventListener("blur", u)
    })
}(), $("#adresse-error").height($("#mail-error").height()), $(".content").on("submit", function(e) {
    e.preventDefault(), isValidEmailAddress($("#input-15").val()) ? $("#mail-error").css("display", "none") : $("#mail-error").css("display", "block"), $("#input-13").val() !== $("#input-14").val() ? $("#passsword-error").css("display", "block") : $("#passsword-error").css("display", "none"), $("#input-16").val() && $("#input-17").val() && $("#input-18").val() && $("#country_select").val() ? $("#adresse-error").css("display", "none") : $("#adresse-error").css("display", "block"), isValidEmailAddress($("#input-15").val()) && $("#input-13").val() === $("#input-14").val() && $("#input-16").val() && $("#input-17").val() && $("#input-18").val() && $("#country_select").val() && $.ajax({
        type: "post",
        url: "inscription-action.php",
        data: $(".content").serialize(),
        success: function(e) {
            "erreur_champs" == $.trim(e) && alert("Veuillez remplir tous les champs ou verifier votre adresse"), "bad_values" == $.trim(e) && alert("Valeurs non conformes, veuillez réessayer dans quelques instants. Si le problème persiste, contactez les administrateurs sur l'adresse suivante : support@highkicks.fr"), "erreur_double_psd" == $.trim(e) && alert("Ce pseudo est déjà utilisé !"), "erreur_double_mail" == $.trim(e) && alert("Cette adresse mail est déjà rattachée à un autre compte !"), "success" == $.trim(e) && (alert("Inscription réussie, appuyez sur OK pour revenir à l'accueil"), window.location.replace("https://highkicks.fr/"))
        }
    })
});

 </script>



 <?php include("../footer.php") ?>

</body>

</html>

