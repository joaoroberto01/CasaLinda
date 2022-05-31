<?php

require_once CLASSES_PATH . "fpdf/fpdf.php";



function generatePDF(){	
	$pdf = new FPDF();

	$header = ['Data', 'Nome', 'Valor Unit.', 'Qtd', 'Valor Total'];

	$data = [['31/05/2022', 'Batata Frita', 'R$50,00', '599', 'R$29.950,00'], ['31/05/2022', 'Batata Assada', 'R$30,00', '299', 'R$8.970,00']];
	$pdf->SetFont('Arial','',14);
	$pdf->AddPage();
	
	reportTable($pdf, $header, $data);

	echo $pdf->Output('I');
}

function reportTable($pdf, $header, $data = []){
	$pdf->Cell(60);

	$pdf->Image("res/img/logo.png",10,6,20);

	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(70,10, utf8_decode('Relatório de Entradas'), 'LRT', 0,'C');
	$pdf->Ln(10);

	$pdf->Cell(60);
	$pdf->SetFont('Arial','',14);
	$pdf->Cell(70,10, utf8_decode("30/05/2022 - 01/06/2022"), 1, 1,'C');

	$pdf->Ln(20);


	$w = array(30, 70, 30, 20, 40);

	$pdf->SetFont('Arial','B',14);
	for($i = 0; $i < count($header);$i++)
		$pdf->Cell($w[$i],7,$header[$i],1,0,'C');

	$pdf->Ln();

	$pdf->SetFont('Arial','',14);

	foreach($data as $row) {
		$pdf->Cell($w[0],6,$row[0],'L', 0, 'C');
		$pdf->Cell($w[1],6,$row[1], 'LR', 0, 'C');
		$pdf->Cell($w[2],6,$row[2], 'LR', 0,'C');
		$pdf->Cell($w[3],6,$row[3], 'LR', 0,'C');
		$pdf->Cell($w[4],6,$row[4], 'R', 0,'C');
		$pdf->Ln();
	}

	$pdf->Cell(array_sum($w),0,'','T');

	$pdf->Ln(5);

	$pdf->SetFont('Arial','',14);
	$pdf->Cell(47.5, 10, utf8_decode('Valor de Entrada:'), 'LTB', 0,'C');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(47.5, 10, 'R$999.920,00', 'RTB', 0);
	$pdf->SetFont('Arial','',14);
	$pdf->Cell(47.5, 10, utf8_decode('Valor Líquido: '), 'TB', 0,'C');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(47.5, 10, 'R$999.920,00', 'RTB', 0);
}
?>