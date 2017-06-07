<?php
require('fpdf.php');
require_once("biblioteca.php");
 session_start();
 $con =conbd();

   $sesion=$_SESSION['id'];
  if($sesion=="")
  {
      header("Location: index.php");
  }
  $desde="";
  $hasta="";
if (isset($_GET['desde']))
{
    $desde= $_GET['desde'];
    $hasta= $_GET['hasta'];
    $sql="SELECT * From lote where idUsuario='".$sesion."'AND fechaElaboracion BETWEEN  '".$desde."' and '".$hasta."' order by fechaElaboracion";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
}
 else {
    $sql="SELECT * From lote where idUsuario='".$sesion."'order by fechaElaboracion";
        $res=mysqli_query($con, $sql);
        $num=mysqli_num_rows($res);
}
//conectamos con la base de datos usando la funcion de la biblioteca
class PDF extends FPDF
{
// Cabecera de página
function Header($desde="",$hasta="")
{
    
    
 
   
          // Movernos a la derecha
    $this->Cell(70);
    
   
    
    $this->SetFont('Arial','B',15);
    // Título
    $this->Cell(60,10,'Outfits de Temporada',1,0,'C');
    // Salto de línea
    if (isset($_GET['desde']))
    {
         $this->Cell(38);
        $this->SetFont('Arial','I',8);
         $this->Cell(24,5,"Desde ".SQLAfecha($_GET['desde']),0,0,'L');
        $this->Cell(30,5,"Hasta ".SQLAfecha($_GET['hasta']),0,0,'L');
         $this->Cell(25);
        
    }
    $this->Ln(17);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
 while($fila=mysqli_fetch_array($res))
 {
        $pdf->SetFont('Times','',12);
        $pdf->Cell(30);
            $pdf->SetFillColor(210,210,210);
            $pdf->Cell(40,6,'Outfit:',1,0,'L',true);
            $pdf->Cell(70,6,$fila["receta"],1,0,'L');
        $pdf->Ln();
        $pdf->Cell(30);
            $pdf->Cell(40,6,'Fecha inicio:',1,0,'L',true);
            $pdf->Cell(70,6,  SQLAfecha($fila["fechaElaboracion"]),1,0,'L');
        $pdf->Ln();
        $pdf->Cell(30);
            $pdf->Cell(40,6,'Fecha fin:',1,0,'L',true);
            $pdf->Cell(70,6,  SQLAfecha($fila["fechaCaducidad"]),1,0,'L');
        $pdf->Ln();
        $pdf->Cell(30);
            $pdf->Cell(40,6,'Numero de coleccion:',1,0,'L',true);
            $pdf->Cell(70,6,$fila["numeroLote"],1,0,'L');
        $pdf->Ln(11);
       

            $pdf->Cell(45,8,'PRENDAS',1,0,'C',true);
            $pdf->Cell(45,8,'MARCA',1,0,'C',true);
            $pdf->Cell(45,8,'NUMERO DE PRENDA',1,0,'C',true);
            $pdf->Cell(45,8,'ADQUISICION',1,0,'C',true);
            $pdf->Ln();
            
            $sql1="SELECT * From productoslote where idLote='".$fila["idLote"]."'";
            $res1=mysqli_query($con,$sql1);

            while($fila1=mysqli_fetch_array($res1))
            {
                if($fila1["imagen"]=="")
                {
                 $pdf->Cell(45,6,$fila1["nombre"],1,0,'L');
                $pdf->Cell(45,6,$fila1["marca"],1,0,'L');
                $pdf->Cell(45,6,$fila1["numeroLote"],1,0,'L');
                $pdf->Cell(45,6,  SQLAfecha($fila1["fechaCaducidad"]),1,0,'L');
                $pdf->Ln(); 
                }
                else { 
                    
                    $pdf->Cell(45,21,$fila1["nombre"],1,0,'L');
                    $pdf->Cell(45,21,$fila1["marca"],1,0,'L');
                     $pdf->Image('imgUsu/'.$fila1["imagen"],null,null,36);
                     $pdf->Cell(45);
                      $pdf->Ln(-20);
                      $pdf->Cell(135);
                    $pdf->Cell(45,21,  SQLAfecha($fila1["fechaCaducidad"]),1,0,'L');
                    $pdf->Ln(28);

                }
            }
         $pdf->Ln();
        $pdf->Ln();  
       
 }

$pdf->Output();
?>
