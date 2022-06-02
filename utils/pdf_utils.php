<?php

require_once CLASSES_PATH . "fpdf/fpdf.php";

function generatePDF($reportData){
	$pdf = new FPDF();

	$pdf->SetFont('Arial','',14);
	$pdf->AddPage();
	
	reportTable($pdf, $reportData);

	$date = formatDate($reportData['finalDate'], "d/m/Y");

	$name = utf8_decode("Relatório_${reportData['type']}s_$date.pdf");

	//echo $pdf->Output('I', $name);
	$pdf->Output('D', $name);
}

function reportTable($pdf, $reportData){
	$type = $reportData['type'];

	$movementsController = new MovementsController();
	$movements = $movementsController->getReport($type, $reportData['startDate'], $reportData['finalDate']);
	
	$startDateF = formatDate($reportData['startDate'], "d/m/Y");
	$finalDateF = formatDate($reportData['finalDate'], "d/m/Y");

	$pdf->Cell(60);

	$pdf->Image("res/img/logo.png",10,6,20);

	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(70,10, utf8_decode("Relatório de ${type}s"), 'LRT', 0,'C');
	$pdf->Ln(10);

	$pdf->Cell(60);
	$pdf->SetFont('Arial','',14);
	$pdf->Cell(70,10, "$startDateF - $finalDateF", 1, 1,'C');

	$pdf->Ln(20);

	$header = ['Data e Hora', 'Nome', 'Qtd', 'Preço', 'Valor Total'];

	$w = array(40, 60, 20, 30, 40);

	$pdf->SetFont('Arial','B',14);
	for($i = 0; $i < count($header);$i++)
		$pdf->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'C');

	$pdf->Ln();

	$pdf->SetFont('Arial','',14);

	$sum = 0;
	foreach($movements as $movement){
		$date = $movement['date'];
		$price = $movement['price'];
		$amount = $movement['amount'];

		$date = substr(formatDate($date), 0, 16);

		$total = $price * $amount;
		$sum += $total;
		$total = formatCurrency($total);
		$price = formatCurrency($price);

		$pdf->SetFont('Arial','',12);
		$pdf->Cell($w[0], 6, $date,'L', 0, 'C');
		$pdf->Cell($w[1], 6, $movement['name'], 'LR', 0, 'C');
		$pdf->SetFont('Arial','',14);
		$pdf->Cell($w[2], 6, $amount, 'LR', 0,'C');
		$pdf->Cell($w[3], 6, $price, 'LR', 0,'C');
		$pdf->Cell($w[4], 6, $total, 'R', 0,'C');
		$pdf->Ln();
	}

	$pdf->Cell(array_sum($w),0,'','T');

	$pdf->Ln(5);

	$sum = formatCurrency($sum);

	$pdf->SetFont('Arial','',14);
	$pdf->Cell(47.5, 10, utf8_decode("Valor de $type:"), 'LTB', 0,'C');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(47.5, 10, $sum, 'RTB', 0);
	$pdf->SetFont('Arial','',14);
	if($type == "Saída"){
		$pdf->Cell(47.5, 10, utf8_decode('Valor Líquido: '), 'TB', 0,'C');
		$pdf->SetFont('Arial','B',14);

		$profit = $movementsController->getProfit($reportData['startDate'], $reportData['finalDate']);

		$profit = formatCurrency($profit);


		$pdf->Cell(47.5, 10, $profit, 'RTB', 0);
	}
}
?>