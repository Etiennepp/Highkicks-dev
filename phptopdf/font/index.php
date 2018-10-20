<?php
session_start();
header( 'content-type: text/html; charset=utf-8' );
require('../phptopdf/rotation.php');
$panier_recap=array();
$arr2='';
try {
	$bdd = new PDO("mysql:host=highkicks.fr; dbname=highkicks_bdd;", "highkick_admin", "[Wit0wska//4rett4H0urQuet]");    
	$bdd->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    $bdd->setAttribute(pdo::ATTR_EMULATE_PREPARES, false);
    $bdd->exec('SET NAMES utf8');
    $query_articles = $bdd->prepare("SELECT * FROM Articles");
    $query_articles -> execute();
	$articles = $query_articles -> fetchAll();
}
catch(Exception $e) {
    echo 'Exception -> ';
    var_dump($e->getMessage());
}
foreach ($_SESSION['panier']['id'] as $panier) {
	$array_tmp=array();
	$id_tmp = array_search($panier, $_SESSION['panier']['id']);

	$qte= $_SESSION['panier']['qteProduit'][$id_tmp];

	$total+= floatval(array_column($articles, 'prix')[$id_tmp])*intval($qte);

	$array_tmp[]=array_column($articles, 'nom')[$id_tmp];	
	$array_tmp[]=strval(array_column($articles, 'prix')[$id_tmp])." EUR";
	$array_tmp[]=strval($qte);	
	$array_tmp[]=strval("/");	
	$array_tmp[]=strval(intval($qte)*array_column($articles, 'prix')[$id_tmp])." EUR";

	$panier_recap[]=$array_tmp;

}
$total=strval($total)." EUR";

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
function Header()
{
	// Logo
	$this->Image('https://highkicks.fr/phptopdf/logo.png',8,6,15);
	$this->Image('https://highkicks.fr/phptopdf/backpdf.png',8,25,400);
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	if ($uri_parts[0]!="/return/") {
		//$this->Image('https://highkicks.fr/phptopdf/cancelled-stamp.png',8,25,140);
	}


	$this->SetFont('Quicksand','',50);
	$this->SetTextColor(180);
	$this->Text(120,20,'FACTURE');

	$this->SetTextColor(0);
	$this->SetFont('Futura','',30);
	// Décalage à droite
	$this->Cell(33);
	$this->Cell(20,10,'HIGH KICKS',0,1,'C');
	$this->Ln();
	$this->SetFont('roboto','',15);
	$this->Cell(0,5,utf8_decode('Adresse de la société'),0,1);
	$this->Cell(0,5,utf8_decode('69000'),0,1);
	$this->Cell(0,5,utf8_decode('Telephone'),0,1);
	$this->Cell(0,5,utf8_decode('highkicks.fr'),0,1);

	$this->Cell(33,50);
	$this->Ln();
	$this->Ln();

}

// Pied de page
function Footer()
{
	$this->SetY(-30);

	$this->SetFont('Quicksand','',15);

	$this->Cell(0,5,'___________________________________________________',0,0,'C');

	$this->Cell(-185,20,'Site internet : highkicks.fr                      contact : sav@highkicks.fr
',0,0,'C');

	

	

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
	$w = array(80, 35, 15, 25, 37);
    // En-tête
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],8,$header[$i],1,0,'C');
    $this->Ln();
    // Données
    foreach($data as $row)
    {
        for($i=0;$i<count($row);$i++)
            $this->Cell($w[$i],8,$row[$i],1,0,'C');
        $this->Ln();
    }
}
}
// Instanciation de la classe dérivée

function PDF_crater(){
	global $panier_recap, $total;
	$pdf = new PDF();
	$header = array(utf8_decode('Désignation'),utf8_decode('Prix (TTC)'),utf8_decode('Qté'),utf8_decode('Reduc.'),utf8_decode('Sous-Total'));
	$data = $panier_recap;
	$prix = $total;

	$pdf->AddFont('Futura','','Futura Std Heavy Oblique.php');
	$pdf->AddFont('Quicksand','','Quicksand_Bold.php');
	$pdf->AddFont('roboto','','helveticaldd.php');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Quicksand','',18);
	$pdf->Cell(0,8,utf8_decode('Toute l\'équipe de HIGH KICKS vous remercie pour vos'),0,1,'C');
	$pdf->Cell(0,8,utf8_decode('achats et vous souhaite une bonne réception. En cas de'),0,1,'C');
	$pdf->Cell(0,8,utf8_decode('problème, n\'hésitez pas à nous contacter pour nous le'),0,1,'C');
	$pdf->Cell(0,8,utf8_decode('signaler.'),0,1,'C');
	$pdf->SetFont('Quicksand','',16);
	$pdf->Ln(4);
	$pdf->BasicTable($header,$data);
	$pdf->SetFont('Quicksand','',18);
	$pdf->Cell(320,20,'Total TTC : '.$prix.'',0,1,'C');
	$pdf->SetFont('Quicksand','',9);

	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	if ($uri_parts[0]!="/return/") {
		$path = '/home/highkicks/public_html/data/commandes/cancelled/'.uniqid($_SESSION['pseudo']."_");
	} else {
		$path = '/home/highkicks/public_html/data/commandes/resume/'.uniqid($_SESSION['pseudo']."_");
	}
	
	$pdf->Output();
	//$pdf->Output($path,'F');
}

PDF_crater();
?>

