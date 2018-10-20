<?php
header('Content-Type: text/html; charset=utf-8');
require('../phpmailer/src/PHPMailer.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = new PHPMailer();
$email->CharSet = 'utf-8';
$email->SetFrom('noreply@highkicks.fr', 'Highkicks'); //Name is optional
$email->Subject   = 'Merci pour votre commande !';
$email->Body      = "Toute l'équipe Highkicks vous remercie pour votre commande. Une facture est jointe à cet e-mail. Nous vous souhaitons une bonne reception, et, cas de problème avec la commande, vous pouvez contacter le service après vente (sav@highkicks.fr). À très vite sur Highkicks !";
$email->AddAddress( $coordonnees['mail'] );
$file_to_attach = '../data/commandes/resume/' . $_SESSION['connected_id'] . '/' . $filename;

$email->AddAttachment( $file_to_attach , 'facture.pdf' );

$email->Send();

$retour_vendeur = new PHPMailer(true);
$retour_vendeur->CharSet = 'utf-8';
$retour_vendeur->SetFrom('noreply@highkicks.fr', 'Commande'); //Name is optional
$retour_vendeur->Subject   = 'Nouvelle commande';
$retour_vendeur->Body      = "Une commande a été effectuée sur highkicks.fr. En PJ : facture et recapitulatif de la commande.";
$retour_vendeur->AddAddress( 'order@highkicks.fr' );
$file_to_attach = '../data/commandes/resume/' . $_SESSION['connected_id'] . '/' . $filename;

$retour_vendeur->AddAttachment( $file_to_attach , 'facture.pdf' );
$retour_vendeur->Send();

?>