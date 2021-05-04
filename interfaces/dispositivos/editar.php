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
                        <td valign="top" align=center width=80& colspan=6>
                            <img src="/ehealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align=center width=80& colspan=6 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Editar Dispositivo</font>
                            </h1>
                        </td>
                    </tr>

                    <?php
                    if ((isset($_POST["enviado"]))){
                        $santi = $_POST["enviado"];
                        echo $santi;
                        $id_tarjeta = $_POST['id_tarjeta'];
                        $propietario =$_POST['propietario'];
                        $ubicacion =$_POST['ubicacion'];
                        $estado = $_POST['estado'];

                        $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.

                        $sql1 = "UPDATE datos_dispositivos set propietario='$propietario' where id_tarjeta='$id_tarjeta'";
                        //echo "sql1".$sql1;
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result1 = $mysqli->query($sql1);

                        $sql2 = "UPDATE datos_dispositivos set ubicacion='$ubicacion' where id_tarjeta='$id_tarjeta'";
                        //echo "sql2".$sql2;
                        $result2 = $mysqli->query($sql2);

                        $sql3 = "UPDATE datos_dispositivos set estado='$estado' where id_tarjeta='$id_tarjeta'";
                        //echo "sql3".$sql3;
                        $result3 = $mysqli->query($sql3);

                        if (($result1 == 1)&&($result2 == 1)&&($result3 == 1)){
                            $mensaje = "Datos modificados correctamente";
                        }else{
                            $mensaje = "Inconveniente el editar los datos";
                        }

                        echo '<tr>
                        <td bgcolor="#EEEEFF" align=center colspan=6>
                                <font FACE="arial" SIZE=2 color="#000048"> <b>'.$mensaje.'</b></font>
                                </td>
                        </tr>';

                        $mysqli = new mysqli($host, $user, $pw, $db);
                        $id_tarj=$_POST["id_tarjeta"];
                        $sql1="SELECT * from datos_dispositivos WHERE id_tarjeta= '$id_tarj'";
                        $result1 = $mysqli->query($sql1);
                        $row1 = $result1->fetch_array(MYSQLI_NUM);

                        $id_ta = $row1[0];
                        $estado = $row1[1];
                        $ubicacion = $row1[2];
                        $propietario= $row1[3];

                        if ($estado=='1') {
                            $estado_si='selected';
                        }else{
                            $estado_si='';
                        }

                        if ($estado=='0') {
                            $estado_no='selected';
                        }else{
                            $estado_no='';
                        }

                    }else{
                        $mysqli = new mysqli($host, $user, $pw, $db);
                        $id_tarj=$_GET["id_tarjeta"];
                        $sql1="SELECT * from datos_dispositivos WHERE id_tarjeta= '$id_tarj'";
                        $result1 = $mysqli->query($sql1);
                        $row1 = $result1->fetch_array(MYSQLI_NUM);

                        $id_ta = $row1[0];
                        $estado = $row1[1];
                        $ubicacion = $row1[2];
                        $propietario= $row1[3];

                        if ($estado=='1') {
                            $estado_si='selected';
                        }else{
                            $estado_si='';
                        }

                        if ($estado=='0') {
                            $estado_no='selected';
                        }else{
                            $estado_no='';
                        }
                    }

                    ?>

                    <form method=POST action="editar.php">
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>ID:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                 <input type="number"  value=<?php echo $id_ta; ?> disabled>
                                 <input type="hidden" name="id_tarjeta" value=<?php echo $id_ta; ?> >
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Propietario</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                <input type="text" name="propietario" value= "<?php echo $propietario; ?>" required>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Ubicación</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                <input type="text" name="ubicacion" value= <?php echo $ubicacion; ?>  required>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Estado:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                <div class="dropdown">
                                    <select class="btn btn-secondary" name="estado" >
                                        <option value="1" <?php echo $estado_si;?> >Activo</option>
                                        <option value="0" <?php echo $estado_no;?> >Inactivo</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center colspan=6>
                                <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/administradores/dispositivos.php" role="button">
                                    <i class="fas fa-angle-double-left"></i>
                                    <span class="pl-3">Volver</span>
                                </a>
                                <input type="hidden" name="enviado" value="S1">
                                <button style="background-color:#281E5D; color:white" type="submit" class="btn btn-lg"><i style="background-color:#281E5D; color:white" class="fas fa-save"></i><span class="pl-3">Guardar</span></button>
                            </td>
                        </tr>
                    </form>

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
