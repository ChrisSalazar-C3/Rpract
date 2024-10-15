<?php
require("lib/fpdf/fpdf.php");
class PDF extends FPDF
{
    function Header()
    {
        $this->Image("imagenes/LOGO.png", 10, 8, 33);

        //tipo de letra
        
        $this->SetFont("Arial", 'B', 15);
        
        
        //movemos a la derecha
        $this->Cell(110);
        
        //titulo
        $this->Cell(60, 10, 'REPORTES DE USUARIO EXISTENTES', 0, 0, 'C');
        
        //salto de linea 
        $this->Ln(30);
        
        //tipo de letra

        $this->SetTextColor(54,16,28);//color a la celda
        $this->SetFillColor(196,153,108);//color a la letra
        


        $this->SetFont("Arial", 'B', 12);
        $this->Ln(10);
        //encabezado de la tabla
        //$this->Cell(30, 10, 0, 0, '');
        $this->Cell(30, 10, 'Nombre', 0, 0, 'C', true);
        $this->Cell(40, 10, 'Paterno', 0, 0, 'C', true );
        $this->Cell(40, 10, 'Materno', 0, 0, 'C', true);
        $this->Cell(90, 10, utf8_decode('Correo electronico'), 0, 0, 'C', true);
        $this->Cell(25, 10, 'Numero', 0, 0, 'C', true);
        //salto de linea
        $this->Ln(10);
    }


    function footer()
    {
        //POSCICION 1.5 al final de la hoja
        $this->SetY(-15);
        $this->SetFont("Arial", 'B', 8);
        $this->Cell(0, 10, 'Pagina' . $this->PageNo(), 0, 0, 'C');
    }
}

//consulta a la base de datos
require("../Servidor/conexion.php");
//$consulta = "SELECT * FROM usuarios;";


$consulta = ("SELECT * FROM usuarios; ");
$resultado = mysqli_query($conexion, $consulta);


$pdf = new PDF('L');
//hacemos referencia a la clase

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
while ($row  = mysqli_fetch_assoc($resultado)) {
    $pdf->cell(30, 10, $row['nomusu'], 1, 0, 'C');
    $pdf->cell(40, 10, $row['apausu'], 1, 0, 'C');
    $pdf->cell(40, 10, $row['amausu'], 1, 0, 'C');
    $pdf->cell(90, 10, $row['correo'], 1, 0, 'C');
    $pdf->cell(25, 10, $row['telefono'], 1, 0, 'C');
    $pdf->Ln(10);

}

$pdf->Output(); //permite la salida de los datos
?>