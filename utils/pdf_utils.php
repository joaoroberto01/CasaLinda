<?php

require_once CLASSES_PATH . "fpdf/fpdf.php";

function generatePDF(){	
	class PDF extends FPDF
	{
// Load data
		function LoadData($file)
		{
    // Read file lines
			$lines = file($file);
			$data = array();
			foreach($lines as $line)
				$data[] = explode(';',trim($line));
			return $data;
		}

// Simple table
		function BasicTable($header, $data)
		{
    // Header
			foreach($header as $col)
				$this->Cell(40,7,$col,1);
			$this->Ln();
    // Data
			foreach($data as $row)
			{
				foreach($row as $col)
					$this->Cell(40,6,$col,1);
				$this->Ln();
			}
		}

// Better table
		function ImprovedTable($header, $data)
		{
    // Column widths
			$w = array(30, 20, 70, 15, 40, 15);
    // Header
			for($i=0;$i < count($header);$i++)
				$this->Cell($w[$i],7,$header[$i],1,0,'C');
			$this->Ln();
    // Data
			foreach($data as $row)
			{
				$this->Cell($w[0],6,$row[0],'L', 0, 'C');
				$this->Cell($w[1],6,$row[1], 0, 0, 'C');
				$this->Cell($w[2],6,$row[2], 0, 0,'C');
				$this->Cell($w[3],6,$row[3], 0, 0,'C');
				$this->Cell($w[4],6,$row[4], 0, 0,'C');
				$this->Cell($w[5],6,$row[5],'R', 0,'C');
				$this->Ln();
			}
    // Closing line
			$this->Cell(array_sum($w),0,'','T');
		}

// Colored table
		function FancyTable($header, $data)
		{
    // Colors, line width and bold font
			$this->SetFillColor(255,0,0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.3);
			$this->SetFont('','B');
    // Header
			$w = array(40, 35, 40, 45);
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$this->Ln();
    // Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
    // Data
			$fill = false;
			foreach($data as $row)
			{
				$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
				$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
				$this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
				$this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
				$this->Ln();
				$fill = !$fill;
			}
    // Closing line
			$this->Cell(array_sum($w),0,'','T');
		}
	}

	$pdf = new PDF();
// Column headings
	$header = ['Data', utf8_decode('Código'), 'Nome', 'Qtd', 'Valor Unit.', 'Tipo'];
// Data loading
	$data = [['31/05/2022', '0001', 'Batata Frita', '599', 'R$50,00', 'E'], ['31/05/2022', '0002', 'Batata Assada', '299', 'R$30,00', 'S']];
	$pdf->SetFont('Arial','',14);
	$pdf->AddPage();
	$pdf->ImprovedTable($header,$data);
	// $pdf->AddPage();
	// $pdf->FancyTable($header,$data);
	echo $pdf->Output('I');
}
?>