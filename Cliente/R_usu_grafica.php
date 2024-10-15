<?php

include_once("../Servidor/conexion.php");


error_reporting(E_ALL);
ini_set('display_errors', 1);


$sql = "SELECT r.tipousu, COUNT(u.idtipo) as sum 
        FROM usuarios AS u 
        INNER JOIN tipousuario AS r 
        ON u.idtipo = r.idtipo 
        GROUP BY u.idtipo";

$res = $conexion->query($sql);

if (!$res) {
    die("Error en la consulta SQL: " . $conexion->error);
}


$rows = [];
while ($fila = $res->fetch_assoc()) {
    $rows[] = "['" . $fila["tipousu"] . "'," . $fila["sum"] . "]";
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
        
        var data = google.visualization.arrayToDataTable([
            ['Tipos de usuario', 'Cantidad por tipo'],
            <?php
                
                if (!empty($rows)) {
                    echo implode(",", $rows);
                } else {
                    
                    echo "['Administrador', 0], ['Gerente', 0], ['Empleado', 0], ['Cliente', 0]";
                }
            ?>
        ]);

        var options = {
            title: 'TIPOS DE USUARIOS',
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

        <p style=text-align:right>
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

    <!--gráfico -->
    <div id="chart_div" style="width: 600px; height: 400px;"></div>
    

    <footer>
            <!--PIE-->
            <?php include_once("include/footer.php"); ?>
            <!--PIE-->
        </footer>
</body>
</html>
