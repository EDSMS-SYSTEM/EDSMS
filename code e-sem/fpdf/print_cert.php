
<?php



require('fpdf.php');
session_start();
require '../connection2.php';
require '../functions/user.php';
require '../core/general.php';
require_once '../classes/Token.php';
$session_user_id = $_SESSION['id'];	
function user_datas($user_id){
	require '../connection2.php';
	$data=array();
	$user_id = (int)$user_id;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		$field =  implode(', ', $func_get_args) ;
		$data = $con->prepare("SELECT " . $field . " FROM users WHERE id = ? ");
		$data->bindParam(1,$user_id);
		$data->execute();
		$row=$data->fetchAll();
		 foreach ($row as $data) {}
		return $data;
	}
}
$user_data = user_datas($session_user_id,'id', 'username', 'firstname', 'password' , 'lastname', 'email', 'accesslevel');
$userid = $_GET['userid'];
$stitle = $_GET['semtitle'];
$date = $_GET['semdate'];
if (logged_in() === TRUE && $session_user_id===$userid ){
	$st = $con->prepare("SELECT semtitle from history WHERE userid=?");
	$st->bindParam(1,$userid);
	$st->execute();
	
	
      $semtitle = $st->fetchAll(PDO::FETCH_COLUMN);
	
	$semtitle=array_values($semtitle);
	if (in_array($stitle,$semtitle)){
		$st = $con->prepare("SELECT semdate from history WHERE semdate=?");
	$st->bindParam(1,$date);
	$st->execute();
	
	
      $semdate = $st->fetchAll(PDO::FETCH_COLUMN);
	$semdate=array_values($semdate);
	if (in_array($date,$semdate)){
class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image('frame.png',5,5,282,195);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	
}

// Page footer
function Footer()
{
	// Position at 1.5 cm from bottom
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	
}
function ChapterTitle($label)
{
    // Title
    $this->SetY(50);
    $this->SetFont('Arial','B',25);
	$this->SetTextColor(100,100,100);
    $this->Cell(0,6,"$label",0,1,'C',false);
    // Line break
    $this->Ln(4);
}
function ChapterBody($file)
{
    // Read text file
    $txt = $file;
    // Times 12
    $this->SetFont('Times','',12);
    // Output justified text
    $this->MultiCell(0,5,$txt,0,'C');
    // Line break
    $this->Ln();
    
}
}

// Instanciation of inherited class
$pdf = new PDF('L');
$title = 'CERTIFICATE OF ATTENDANCE';
$name = $user_data['firstname']." ".$user_data['lastname'];
$semtitle = $stitle;
$semdate = $date;
$file = $cond. $session_user_id."The (school title) certifies that \n". $name."\nhas partcipated in the seminar titled\n".$semtitle."\nthat take place in (location) at ".$semdate;
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->ChapterTitle($title);
$pdf->ChapterBody($file);
$pdf->SetFont('Times','',12);
$pdf->Output();
}
}else{print_r($semdate);}}
else{echo"hello";}
?>
