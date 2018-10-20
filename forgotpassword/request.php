<!DOCTYPE html>

<html>
<head>
	<title>High Kicks</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="../menu-style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="icon" href="https://highkicks.fr/data/image/logo.png">
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


!-->


<body>

	<?php include("../menu.php") ?>




	<div id="body-wrap">

	<?php
try {
	$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    
	$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
    $bdd->exec('SET NAMES UTF8');

	$pseudo = $_POST['pseudo'];

$verif_login = $bdd->prepare("SELECT COUNT(*) FROM comptes WHERE Pseudo = '".$pseudo."'");//EST CE QUE LE PSEUDO EXISTE (requête préparée pour eviter les injections)
$verif_login -> execute(); 
if ($verif_login->fetchColumn()==0) {
?>
<script type="text/javascript">
window.location.href = 'https://highkicks.fr/forgotpassword/?error=not_found';
</script>
<?php
} else {
	$key = bin2hex(openssl_random_pseudo_bytes(16));
	$key_insert = $bdd->prepare("UPDATE comptes SET forgot_pass_key='".$key."' WHERE Pseudo='".$pseudo."'");
	$key_insert ->execute();
	$key_query = $bdd->prepare("SELECT mail FROM comptes WHERE Pseudo = '".$pseudo."'");
	$key_query -> execute();
	$key_response = $key_query->fetch();
	$mail = $key_response[0];


    header( 'content-type: text/html; charset=utf8' );

    ini_set( 'display_errors', 1 );
 
    error_reporting( E_ALL );
 
    $from = "noreply@highkicks.fr";
 
    $to = $mail;
 
    $subject = "Réinitialisation du mot de passe - High Kicks";
 
	$message = '<html><body>'; 
	$message .= '<div style="line-height:100px;"><img src="https://highkicks.fr/data/image/logo.png" style="width:100px;float:left;">';
	$message .= '<h1>Réinitialisation du mot de passe</h1></div>';
	$message .= '<p>Cliquez sur ce lien pour réinitialiser votre mot de passe :</p>';
	$message .= '<a href="https://highkicks.fr/forgotpassword/reset.php?name='.$pseudo.'&key='.$key.'">Réinitialiser le mot de passe</a>';
	$message .= "<p>Si vous n'êtes pas à l'origine de cette demande, merci d'ignorer ce message.</p>";
	$message .= '<p>Bonne journée et à tout de suite sur HighKicks.</p>';
	$message .= '<br/><p>Ce message est automatique merci de ne pas y répondre.</p>';
	$message .= '</body></html>';


    $headers = "From:" . $from;
	$headers .= "Reply-To: ".$mail."\n";
	$headers .= "Content-Type: text/html; charset=\"utf8\"";    
	mail($to,$subject,$message, $headers);
 
    ?>
    	<p id="mail_sent">Un lien de réinitialisation de mot de passe a été envoyé sur l'adresse mail associée à ce compte. Il se peut que le mail se situe dans vos courriers indésirables.</p>

<?php
}
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}

?>

		


	</div>
	
<?php include("../footer.php") ?>
</body>
</html>