<?php
include_once("fpdf.php");

 
try {

    $pdo = new PDO('mysql:host=localhost;dbname=sistemasgp', 'root', '');
} catch (PDOException $e) {
    echo "Falha:" . $e->getMessage();
}
 class myPDF extends FPDF{
     
     function headerTable(){
            $this->SetFont('Times','',10);
            $this->Cell(39,8,'Codigo',1,0,'C');
            $this->Cell(39,8,'Cargo',1,0,'C');
            $this->Cell(39,8,'CBO',1,0,'C');
            $this->Cell(39,8,'Grupoderisco',1,0,'C');
            $this->Cell(39,8,'Descricaodaatividade',1,0,'C');
            $this->Cell(39,8,'Tipomo',1,0,'C');
             $this->Cell(36,8,'Grupocargo',1,0,'C');
             $this->Ln();
         
     }
     function header(){
         $this->Image('logopassaura5.png',10,5); 
         $this->SetFont('Arial','B',14);
         $this->Cell(276,5,utf8_decode('Relatório de Cadastro dos Cargos'),0,0,'C');
         $this->Ln(10);
         //$this->SetFont('Times','',12);
         //$this->Cell(276,10,'Employee Documentos',0,0,'C');
         //$this->Ln(20);
         
     }
     function footer(){
         $this->SetY(-15);
         $this->SetFont('Arial','',8);
         $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
         
     }
     function myCell($w,$h,$x,$t){
         $height = $h/3;
         $first  = $height +2;
         $second  = $height+$height+$height+3;
         $len = strlen($t);
         if($len>16){
             $txt = str_split($t,16);
             $this->SetX($x);
             $this->Cell($w,$first,$txt[0],'','','');
             $this->SetX($x);
             $this->Cell($w,$second,$txt[1],'','','');
             $this->SetX($x);
             $this->Cell($w,$h,'','LTRB',0,'L',0);
                       
         }else{
             $this->SetX($x);
             $this->Cell($w,$h,$t,'LTRB',0,'L',0);
                       
         }
   
     }
 }
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf -> AddPage('L','A4',0);
//$pdf->SetFont('Times','',8);
$pdf->headerTable();
$w=38.6;
$h=8;

         
$stmt = $pdo->query('SELECT * FROM CARGO');
while($data = $stmt->fetch(PDO:: FETCH_OBJ)){
 $x=$pdf->GetX();
 $pdf->myCell($w,$h,$x, $data->codigo);
 $x=$pdf->GetX();
 $pdf->myCell($w,$h,$x, $data->cargo);
 $x=$pdf->GetX();
 $pdf->myCell($w,$h,$x, $data->cbo);
 $x=$pdf->GetX();
 $pdf->myCell($w,$h,$x, $data->grupoderisco);
 $x=$pdf->GetX();
 $pdf->myCell($w,$h,$x, $data->descricaodaatividade);
 $x=$pdf->GetX();
 $pdf->myCell($w,$h,$x, $data->tipomo);
 $x=$pdf->GetX();
 $pdf->myCell($w,$h,$x, $data->grupocargo);
$pdf->Ln();
}

$pdf->Output(); 



 


