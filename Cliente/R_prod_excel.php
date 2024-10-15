<?php

require("../Servidor/conexion.php");



// nombre del archivo y charset
header('Content-Type: text/csv; charset=latin1');
header('Content-Disposition: attachment; filename="Reporte_Productos.csv"');

// Salida del archivo
$salida = fopen('php://output', 'w');

// Encabezados del CSV
fputcsv($salida, array('Id', 'Nombre producto', 'Cantidad', 'Precio ($)', 'Color', 'foto', 'tamaño'));

// Consulta para obtener los datos
$reporteCsv = mysqli_query($conexion, 'SELECT * FROM productos');

// Verificar si la consulta fue exitosa
if (!$reporteCsv) {
    die("Error en la consulta: " . $mysqli->error);
}

// Escribir los datos en el archivo CSV
while ($filaR = $reporteCsv->fetch_assoc()) {
    fputcsv($salida, array(
        $filaR['idprod'],
        $filaR['nombre'],
        $filaR['cantidad'],
        $filaR['precio'],
        $filaR['color'],
        $filaR['foto'],
        $filaR['tamanio']
    ));
}

// Cerrar la salida
fclose($salida);
?>