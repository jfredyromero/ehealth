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
                                <font color=white>Editar Usuario</font>
                            </h1>
                        </td>
                    </tr>

                    <?php
                    if ((isset($_POST["enviado"]))){
                        $NombreCompleto = $_POST["nombre_completo"];
                        $identificacion_Usuario =$_POST["identificacion"];
                        $DireccionUsuario =$_POST["direccion"];
                        $loginUsuario = $_POST["login"];
                        $TipoUsuario = $_POST["tipo_usuario"];
                        $contraseña = $_POST["contraseña"];
                        $contraseña_codific = md5($contraseña);

                        $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.

                        if($contraseña_codific != null){
                            $sql2 = "UPDATE datos_usuarios set passwd='$contraseña_codific' where identificacion=$identificacion_Usuario";
                            $result2 = $mysqli->query($sql2);
                        }

                        $sql1 = "UPDATE datos_usuarios set nombre_completo='$NombreCompleto' where identificacion=$identificacion_Usuario";
                        // la siguiente l�nea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexi�n a la base de datos mysqli
                        $result1 = $mysqli->query($sql1);

                        $sql3 = "UPDATE datos_usuarios set direccion='$DireccionUsuario' where identificacion=$identificacion_Usuario";
                        $result3 = $mysqli->query($sql3);

                        $sql4 = "UPDATE datos_usuarios set login ='$loginUsuario' where identificacion=$identificacion_Usuario";
                        $result4 = $mysqli->query($sql4);

                        $sql5 = "UPDATE datos_usuarios set tipo_usuario=$TipoUsuario where identificacion=$identificacion_Usuario";
                        $result5 = $mysqli->query($sql5);


                        if (($result1 == 1)&&($result3 == 1)&&($result5 == 1)&& ($result4 == 1) && ($result1 == 1)){
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
                        $identificacion_Usuario=$_POST["identificacion"];
                        $sql1="SELECT * from datos_usuarios WHERE identificacion=$identificacion_Usuario";
                        $result1 = $mysqli->query($sql1);
                        $row1 = $result1->fetch_array(MYSQLI_NUM);

                        $NombreCompleto=$row1[1];
                        $identificacion_Usuario = $row1[2];
                        $DireccionUsuario = $row1[3];
                        $loginUsuario = $row1[4];
                        $TipoUsuario= $row1[6];

                        if ($TipoUsuario=='1') {
                            $Tipo_Ad='Administrador';
                        }else{
                            $Tipo_Ad='';
                        }

                        if ($TipoUsuario=='0') {
                            $Tipo_Con='selected';
                        }else{
                            $Tipo_Con='';
                        }
                        ?>
                         </tr>
                    <?php
                    }else{
                        $mysqli = new mysqli($host, $user, $pw, $db);
                        $identificacion_Usuario=$_GET["identificacion"];
                        $sql1="SELECT * from datos_usuarios WHERE identificacion=$identificacion_Usuario";
                        $result1 = $mysqli->query($sql1);
                        $row1 = $result1->fetch_array(MYSQLI_NUM);

                        $NombreCompleto=$row1[1];
                        $identificacion_Usuario = $row1[2];
                        $DireccionUsuario = $row1[3];
                        $loginUsuario =  $row1[4];
                        $TipoUsuario= $row1[6];


                        if ($TipoUsuario=='1') {
                            $Tipo_Ad='Administrador';
                        }else{
                            $Tipo_Ad='';
                        }

                        if ($TipoUsuario=='0') {
                            $Tipo_Con='selected';
                        }else{
                            $Tipo_Con='';
                        }
                    }

                    ?>

                    <form method=POST action="editar.php">
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Nombre Completo:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                <input type="text" name="nombre_completo" value= "<?php echo $NombreCompleto; ?>" required>

                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Identificacion:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                <input type="number"  value=<?php echo $identificacion_Usuario; ?> disabled>
                                <input type="hidden" name="identificacion" value=<?php echo $identificacion_Usuario; ?>>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Tipo de Usuario:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                <div class="dropdown">
                                    <select class="btn btn-secondary" name="tipo_usuario" >
                                        <option value="1" <?php echo $Tipo_Ad;?> >Administrador</option>
                                        <option value="0" <?php echo $Tipo_Con;?> >Consulta</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Login</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                <input type="text" name="login" value= <?php echo $loginUsuario; ?>  required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Constraseña Nueva:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                <input type="password" name="contraseña" value= "">
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=2>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Direccion:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=4>
                                <input type="text" name="direccion" value= "<?php echo $DireccionUsuario; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center colspan=6>
                                <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/consultas/usuarios.php" role="button">
                                    <i class="fas fa-angle-double-left"></i>
                                    <span class="pl-3">Volver</span>
                                </a>
                                <input type="hidden" name="enviado" value="S1">
                                <button style="background-color:#281E5D; color:white" type="submit" class="btn btn-lg"><i style="background-color:#281E5D; color:white" class="fas fa-save"></i><span class="pl-3">Guardar</span></button>
                            </td>
                        </tr>
                    </form>
                    <tr>
                    </tr>
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
