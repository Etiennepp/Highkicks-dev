<?php session_start();



$cookie = isset($_COOKIE['rememberme_hk']) ? $_COOKIE['rememberme_hk'] : '';



if ($cookie) {



	list ($user, $token, $mac) = explode(':', $cookie);



	if (!hash_equals(hash_hmac('sha256', $user . ':' . $token, '(Ft>[IP2,i3<?_yR|-pK/r>ZnZg`^G1&Ez|PNW;Psj{8f)HA=n3EyqaYTR`#lGM'), $mac)) {



	} else {







		$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    



		$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);



	    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);



	    $bdd->exec('SET NAMES UTF8');







	    $fetch_token = $bdd -> prepare("SELECT  session_key FROM comptes WHERE Pseudo=:user");



	    $fetch_token -> bindValue(':user', $user, PDO::PARAM_STR);



	    $fetch_token -> execute();



	    $usertoken = $fetch_token->fetch();



	if (hash_equals($usertoken[0], $token)) {



		



		$_SESSION['pseudo'] = $user;



	}



	}



}







include_once("panier/fonctions-panier.php");



creationPanier();



$_SESSION['panier']['verrou']=false;



header( 'content-type: text/html; charset=utf-8' );?>



	<script



			  src="https://code.jquery.com/jquery-2.2.4.js"



			  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="



			  crossorigin="anonymous"></script>



	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>



	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>



	<script src="https://highkicks.fr/app.js"></script>





	<div id="menu">



	<div id="mySidenav" class="sidenav">







		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>



		  <a href="https://highkicks.fr/">ACCUEIL</a>



		  <a href="https://highkicks.fr/boutique/">BOUTIQUE</a>



		  <a href="https://highkicks.fr/panier/">PANIER</a>







		</div>



		







		<h1 id="brand-name" onclick='location.href="https://highkicks.fr/"'>HIGH KICKS</h1>







		



		<ul id="menu-list">



			



			<li class="menu-link"><a href="https://highkicks.fr/" class="nav-link-a">ACCUEIL</a></li>



			



			<li class="menu-link"><a href="https://highkicks.fr/boutique/" class="nav-link-a">BOUTIQUE</a></li>







			<li class="menu-link"><a href="" class="nav-link-a marketplace-lnk">MARKETPLACE<p id="comingsoon_mk">Coming soon !</p></a> </li>



			



			<li class="menu-link"><a href="https://highkicks.fr/panier/" class="nav-link-a">PANIER<div id="nb_article"></div></a></li>



			











		</ul>







		<div onclick="openNav()" id="openNav"><img alt="" src="https://highkicks.fr/data/image/menu.png"> </div>







		<div id="up-right-menu">











			<div id="compte-wrap">







				<div id="compte">



					<?php if (isset($_SESSION['connected_id'])) {?>



						<img alt="" src="https://highkicks.fr/data/image/comptelog.png">



					<?php }else{?>	



						<img alt="" src="https://highkicks.fr/data/image/compte.png">



					<?php }?>



				</div>







				<div id="compte-open">



					<h2 id="compte-title">MON COMPTE</h2>







					<?php if (isset($_SESSION['connected_id'])) {



						try {



							$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    



							$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);



						    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);



						    $bdd->exec('SET NAMES UTF8');















						    $select_user = $bdd->prepare("SELECT * FROM comptes WHERE id=:id");



							$select_user -> bindValue(':id', $_SESSION['connected_id'], PDO::PARAM_STR);



						    $select_user -> execute();



						    $user_data = $select_user -> fetch();



						    $char_to_replace = array('à','é','ù','ç');



						    $replace = array('a','e','u','c');



						    $nom = str_replace($char_to_replace, $replace, $user_data['Nom']) ;



						    $prenom = str_replace($char_to_replace, $replace, $user_data['Prenom']) ;



						    $mail = $user_data['mail'];







						}



						catch(Exception $e) {



						    echo 'Exception -> ';



						    var_dump($e->getMessage());



						}?>







						<p id="pseudo"><?php echo ucfirst(strtolower(htmlspecialchars($nom))); ?> <?php echo ucfirst(strtolower(htmlspecialchars($prenom))); ?></p>



						<p id="c-mail"><?php echo $mail; ?></p>



						<a href="https://highkicks.fr/account/order/" id="order-link" class="parameter_links">



							<span id="order-button" class="account-param-button">Mes commmandes</span>



						</a>



						<a href="https://highkicks.fr/account/settings/" id="param-link" class="parameter_links">



							<span id="order-button" class="account-param-button">Paramètres</span>



						</a>



						<a href="https://highkicks.fr/deconnexion.php?url=https://highkicks.fr<?php echo $_SERVER['REQUEST_URI']; ?>" id="disconnection-link">



							<span id="disconnection-button">Se déconnecter</span>



						</a>







					<?php } else { ?>



					<form method="post" id="connexion-form">



							<label for="pseudo" class="pseudoid">Nom d'utilisateur :</label>



							<input  name="pseudo" id="pseudoid" />







							<br />



							<label for="mot_de_passe" class="mot_de_passeid">Mot de Passe :</label>



							<input type="password" name="mot_de_passe" id="mot_de_passeid" />



							<br/>



							<br/>



							<input type="checkbox" name="keeplogged" value="keeplogged">



							<label for="keeplogged[]" id="lbl-checkbox-keeplgd">Rester connecté</label>



							<br/>







							<p id="connexion-fail">Nom d'utilisateur/Mot de passe incorrect !</p>







							<input type="submit" value="SE CONNECTER" id="submit_connexion"/> <br/>



							<a href="https://highkicks.fr/forgotpassword/" id="forgot-link">Mot de passe oublié ?</a>



							<div onclick="location.href='https://highkicks.fr/inscription/';" id="inscription-link">



								<p id="inscription-link-text">S'INSCRIRE</p>



								



							</div>



					</form>



					<?php }; ?>











				</div>







			</div>







		</div>







	</div>















<script type="text/javascript">



	function openNav() {



		document.getElementById("mySidenav").style.width = "80%";



	}



	function closeNav() {



		document.getElementById("mySidenav").style.width = "0";



	} 



	if (<?php echo array_sum($_SESSION['panier']['qteProduit']) ?>==0){ 



 		$('#nb_article').css('display', 'none');



	} else if (<?php echo array_sum($_SESSION['panier']['qteProduit']) ?>!=0)	{ 



			$('#nb_article').show(); 



			$('#nb_article').text(<?php echo array_sum($_SESSION['panier']['qteProduit']); ?>);







		}



</script>



