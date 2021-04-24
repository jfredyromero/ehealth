<?php
    $root = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/conexion.php";
    include $root;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <?php
            $head = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/head.php";
            include $head;
        ?>

        <meta http-equiv="refresh" content="15"/>
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
                        <td valign="center" align=center width=80% colspan=7>
                            <img src="/ehealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align=center width=80% colspan=7 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Ultimos datos medidos del dispositivo eHealth</font>
                            </h1>
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
                    $sql1 = "SELECT * from datos_medidos order by id DESC LIMIT 30"; // Aqu� se ingresa el valor recibido a la base de datos.
                    // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                    $result1 = $mysqli->query($sql1);
                    // la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
                    // tenga alg�n registro resultante. Como la consulta arroja 5 resultados, los �ltimos que tenga la tabla, se ejecutar� 5 veces el siguiente ciclo while.
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
