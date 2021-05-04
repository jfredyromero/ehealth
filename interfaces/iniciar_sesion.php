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
                                <font color=white>Inicio de sesión de usuarios</font>
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align=center width=80% colspan=6 style="color:red;" >
                             <?php
                                if ((isset($_GET["mensaje"]))){
                                    $mensaje = $_GET["mensaje"];
                                    if ($mensaje == 1)
                                        echo "El password del usuario no coincide.";
                                    if ($mensaje == 2)
                                        echo "No hay usuarios con el login (usuario) ingresado.";
                                    if ($mensaje == 3)
                                        echo "No se ha logueado en el Sistema. Por favor ingrese los datos.";
                                }
                            ?>
                        </td>
                    </tr>
                    <form method=POST action="/ehealth/procesos/validar_sesion.php">
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=3>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Usuario:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=3>
                                <input type="text" name="user" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center colspan=3>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Contraseña:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=3>
                                 <input type="password" name="contrasena"  required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center colspan=6>
                                <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/index.php" role="button">
                                    <i class="fas fa-angle-double-left"></i>
                                    <span class="pl-3">Volver</span>
                                </a>
                                <button style="background-color:#281E5D; color:white" type="submit" class="btn btn-lg"><i style="background-color:#281E5D; color:white" class="fas fa-sign-in-alt"></i><span class="pl-3">Iniciar sesión</span></button>
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
