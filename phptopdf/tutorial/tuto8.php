<?php
session_start();
require('../rotation.php');






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
	$this->Image('logo.png',8,5,25);
	// Police Futura 50
	$this->SetFont('Futura','',50);
	// Décalage à droite
	$this->Cell(80);
	// Titre
	$this->Cell(30,16,'HIGH KICKS',0,0,'C');
	// Police Futura 50
	$this->SetFont('Quicksand','',12);
	// Décalage à droite
	$this->Cell(78);
	//N°
	$this->Cell(0,-11,'	',0,0,'C');
	// Saut de ligne
	$this->Ln(38);
}

// Pied de page
function Footer()
{
	$this->SetY(-30);

	$this->SetFont('Quicksand','',15);

	$this->Cell(0,5,'___________________________________________________',0,0,'C');

	$this->Cell(-185,20,'Site internet : highkicks.fr                  contact : contact@highkicks.fr
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
	$pdf=new PDF();
$header = array('Désignation','Prix (TTC)','Qté','Reduc.','Sous-Total');
$data = [array('Nom1','25','1','/','25'),array('Nom2','27','2','offert','0')];
$prix = 25;
$pdf->AddFont('Futura','','../Futura Std Heavy Oblique.php');
$pdf->AddFont('Quicksand','','../Quicksand_Bold.php');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Quicksand','',18);
$pdf->Cell(0,10,'Toute l’équipe de HIGH KICKS vous remercie pour vos',0,1,'C');
$pdf->Cell(0,10,'achats et vous souhaite une bonne réception. En cas de',0,1,'C');
$pdf->Cell(0,10,'problème, n’hésitez pas à nous contacter pour nous le',0,1,'C');
$pdf->Cell(0,10,'signaler.',0,1,'C');
$pdf->SetFont('Quicksand','',16);
$pdf->Ln(4);
$pdf->BasicTable($header,$data);
$pdf->SetFont('Quicksand','',18);
$pdf->Cell(335,10,'Total TTC : '.$prix.'',0,1,'C');
$pdf->SetFont('Quicksand','',10);


$pdf->RotatedText(100,60,'Hello!',90);
$pdf->Output();
}

PDF_crater();	
?>

