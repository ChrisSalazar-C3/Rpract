<?php

include_once("../Servidor/conexion.php");

// Mostrar errores de PHP para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ejecución de la consulta y manejo de errores -u 
$sql = "SELECT r.categoria, COUNT(u.idcate) as sum 
        FROM productos AS u 
        INNER JOIN categorias AS r 
        ON u.idcate = r.idcate 
        GROUP BY u.idcate";

$res = $conexion->query($sql);

if (!$res) {
    die("Error en la consulta SQL: " . $conexion->error);
}

// Verificar si la consulta devuelve filas
$rows = [];
while ($fila = $res->fetch_assoc()) {
    // Cambiar 'idcate' por 'categoria' para mostrar el nombre
    $rows[] = "['" . $fila["categoria"] . "'," . $fila["sum"] . "]";
}
?>
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    // Carga Google Charts
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Verifica si hay datos en PHP
        var data = google.visualization.arrayToDataTable([
            ['Tipos de categoria', 'Cantidad por categoria'],
            <?php
                // Si hay filas en la consulta, genera el gráfico
                if (!empty($rows)) {
                    echo implode(",", $rows);
                } else {
                    // Si no hay filas, usa un gráfico de prueba
                    
                }
            ?>
        ]);

        var options = {
            title: 'TIPOS DE PRODUCTOS',
            width: 600,
            height: 400,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
    </script>
</head>
<body>
<header>
    <!--ENCABEZADO-->
    <?php include_once("include/encabezado.php"); ?>
    <!--ENCABEZADO-->
    <div class="container">

        <p style="text-align:right">
            <?php
            echo  $_SESSION['nombre'];
            echo " ";
            echo $_SESSION['paterno'];
            echo " ";
            echo $_SESSION['materno'];
            echo " ";
            echo $_SESSION['rol'];
            ?>
        </p>

    </div>
</header>

    <!-- Contenedor para el gráfico -->
    <div id="chart_div" style="width: 600px; height: 400px;"></div>
    

    <footer>
        <!--PIE-->
        <?php include_once("include/footer.php"); ?>
        <!--PIE-->
    </footer>
</body>
</html>
