<?php
    $conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include $conexion;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $autenticacion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/autenticacion_sesion.php";
    include $autenticacion;
    $validacion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/validar_acceso.php";
    include $validacion;
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
                        <td valign="center" align=center width=100% colspan=6 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Consulta de busquedas eHealth</font>
                            </h1>
                        </td>
                    </tr>
                </table>
                <table width="90%" align=center cellpadding=5 border=0>
                    <tr height=20>
                    </tr>
                    <tr>
                        <form method="POST">
                            <td style="border: none;" valign="center" align=center colspan=1>
                                <input type="Text" class="form-control" name="nombre_buscar" placeholder="Buscar por nombre...">
                            </td>
                            <td style="border: none;" valign="center" align=right colspan=2>
                                <label for="fecha_ini_buscar">Fecha Inicial</label>
                                <input type="date" name="fecha_ini_buscar" value="">
                                <br>
                                <label for="fecha_fin_buscar">Fecha Final</label>
                                <input type="date" name="fecha_fin_buscar" value="">
                            </td>
                            <td style="border: none;" valign="center" align=right colspan=1>
                                <button style="background-color:#281E5D; color:white" value="Buscar" type="submit" class="btn btn-lg" name="submit"><i style="background-color:#281E5D; color:white" class="fas fa-search"></i><span class="pl-3">Buscar</span></button>
                            </td>
                        </form>
                    </tr>
                </table>
                <table width="90%" align=center cellpadding=5 border=1>
                    <tr>
                        <?php
                            $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                            if (isset($_POST["submit"])) {
                                $nombre_buscar=$_POST["nombre_buscar"];
                                $fecha_ini_buscar=$_POST["fecha_ini_buscar"];
                                $fecha_fin_buscar=$_POST["fecha_fin_buscar"];
                                if ($nombre_buscar==null && $fecha_ini_buscar==null && $fecha_fin_buscar==null) { 
                                    // Si los campos estan vacios....
                        ?>
                                    <tr height=20>
                                    </tr>
                                    <tr>
                                        <td valign="center" align=center bgcolor="#E1E1E1" colspan=6>
                                            <b>No se puede realizar búsqueda - Por favor ingrese un valor</b>
                                        </td>
                                    </tr>
                                    <tr height=20>
                                    </tr>
                                    <tr height=50>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Usuario</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Fecha</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Hora</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1" width=300>
                                            <b>Consulta</b>
                                        </td>
                                <?php
                                    $sql1 = "SELECT * from datos_usuarios"; // Aqu� se ingresa el valor recibido a la base de datos.
                                    $result1 = $mysqli->query($sql1);
                                    //$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                                    $sql2 = "SELECT datos_usuarios.nombre_completo, fecha, hora, fecha_inicial_consulta, fecha_final_consulta, datos_dispositivos.ubicacion from datos_consultas JOIN datos_usuarios ON datos_consultas.id_usuario = datos_usuarios.id JOIN datos_dispositivos ON datos_consultas.id_tarjeta_consulta = datos_dispositivos.id_tarjeta";
                                    $result2 = $mysqli->query($sql2);
                                    while ($row1 = $result2->fetch_array(MYSQLI_NUM)) {
                                        $nombre_usuario = $row1[0];
                                        $fecha = $row1[1];
                                        $hora = $row1[2];
                                        $fecha_ini = $row1[3];
                                        $fecha_fin = $row1[4];
                                        $ubicacion = $row1[5];
                                ?>
                                    <tr height=60>
                                        <td valign="center" align=center>
                                            <?php echo $nombre_usuario; ?>
                                        </td>
                                        <td valign="center" align=center>
                                            <?php echo $fecha; ?>
                                        </td>
                                        <td valign="center" align=center width=140>
                                            <?php echo $hora; ?>
                                        </td>
                                        <td valign="center" align=center width=80>
                                            Se consultó por las probabilidades en <?php echo $ubicacion; ?> durante las fechas <?php echo $fecha_ini; ?> y <?php echo $fecha_fin; ?> 
                                        </td>
                                <?php 
                                }
                            }else{
                                // Si alguno de los campos tiene texto 
                                ?>
                            </tr>
                                    <?php
                                        if($fecha_ini_buscar!=null && $fecha_fin_buscar!=null){
                                        // Si se filtra por fechas
                                        $sql5 = "SELECT datos_usuarios.nombre_completo, fecha, hora, fecha_inicial_consulta, fecha_final_consulta, datos_dispositivos.ubicacion from datos_consultas JOIN datos_usuarios ON datos_consultas.id_usuario = datos_usuarios.id JOIN datos_dispositivos ON datos_consultas.id_tarjeta_consulta = datos_dispositivos.id_tarjeta WHERE fecha >= '$fecha_ini_buscar' AND fecha <= '$fecha_fin_buscar' ORDER BY fecha";
                                        $result5=$mysqli->query($sql5);
                                        $row5 = $result5->fetch_array(MYSQLI_NUM);
                                            if($row5 == NULL){
                                                $sql1 = "SELECT datos_usuarios.nombre_completo, fecha, hora, fecha_inicial_consulta, fecha_final_consulta, datos_dispositivos.ubicacion from datos_consultas JOIN datos_usuarios ON datos_consultas.id_usuario = datos_usuarios.id JOIN datos_dispositivos ON datos_consultas.id_tarjeta_consulta = datos_dispositivos.id_tarjeta";
                                    ?>
                                                <tr height=20>
                                                </tr>
                                                 <tr>
                                                    <td valign="center" align=center bgcolor="#E1E1E1" colspan=6>
                                                        <b>No hay consultas realizadas entre <?php echo $fecha_ini_buscar?> y <?php echo $fecha_fin_buscar?></b>
                                                    </td>
                                                </tr>
                                    <?php

                                            }else{
                                            $sql1 = "SELECT datos_usuarios.nombre_completo, fecha, hora, fecha_inicial_consulta, fecha_final_consulta, datos_dispositivos.ubicacion from datos_consultas JOIN datos_usuarios ON datos_consultas.id_usuario = datos_usuarios.id JOIN datos_dispositivos ON datos_consultas.id_tarjeta_consulta = datos_dispositivos.id_tarjeta WHERE fecha >= '$fecha_ini_buscar' AND fecha <= '$fecha_fin_buscar' ORDER BY fecha";
                                            }
                                    }else{
                                        $sql1 = "SELECT datos_usuarios.nombre_completo, fecha, hora, fecha_inicial_consulta, fecha_final_consulta, datos_dispositivos.ubicacion from datos_consultas JOIN datos_usuarios ON datos_consultas.id_usuario = datos_usuarios.id JOIN datos_dispositivos ON datos_consultas.id_tarjeta_consulta = datos_dispositivos.id_tarjeta";                                        
                                        if($nombre_buscar==null){
                                    ?>
                                        <tr>
                                            <td valign="center" align=center bgcolor="#E1E1E1" colspan=6>
                                                <b>ERROR: Las dos fechas son requeridas</b>
                                            </td
                                        </tr>
                                    <?php
                                        }
                                    }
                                    if($nombre_buscar!=null){
                                        // Si se busca por nombre
                                        $sql5 = "SELECT datos_usuarios.nombre_completo, fecha, hora, fecha_inicial_consulta, fecha_final_consulta, datos_dispositivos.ubicacion from datos_consultas JOIN datos_usuarios ON datos_consultas.id_usuario = datos_usuarios.id JOIN datos_dispositivos ON datos_consultas.id_tarjeta_consulta = datos_dispositivos.id_tarjeta WHERE datos_usuarios.nombre_completo LIKE '%$nombre_buscar%'";
                                        $result5=$mysqli->query($sql5);
                                        $row5 = $result5->fetch_array(MYSQLI_NUM);
                                            if($row5 == NULL){
                                                $sql1 = "SELECT datos_usuarios.nombre_completo, fecha, hora, fecha_inicial_consulta, fecha_final_consulta, datos_dispositivos.ubicacion from datos_consultas JOIN datos_usuarios ON datos_consultas.id_usuario = datos_usuarios.id JOIN datos_dispositivos ON datos_consultas.id_tarjeta_consulta = datos_dispositivos.id_tarjeta";
                                                ?>
                                                <tr>
                                                   <td valign="center" align=center bgcolor="#E1E1E1" colspan=6>
                                                       <b>No hay consultas realizadas por usuarios con un nombre similar a: <?php echo $nombre_buscar?></b>
                                                   </td>
                                               </tr>
                                   <?php
                                            }else{
                                            $sql1 = "SELECT datos_usuarios.nombre_completo, fecha, hora, fecha_inicial_consulta, fecha_final_consulta, datos_dispositivos.ubicacion from datos_consultas JOIN datos_usuarios ON datos_consultas.id_usuario = datos_usuarios.id JOIN datos_dispositivos ON datos_consultas.id_tarjeta_consulta = datos_dispositivos.id_tarjeta WHERE datos_usuarios.nombre_completo LIKE '%$nombre_buscar%'";
                                            }
                                    }
                                    ?>
                                    <!-- <tr height=20>
                                    </tr> -->
                                    <tr height=50>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Usuario</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Fecha</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1">
                                            <b>Hora</b>
                                        </td>
                                        <td valign="center" align=center bgcolor="#E1E1E1" width=300>
                                            <b>Consulta</b>
                                        </td>
                                    <?php
                                    $result3 = $mysqli->query($sql1);
                                    while ($row1 = $result3->fetch_array(MYSQLI_NUM)) {
                                        $nombre_usuario = $row1[0];
                                        $fecha = $row1[1];
                                        $hora = $row1[2];
                                        $fecha_ini = $row1[3];
                                        $fecha_fin = $row1[4];
                                        $ubicacion = $row1[5];
                                    ?>
                                        <tr>
                                            <td valign="center" align=center>
                                                <?php echo $nombre_usuario; ?>
                                            </td>
                                            <td valign="center" align=center>
                                                <?php echo $fecha; ?>
                                            </td>
                                            <td valign="center" align=center width=140>
                                                <?php echo $hora; ?>
                                            </td>
                                            <td valign="center" align=center width=80>
                                                Se consultó por las probabilidades en <?php echo $ubicacion; ?> durante las fechas <?php echo $fecha_ini; ?> y <?php echo $fecha_fin; ?> 
                                            </td>
                                        </tr>
                                <?php } ?>
                                    </table>
                                    <table border=0>
                                        <tr height=20>
                                        </tr>
                                    </table>
                            <table width="90%" align=center cellpadding=5 border=0>
                                <tr>
                                    <td style="border: none;" valign="center" align=left colspan=3>
                                        <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/consultas.php" role="button">
                                            <i class="fas fa-angle-double-left"></i>
                                            <span class="pl-3">Volver</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr height=20>
                                </tr>
                            <?php }

                            }else{ ?>

                            <tr height=20>
                            </tr>
                            <tr height=50>
                                <td valign="center" align=center bgcolor="#E1E1E1">
                                    <b>Usuario</b>
                                </td>
                                <td valign="center" align=center bgcolor="#E1E1E1">
                                    <b>Fecha</b>
                                </td>
                                <td valign="center" align=center bgcolor="#E1E1E1">
                                    <b>Hora</b>
                                </td>
                                <td valign="center" align=center bgcolor="#E1E1E1" width=300>
                                    <b>Consulta</b>
                                </td>
                        <?php
                            //$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                            $sql2 = "SELECT datos_usuarios.nombre_completo, fecha, hora, fecha_inicial_consulta, fecha_final_consulta, datos_dispositivos.ubicacion from datos_consultas JOIN datos_usuarios ON datos_consultas.id_usuario = datos_usuarios.id JOIN datos_dispositivos ON datos_consultas.id_tarjeta_consulta = datos_dispositivos.id_tarjeta";
                            $result2 = $mysqli->query($sql2);
                            while ($row1 = $result2->fetch_array(MYSQLI_NUM)) {
                                $nombre_usuario = $row1[0];
                                $fecha = $row1[1];
                                $hora = $row1[2];
                                $fecha_ini = $row1[3];
                                $fecha_fin = $row1[4];
                                $ubicacion = $row1[5];
                        ?>
                            <tr height=60>
                                <td valign="center" align=center>
                                    <?php echo $nombre_usuario; ?>
                                </td>
                                <td valign="center" align=center>
                                    <?php echo $fecha; ?>
                                </td>
                                <td valign="center" align=center width=140>
                                    <?php echo $hora; ?>
                                </td>
                                <td valign="center" align=center width=80>
                                    Se consultó por las probabilidades en <?php echo $ubicacion; ?> durante las fechas <?php echo $fecha_ini; ?> y <?php echo $fecha_fin; ?> 
                                </td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
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
