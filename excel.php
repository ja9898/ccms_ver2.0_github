<?php
//USEFUL LINKS
// http://stackoverflow.com/questions/12795615/how-to-make-table-use-fpdf

// http://interpid.eu/fpdf-table/examples

$emp_name = $_GET['emp_name'];
$emp_designation = $_GET['emp_designation'];
$emp_shift = $_GET['emp_shift'];
$emp_app_date = $_GET['emp_app_date'];
$paid_leaves = $_GET['paid_leaves'];

$basic_pay = $_GET['basic_pay'];
$working_days = $_GET['working_days'];
$days_worked = $_GET['days_worked'];
$gross_pay_ad = $_GET['gross_pay_ad'];

$increament = $_GET['increament'];
$arrears = $_GET['arrears'];
$incentive_bonus = $_GET['incentive_bonus'];
$commision_paid = $_GET['commision_paid'];
$commision_unpaid = $_GET['commision_unpaid'];
$trvl_allow = $_GET['trvl_allow'];


$staff_adv = $_GET['staff_adv'];
$fine = $_GET['fine'];
$other_deduction = $_GET['other_deduction'];
$tea_deduction = $_GET['tea_deduction'];

$residance_allowance = $_GET['residance_allowance'];
$net_payable = $_GET['net_payable'];
$salaries_paid = $_GET['salaries_paid'];
$payment_date = $_GET['payment_date'];

$total_earn = $_GET['total_earn'];
$total_deduct = $_GET['total_deduct'];

$date_month = date('m', strtotime( nl2br($payment_date)));
$date_year = date('Y', strtotime( nl2br($payment_date)));
if($date_month=='01'){$mon='Jan';}	//
if($date_month=='02'){$mon='Feb';}	//
if($date_month=='03'){$mon='Mar';}	//
if($date_month=='04'){$mon='Apr';}	//
if($date_month=='05'){$mon='May';}	//
if($date_month=='06'){$mon='Jun';}	//
if($date_month=='07'){$mon='Jul';}	//
if($date_month=='08'){$mon='Aug';}	//
if($date_month=='09'){$mon='Sep';}	//
if($date_month=='10'){$mon='Oct';}	//
if($date_month=='11'){$mon='Nov';}	//
if($date_month=='12'){$mon='Dec';}	//

//require('fpdf/fpdf.php');
require('fpdf/pdf_js.php');

class PDF_AutoPrint extends PDF_JavaScript
{
function AutoPrint($dialog=false)
{
    //Open the print dialog or start printing immediately on the standard printer
    //$param=($dialog ? 'true' : 'false');
    $param = 'true';
	$script="print($param);";
    $this->IncludeJS($script);
}

function AutoPrintToPrinter($server, $printer, $dialog=false)
{
    //Print on a shared printer (requires at least Acrobat 6)
    $script = "var pp = getPrintParams();";
    if($dialog)
        $script .= "pp.interactive = pp.constants.interactionLevel.full;";
    else
        $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
    $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
    $script .= "print(pp);";
    $this->IncludeJS($script);
}
}

