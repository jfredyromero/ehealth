<?php
    $conexion = $_SERVER['DOCUMENT_ROOT']."/ehealth/procesos/conexion.php";
    include $conexion;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
    $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>eHealth</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="/eHealth/static/css/styles.css" rel="stylesheet">
    <link rel="icon" href="../static/img/favicon.png" type="image/gif" />
</head>

<body background="/eHealth/static/img/background.jpg">
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
                                </ul>
                <ul class="navbar-nav">
                </ul>
            </div>
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
                <td valign="top" align=center width=80% colspan=6 >
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


                <form method=POST action="validar_sesion.php">
                         <tr>
                            <td bgcolor="#FFFFFF" align=center colspan=3>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Usuario:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=3>
                                <input type="text" name="user" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#FFFFFF" align=center colspan=3>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Contraseña:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center colspan=3>
                                 <input type="password" name="contrasena"  required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center colspan=6>
                                <button style="background-color:#281E5D; color:white" value="Registrar" type="submit" class="btn btn-lg" name="Registrar"><i style="background-color:#281E5D; color:white" class="fas fa-user-plus"></i><span class="pl-3">Iniciar sesión</span></button>
                                <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/index.php" role="button">
                                    <i class="fas fa-angle-double-left"></i>
                                    <span class="pl-3">Volver</span>
                                </a>
                            </td>
                </form> 
                            
            </table>
        </div>
</html>