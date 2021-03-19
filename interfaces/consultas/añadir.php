<?php
    $root = $_SERVER['DOCUMENT_ROOT']."/eHealth/static/php/conexion.php";
    include $root;  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
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
                        <li class="nav-item">
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
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/eHealth/interfaces/probabilidades/probabilidades.php">Probabilidades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/eHealth/interfaces/rangos/rangos.php">Rangos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><strong>Username</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Salir</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div id="page-content">
                <table width="80%" align=center cellpadding=5 border=1>
                    <tr>
                        <td valign="top" align=center width=80& colspan=6>
                            <img src="/eHealth/static/img/logo.png" width=800 height=250>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" align=center width=80& colspan=6 bgcolor="#281E5D">
                            <h1>
                                <font color=white>Añadir Dispositivo</font>
                            </h1>
                        </td>
                    </tr>

                    <?php
                        if ((isset($_POST["enviado"]))){  // Ingresa a este if si el formulario ha sido enviado..., al ingresar actualiza los datos ingresados en el formulario, en la base de datos.
                            $enviado = $_POST["enviado"];
                            if ($enviado == "S1"){
                                $Id_Tarj = $_POST["Id"];  // en estas variables se almacenan los datos de fechas recibidos del formulario HTML inicial
                                $Estado_Tarj = $_POST["Estado"];

                                $mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                                // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos.
                                // se actualiza la tabla de valores m�ximos
                                $sql1="INSERT into dispositivos (id,estado) VALUES ('$Id_Tarj', '$Estado_Tarj')";
                                // la siguiente l�nea ejecuta la consulta guardada en la variable sql1, con ayuda del objeto de conexi�n a la base de datos mysqli
                                $result1 = $mysqli->query($sql1);
                                if ($result1 == 1){
                                    $mensaje = "Dispositivo añadido correctamente";
                                }
                                else{
                                    $mensaje = "¡ERROR! Dispositivo no se pudo agregar";
                                }
                                header('Location: añadir.php?mensaje='.$mensaje);

                            }   // FIN DEL IF, si ya se han recibido los datos del formulario
                        }   // FIN DEL IF, si la variable enviado existe, que es cuando ya se env�o el formulario
                        if ((isset($_GET["mensaje"]))){
                            $mensaje = $_GET["mensaje"];
                            echo '<tr>
                                <td bgcolor="#EEEEFF" align=center colspan=2>
                                        <font FACE="arial" SIZE=2 color="#000048"> <b>'.$mensaje.'</b></font>
                                        </td>
                                </tr>';
                        }
                    ?>

                    <form method=POST action="añadir.php">
                        <tr>
                            <td bgcolor="#CCEECC" align=center>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>ID:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <input type="number" name="Id" required>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#CCEECC" align=center>
                                <font FACE="arial" SIZE=2 color="#000044"> <b>Estado:</b></font>
                            </td>
                            <td bgcolor="#EEEEEE" align=center>
                                <div class="dropdown">
                                    <select class="btn btn-secondary" name="Estado">
                                        <option value="1" >Activo</option>
                                        <option value="0" >Inactivo</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#EEEEEE" align=center colspan=2>
                                <input type="hidden" name="enviado" value="S1">
                                <input type="submit" value="añadir" name="Añadir">
                            </td>
                        </tr>
                    </form>

                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