class PDF extends FPDF
{
// Page header	// Coming from pdf class and currently NOT IS USE
function Header()
{
    // Logo
    $this->Image('fpdf/tutorial/zeb_fortunes_logo.png',10,6,30);
    //$this->Cell(30,10,'Zeb fortunes');
	
	// Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(60,10,'Zeb Fortunes Pvt Ltd',1,0,'C');
	//$this->Cell(30,10,'Pay Slip');
	
	// Line break
    $this->Ln(10);
	
	// Arial bold 15
    $this->SetFont('Arial','B',10);
    // Move to the right
    $this->Cell(60);
	//Address
	$this->Cell(60,10,'Office # 1, 2nd Floor, Grace Plaza, 5th Road,',0,0,'C');
	//$this->Cell(30,10,'Pay Slip');
	
	// Line break
    $this->Ln(5);
	
	// Arial bold 15
    $this->SetFont('Arial','B',10);
    // Move to the right
    $this->Cell(60);
	//Address
	$this->Cell(60,10,'Commercial Market, Rawalpindi.',0,0,'C');
	//$this->Cell(30,10,'Pay Slip');
	
	// Line break
    $this->Ln(10);
	
/*	// Arial bold 15
    $this->SetFont('Arial','B',11);
    // Move to the right
    $this->Cell(60);
	//Pay slip for the month of
	$this->Cell(60,10,'Pay Slip for the Month of '.$aug,0,0,'C');
	
	
	// Line break
    $this->Ln(20);*/
	
	
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
/*$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,'Payment month: '.$aug,0,1);*/

//NEW PDF for this PDF page
$pdf = new PDF();
//NEW PDF for PDF AUTO PRINT
$pdf=new PDF_AutoPrint();
$pdf->AliasNbPages();
$pdf->AddPage();


//NOTE: Following HEADER is not used from the fpdf class and it has been made manually
	// Logo
    $pdf->Image('fpdf/tutorial/zeb_fortunes_logo.png',10,6,30);
    //$this->Cell(30,10,'Zeb fortunes');
	
	// Arial bold 15
    $pdf->SetFont('Arial','B',15);
    // Move to the right
    $pdf->Cell(60);
    // Title
    $pdf->Cell(60,10,'Zeb Fortunes Pvt Ltd',1,0,'C');
	//$this->Cell(30,10,'Pay Slip');
	
	// Line break
    $pdf->Ln(10);
	
	// Arial bold 15
    $pdf->SetFont('Arial','B',10);
    // Move to the right
    $pdf->Cell(60);
	//Address
	$pdf->Cell(60,10,'Office # 1, 2nd Floor, Grace Plaza, 5th Road,',0,0,'C');
	//$this->Cell(30,10,'Pay Slip');
	
	// Line break
    $pdf->Ln(5);
	
	// Arial bold 15
    $pdf->SetFont('Arial','B',10);
    // Move to the right
    $pdf->Cell(60);
	//Address
	$pdf->Cell(60,10,'Commercial Market, Rawalpindi.',0,0,'C');
	//$this->Cell(30,10,'Pay Slip');
	
	// Line break
    $pdf->Ln(10);


$pdf->SetFont('Times','B',12);
$pdf->Cell(180,10,'Pay Slip for the Month of: '.$mon.' '.$date_year,0,2,'C',0);
$pdf->Ln();
$pdf->Ln();


$pdf->Cell(30,5,'Employee Name:',0,0,'',0);$pdf->Cell(40,5,' '.$emp_name,0,0,'',0);$pdf->Cell(50,5,'No of days worked:',0,0,'',0);$pdf->Cell(30,5,' '.$days_worked,0,0,'',0);
$pdf->Ln();
$pdf->Cell(30,5,'Designation:',0,0,'',0);$pdf->Cell(40,5,' '.$emp_designation,0,0,'',0);$pdf->Cell(50,5,'Paid Leaves',0,0,'',0);$pdf->Cell(30,5,' '.$paid_leaves,0,0,'',0);
$pdf->Ln();
$pdf->Cell(30,5,'Shift:',0,0,'',0);$pdf->Cell(40,5,' '.$emp_shift,0,0,'',0);
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(60,10,'Earning','LT',0,'L',0);$pdf->Cell(30,10,'Amount','RT',0,'R',0);$pdf->Cell(60,10,'Deduction','LT',0,'L',0);$pdf->Cell(30,10,'Amount','RT',0,'R',0);
$pdf->Ln();


$pdf->Cell(60,5,'Gross pay before Deduction','LT',0,'',0);$pdf->Cell(30,5,$basic_pay,'RT',0,'R',0);$pdf->Cell(60,5,'Staff advance','LT',0,'',0);$pdf->Cell(30,5,$staff_adv,'RT',0,'R',0);
$pdf->Ln();
$pdf->Cell(60,5,'Gross pay after Deduction','L',0,'',0);$pdf->Cell(30,5,$gross_pay_ad,'R',0,'R',0);$pdf->Cell(60,5,'Fine','L',0,'',0);$pdf->Cell(30,5,$fine,'R',0,'R',0);
$pdf->Ln();
$pdf->Cell(60,5,'Increament','L',0,'',0);$pdf->Cell(30,5,$increament,'R',0,'R',0);$pdf->Cell(60,5,'Other deduction','L',0,'',0);$pdf->Cell(30,5,$other_deduction,'R',0,'R',0);
$pdf->Ln();
$pdf->Cell(60,5,'Arrears','L',0,'',0);$pdf->Cell(30,5,$arrears,'R',0,'R',0);$pdf->Cell(60,5,'Tea deduction','L',0,'',0);$pdf->Cell(30,5,$tea_deduction,'R',0,'R',0);
$pdf->Ln();
$pdf->Cell(60,5,'Incentive/Bonus','L',0,'',0);$pdf->Cell(30,5,$incentive_bonus,'R',0,'R',0);$pdf->Cell(60,5,'','L',0,'',0);$pdf->Cell(30,5,'','R',0,'R',0);
$pdf->Ln();
$pdf->Cell(60,5,'Commision Unpaid','L',0,'',0);$pdf->Cell(30,5,$commision_unpaid,'R',0,'R',0);$pdf->Cell(60,5,'','L',0,'',0);$pdf->Cell(30,5,'','R',0,'',0);
$pdf->Ln();
$pdf->Cell(60,5,'Commision paid','L',0,'',0);$pdf->Cell(30,5,$commision_paid,'R',0,'R',0);$pdf->Cell(60,5,'','L',0,'',0);$pdf->Cell(30,5,'','R',0,'',0);
$pdf->Ln();
$pdf->Cell(60,5,'Travelling Allowance','LB',0,'',0);$pdf->Cell(30,5,$trvl_allow,'RB',0,'R',0);$pdf->Cell(60,5,'','LB',0,'',0);$pdf->Cell(30,5,'','RB',0,'',0);
$pdf->Ln();

//$pdf->Cell(60,5,'',0,0,'',0);$pdf->Cell(30,5,'',0,0,'R',0);$pdf->Cell(60,5,'',0,0,'',0);$pdf->Cell(30,5,'',0,0,'',0);
//$pdf->Ln();


$pdf->Cell(60,5,'Total Earning','LTB',0,'L',0);$pdf->Cell(30,5,$total_earn,'RTB',0,'R',0);$pdf->Cell(60,5,'Total Deduction','LTB',0,'L',0);$pdf->Cell(30,5,$total_deduct,'RTB',0,'R',0);
$pdf->Ln();

$pdf->Cell(60,10,'','LTB',0,'',0);$pdf->Cell(30,10,'','TB',0,'R',0);$pdf->Cell(60,10,'Net payable','TB',0,'',0);$pdf->Cell(30,10,($total_earn)-($total_deduct),'RTB',0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(40,10,'HR Manager','T',0,'L',0);$pdf->Cell(30,10,'','',0,'',0);$pdf->Cell(60,10,'','',0,'',0);$pdf->Cell(40,10,'Employee Signature','T',0,'R',0);




// Rectangle
//$pdf->Rect(10, 160, 180, 5, ''); //MIGHT BE USEFUL LATER


//$pdf->Output($emp_name.'_'.$mon.'_'.$date_year,'D');
$pdf->AutoPrint(false);
//$pdf->IncludeJS("print('true');"); 
$pdf->Output();


?>