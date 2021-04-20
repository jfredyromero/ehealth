<?php
    $root = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/conexion.php";
    include $root;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>eHealth</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="/ehealth/static/css/styles.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="/ehealth/static/img/favicon.png">
    </head>
    <body background="/ehealth/static/img/background.jpg">
        <h1 id="home-title">eHealth: Dispositivo IoT</h1>
        <div id="home">
            <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #281E5D;">
                <!-- Toggler/collapsibe Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/ehealth/interfaces/consultas/ultimos.php">
                                Últimos
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Consultas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/ehealth/interfaces/consultas/ultimos.php">Últimos</a>
                                <a class="dropdown-item" href="/ehealth/interfaces/consultas/fechas.php">Fechas</a>
                                <a class="dropdown-item" href="/ehealth/interfaces/consultas/dispositivos.php">Dispositivos</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ehealth/interfaces/probabilidades/probabilidades.php">Probabilidades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/ehealth/interfaces/rangos/rangos.php">Rangos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><strong>Username</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Salir</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div id="page-content">
                <table width="80%" align=center cellpadding=5 border=1>
                    <tr>
                        <td valign="center" align=center width=80& colspan=7>
                            <img src="/ehealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align=center width=80& colspan=7 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Consulta datos medidos dispositivo eHealth, por rango de fechas</font>
                            </h1>
                        </td>
                    </tr>

                    <?php
                        if ((isset($_POST["enviado"]))){
                            $enviado = $_POST["enviado"];
                            if ($enviado == "S1"){
                                $fecha_ini = $_POST["fecha_ini"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
                                $fecha_fin = $_POST["fecha_fin"];
                                $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                    ?>

                    <tr>
                        <td valign="center" align=center bgcolor="#E1E1E1" colspan=7>
                            <b>Rango de fechas consultado: desde <?php echo $fecha_ini; ?> hasta <?php echo $fecha_fin; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>#</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>ID Tarjeta</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Fecha</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Hora</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Temperatura</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Humedad</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Presencia de lluvia</b>
                        </td>
                    </tr>
                    <?php
                        // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
                        $sql1 = "SELECT * from datos_medidos where fecha >= '$fecha_ini' and fecha <= '$fecha_fin' order by fecha";
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result1 = $mysqli->query($sql1);
                        // la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
                        // tenga alg�n registro resultante. Como la consulta arroja X resultados, se ejecutar� X veces el siguiente ciclo while.
                        // el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente
                        $contador = 0;
                        while($row1 = $result1->fetch_array(MYSQLI_NUM)){
                            $ID_TARJ = $row1[1];
                            $temp = $row1[2];
                            $hum = $row1[3];
                            $fecha = $row1[4];
                            $hora = $row1[5];
                            $lluvia = $row1[6];
                            $contador++;
                    ?>
                    <tr>
                        <td valign="center" align=center>
                            <?php echo $contador; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $ID_TARJ; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $fecha; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $hora; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $temp." *C"; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $hum." %"; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php
                                if ($lluvia == 1){
                            ?>

                            <img src="/ehealth/static/img/rainy.png" width=32 height=32>

                            <?php
                                }
                                else{
                            ?>

                            <img src="/ehealth/static/img/sunny.png" width=32 height=32>

                            <?php
                                }
                            ?>
                        </td>
                    </tr>

                    <?php
                        }  // FIN DEL WHILE
                        echo '
                        <tr>
                            <form method=POST action="fechas.php">
                                <td bgcolor="#EEEEEE" align=center colspan=7>
                                    <button style="background-color:#281E5D; color:white" value="Volver" type="submit" class="btn btn-lg" name="submit"><i style="background-color:#281E5D; color:white" class="fas fa-angle-double-left"></i><span class="pl-3">Volver</span></button>
                                </td>
                            </form>
                        </tr>';
                        }   // FIN DEL IF, si ya se han recibido las fechas del formulario
                        }   // FIN DEL IF, si la variable enviado existe, que es cuando ya se env�o el formulario
                        else
                        {
                    ?>

                    <form method=POST action="fechas.php">
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Fecha Inicial:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=5>
                                <input type="date" name="fecha_ini" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Fecha Final:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=5>
                                <input type="date" name="fecha_fin" value="" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center colspan=7>
                                <input type="hidden" name="enviado" value="S1">
                                <button style="background-color:#281E5D; color:white" value="Consultar" type="submit" class="btn btn-lg" name="submit"><i style="background-color:#281E5D; color:white" class="fas fa-search"></i><span class="pl-3">Consultar</span></button>
                            </td>
                        </tr>
                    </form>

                    <?php
                        }
                    ?>

                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    </body>
</html>
