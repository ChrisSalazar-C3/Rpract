<?php
require("lib/fpdf/fpdf.php");

class PDF extends FPDF
{
    // Cabecera del PDF
    function Header()
    {
        // Imagen del logo
        $this->Image("imagenes/LOGO.png", 10, 8, 33);

        // Tipo de letra para el título
        $this->SetFont("Arial", 'B', 15);
        
        // Mover a la derecha
        $this->Cell(110);
        
        // Título del reporte
        $this->Cell(60, 10, 'REPORTES DE PRODUCTO EXISTENTES', 0, 0, 'C');
        
        // Salto de línea
        $this->Ln(30);
        
        // Configuración de colores
        $this->SetTextColor(54, 16, 28); // Color del texto
        $this->SetFillColor(196, 153, 108); // Color de fondo
        
        // Encabezado de la tabla
        $this->SetFont("Arial", 'B', 12);
        $this->Cell(20, 10, 'Id', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Nombre', 1, 0, 'C', true);
        
        
        // Salto de línea para comenzar la tabla
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        
        // Tipo de letra del pie de página
        $this->SetFont("Arial", 'B', 8);
        
        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Consulta a la base de datos
require("../Servidor/conexion.php");

// Consulta para obtener los productos
$consulta = "SELECT * FROM categorias;";
$resultado = mysqli_query($conexion, $consulta);

// Crear el PDF
$pdf = new PDF('L'); // Formato horizontal (Landscape)
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10); // Fuente para los datos de la tabla

// Recorrer los resultados de la consulta
while ($row = mysqli_fetch_assoc($resultado)) {
    $pdf->cell(20, 10, $row['idcate'], 1, 0, 'C');    // ID del producto
    $pdf->cell(50, 10, $row['categoria'], 1, 0, 'C');    // Nombre del producto
    $pdf->Ln(10);  // Salto de línea después de cada fila

    
}

// Generar el archivo PDF
$pdf->Output(); // Permitir la salida de los datos
?>
