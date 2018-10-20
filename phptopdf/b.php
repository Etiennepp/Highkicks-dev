<?php
require('fpdf.php');
 
$pdf=new FPDF();
 
$pdf_larg = $pdf->w;
$pdf_long = $pdf->h;
 
$pdf->AddPage();
// on met la prochaine couleur de remplissage en noir
$pdf->SetFillColor(0,0,0);
// on dessine un grand rectangle coloré (cf le DF)
$pdf->Rect(0,0, $pdf_larg, $pdf_long, DF);
 
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(40,10,'Ceci est un texte en blanc sur fond noir !!');
 
$pdf->AddPage();
// on met la prochaine couleur de remplissage en rouge
$pdf->SetFillColor(255,0,0);
$pdf->Rect(0,0, $pdf_larg, $pdf_long, DF);
 
$pdf->SetFont('Arial','B',16);
$pdf->SetTextColor(0, 0, 255);
$pdf->Cell(50,30,'Et ceci est un texte en bleu sur fond rouge !!');
 
$pdf->SetDisplayMode( 'fullpage' , 'two' );
 
$pdf->Output();
?>