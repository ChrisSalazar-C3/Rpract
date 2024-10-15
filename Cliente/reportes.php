<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>INICIO</title>
</head>

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


<body>

<div class="container" style="text-align: center;">
    <div class="row">
        <div class="col">
            <a href="R_usu_excel.php">
                <img src="imagenes/archivo-excel.png" alt="">
            </a>
        </div>
        
        <div class="col">
            <a href="R_usu_pdf.php">
                <img src="imagenes/archivo-pdf.png" alt="">
            </a>
        </div>
        
        <div class="col">
            <a href="R_usu_grafica.php">
                <img src="imagenes/barra-grafica.png" alt="">
            </a>
        </div>
    </div>
</div>


    <footer><!--PIE-->
        <?php include_once("include/footer.php"); ?>
        <!--PIE-->

    </footer>



</body>




</html>