<?php
    require('fpdf/fpdf.php');
// Database Connection
$conn = new mysqli('localhost', 'root', 'arktechdb', 'ojtDatabase');


//Check for connection error
if($conn->connect_error)
{
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}

// Select data from MySQL database
$select = "SELECT * FROM `tbl_jeramay` ORDER BY id";
$result = $conn->query($select);
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);



class PDF extends Fpdf
{
    // Page header
    function Header()
    {
        // Arial bold 15
       $this -> SetFont('Arial','B',12);
       $this->SetFillColor(91,96,104);
       $this->SetTextColor(255);
        // Move to the right (for Center Position)
       
        // header
        $this->Cell(12,10,'ID',1,0,'C',true);
        $this->Cell(40,10,'First Name',1,0,'C',true);
        $this->Cell(40,10,'Last Name',1,0,'C',true);
        $this->Cell(120,10,'Address',1,0,'C',true);
        $this->Cell(30,10,'Birthday',1,0,'C',true);
        $this->Cell(25,10,'Gender',1,0,'C',true);
        
        
        // Line break
       $this -> Ln(10);
    }
    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
       $this->SetY(-15);
        // Arial italic 8
       $this->SetFont('Arial','B',8);
        // Page number
       $this->Cell(0,10,'Page '.$this -> PageNo().' out of {nb}',0,0,'C');
    }
    
}
    $pdf = new PDF('L','mm','A4');
    /* A4 - 210 * 297 mm */
    $pdf -> AliasNbPages(); // Must for print total no of page
    $pdf -> AddPage();
 
    $pdf->SetFont('Arial','B',11);
    


    
    while($row = $result->fetch_object())
    {
      
      $id = $row->id;
      $firstName = $row->firstName;
      $lastName = $row->lastName;
      $address = $row->address;
      $birthday = $row->birthday;
      $gender = $row->gender;
      

      
      
      if($id%2==0)
      {
        $pdf->SetFillColor(255,255,147);
        $pdf->Cell(12,10,$id,1,0,'C',true);
        $pdf->Cell(40,10,$firstName,1,0,'C',true);
        $pdf->Cell(40,10,$lastName,1,0,'C',true);
        $pdf->Cell(120,10,$address,1,0,'C',true);
        $pdf->Cell(30,10,($birthday),1,0,'C',true);
        $pdf->Cell(25,10,($gender)== '0'? "Male":"Female",1,0,'C',true);
        $pdf->Ln();


      }else
      {
        $pdf->SetFillColor(182,215,168);
        $pdf->Cell(12,10,$id,1,0,'C',true);
        $pdf->Cell(40,10,$firstName,1,0,'C',true);
        $pdf->Cell(40,10,$lastName,1,0,'C',true);
        $pdf->Cell(120,10,$address,1,0,'C',true);
        $pdf->Cell(30,10,($birthday),1,0,'C',true);
        $pdf->Cell(25,10,($gender)== '0'? "Male":"Female",1,0,'C',true);
        $pdf->Ln();
      }
      
      
    }

$pdf->Output();

?>