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
}
if (isset($_POST['pseudo']) && isset($_POST['mot_de_passe'])) {  //SI ON A BIEN RENTRE QUELQUE CHOSE
	 $pseudo = $_POST['pseudo'];  //recuperation valeur du pseudo envoyé
	 $mdp = $_POST ['mot_de_passe']; //recup.............. mdp envoyé
$verif_login = $bdd->prepare("SELECT COUNT(*) FROM comptes WHERE Pseudo = '".$pseudo."'");//EST CE QUE LE PSEUDO EXISTE (requête préparée pour eviter les injections)
$verif_login -> execute(); 
if ($verif_login->fetchColumn()==0) {
	echo "fail";
}
else {

	$reponse_login = $bdd->prepare("SELECT mdpasse, id FROM comptes WHERE Pseudo = '".$pseudo."' LIMIT 1");
	$reponse_login->execute();
	$donnees = $reponse_login->fetch();

	if (md5($mdp) == $donnees['mdpasse'])
	{

		if (isset($_POST['keeplogged'])) {
			$token = bin2hex(openssl_random_pseudo_bytes(16));
			$cookie = $pseudo . ':' . $token;
			$mac = hash_hmac('sha256', $cookie, '(Ft>[IP2,i3<?_yR|-pK/r>ZnZg`^G1&Ez|PNW;Psj{8f)HA=n3EyqaYTR`#lGM');
			$cookie .= ':' . $mac;
			setcookie('rememberme_hk', $cookie,time()+60*60*24*30);
			$insert_key = $bdd -> prepare("UPDATE comptes SET session_key=:key WHERE Pseudo=:user");
			$insert_key -> bindValue(':key', $token, PDO::PARAM_STR);
			$insert_key -> bindValue(':user', $pseudo, PDO::PARAM_STR);
			$insert_key -> execute();
		}
		$_SESSION['connected_id'] = $donnees['id'];
		echo "success";

	}
	else{
		echo "fail";
	}
}
}
else {
	echo "fail";
}
?>

