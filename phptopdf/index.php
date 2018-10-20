<?php
session_start();
header( 'content-type: text/html; charset=utf-8' );
require('../phptopdf/rotation.php');



$frais_expedition = number_format(9.50,2);

$filename = uniqid($coordonnees['Nom'] . '_') . '.pdf';


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



function comma_separated_to_array($string, $separator = ',')
{
  //Explode on comma
  $vals = explode($separator, $string);
 
  //Trim whitespace
  foreach($vals as $key => $val) {
    $vals[$key] = trim($val);
  }
  //Return empty array if no items found
  //http://php.net/manual/en/function.explode.php#114273
  return array_diff($vals, array(""));
}





class PDF extends PDF_Rotate
{
function RotatedText($x,$y,$txt,$angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->Text($x,$y,$txt);
	$this->Rotate(0);

}
// En-tête
function aa()
{
	global $coordonnees, $no_commande;
	// Logo
	$this->Image('https://highkicks.fr/phptopdf/logo.png',8,6,15);
	$this->Image('https://highkicks.fr/phptopdf/backpdf.png',8,25,400);
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	if ($uri_parts[0]!="/return/") {
		//$this->Image('https://highkicks.fr/phptopdf/cancelled-stamp.png',8,25,140);
	}

	//$adresse_split = preg_split('~\s+(?=[0-9]{5})~', $coordonnees['adresse']);

	$this->SetFont('Quicksand','',50);
	$this->SetTextColor(180);
	$this->Text(120,20,'FACTURE');

	$this->SetTextColor(0);
	$this->SetFont('Futura','',30);
	// Décalage à droite
	$this->Cell(33);
	$this->Cell(20,10,'HIGHKICKS',0,1,'C');
	$this->Ln();
	$this->SetFont('roboto','',15);
	$this->Cell(0,6,utf8_decode('HIGHKICKS'),0,1);
	$this->Cell(0,6,utf8_decode('01480 Frans'),0,1);
	$this->Cell(0,6,utf8_decode('FRANCE'),0,1);
	$this->Cell(0,6,utf8_decode('842 188 625 R.C.S. Bourg-en-Bresse'),0,1);
	$this->Cell(0,6,utf8_decode('contact@highkicks.fr'),0,1);
	$this->Cell(120);
	$this->Cell(140,6,utf8_decode(mb_strtoupper( mb_substr( $coordonnees['Nom'], 0, 1 )) . mb_substr( $coordonnees['Nom'], 1 ) . ' ' . mb_strtoupper( mb_substr( $coordonnees['Prenom'], 0, 1 )) . mb_substr( $coordonnees['Prenom'],1)) ,0,1);
	$this->Cell(120);
	$this->SetAutoPageBreak(true);
	$this->Cell(140,6,utf8_decode($coordonnees['adresse']),0,1);
	$this->Cell(120);
	$this->Cell(140,6,utf8_decode($coordonnees['code_postal'] . ' ' . $coordonnees['ville']),0,1);
	$this->Cell(120);
	$this->Cell(140,6,utf8_decode($coordonnees['pays']),0,1);
	$this->Ln();
	$this->Cell(140,6,utf8_decode('Réalisée le '. date("d/m/y")),0,1);
	$this->Cell(140,6,utf8_decode('Facture n°').$no_commande,0,1);
	$this->Ln();
//. ' ' . mb_strtoupper( mb_substr( $coordonnees['Prenom'], 0, 1 )) . mb_substr( $coordonnees['Prenom'])
}

// Pied de page
function Footer()
{
	$this->SetY(-30);

	$this->SetFont('Quicksand','',15);

	$this->Cell(0,5,'___________________________________________________',0,0,'C');

	$this->SetFont('Quicksand','',10);

	$this->Cell(-185,20,utf8_decode('HIGHKICKS/SERVIDOM - Route de biesse 01480 FRANS - 842 188 625 R.C.S. Bourg-en-Bresse'),0,0,'C');

	

	

	// Positionnement à 1,5 cm du basfgd j
	$this->SetY(-15);
	// Police Arial italique 8
	$this->SetFont('Quicksand','',8);
	// Numéro de page
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}


// Tableau simple
function BasicTable($header, $data)
{
	$w = array(65, 35, 13, 18, 18, 43);
    // En-tête
    for($i=0;$i<count($header);$i++)
    {
    	$this->SetFillColor(0);
    	$this->SetTextColor(255);
        $this->Cell($w[$i],8,$header[$i],1,0,'C',true);
    }
    $this->Ln();
    $this->SetFillColor(255);
    $this->SetTextColor(0);
    // Données
	$n = 0;
    foreach($data as $row)
    {
    	if ($n % 2 == 0) {
    		$this->SetFillColor(255);
    	} else {
    		$this->SetFillColor(210);
    	}
        for($i=0;$i<count($row);$i++)
        {
            $this->CellFit($w[$i],8,utf8_decode($row[$i]),1,0,'C', true,'',false, false);
        }
        $this->Ln();

        $n+=1;
    }
    $this->SetFillColor(255);

}  
}
// Instanciation de la classe dérivée

