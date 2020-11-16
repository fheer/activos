<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* Con este código se crea el HEADER y FOOTER
*/
class PDF extends FPDF
{
	function Header()
	{
		$this->SetFont('Arial','B',15);
		$this->Cell(0,10,utf8_decode("ACTA DE ENTREGA DE INVENTARIO INDIVIDUALIZADO DE ACTIVOS FIJOS"),1,0,'C');
		$this->Cell(0,10,utf8_decode("INCOS - NOCTURNO "),1,0,'C');
		$this->Cell(0,10,utf8_decode('U.A.F. ...../'),1,0,'C');
		$this->Ln(20);
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->Cell(0,10,utf8_decode('FIRMA RESPONSABLE'),1,0,'C');
		$this->Cell(0,10,utf8_decode('NOMBRE'),1,0,'C');
		$this->Cell(0,10,utf8_decode('CI'),1,0,'C');
		$this->Cell(0,10,utf8_decode('COCHABAMBA, fecha'),1,0,'C');
		$this->Cell(-15,10,utf8_decode('Página ') . $this->PageNo(),0,0,'C');
	}
}
