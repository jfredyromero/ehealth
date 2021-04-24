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
                        <td valign="center" align=center width=80% colspan=6>
                            <img src="/ehealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="center" align=center width=80% colspan=6 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Consulta de dispositivos eHealth</font>
                            </h1>
                        </td>
                    </tr>
                    <tr height=20>
                    </tr>
                    <tr>
                        <?php

                        if (isset($_GET["submit"]) && !empty($_GET["submit"])) {
                            $id = $_GET["id_tarjeta"];
                            $sql5 = "SELECT estado from datos_dispositivos WHERE id_tarjeta= $id";
                            $result5 = $mysqli->query($sql5);
                            $row5 = $result5->fetch_array(MYSQLI_NUM);
                            if ($row5 == NULL) {
                                ?>
                                <tr>
                                    <td valign="center" align=center bgcolor="#E1E1E1" colspan=7>
                                        <b>El ID solicitado NO existe</b>
                                    </td>
                                </tr>
                                <?php
                                unset($_GET["submit"]);
                            }
                            else{
                                ?>
                                <tr>
                                    <td valign="center" align=center bgcolor="#E1E1E1" colspan=7>
                                        <b>Usted ha consultado el ID: <?php echo $id; ?></b>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        <form method="GET">
                            <td style="border: none;" valign="center" align=center colspan=3>
                            </td>
                            <td style="border: none;" valign="center" align=right colspan=1>
                                <input type="number" class="form-control" name="id_tarjeta" placeholder="ID de la tarjeta..." required>
                            </td>
                            <td style="border: none;" valign="center" align=center colspan=2>
                                <button style="background-color:#281E5D; color:white" value="Buscar" type="submit" class="btn btn-lg" name="submit"><i style="background-color:#281E5D; color:white" class="fas fa-search"></i><span class="pl-3">Buscar</span></button>
                            </td>
                        </form>
                    </tr>
                    <tr height=20>
                    </tr>
                    <tr height=50>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>ID de la Tarjeta</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Propietario</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Ubicación</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Estado</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1">
                            <b>Último registro</b>
                        </td>
                        <td valign="center" align=center bgcolor="#E1E1E1" width=80px>
                            <b>Editar</b>
                        </td>
                    </tr>

                    <?php

                    $mysqli1 = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                    // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
                    $sql1 = "SELECT * from datos_dispositivos order by id_tarjeta"; // Aqu� se ingresa el valor recibido a la base de datos.
                    //
                    // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                    $result1 = $mysqli->query($sql1);
                    // la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
                    // tenga alg�n registro resultante. Como la consulta arroja 5 resultados, los �ltimos que tenga la tabla, se ejecutar� 5 veces el siguiente ciclo while.
                    // el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente
                    if (isset($_GET["submit"]) && !empty($_GET["submit"])) {
                        $sql2 = "SELECT MAX(fecha) from datos_medidos WHERE id_tarjeta= $id";
                        $result2 = $mysqli->query($sql2);
                        $row2 = $result2->fetch_array(MYSQLI_NUM);
                        $fecha = $row2[0];
                        $sql3 = "SELECT * from datos_dispositivos WHERE id_tarjeta= $id";
                        $result3 = $mysqli->query($sql3);
                        while ($row3 = $result3->fetch_array(MYSQLI_NUM)) {
                            $propietario = $row3[3];
                            $estado = $row3[1];
                            $ubicacion = $row3[2];
                        }
                        /*$result3 = $mysqli->query($sql3);
                        $row3 = $result3->fetch_array(MYSQLI_NUM);
                        $estado = $row3[0];
                        $sql7 = "SELECT ubicacion from datos_dispositivos WHERE id_tarjeta= $id";
                        $result7 = $mysqli->query($sql7);
                        $row7 = $result7->fetch_array(MYSQLI_NUM);
                        $ubicacion = $row7[0];
                        $sql8 = "SELECT propietario from datos_dispositivos WHERE id_tarjeta= $id";
                        $result8 = $mysqli->query($sql8);
                        $row8 = $result8->fetch_array(MYSQLI_NUM);
                        $propietario = $row8[0]; */
                    ?>
                        <tr>
                            <td valign="center" align=center>
                                <?php echo $id; ?>
                            </td>
                            <td valign="center" align=center>
                                <?php echo $propietario; ?>
                            </td>
                            <td valign="center" align=center>
                                <?php echo $ubicacion; ?>
                            </td>
                            <td valign="center" align=center>
                                <?php
                                if ($estado == 1) {
                                ?>
                                    <img src="/ehealth/static/img/comprobado.png" width=32 height=32>
                                <?php
                                } else {
                                ?>
                                    <img src="/ehealth/static/img/cancelar.png" width=32 height=32>
                                <?php
                                }
                                ?>
                            </td>
                            <td valign="center" align=center>
                                <?php echo $fecha; ?>
                            </td>
                            <td valign="center" align=center>
                                <a class="btn btn-lg btn-block" href="/ehealth/interfaces/consultas/editar.php?id_tarjeta=<?php echo $ID_TARJ; ?>" role="button">
                                    <img src="/ehealth/static/img/dibujar.png" width=32 height=32>
                                </a>
                            </td>
                        </tr>
                        <tr height=20>
                        </tr>
                        <tr>
                            <td style="border: none;" valign="center" align=left colspan=4>
                                <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/dispositivos.php" role="button">
                                    <i class="fas fa-angle-double-left"></i>
                                    <span class="pl-3">Volver</span>
                                </a>
                            </td>
                            <td style="border: none;" valign="center" align=right colspan=2>
                                <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/añadir.php" role="button">
                                    <i class="fas fa-plus-circle"></i>
                                    <span class="pl-3">Nuevo</span>
                                </a>
                            </td>
                        </tr>
                        <tr height=20>
                        </tr>
                        <?php
                    } else {
                        $contador = 0;
                        while ($row1 = $result1->fetch_array(MYSQLI_NUM)) {
                            $ID_TARJ = $row1[0];
                            $propietario = $row1[3];
                            $estado = $row1[1];
                            $ubicacion = $row1[2];
                            $contador++;
                            $sql2 = "SELECT MAX(fecha) from datos_medidos WHERE id_tarjeta= $contador";
                            $result2 = $mysqli->query($sql2);
                            $row2 = $result2->fetch_array(MYSQLI_NUM);
                            $fecha = $row2[0];
                        ?>
                            <tr>
                                <td valign="center" align=center>
                                    <?php echo $ID_TARJ; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $propietario; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $ubicacion; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php
                                    if ($estado == 1) {
                                    ?>
                                        <img src="/ehealth/static/img/comprobado.png" width=32 height=32>
                                    <?php
                                    } else {
                                    ?>
                                        <img src="/ehealth/static/img/cancelar.png" width=32 height=32>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $fecha; ?>
                                </td>
                                <td valign="center" align=center>
                                    <a class="btn btn-lg btn-block" href="/ehealth/interfaces/consultas/editar.php?id_tarjeta=<?php echo $ID_TARJ; ?>" role="button">
                                        <img src="/ehealth/static/img/dibujar.png" width=32 height=32>
                                    </a>
                                </td>
                            </tr>

                    <?php
                        }
                    ?>

                    <tr height=20>
                    </tr>
                    <tr>
                        <td style="border: none;" valign="center" colspan=4>
                        </td>
                        <td style="border: none;" valign="center" align=right colspan=2>
                            <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/añadir.php" role="button">
                                <i class="fas fa-plus-circle"></i>
                                <span class="pl-3">Nuevo</span>
                            </a>
                        </td>
                    </tr>
                    <tr height=20>
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
