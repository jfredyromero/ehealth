<?php
    $root = $_SERVER['DOCUMENT_ROOT'] . "/eHealth/static/php/conexion.php";
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
                    <td valign="top" align=center width=80% colspan=6>
                        <img src="/eHealth/static/img/logo.png" width=800 height=250>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align=center width=80% colspan=6 bgcolor="#281E5D">
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

                        $sql5 = "SELECT estado from datos_dispositivos WHERE id= $id";
                        $result5 = $mysqli->query($sql5);
                        $row5 = $result5->fetch_array(MYSQLI_NUM);
                        if ($row5 == NULL) {
                            unset($_GET["submit"]);
                        }
                    }
                    ?>
                    <form method="GET">
                        <td style="border: none;" valign="top" align=center colspan=3>
                        </td>
                        <td style="border: none;" valign="center" align=right colspan=1>
                            <input type="number" class="form-control" name="id_tarjeta" placeholder="ID de la tarjeta..." required>
                        </td>
                        <td style="border: none;" valign="top" align=center colspan=2>
                            <button style="background-color:#281E5D; color:white" class="btn" type="submit"><i class="fas fa-search"></i><span class="pl-3" >Buscar</span></button>
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
                        <b>Ubicación</b>
                    </td>
                    <td valign="center" align=center bgcolor="#E1E1E1">
                        <b>Estado</b>
                    </td>
                    <td valign="center" align=center bgcolor="#E1E1E1">
                        <b>Fecha de último registro</b>
                    </td>
                    <td valign="center" align=center bgcolor="#E1E1E1" width=80px>
                        <b>Editar</b>
                    </td>
                    <td valign="center" align=center bgcolor="#E1E1E1" width=80px>
                        <b>Eliminar</b>
                    </td>
                </tr>

                <?php

                $mysqli1 = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
                // la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
                $sql1 = "SELECT * from datos_dispositivos order by id"; // Aqu� se ingresa el valor recibido a la base de datos.
                //
                // la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
                $result1 = $mysqli->query($sql1);
                // la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
                // tenga alg�n registro resultante. Como la consulta arroja 5 resultados, los �ltimos que tenga la tabla, se ejecutar� 5 veces el siguiente ciclo while.
                // el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente
                if (isset($_GET["submit"]) && !empty($_GET["submit"])) {
                    $sql2 = "SELECT MAX(fecha) from datos_medidos WHERE ID_TARJ= $id";
                    $result2 = $mysqli->query($sql2);
                    $row2 = $result2->fetch_array(MYSQLI_NUM);
                    $fecha = $row2[0];
                    $sql3 = "SELECT estado from datos_dispositivos WHERE id= $id";
                    $result3 = $mysqli->query($sql3);
                    $row3 = $result3->fetch_array(MYSQLI_NUM);
                    $estado = $row3[0];
                ?>
                    <tr>
                        <td valign="center" align=center>
                            <?php echo $id; ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo "1"; ?>
                        </td>
                        <td valign="top" align=center>
                            <?php
                            if ($estado == 1) {
                            ?>
                                <img src="/eHealth/static/img/comprobado.png" width=32 height=32>
                            <?php
                            } else {
                            ?>
                                <img src="/eHealth/static/img/cancelar.png" width=32 height=32>

                            <?php
                            }
                            ?>
                        </td>
                        <td valign="center" align=center>
                            <?php echo $fecha; ?>
                        </td>
                        <td valign="center" align=center>
                            <a href="#">
                                <img src="/eHealth/static/img/dibujar.png" width=32 height=32>
                            </a>
                        </td>
                        <td valign="center" align=center>
                            <a href="#">
                                <img src="/eHealth/static/img/basura.png" width=32 height=32>
                                <a>
                        </td>

                    </tr>
                    <?php
                } else {
                    $contador = 0;
                    while ($row1 = $result1->fetch_array(MYSQLI_NUM)) {
                        $ID_TARJ = $row1[0];
                        $estado = $row1[1];
                        // $ubi = $row1[2];
                        $contador++;
                        $sql2 = "SELECT MAX(fecha) from datos_medidos WHERE ID_TARJ= $contador";
                        $result2 = $mysqli->query($sql2);
                        $row2 = $result2->fetch_array(MYSQLI_NUM);
                        $fecha = $row2[0];
                    ?>
                        <tr>
                            <td valign="center" align=center>
                                <?php echo $ID_TARJ; ?>
                            </td>
                            <td valign="center" align=center>
                                <?php echo "1"; ?>
                            </td>
                            <td valign="top" align=center>
                                <?php
                                if ($estado == 1) {
                                ?>
                                    <img src="/eHealth/static/img/comprobado.png" width=32 height=32>
                                <?php
                                } else {
                                ?>
                                    <img src="/eHealth/static/img/cancelar.png" width=32 height=32>

                                <?php
                                }
                                ?>
                            </td>
                            <td valign="center" align=center>
                                <?php echo $fecha; ?>
                            </td>
                            <td valign="center" align=center>
                                <input type="image" name="botondeenvio" src="/eHealth/static/img/dibujar.png" width=32 height=32>
                            </td>
                            <td valign="center" align=center>
                                <img src="/eHealth/static/img/basura.png" width=32 height=32>
                            </td>

                        </tr>

                <?php
                    }
                }
                ?>

                <tr height=20>
                </tr>
                <tr>
                    <td style="border: none;" valign="top" align=center colspan=4>
                    </td>
                    <td style="border: none;" valign="top" align=center colspan=2>
                        <a class="btn btn-lg btn-block" style="background-color:#281E5D; color:white" href="/eHealth/interfaces/consultas/añadir.php" role="button">
                            <i class="fas fa-plus-circle"></i>
                            <span class="pl-3">Nuevo</span>
                        </a>
                    </td>
                </tr>
                <tr height=20>
                </tr>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
</body>

</html>
