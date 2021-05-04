<?php
    $conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include $conexion;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <?php
            $head = $_SERVER['DOCUMENT_ROOT']."/ehealth/static/php/head.php";
            include $head;
        ?>

    </head>
    <body background="/eHealth/static/img/background.jpg">
        <h1 id="home-title">eHealth: Dispositivo IoT</h1>
        <div id="home">
            <nav class="navbar navbar-expand-xl navbar-dark" style="background-color: #281E5D; height:50px;">
            </nav>
            <div id="page-content">
                <table width="80%" align=center cellpadding=5 border=1>
                    <tr>
                        <td valign="top" align=center width=80% colspan=6>
                            <img src="/eHealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align=center width=80% colspan=6 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Registrar Usuario</font>
                            </h1>
                        </td>
                    </tr>

                    <?php
                            if ((isset($_POST["enviado"]))){  // Ingresa a este if si el formulario ha sido enviado..., al ingresar actualiza los datos ingresados en el formulario, en la base de datos.
                                $enviado = $_POST["enviado"];
                                if ($enviado == "S1"){
                                    $Nombre = $_POST["nombre"];
                                    $Identificacion = $_POST["identificacion"];
                                    $DireccionUsuario =$_POST["direccion"];
                                    $loginUsuario = $_POST["login"];
                                    $contraseña = $_POST["contrasena"];
                                    $contrasena_codif = md5($contraseña);

                                    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                                    // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos.
                                    // se actualiza la tabla de valores m�ximos
                                    $sql1="INSERT into datos_usuarios (nombre_completo, identificacion, tipo_usuario, direccion, login, passwd) VALUES ('$Nombre','$Identificacion',0,'$DireccionUsuario','$loginUsuario','$contrasena_codif')";
                                    // la siguiente l�nea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexi�n a la base de datos mysqli
                                    $result1 = $mysqli->query($sql1);
                                    if ($result1 == 1){
                                        $mensaje = "Usuario añadido correctamente";
                                    }
                                    else{
                                        $mensaje = "¡ERROR! El usuario no se pudo agregar";
                                    }

                                    echo '<tr>
                                    <td bgcolor="#EEEEFF" align=center colspan=2>
                                            <font FACE="arial" SIZE=2 color="#000048"> <b>'.$mensaje.'</b></font>
                                            </td>
                                    </tr>';

                                }   // FIN DEL IF, si ya se han recibido los datos del formulario
                            }   //FIN DEL IF, si la variable enviado existe, que es cuando ya se env�o el formulario
                                // $mysqli2 = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                                // // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos.
                                // // // se actualiza la tabla de valores m�ximos
                                //  $sql2="SELECT MAX(id_tarjeta) from datos_dispositivos ";
                                // $result2 = $mysqli2->query($sql2);
                                // $row2 = $result2->fetch_array(MYSQLI_NUM);
                                // $id_tarjeta_nueva = $row2[0]+1;

                        ?>

                    <form method=POST action="registrar.php">
                             <tr>
                                <td bgcolor="#CCEECC" align=center colspan=1>
                                    <font FACE="arial" SIZE=2 color="#000044"> <b>Nombre Completo</b></font>
                                </td>
                                <td bgcolor="#EEEEEE" align=center colspan=5>
                                    <input type="text" name="nombre" required>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#CCEECC" align=center colspan=1>
                                    <font FACE="arial" SIZE=2 color="#000044"> <b>Identificacion:</b></font>
                                </td>
                                <td bgcolor="#EEEEEE" align=center colspan=5>
                                     <input type="number" name="identificacion"  required>
                                </td>
                            </tr>

                            <tr>
                                <td bgcolor="#CCEECC" align=center colspan=1>
                                    <font FACE="arial" SIZE=2 color="#000044"> <b>Login</b></font>
                                </td>
                                <td bgcolor="#EEEEEE" align=center colspan=5>
                                    <input type="text" name="login"  required>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#CCEECC" align=center colspan=1>
                                    <font FACE="arial" SIZE=2 color="#000044"> <b>Constraseña:</b></font>
                                </td>
                                <td bgcolor="#EEEEEE" align=center colspan=5>
                                    <input type="password" name="contrasena" >
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#CCEECC" align=center colspan=1>
                                    <font FACE="arial" SIZE=2 color="#000044"> <b>Direccion:</b></font>
                                </td>
                                <td bgcolor="#EEEEEE" align=center colspan=5>
                                    <input type="text" name="direccion" required>
                                </td>
                            </tr>

                            <tr>
                                <td bgcolor="#EEEEEE" align=center colspan=6>
                                    <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/index.php" role="button">
                                        <i class="fas fa-angle-double-left"></i>
                                        <span class="pl-3">Volver</span>
                                    </a>
                                    <input type="hidden" name="enviado" value="S1">
                                    <button style="background-color:#281E5D; color:white" value="Registrar" type="submit" class="btn btn-lg" name="Registrar"><i style="background-color:#281E5D; color:white" class="fas fa-save"></i><span class="pl-3">Guardar</span></button>
                                    <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/interfaces/iniciar_sesion.php" role="button">
                                        <i class="fas fa-sign-in-alt"></i>
                                        <span class="pl-2">Iniciar Sesion</span>
                                    </a>

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
