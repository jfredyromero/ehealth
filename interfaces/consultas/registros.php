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
                            <b>Condición Climática</b>
                        </td>
                    </tr>

                    <?php
                        $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                        $sql1 = "SELECT * from datos_medidos order by id DESC LIMIT 30"; // Aqu� se ingresa el valor recibido a la base de datos.
                        $result1 = $mysqli->query($sql1);
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