function PDF_crater(){
	global $panier_recap, $total, $coordonnees, $frais_expedition, $filename;
	$pdf = new PDF();
	$header = array(utf8_decode('Désignation'),utf8_decode('Prix TTC'),utf8_decode('Qté'), utf8_decode('Taille'),utf8_decode('Reduc.'),utf8_decode('Sous-Total TTC'));
	$data = $panier_recap;
	$prix = strval($total)." EUR";
	$totalTTC = number_format(strval($total)+$frais_expedition,2, ',',' ');

	$pdf->AddFont('Futura','','Futura Std Heavy Oblique.php');
	$pdf->AddFont('Quicksand','','Quicksand_Bold.php');
	$pdf->AddFont('roboto','','helvetica.php');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->aa();

	$pdf->SetFont('Quicksand','',18);
	// $pdf->Cell(0,8,utf8_decode('Toute l\'équipe de HIGH KICKS vous remercie pour vos'),0,1,'C');
	// $pdf->Cell(0,8,utf8_decode('achats et vous souhaite une bonne réception. En cas de'),0,1,'C');
	// $pdf->Cell(0,8,utf8_decode('problème, n\'hésitez pas à nous contacter pour nous le'),0,1,'C');
	// $pdf->Cell(0,8,utf8_decode('signaler.'),0,1,'C');
	$pdf->SetFont('Quicksand','',13);
	$pdf->Ln(4);
	$pdf->BasicTable($header,$data);
	$pdf->Ln();
	$pdf->SetFont('Quicksand','',18);
	$pdf->Cell(140,8,'Total HT : ',0,0,'R');
	$pdf->SetX(0);
	$pdf->Cell(200,8,number_format($prix,2,',', ' ') . ' EUR',0,1,'R');
	$pdf->Cell(140,8,utf8_decode("Frais d'expédition : "),0,0,'R');
	$pdf->SetX(0);
	$pdf->Cell(200,8,str_replace('.', ',', $frais_expedition.' EUR'),0,1,'R');

	$pdf->SetFont('Quicksand','',12);
	$pdf->Cell(190,8,'TVA non applicable, art. 293 B du CGI',0,1,'R');
	$pdf->SetFont('Quicksand','',18);

	$pdf->Cell(140,15,'Total TTC : ',0,0,'R');
	$pdf->SetX(0);
	$pdf->Cell(200,15, $totalTTC.' EUR',0,1,'R');
	$pdf->SetFont('Quicksand','',9);


	$pdf-> AddPage();
	$pdf-> Image('https://highkicks.fr/phptopdf/CGV-1.png',0,0, 210);

	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	if ($uri_parts[0]!="/return/") {
		$path = '/home/highkicks/public_html/data/commandes/cancelled/';
	} else {
		$path = '/home/highkicks/public_html/data/commandes/resume/';
	}
	
	//$pdf->Output();
	$dossier = $path . $_SESSION['connected_id'];
	if(!is_dir($dossier)){
		mkdir($dossier);
	}
	$export = $dossier . '/' . $filename;
	$pdf->Output($export,'F');
}
PDF_crater();
?>

