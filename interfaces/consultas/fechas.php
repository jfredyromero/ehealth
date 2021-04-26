<?php
    $conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include $conexion;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $autenticacion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/autenticacion_sesion.php";
    include $autenticacion;
?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <?php
            $head = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/head.php";
            include $head;
        ?>

    </head>
    <body background="/ehealth/static/img/background.jpg">
        <h1 id="home-title">eHealth: Dispositivo IoT</h1>
        <div id="home">

            <?php
                if ($_SESSION["tipo_usuario"]==1)
                    $nav = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/nav_admin.php";
                else
                    $nav = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/nav_user.php";
                include $nav;
            ?>

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
        <div id="jscripts">
            <?php
                $jscripts = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/jscripts.php";
                include $jscripts;
            ?>
        </div>
    </body>
</html>
