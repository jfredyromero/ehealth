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
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="/eHealth/interfaces/consultas/ultimos.php">
                            Últimos
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Consultas
                        </a>
                         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/eHealth/interfaces/consultas/ultimos.php">Últimos</a>
                            <a class="dropdown-item" href="/eHealth/interfaces/consultas/fechas.php">Fechas</a>
                            <a class="dropdown-item" href="/eHealth/interfaces/consultas/dispositivos.php">Dispositivos</a>
                        </div> -->
                    <!-- </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/eHealth/interfaces/probabilidades/probabilidades.php">Probabilidades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/eHealth/interfaces/rangos/rangos.php">Rangos</a>
                    </li> --> -->
                </ul>
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#"><strong>Username</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Salir</a>
                    </li> -->
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
                                <button style="background-color:#281E5D; color:white" value="Registrar" type="submit" class="btn btn-lg" name="Registrar"><i style="background-color:#281E5D; color:white" class="fas fa-user-plus"></i><span class="pl-3">Guardar</span></button>
                                <a class="btn btn-lg" style="background-color:#281E5D; color:white" href="/ehealth/procesos/iniciar_sesion.php" role="button">
                                    <i class="fas fa-plus-circle"></i>
                                    <span class="pl-3">Iniciar Sesion</span>
                                </a>
                               
                            </td>
                        </tr>
                    </form>
            </table>
        </div>
</html>